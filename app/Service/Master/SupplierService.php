<?php 

namespace App\Service\Master;

class SupplierService
{
    public static function getSupplier()
    {
        return \DB::table('mst_supplier')
                ->where('is_active', '=', TRUE)
                ->orderBy('supplier_name')
                ->get();
    }
}