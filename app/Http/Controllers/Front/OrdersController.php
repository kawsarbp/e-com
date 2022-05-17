<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function orders()
    {
        $orders = Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
        return view('front.orders.orders',compact('orders'));
    }
    /*orderDetails*/
    public function orderDetails($id)
    {
        $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
        return view('front.orders.order_details',compact('orderDetails'));
    }
}
