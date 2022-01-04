<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shopifyOrders = 100;
        $failedOrders = 100;
        $failedUpdates = 100;
        $inventoryUpdates = 100;
        return view('home', compact(['shopifyOrders', 'inventoryUpdates', 'failedOrders', 'failedUpdates']));
    }
}
