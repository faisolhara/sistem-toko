<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\MasterItem;
use App\Model\Transaction\PaymentHeader;
use App\Model\Transaction\PaymentLine;
use App\Model\Transaction\ItemStock;
use App\Service\Master\SupplierService;
use App\Service\Master\MasterItemService;
use App\Service\Master\UomService;
use App\Service\Master\ConversionService;
use App\Service\Numbering;

class PaymentController extends Controller
{
    const URL       = 'payment';
    const RESOURCE  = 'Payment';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'view'])) {
            abort('403');
        }

        if ($request->isMethod('post')) {
            $request->session()->put('filters', $request->all());
            return redirect(self::URL.'?page=1');
        } elseif (empty($request->get('page'))) {
            $request->session()->forget('filters');
        }
        $filters = $request->session()->get('filters');
        $query = \DB::table('trans_payment_header')
                    ->select('trans_payment_header.*', 'mst_supplier.supplier_name')
                    ->orderBy('trans_payment_header.created_date', 'desc');

        if (!empty($filters['receiptNumber'])) {
            $query->where('trans_payment_header.payment_number', 'like', '%'.$filters['receiptNumber'].'%');
        }

        if (!empty($filters['dateFrom'])) {
            $dateFrom = new \DateTime($filters['dateFrom']);
            $query->where('trans_payment_header.created_date', '>=', $dateFrom->format('Y-m-d 00:00:00'));
        }

        if (!empty($filters['dateTo'])) {
            $dateTo = new \DateTime($filters['dateTo']);
            $query->where('trans_payment_header.created_date', '<=', $dateTo->format('Y-m-d 23:59:59'));
        }

        return view('transaction/payment.index',[
            "models"        => $query->paginate(10),
            "filters"       => $filters,
            "url"           => self::URL,
            "resource"      => self::RESOURCE,
        ]);
    }

    public function add(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'add'])) {
            abort('403');
        } 

        $model              = new PaymentHeader();
        
        return view('transaction/payment.add',[
            "model"           => $model,
            "title"           => trans('fields.add'),
            "url"             => self::URL,
            "itemOptions"     => MasterItemService::getItem(),
            "uomOptions"      => UomService::getUom(),
        ]);

    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        }  

        $model = PaymentHeader::find($id);

        return view('transaction/payment.add',[
            "model"           => $model,
            "title"           => trans('fields.edit'),
            "url"             => self::URL,
            "itemOptions"     => MasterItemService::getItem(),
            "uomOptions"      => UomService::getUom (),
        ]);
    }

    public function save(Request $request)
    {
        // dd($request->all());
        if (!\Gate::allows('access', [self::RESOURCE, 'add']) && !\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $id     = intval($request->get('id'));
        
        $this->validate($request, [
            'receiptDate'    => 'required|date',
            'supplierId'     => 'required',
            'description'    => 'max:255',
        ]);

        if(empty($request->get('itemId'))){
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.item-required')]);
        }

        $now = new \DateTime();  

        \DB::beginTransaction();

        if(empty($id)){
            $model                     = new PaymentHeader();
            $model->created_by         = \Auth::user()->id;
            $model->created_date       = $now;
            $model->payment_number= $this->getReceiptNumber($model);
        }else{
            $model                     = PaymentHeader::find($id);
            $model->last_updated_by    = \Auth::user()->id;
            $model->last_updated_date  = $now;
        }

        $model->receipt_date = !empty($request->get('receiptDate')) ? new \DateTime($request->get('receiptDate')) : new \DateTime();
        $model->supplier_id  = $request->get('supplierId');
        $model->description  = $request->get('descriptionHeader');
        
        try{
            $model->save();
        } catch(\Exception $e) {
            \DB::rollBack();
        }

        $idDetail = $request->get('idDetail', []);
        foreach ($model->lines()->get() as $line) {
            $index = array_search($line->payment_line_id, $idDetail);
            $receiptQuantity = intval(str_replace('.', '', $request->get('receiptQuantity')[$index]));
            if ($index !== false) {
                $itemStock = $this->getModelItemStock($line->item_id);
                if($receiptQuantity < $line->receipt_quantity){
                    if($itemStock->stock < $receiptQuantity){
                        \DB::rollBack();
                        return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.item-stock-not-enough')]);
                    }
                    $itemStock->stock -= ConversionService::conversion($line->uom_id, $line->item_id, $line->receipt_quantity - $receiptQuantity);
                }else if($receiptQuantity > $line->receipt_quantity){
                    $itemStock->stock +=  ConversionService::conversion($line->uom_id, $line->item_id, $receiptQuantity - $line->receipt_quantity);
                }

                try{
                    $itemStock->save();
                } catch(\Exception $e) {
                    \DB::rollBack();
                }

                $line->item_id          = $request->get('itemId')[$index];
                $line->uom_id           = $request->get('uomId')[$index];
                $line->receipt_quantity = $receiptQuantity;
                $line->price            = intval(str_replace('.', '', $request->get('price')[$index]));
                $line->description      = $request->get('description')[$index];
                $line->last_updated_date = $now;
                $line->last_updated_by = \Auth::user()->id;
                try{
                    $line->save();
                } catch(\Exception $e) {
                    \DB::rollBack();
                }


                
            } else {
                if($itemStock === null || $itemStock->stock < $line->receipt_quantity){
                    \DB::rollBack();
                    return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.item-stock-not-enough')]);
                }
                $itemStock = ItemStock::where('item_id', '=', $line->item_id)->first();
                $itemStock->stock -= $line->receipt_quantity;

                try{
                    $itemStock->save();
                } catch(\Exception $e) {
                    \DB::rollBack();
                }

                $line->delete();
            }
        }

        $uomId= $request->get('uomId');
        for($index = 0; $index < count($uomId); $index++) {
            if (empty($idDetail[$index])) {
                $line            = new PaymentLine();
                $line->payment_header_id = $model->payment_header_id;
                $line->item_id          = $request->get('itemId')[$index];
                $line->uom_id           = $request->get('uomId')[$index];
                $line->receipt_quantity = intval(str_replace('.', '', $request->get('receiptQuantity')[$index]));
                $line->price            = intval(str_replace('.', '', $request->get('price')[$index]));

                $line->created_date = $now;
                $line->created_by = \Auth::user()->id;

                try{
                    $line->save();
                } catch(\Exception $e) {
                    \DB::rollBack();
                }

                $itemStock = $this->getModelItemStock($line->item_id);
                $itemStock->stock += ConversionService::conversion($line->uom_id, $line->item_id, $line->receipt_quantity);
                try{
                    $itemStock->save();
                } catch(\Exception $e) {
                    \DB::rollBack();
                }
            }
        }
        \DB::commit();

        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.payment').' '.$model->payment_number])
            );

        return redirect(route('payment-index'));
    }

    private function getReceiptNumber(PaymentHeader $model){
        $createdDate = $model->created_date instanceof \DateTime ? $model->created_date : new \DateTime($model->created_date);
        $count        = \DB::table('trans_payment_header')
                            ->where('created_date', '>=', $createdDate->format('Y-01-01 00:00:00'))
                            ->where('created_date', '<=', $createdDate->format('Y-12-31 23:59:59'))
                            ->count();

        return 'RCI.'.$createdDate->format('y').Numbering::getStringNumber($count+1, 6);
    }

    private function getModelItemStock($itemId){
        $model = ItemStock::where('item_id', '=', $itemId)->first();
        if($model === null){
            $model = new ItemStock();
            $model->item_id = $itemId;
            $model->created_date = new \DateTime();
            $model->created_by   = \Auth::user()->id;
        }
        return $model;
    }
}
