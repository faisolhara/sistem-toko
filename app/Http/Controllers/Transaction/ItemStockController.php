<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Transaction\ItemStock;
use App\Service\Transaction\UomService;

class ItemStockController extends Controller
{
    const URL       = 'item-stock';
    const RESOURCE  = 'Item Stock';

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
        $query = \DB::table('item_stock')
                    ->select('item_stock.*', 'mst_item.item_code', 'mst_item.item_name', 'mst_uom.uom_code')
                    ->leftJoin('mst_item', 'mst_item.item_id', '=', 'item_stock.item_id')
                    ->leftJoin('mst_uom', 'mst_uom.uom_id', '=', 'mst_item.uom_id')
                    ->orderBy('uom_name');

        if (!empty($filters['itemName'])) {
            $query->where('mst_item.item_name', 'like', '%'.$filters['itemName'].'%');
        }

        if (!empty($filters['itemCode'])) {
            $query->where('mst_item.item_code', 'like', '%'.$filters['itemCode'].'%');
        }

        if (!empty($filters['stockLessThan'])) {
            $query->where('item_stock.stock', '<=', $filters['stockLessThan']);
        }

        if (!empty($filters['stockMoreThan'])) {
            $query->where('item_stock.stock', '<=', $filters['stockLessThan']);
        }

        return view('transaction/item-stock.index',[
            "models"        => $query->paginate(10),
            "filters"       => $filters,
            "url"           => self::URL,
            "resource"      => self::RESOURCE,
        ]);
    }
}
