<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    //
    protected $table        = 'mst_conversion';
    protected $primaryKey   = 'conversion_id';
    public $timestamps      = false;

    public function accessControl(){
        return $this->hasMany(AccessControl::class, 'conversion_id');
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

    public function uomFrom(){
        return $this->belongsTo(MasterUom::class, 'uom_id_from');
    }

    public function uomTo(){
        return $this->belongsTo(MasterUom::class, 'uom_id_to');
    }

}