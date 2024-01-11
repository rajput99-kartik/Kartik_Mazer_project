<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use DB;
use App\Models\Ordercategory;
// use Laravel\Fortify\TwoFactorAuthenticatable;
// use Laravel\Jetstream\HasProfilePhoto;
use App\Models\AssignAcPayable;
use App\Models\Agency_detail;
use App\Models\AgencyDetail;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\LogOptions; 
use Spatie\Activitylog\Traits\LogsActivity;
use Auth;

class User extends Authenticatable
{
    
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, LogsActivity;
    // use HasProfilePhoto;    
    // use TwoFactorAuthenticatable;
     use Loggable;
     protected static $recordEvents = ['created','updated','deleted'];
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 
     */

    // protected $appends = [
    //     'profile_photo_url',
    // ];

    // protected $guard_name = 'auth';
    
        public function getActivitylogOptions(): LogOptions{

            $authName = Auth::User();
            $activity = Activity::all();
            //$userName = $activity->subject['name'];

            $lastActivity = Activity::latest()->first();

            $eventName = '';

            $eventName =isset($eventName) ? $eventName : Null  ;
            if(empty($activity)){
                $eventName = 'login' ;
            }

            
            // $userName =isset($userName) ? $userName : Null  ;
            // if(!empty($activity)){
            //     $userName = isset($activity->properties['attributes']['name']) ? $activity->properties['old']['name'] : Null ;
            // }else{
               
            //     $userName = '';
            // }

            return LogOptions::defaults()
            ->useLogName('User Table')
            ->setDescriptionForEvent(fn(string $eventName) => "{$authName->name} {$eventName} User Profile")
            ->logOnly(['name','user_type','status','password','email'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logUnguarded();

        }


    protected $fillable = [
        'name',
        'user_type',
        'status',
        'email',
        'officerid',
        'password',
        'phone',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cat(){
        return $this->hasOne(Ordercategory::class);
    }

    public static function getpermissionGroups(){
        $permission_groups = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();
        return $permission_groups;
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
		//dd($permissions);
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }


    public static function agencyData($id)
    {
        $details = DB::table('agency_details')
            ->select('*')
            ->where('user_id', $id)
            ->get();
        return $permissions;
    }
 

    //This is use only assign account payable
    public function apAssignbyUser(){
        return $this->hasMany(AssignAcPayable::class, 'user_id' , 'id');
    }
    public function apTeamLeader(){
        return $this->hasMany(AssignAcPayable::class, 'ap_user' , 'id');
    }
    public function apTeamAgent(){
        return $this->hasMany(AssignAcPayable::class, 'assign_agent_to' , 'id');
    }
    //This is use only assign account payable End



    //This is use only User Details Data Get
    public function userDetailsdata(){
        return $this->hasMany('App\Models\Userdetail', 'userid');
    }
    //This is use only assign account payable End
    
    
    public function usership(){
        return $this->hasOne('App\Models\Agency_detail',  'user_id', 'id');
      }

    
        
    
   

}
