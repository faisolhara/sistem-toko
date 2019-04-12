<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Model\Master\MasterItem;
use App\Model\Master\MasterUom;

class PaymentLine extends Model
{
    //
    protected $table        = 'trans_payment_line';
    protected $primaryKey   = 'payment_line_id';
    public $timestamps      = false;

    public function header(){
        return $this->belongsTo(PaymentHeader::class, 'payment_header_id');
    }

    public function item(){
        return $this->belongsTo(MasterItem::class, 'item_id');
    }

    public function uom(){
        return $this->belongsTo(MasterUom::class, 'uom_id');
    }
}