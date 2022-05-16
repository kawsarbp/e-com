<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::with('orders_products')->get();
        return view('admin.orders.orders', compact('orders'));
    }

    /*orderDetails*/
    public function orderDetails($id)
    {
        $orderDetails = Order::with('orders_products')->where('id', $id)->first();
        $userDetails = User::where('id', $orderDetails['user_id'])->first();
        $orderStatuses = OrderStatus::where('status', 1)->get();
        return view('admin.orders.order_details', compact('orderDetails', 'userDetails', 'orderStatuses'));
    }

    /*updateOrderStatus*/
    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            /*send register sms*/
            $deliveryDetails = Order::select('mobile','email','name')->where('id',$data['order_id'])->first();
            /*$message = 'Dear Customer, Your order status has been update successfully!';
            $mobile = $deliveryDetails['mobile'];
            Sms::sendSms($message, $mobile);*/

            //send email order status update
            $orderDetails = Order::with('orders_products')->where('id',$data['order_id'])->first();

            $email = $deliveryDetails['email'];
            $messageData = [
                'email'=>$email,
                'name'=>$deliveryDetails['name'],
                'order_id'=>$data['order_id'],
                'order_status'=>$data['order_status'],
                'orderDetails'=>$orderDetails,
            ];
            Mail::send('emails.order_status',$messageData,function ($message) use ($email){
                $message->to($email)->subject('Order Status Updated - FAZ GROUP LTD');
            });


            return redirect()->back()->with(['message' => 'Order Status Has benn Update!', 'type' => 'success']);
        }
    }
}
