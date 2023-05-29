<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Musics extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'title',
        'artist',
        'genre',
        'genres',
        'link',
        'spotify',
        'img',
        'term',
        'review',
        'hot',
        'status',
    ];
}
