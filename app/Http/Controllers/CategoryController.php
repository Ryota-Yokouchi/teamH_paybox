<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\StoreCategory;
 
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();
        return response()->json([
            'message' => 'ok',
            'data' => $categorys
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = Category::create($request->all());
        return response()->json([
            'message' => 'Book created successfully',
            'data' => $category
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
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'message' => 'ok',
                'data' => $category
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Book not found',
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
    public function update(StoreCategory $request, $id)
    {
        $update = [
            'name' => $request->name
        ];
        $category = Category::where('id', $id)->update($update);
        if ($category) {
            return response()->json([
                'message' => 'Book updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Book not found',
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
        $category = Category::where('id', $id)->delete();
        if ($category) {
            return response()->json([
                'message' => 'Book deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Book not found',
            ], 404);
        }
    }
}
