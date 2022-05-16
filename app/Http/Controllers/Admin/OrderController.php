<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::with('orders_products')->get();
        return view('admin.orders.orders',compact('orders'));
    }
    /*orderDetails*/
    public function orderDetails($id)
    {
        $orderDetails = Order::with('orders_products')->where('id',$id)->first();
        $userDetails = User::where('id',$orderDetails['user_id'])->first();
        $orderStatuses = OrderStatus::where('status',1)->get();
        return view('admin.orders.order_details',compact('orderDetails','userDetails','orderStatuses'));
    }
    /*updateOrderStatus*/
    public function updateOrderStatus(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with(['message'=>'Order Status Has benn Update!','type'=>'success']);
        }
    }
}
