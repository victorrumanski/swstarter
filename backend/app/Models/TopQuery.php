<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopQuery extends Model
{
    protected $fillable = [
        'query_type',
        'query_string',
        'query_count',
        'percent'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];
}