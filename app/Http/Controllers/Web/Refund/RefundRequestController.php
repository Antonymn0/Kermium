<?php

namespace App\Http\Controllers\Web\Refund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refund;
use Inertia\Inertia;

class RefundRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refunds = Refund::paginate(env('API_PAGINATION', 10));
        return Inertia::render('Refund/Refunds', $refunds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Refund/Create');
    }


}
