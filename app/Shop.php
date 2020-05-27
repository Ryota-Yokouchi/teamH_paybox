<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'category_name',
        'latitude',
        'longitude',
    ];
   
    public static function getCategoryShops($latitude, $longitude, $range, $category)
    {  
       if(!gettype($latitude) == "double" || !gettype($longitude) == "double" || 
          !gettype($range) == "double" || !gettype($category) == "string") {
         $shops = [];
         return $shops;
       }       

       $latitude_min = $latitude - $range;
       $latitude_max = $latitude + $range;
       $longitude_min = $longitude - $range;
       $longitude_max = $longitude + $range;

       $shops = self::select(['name',
                              'category_name',
                              'latitude',
                              'longitude',
                             ])
                        ->join('categories', 'shops.category_id', '=', 'categories.id')
                        ->where('category_name', $category)
                        ->whereBetween('latitude', [$latitude_min, $latitude_max])
                        ->whereBetween('longitude', [$longitude_min, $longitude_max])
                        ->get();
       return $shops; 
    }
    public static function getShops($latitude, $longitude, $range)
    {
       if(!gettype($latitude) == "double" || !gettype($longitude) == "double" || 
          !gettype($range) == "double") {
         $shops = [];
         return $shops;
       }
       $latitude_min = $latitude - $range;
       $latitude_max = $latitude + $range;
       $longitude_min = $longitude - $range;
       $longitude_max = $longitude + $range;
       
       $shops = self::select(['name',
                              'category_name',
                              'latitude',
                              'longitude',
                             ])
                        ->join('categories', 'shops.category_id', '=', 'categories.id')
                        ->whereBetween('latitude', [$latitude_min, $latitude_max])
                        ->whereBetween('longitude', [$longitude_min, $longitude_max])
                        ->get();
       return $shops;
    }
    public static function getCategorys($category)
    {
       if(!gettype($category) == "string") {
         $shops = [];
         return $shops;
       }
      $shops = self::select(['name',
                             'category_name',
                             'latitude',
                             'longitude',
                             ])
                        ->join('categories', 'shops.category_id', '=', 'categories.id')
                        ->where('category_name', $category)
                        ->get();
       return $shops;
    }
}
