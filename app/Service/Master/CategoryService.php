<?php 

namespace App\Service\Master;

class CategoryService
{
    public static function getCategory()
    {
        return \DB::table('mst_category')
                ->where('is_active', '=', TRUE)
                ->orderBy('category_name')
                ->get();
    }
}