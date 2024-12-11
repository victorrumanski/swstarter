<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $fillable = [
        'metric_type',
        'metric_data'
    ];
}