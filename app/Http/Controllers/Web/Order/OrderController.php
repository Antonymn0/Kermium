<?php

namespace App\Http\Controllers\Web\Order;

use App\Models\Order;
use Inertia\Inertia;
use App\Helpers\DashboardFilter;
use Illuminate\Http\Request;
use App\Events\OrderCreated;
use App\Events\OrderUpdated;
use App\Events\OrderDestroyed;
use App\Http\Controllers\Controller;
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
        return Inertia::render('Orders/Order', DashboardFilter::allOrders());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Orders/components/NewOrder');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

       return Inertia::render('Orders/components/EditOrder', [
            'order' => $order
        ]);
    }   

    /**
     * Retrieve on hold orders from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function onHold()
    {
        
        return Inertia::render('Orders/OnHold', DashboardFilter::onHold());
    }

    /**
     * Retrieve on inProgress orders from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function inProgress()
    {
        
        return Inertia::render('Orders/inProgress', DashboardFilter::inProgress());
    }

    /**
     * Retrieve on revisions orders from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function revisions()
    {
        
        return Inertia::render('Orders/Revisions', DashboardFilter::revisions());
    }

    /**
     * Retrieve on complete orders from storage.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {
        
        return Inertia::render('Orders/Complete', DashboardFilter::complete());
    }





}
