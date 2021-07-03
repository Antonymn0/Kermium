<?php

namespace App\Http\Controllers\Web\User;

use Auth;
use App\Models\User;
use Inertia\Inertia;
use App\Events\UserCreated;
use App\Events\UserUpdated;
use App\Events\UserDestroyed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(env('API_PAGINATION', 10));
         $data = [
            'users' => $users,
            'authUser'=> Auth::user()
        ];
        return Inertia::render('User/User', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/NewUser');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    $user = User::findOrfail($id);
         return Inertia::render('User/ViewUser', [
            'user' => $user
        ]);
    }
}
