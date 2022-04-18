<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    public $table = 'supplies';

    protected $fillable = [
        'id',
        'name',
        'quantity',
        'email',
        'date',
    ];
}
