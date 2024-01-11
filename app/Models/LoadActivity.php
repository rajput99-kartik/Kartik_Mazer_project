<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadActivity extends Model
{
    use HasFactory;
    
    function shipmentDetail(){
        return $this->hasMany('App\Models\Shipment','id', 'shipment_id_load');
    }
}
