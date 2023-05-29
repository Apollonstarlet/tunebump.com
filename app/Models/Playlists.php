<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlists extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'title',
        'spotifyId',
        'img',
        'genre',
        'genres',
        'tracks',
        'followers'
    ];
}
