<?php 

namespace App\Service\Master;

class RoleService
{
    public static function getActiveRole()
    {
        return \DB::table('mst_role')
                ->where('is_active', '=', 1)
                ->orderBy('role_name')
                ->get();
    }
}