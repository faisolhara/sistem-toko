<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Model\Master\MasterSupplier;

class PaymentHeader extends Model
{
    //
    protected $table        = 'trans_payment_header';
    protected $primaryKey   = 'payment_header_id';
    public $timestamps      = false;

    public function lines(){
        return $this->hasMany(PaymentLine::class, 'payment_header_id');
    }
}