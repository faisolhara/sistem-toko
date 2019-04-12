<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class MasterUom extends Model
{
    //
    protected $table        = 'mst_uom';
    protected $primaryKey   = 'uom_id';
    public $timestamps      = false;

    public function parentBase(){
        return $this->belongsTo(MasterUom::class, 'parent_base');
    }
}