<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rent_date',
        'rent_time',
        'return_date',
        'actual_return_date',
        'car_id'
    ];
}
