<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'stock',
    ];
}