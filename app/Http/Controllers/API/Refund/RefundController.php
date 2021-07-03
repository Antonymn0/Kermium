<?php

namespace App\Http\Controllers\API\Refund;

use App\Models\Refund;
use Illuminate\Http\Request;
use App\Events\RefundCreated;
use App\Events\RefundUpdated;
use App\Events\RefundDestroyed;
use App\Http\Requests\RefundRequest\ValidateRefundRequest;
use App\Http\Controllers\Controller;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refunds = Refund::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true, 
            'message'=> 'A list of refund requests',
            'data'=>$refunds], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Order\ValidateRefundRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateRefundRequest $request)
    {
        $data = $request->validated();        
        $refund = Refund::create($data);
        event(new RefundCreated($refund));
        return response()->json([
            'success'=> true,
            'message'=> 'Refund created successfuly.',
            'data'=>$refund],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $refund = Refund::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=>'A single refund request retrieved successfuly.',
            'data'=>$refund], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Order\ValidateRefundRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateRefundRequest $request, $id)
    {
        $data = $request->validated();
        $refund = Refund::findOrFail($id);
        $refund->update($data);
        event(new RefundUpdated($refund));
        return response()->json([
            'success'=> true ,
            'message'=>'Refund updated successfuly.',
            'data'=>$refund], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $refund = Refund::findOrFail($id);
        $refund->delete();
        event(new RefundDestroyed($refund));
        return response()->json([
            'success'=> true,
            'message'=> 'Refund deleted successfuly.',
            'data'=>$refund], 200);
    }
}
