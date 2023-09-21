<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\Agency;
use App\Models\User;

class AgencyDetail extends Model
{
    use HasFactory;
    use Loggable;

    protected $table="agency_details";

    protected $fillable = [
        'user_id',
        'agency_id',
        'team_role',
        'a_detail_name',
        'ed',
    ];

}
