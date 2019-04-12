<?php 

namespace App\Service\Master;

class UomService
{
    public static function getUom()
    {
        return \DB::table('mst_uom')
                ->where('is_active', '=', TRUE)
                ->orderBy('uom_name')
                ->get();
    }

    public static function getUomNotBase()
    {
        return \DB::table('mst_uom')
                ->where('is_active', '=', TRUE)
                ->where('is_base', '=', FALSE)
                ->orderBy('uom_name')
                ->get();
    }

    public static function getUomIsBase()
    {
        return \DB::table('mst_uom')
                ->where('is_active', '=', TRUE)
                ->where('is_base', '=', TRUE)
                ->orderBy('uom_name')
                ->get();
    }

}