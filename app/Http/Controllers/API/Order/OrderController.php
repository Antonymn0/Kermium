<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\OrderCreated;
use App\Events\OrderUpdated;
use App\Events\OrderDestroyed;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Order\ValidateOrder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true, 
            'message'=> 'A list of orders',
            'data'=>$order], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Order\ValidateOrder;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateOrder $request)
    {
        $data = $request->validated(); 
        if(isset($data['sample_file'])){
            $pathToFile = $request->file('sample_file')->store('UserFiles', 'public');
            $data['sample_file']= $pathToFile;            
        } 
                    
        $order= Order::create($data);
        event(new OrderCreated($order));
        return response()->json([
            'success'=> true,
            'message'=> 'Order created successfuly',
            'data'=>$order],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=>'A single order retrieved successfuly',
            'data'=>$order], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Order\ValidateOrder;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateOrder $request, $id)    
    {   
        $data = $request->validated();
        $order = Order::findOrFail($id);
        if(isset($data['sample_file'])){
            $pathToFile = $request->file('sample_file')->store('UserFiles', 'public');
            $data['sample_file']= $pathToFile;
        } 
        $order->update($data);
        event(new OrderUpdated($order));
        return response()->json([
            'success'=> true, 
            'message'=>'Order updated successfuly',
            'data'=>$order], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        event(new OrderDestroyed($order));
        return response()->json([
            'success'=> true,
            'message'=> 'Order deleted successfuly',
            'data'=>$order], 200);
    }
}

