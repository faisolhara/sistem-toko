<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\MasterItem;
use App\Model\Master\ItemPrice;
use App\Service\Master\CategoryService;
use App\Service\Master\UomService;

class MasterItemController extends Controller
{
    const URL       = 'master-item';
    const RESOURCE  = 'Master Item';

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
        $query = \DB::table('mst_item')
                    ->select('mst_item.*', 'mst_uom.uom_code', 'mst_category.category_name')
                    ->leftJoin('mst_uom', 'mst_uom.uom_id', '=', 'mst_item.uom_id')
                    ->leftJoin('mst_category', 'mst_category.category_id', '=', 'mst_item.category_id')
                    ->orderBy('item_name');

        if (!empty($filters['itemName'])) {
            $query->where('mst_item.uom_name', 'like', '%'.$filters['itemName'].'%');
        }

        if (!empty($filters['itemCode'])) {
            $query->where('mst_item.item_code', 'like', '%'.$filters['itemCode'].'%');
        }

        if (!empty($filters['barcode'])) {
            $query->where('mst_item.barcode', 'like', '%'.$filters['barcode'].'%');
        }

        if (!empty($filters['isActive']) || !$request->session()->has('filters')) {
            $query->where('mst_item.is_active', '=', true);
        } else {
            $query->where('mst_item.is_active', '=', false);
        }

        return view('master/master-item.index',[
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

        $model              = new MasterItem();
        $model->is_active   = true;
        
        return view('master/master-item.add',[
            "model"           => $model,
            "title"           => trans('fields.add'),
            "uomOptions"      => UomService::getUomIsBase(),
            "categoryOptions" => CategoryService::getCategory(),
            "url"             => self::URL,
        ]);

    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        }  

        $model = MasterItem::find($id);

        return view('master/master-item.add',[
            "model"           => $model,
            "title"           => trans('fields.edit'),
            "uomOptions"      => UomService::getUomIsBase(),
            "categoryOptions" => CategoryService::getCategory(),
            "url"             => self::URL,
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
            'itemCode'       => 'required|max:200|unique:mst_item,item_code,'.$id.',item_id',
            'itemName'       => 'required|max:255',
            'description'    => 'max:255',
            'uomIdHeader'    => 'required',
            'categoryId'     => 'required',
        ]);

        if(empty($request->get('uomId'))){
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.item-price-required')]);
        }

        $now = new \DateTime();     
        if(empty($id)){
            $model                     = new MasterItem();
            $model->created_by         = \Auth::user()->id;
            $model->created_date       = $now;
        }else{
            $model                     = MasterItem::find($id);
            $model->last_updated_by    = \Auth::user()->id;
            $model->last_updated_date  = $now;
        }

        $model->item_code   = $request->get('itemCode');
        $model->item_name   = $request->get('itemName');
        $model->barcode     = $request->get('barcode');
        $model->description = $request->get('description');
        $model->uom_id      = $request->get('uomIdHeader');
        $model->category_id = $request->get('categoryId');
        $model->is_active   = !empty($request->get('isActive')) ? true : false;
        
        $model->save();

        $idDetail = $request->get('idDetail', []);
        foreach ($model->itemPrice()->get() as $itemPrice) {
            $index = array_search($itemPrice->item_price_id, $idDetail);
            if ($index !== false) {
                $itemPrice->uom_id = $request->get('uomId')[$index];
                $itemPrice->price  = intval(str_replace(',', '', $request->get('price')[$index]));

                if (empty($id)) {
                    $itemPrice->created_date = $now;
                    $itemPrice->created_by = \Auth::user()->id;
                } else {
                    $itemPrice->last_updated_date = $now;
                    $itemPrice->last_updated_by = \Auth::user()->id;
                }
                $itemPrice->save();
            } else {
                $itemPrice->delete();
            }
        }

        $uomId= $request->get('uomId');
        for($index = 0; $index < count($uomId); $index++) {
            if (empty($idDetail[$index])) {
                $itemPrice = new ItemPrice();
                $itemPrice->item_id = $model->item_id;
                $itemPrice->uom_id = $request->get('uomId')[$index];
                $itemPrice->price = intval(str_replace(',', '', $request->get('price')[$index]));
                $itemPrice->is_active = true;

                if (empty($id)) {
                    $itemPrice->created_date = $now;
                    $itemPrice->created_by = \Auth::user()->id;
                } else {
                    $itemPrice->last_updated_date = $now;
                    $itemPrice->last_updated_by = \Auth::user()->id;
                }

                $itemPrice->save();
            }
        }

        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.master-item').' '.$model->item_name])
            );

        return redirect(route('master-item-index'));
    }
}
