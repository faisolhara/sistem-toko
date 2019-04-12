<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    const URL       = 'master-conversion';
    const RESOURCE  = 'Master Conversion';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUom(Request $request)
    {
        $uomTo = \DB::table('mst_uom')
                    ->select('uom_to.*')
                    ->join('mst_uom as uom_to', 'uom_to.uom_id', '=', 'mst_uom.parent_base')
                    ->where('mst_uom.uom_id', '=', $request->get('uomFrom'))
                    ->first();
        return response()->json($uomTo);
    }

    public function getUomItem(Request $request)
    {
        $data = \DB::table('mst_uom')
                    ->where(function($query) use ($request){
                        $query->where('mst_uom.uom_id', '=', $request->get('uomId'))
                            ->orWhere('mst_uom.parent_base', '=', $request->get('uomId'));
                    })
                    ->get();
        return response()->json($data);
    }

    public function getUomByItem(Request $request)
    {
        $first = \DB::table('mst_uom')
                    ->select('mst_uom.*')
                    ->join('mst_item', 'mst_item.uom_id', '=', 'mst_uom.uom_id')
                    ->where('mst_item.item_id', '=', $request->get('itemId'));
                    
        $data = \DB::table('mst_uom')
                    ->select('mst_uom.*')
                    ->join('mst_uom as parent', 'parent.uom_id', '=', 'mst_uom.parent_base')
                    ->join('mst_item', 'mst_item.uom_id', '=', 'parent.uom_id')
                    ->where('mst_uom.is_base', '=', false)
                    ->where('mst_item.item_id', '=', $request->get('itemId'))
                    ->union($first)
                    ->get();

        return response()->json($data);
    }

}