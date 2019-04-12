<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Model\Master\MasterItem;

class ItemStock extends Model
{
    //
    protected $table        = 'item_stock';
    protected $primaryKey   = 'item_stock_id';
    public $timestamps      = false;

    public function item(){
        return $this->belongsTo(MasterItem::class, 'item_id');
    }
}