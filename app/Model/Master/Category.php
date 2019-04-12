<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table        = 'mst_category';
    protected $primaryKey   = 'category_id';
    public $timestamps      = false;

    public function accessControl(){
        return $this->hasMany(AccessControl::class, 'category_id');
    }

    public function canAccess($resource, $privilege)
    {
        foreach ($this->accessControl as $access) {
            if ($access->resource == $resource && $access->privilege == $privilege) {
                return true;
            }
        }
        return false;
    }
}