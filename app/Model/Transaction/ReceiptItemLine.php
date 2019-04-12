<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Model\Master\MasterItem;
use App\Model\Master\MasterUom;

class ReceiptItemLine extends Model
{
    //
    protected $table        = 'trans_receipt_item_line';
    protected $primaryKey   = 'receipt_item_line_id';
    public $timestamps      = false;

    public function header(){
        return $this->belongsTo(ReceiptItemHeader::class, 'receipt_item_header_id');
    }

    public function item(){
        return $this->belongsTo(MasterItem::class, 'item_id');
    }

    public function uom(){
        return $this->belongsTo(MasterUom::class, 'uom_id');
    }
}