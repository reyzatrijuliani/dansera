<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DancePlace extends Model
{
    protected $fillable = [
        'name',
        'location',
        'price_per_hour',
        'description',
    ];
}