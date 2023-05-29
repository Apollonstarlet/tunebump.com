<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subgenres extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mainId',
        'subname',
    ];
}
