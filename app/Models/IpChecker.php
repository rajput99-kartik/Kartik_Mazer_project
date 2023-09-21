<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpChecker extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'office',
        'ip_address',
        'whitelisted',
    ];
    
}


