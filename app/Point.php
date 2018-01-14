<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'name', 'previous_point_id', 'next_point_id',
    ];
}
