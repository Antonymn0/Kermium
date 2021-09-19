<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// prevent mixed content error in production
if (App::environment('production')) {
    URL::forceScheme('https');
}


//home ro
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    //get all Users route
Route::get('dashboard/users', 'Web\User\UserController@index')->middleware(['auth', 'verified']);

    //create new User route
Route::get('dashboard/users/create', 'Web\User\UserController@create')->middleware(['auth', 'verified']);

    //get all orders route
Route::get('dashboard/orders', 'Web\Order\OrderController@index')->middleware(['auth', 'verified']);
 
    //new orders route
Route::get('dashboard/orders/create', 'Web\Order\OrderController@create')->middleware(['auth', 'verified']);

    //edit orders route
Route::get('dashboard/orders-edit/{id}', 'Web\Order\OrderController@edit')->middleware(['auth', 'verified']);
  
    //onHold orders route
Route::get('/dashboard/orders-onhold', 'Web\Order\OrderController@onHold')->middleware(['auth', 'verified']);

    //inProgress orders route
Route::get('/dashboard/orders-inprogress', 'Web\Order\OrderController@inProgress')->middleware(['auth', 'verified']);

    //revisions orders route
Route::get('/dashboard/orders-revisions', 'Web\Order\OrderController@revisions')->middleware(['auth', 'verified']);

    //complete orders route
Route::get('/dashboard/orders-complete', 'Web\Order\OrderController@complete')->middleware(['auth', 'verified']);

    // All Refunds route
Route::get('/dashboard/refunds', 'Web\Refund\RefundRequestController@index')->middleware(['auth', 'verified']);

    // Create Refund route
Route::get('/dashboard/refunds-create', 'Web\Refund\RefundRequestController@create')->middleware(['auth', 'verified']);





require __DIR__.'/auth.php';
