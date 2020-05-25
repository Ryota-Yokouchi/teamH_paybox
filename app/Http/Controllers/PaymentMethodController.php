<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Payment_method;
use App\Http\Requests\StorePaymentMethod;
 
class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethod = Payment_method::all();
        return response()->json([
            'message' => 'ok',
            'data' => $paymentMethod
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMethod $request)
    {
        $paymentMethod = Payment_method::create($request->all());
        return response()->json([
            'message' => 'Payment method created successfully',
            'data' => $paymentMethod
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
        $paymentMethod = Payment_method::find($id);
        if ($paymentMethod) {
            return response()->json([
                'message' => 'ok',
                'data' => $paymentMethod
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Payment method not found',
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
    public function update(StorePaymentMethod $request, $id)
    {
        $update = [
            'name' => $request->name,
            'back_rate' => $request->back_rate
        ];
        $paymentMethod = Payment_method::where('id', $id)->update($update);
        if ($paymentMethod) {
            return response()->json([
                'message' => 'Payment Method updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Payment method not found',
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
        $paymentMethod = Payment_method::where('id', $id)->delete();
        if ($paymentMethod) {
            return response()->json([
                'message' => 'Payment method deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Payment method not found',
            ], 404);
        }
    }
}
