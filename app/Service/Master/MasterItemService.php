<?php 

namespace App\Service\Master;

class MasterItemService
{
    public static function getItem()
    {
        return \DB::table('mst_item')
                ->join('mst_uom', 'mst_uom.uom_id', '=', 'mst_item.uom_id')
                ->where('mst_item.is_active', '=', TRUE)
                ->orderBy('item_name')
                ->get();
    }
}