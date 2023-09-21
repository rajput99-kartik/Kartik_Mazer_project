<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\Agency ;
use App\Models\User ;

class Agency_detail extends Model
{
    use HasFactory;
    use Loggable;



    protected $fillable = [
        'user_id',
        'agency_id',
        'team_role',
        'a_detail_name',
        'ed',
    ];


    public function agency(){
        return $this->belongsTo(Agency::class,'id','agency_id')->withDefault();
    }

    public function user(){
        // return $this->belongsTo(user::class,'id','agency_id')->withDefault();
        // $posts = User::whereBelongsTo($users)->get();

        return User::where('id', $agency->user_id)->get();
    }


    public function officData(){
        return $this->hasMany('App\Models\User', 'id', 'user_id');
    }
    

}
