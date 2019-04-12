<?php

namespace App\Model\Transaction;

use Illuminate\Database\Eloquent\Model;

class AdjustmentStockHeader extends Model
{
    //
    protected $table        = 'trans_adjustment_stock_header';
    protected $primaryKey   = 'adjustment_stock_header_id';
    public $timestamps      = false;

    const ADJUSTMENT_PLUS   = 'Adjustment Plus'; 
    const ADJUSTMENT_MIN    = 'Adjustment Min'; 

    public function lines(){
        return $this->hasMany(AdjustmentStockLine::class, 'adjustment_stock_header_id');
    }
}