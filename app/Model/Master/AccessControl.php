<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class AccessControl extends Model
{
    //
    protected $table        = 'access_control';
    protected $primaryKey   = 'access_control_id';
    public $timestamps      = false;

}