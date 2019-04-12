<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Model\Master\MasterItem;
use App\Model\Master\MasterUom;

class AdjustmentStockLine extends Model
{
    //
    protected $table        = 'trans_adjustment_stock_line';
    protected $primaryKey   = 'adjustment_stock_line_id';
    public $timestamps      = false;

    public function header(){
        return $this->belongsTo(AdjustmentStockHeader::class, 'adjustment_stock_header_id');
    }

    public function item(){
        return $this->belongsTo(MasterItem::class, 'item_id');
    }

    public function uom(){
        return $this->belongsTo(MasterUom::class, 'uom_id');
    }
}