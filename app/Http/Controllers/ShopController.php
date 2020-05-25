<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Shop;
use App\Http\Requests\StoreShop;

const DISTANCE = 0.000011;
 
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 引数から緯度経度取得
        $s_latitude = $request->input('latitude');
        $s_longitude = $request->input('longitude');
        
        // 緯度経度が引数にあるならその値を中心に-0.000011 ~ 0.000011の範囲でお店の名前と座標を取得する。引数がなければ全件取得する。
        if(!empty($s_latitude) && !empty($s_longitude)) {
          $shops = Shop::getShops($s_latitude, $s_longitude);
        } else {
          $shops = Shop::all();
        }

        return response()->json([
            'message' => 'ok',
            'data' => $shops
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShop $request)
    {
        $shops = Shop::create($request->all());
        return response()->json([
            'message' => 'Shop created successfully',
            'data' => $shops
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shops = Shop::find($id);
        if ($shops) {
            return response()->json([
                'message' => 'ok',
                'data' => $shops
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Shop not found',
            ], 404);
        }
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShop $request, $id)
    {
        $update = [
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ];
        $shops = Shop::where('id', $id)->update($update);
        if ($shops) {
            return response()->json([
                'message' => 'Shop updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Shop not found',
            ], 404);
        }
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shops = Shop::where('id', $id)->delete();
        if ($shops) {
            return response()->json([
                'message' => 'Shop deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Shop not found',
            ], 404);
        }
    }
}
