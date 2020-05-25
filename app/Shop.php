<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];
    
    public static function getShops($latitude, $longitude)
    {
       $distance = 0.000011;
       $latitude_min = $latitude - $distance;
       $latitude_max = $latitude + $distance;
       $longitude_min = $longitude - $distance;
       $longitude_max = $longitude + $distance;
       
       $shops = self::select(['name',
                              'latitude',
                              'longitude',
                             ])
                        ->whereBetween('latitude', [$latitude_min, $latitude_max])
                        ->whereBetween('longitude', [$longitude_min, $longitude_max])
                        ->get();
       return $shops;
    }
}
