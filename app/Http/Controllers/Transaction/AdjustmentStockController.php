<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\MasterItem;
use App\Model\Transaction\AdjustmentStockHeader;
use App\Model\Transaction\AdjustmentStockLine;
use App\Model\Transaction\ItemStock;
use App\Service\Master\MasterItemService;
use App\Service\Master\UomService;
use App\Service\Master\ConversionService;
use App\Service\Numbering;

class AdjustmentStockController extends Controller
{
    const URL       = 'adjustment-stock';
    const RESOURCE  = 'Adjustment Stock';

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
        $query = \DB::table('trans_adjustment_stock_header')
                    ->orderBy('trans_adjustment_stock_header.created_date', 'desc');

        if (!empty($filters['adjustmentNumber'])) {
            $query->where('trans_adjustment_stock_header.adjustment_stock_number', 'like', '%'.$filters['adjustmentNumber'].'%');
        }

        if (!empty($filters['reason'])) {
            $query->where('trans_adjustment_stock_header.reason', 'like', '%'.$filters['reason'].'%');
        }

        if (!empty($filters['dateFrom'])) {
            $dateFrom = new \DateTime($filters['dateFrom']);
            $query->where('trans_adjustment_stock_header.adjustment_date', '>=', $dateFrom->format('Y-m-d 00:00:00'));
        }

        if (!empty($filters['dateTo'])) {
            $dateTo = new \DateTime($filters['dateTo']);
            $query->where('trans_adjustment_stock_header.adjustment_date', '<=', $dateTo->format('Y-m-d 23:59:59'));
        }

        return view('transaction/adjustment-stock.index',[
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

        $model              = new AdjustmentStockHeader();
        
        return view('transaction/adjustment-stock.add',[
            "model"             => $model,
            "title"             => trans('fields.add'),
            "url"               => self::URL,
            "adjustmentOptions" => [AdjustmentStockHeader::ADJUSTMENT_PLUS, AdjustmentStockHeader::ADJUSTMENT_MIN],
            "itemOptions"       => MasterItemService::getItem(),
            "uomOptions"        => UomService::getUom(),
        ]);

    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        }  

        $model = AdjustmentStockHeader::find($id);

        return view('transaction/adjustment-stock.add',[
            "model"             => $model,
            "title"             => trans('fields.edit'),
            "url"               => self::URL,
            "itemOptions"       => MasterItemService::getItem(),
            "adjustmentOptions" => [AdjustmentStockHeader::ADJUSTMENT_PLUS, AdjustmentStockHeader::ADJUSTMENT_MIN],
            "uomOptions"        => UomService::getUom (),
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
            'reason'         => 'required|max:191',
            'adjustmentType' => 'required',
            'adjustmentDate' => 'required|date',
            'description'    => 'max:191',
        ]);

        if(empty($request->get('itemId'))){
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.item-required')]);
        }

        $now = new \DateTime();  

        \DB::beginTransaction();

        if(empty($id)){
            $model                         = new AdjustmentStockHeader();
            $model->created_by             = \Auth::user()->id;
            $model->created_date           = $now;
            $model->adjustment_stock_number = $this->getAdjustmentNumber($model);
        }else{
            $model                     = AdjustmentStockHeader::find($id);
            $model->last_updated_by    = \Auth::user()->id;
            $model->last_updated_date  = $now;
        }

        $model->adjustment_type = $request->get('adjustmentType');
        $model->adjustment_date = !empty($request->get('receiptDate')) ? new \DateTime($request->get('receiptDate')) : new \DateTime();

        $model->reason          = $request->get('reason');
        $model->description     = $request->get('descriptionHeader');
        
        try{
            $model->save();
        } catch(\Exception $e) {
            \DB::rollBack();
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $e->getMessage()]);
        }

        $idDetail  = $request->get('idDetail', []);
        $itemId    = $request->get('itemId');
        for($index = 0; $index < count($itemId); $index++) {
            if (empty($idDetail[$index])) {
                $line                   = new AdjustmentStockLine();
                $line->adjustment_stock_header_id = $model->adjustment_stock_header_id;
                $line->item_id          = $request->get('itemId')[$index];
                $line->uom_id           = $request->get('uomId')[$index];
                $line->adjustment_quantity = intval(str_replace('.', '', $request->get('adjustmentQuantity')[$index]));
                $line->price            = intval(str_replace('.', '', $request->get('price')[$index]));

                $line->created_date = $now;
                $line->created_by = \Auth::user()->id;

                try{
                    $line->save();
                } catch(\Exception $e) {
                    \DB::rollBack();
                    return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $e->getMessage()]);
                }

                $itemStock = $this->getModelItemStock($line->item_id);
                if($model->adjustment_type == AdjustmentStockHeader::ADJUSTMENT_PLUS){
                    $itemStock->stock += ConversionService::conversion($line->uom_id, $line->item_id, $line->adjustment_quantity);
                }elseif($model->adjustment_type == AdjustmentStockHeader::ADJUSTMENT_MIN){
                    if($itemStock->stock < $line->adjustment_quantity){
                        \DB::rollBack();
                        return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.item-stock-not-enough')]);
                    }else{
                        $itemStock->stock -= ConversionService::conversion($line->uom_id, $line->item_id, $line->adjustment_quantity);
                    }
                }
                try{
                    $itemStock->save();
                } catch(\Exception $e) {
                    \DB::rollBack();
                    return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $e->getMessage()]);
                }
            }
        }
        \DB::commit();

        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.adjustment-stock').' '.$model->adjustment_stock_number])
            );

        return redirect(route('adjustment-stock-index'));
    }

    private function getAdjustmentNumber(AdjustmentStockHeader $model){
        $createdDate = $model->created_date instanceof \DateTime ? $model->created_date : new \DateTime($model->created_date);
        $count        = \DB::table('trans_adjustment_stock_header')
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
