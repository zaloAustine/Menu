<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashBoardController extends Controller
{
    function index(){
        $orders = Order::all();
        return View::make('welcome',['orders'=> $orders]);
    }

    function newOrder(Request $request){
        $summary = $request['orderSummary'];
        $name = $request['customerName'];
        $pricing = $request['orderPricing'];
        $status = $request['orderStatus'];
        $location = $request['$location'];

        $newOrder = new Order();
        $newOrder->orderSummary  = $summary;
        $newOrder->customerName  = $name;
        $newOrder->location = $location;
        $newOrder->orderPricing  = $pricing;
        $newOrder->orderStatus  = $status;
        $newOrder->save();
    }
}
