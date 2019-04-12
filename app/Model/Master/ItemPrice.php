<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class ItemPrice extends Model
{
    //
    protected $table        = 'mst_item_price_uom';
    protected $primaryKey   = 'item_price_id';
    public $timestamps      = false;

    public function item(){
        return $this->belongsTo(MasterItem::class, 'item_id');
    }
    public function uom(){
        return $this->belongsTo(MasterUom::class, 'uom_id');
    }
}