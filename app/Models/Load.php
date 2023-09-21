<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


use Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;



class Load extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
     
     protected static $recordEvents = ['created','updated','deleted'];
     
     
     public function getActivitylogOptions(): LogOptions
      {

        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;
        
        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'Load';
        }


        return LogOptions::defaults()
        ->useLogName('load-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Load {$eventName} by $uNameData")
        ->logOnly(['user_id', 'load_dat_id','alarm_status','alarm_id', 'search_id','age','ref_no','load_status','load_status_two','agent_name',
            'comment','shipper_price','load_carrier_price','load_rate_range_from', 'load_rate_range_to','distance','post_date','pick_up_date','delivery_date','dat_pick_date',
            'dat_drop_date','load_state_origin','load_state_origin_id','load_zipcode_origin', 'load_state_code','load_city_desti_id','load_city_desti','drop_state_code','load_offer_rate','load_rate_base_on',
            'pallets','load_hight_inches','length_load','o_lat', 'o_long','d_lat','d_long','equipments','equipment_spotrates','full_partial_tl_ltl',
            'load_commodity','weight_load','special_requirement','p_u_hours_comment', 'p_u_hours','load_generate'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
      }
      
      
        protected $fillable = [
            'user_id', 'load_dat_id','alarm_status','alarm_id', 'search_id','age','ref_no','load_status','load_status_two','agent_name',
            'comment','shipper_price','load_carrier_price','load_rate_range_from', 'load_rate_range_to','distance','post_date','pick_up_date','delivery_date','dat_pick_date',
            'dat_drop_date','load_state_origin','load_state_origin_id','load_zipcode_origin', 'load_state_code','load_city_desti_id','load_city_desti','drop_state_code','load_offer_rate','load_rate_base_on',
            'pallets','load_hight_inches','length_load','o_lat', 'o_long','d_lat','d_long','equipments','equipment_spotrates','full_partial_tl_ltl',
            'load_commodity','weight_load','special_requirement','p_u_hours_comment', 'p_u_hours','load_generate'
        ];


        public function usersref(){
            return $this->hasMany('App\Models\User',  'id', 'user_id');
        }

}
