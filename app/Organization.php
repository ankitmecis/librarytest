<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Organization extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'Organization';


    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];
}
