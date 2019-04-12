<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class MasterSupplier extends Model
{
    //
    protected $table        = 'mst_supplier';
    protected $primaryKey   = 'supplier_id';
    public $timestamps      = false;
}