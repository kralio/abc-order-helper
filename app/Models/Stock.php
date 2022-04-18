<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    public $table = 'stock';

    protected $fillable = [
        'date',
        'name',
        'total',
        'ordered',
        'avg_price',
    ];
}
