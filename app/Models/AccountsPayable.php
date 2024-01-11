<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignAcPayable;
use App\Models\AccountPayable;
use App\Models\Carriers;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class AccountsPayable extends Model
{
    use HasFactory;
    use Loggable;


    public function getAPdata(){
        return $this->hasMany('App\Models\AssignAcPayable', 'user_id' , 'assign_to');
    }


    public function getshipmentdata(){
        return $this->hasMany('App\Models\Shipment','user_id','user_id' ); 
        }

    


    
}
