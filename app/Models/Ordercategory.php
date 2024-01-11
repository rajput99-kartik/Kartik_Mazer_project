<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

use App\Models\User;

class Ordercategory extends Model
{
    use HasFactory;
    use Loggable;
    protected $table="order_categories";

    protected $fillable = ['category_name','user_id'];


    // public function category(): BelongsTo
    // {
    //     return $this->hasMany(User::class);
    // }


    public function User()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'id','user_id');

    }


}
