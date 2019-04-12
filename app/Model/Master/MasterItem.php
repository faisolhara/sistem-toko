<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    //
    protected $table        = 'mst_item';
    protected $primaryKey   = 'item_id';
    public $timestamps      = false;

    public function uom(){
        return $this->belongsTo(MasterUom::class, 'uom_id');
    }

    public function category(){
        return $this->belongsTo(MasterCategory::class, 'category_id');
    }

    public function itemPrice(){
        return $this->hasMany(ItemPrice::class, 'item_id');
    }
}