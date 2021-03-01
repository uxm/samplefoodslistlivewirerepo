<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'example_foods';

    protected $fillable = [
    	'name', 'quantity'
    ];
    
}
