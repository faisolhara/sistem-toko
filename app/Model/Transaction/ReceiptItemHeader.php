<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Model\Master\MasterSupplier;

class ReceiptItemHeader extends Model
{
    //
    protected $table        = 'trans_receipt_item_header';
    protected $primaryKey   = 'receipt_item_header_id';
    public $timestamps      = false;

    public function lines(){
        return $this->hasMany(ReceiptItemLine::class, 'receipt_item_header_id');
    }

    public function supplier(){
        return $this->belongsTo(MasterSupplier::class, 'supplier_id');
    }
}