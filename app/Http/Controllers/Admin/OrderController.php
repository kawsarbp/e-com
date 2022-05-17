<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrdersLog;
use App\Models\OrderStatus;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;

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
        $orderLog = OrdersLog::where('order_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.orders.order_details', compact('orderDetails', 'userDetails', 'orderStatuses', 'orderLog'));
    }

    /*updateOrderStatus*/
    public function updateOrderStatus(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Order::where('id', $data['order_id'])->update(['order_status' => $data['order_status']]);
            //update courier name and tracking number
            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                Order::where('id', $data['order_id'])->update(['courier_name' => $data['courier_name'], 'tracking_number' => $data['tracking_number']]);
            }

            /*send register sms*/
            $deliveryDetails = Order::select('mobile', 'email', 'name')->where('id', $data['order_id'])->first();
            /*$message = 'Dear Customer, Your order status has been update successfully!';
            $mobile = $deliveryDetails['mobile'];
            Sms::sendSms($message, $mobile);*/

            //send email order status update
            $orderDetails = Order::with('orders_products')->where('id', $data['order_id'])->first();

            $email = $deliveryDetails['email'];
            $messageData = [
                'email' => $email,
                'name' => $deliveryDetails['name'],
                'order_id' => $data['order_id'],
                'order_status' => $data['order_status'],
                'courier_name' => $data['courier_name'],
                'tracking_number' => $data['tracking_number'],
                'orderDetails' => $orderDetails,
            ];
            Mail::send('emails.order_status', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Order Status Updated - FAZ GROUP LTD');
            });
            //update order log
            $log = new OrdersLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();

            return redirect()->back()->with(['message' => 'Order Status Has benn Update!', 'type' => 'success']);
        }
    }

    /*viewOrderInvoice*/
    public function viewOrderInvoice($id)
    {
        $orderDetails = Order::with('orders_products')->where('id', $id)->first();
        $userDetails = User::where('id', $orderDetails['user_id'])->first();

        return view('admin.orders.order_invoice', compact('orderDetails', 'userDetails'));
    }

    /*printPdfInvoice*/
    public function printPdfInvoice($id)
    {
        $orderDetails = Order::with('orders_products')->where('id', $id)->first();
        $userDetails = User::where('id', $orderDetails['user_id'])->first();

        $subtotal = 0;
        $pfd = "";
        foreach ($orderDetails["orders_products"] as $product) {
            $pfd .= '<tr>
                        <td>'.$product["product_code"].'</td>
                        <td>'.$product["product_size"].'</td>
                        <td>'.$product["product_color"].'</td>
                        <td>'.$product["product_price"].'</td>
                        <td>'.$product["product_qty"].'</td>
                        <td>'.$product["product_price"]*$product["product_qty"].'</td>
                    </tr>';
            $subtotal = $subtotal + ($product["product_price"]*$product["product_qty"]);
        }

        $output = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0  0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3{
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #57B223;
        }

        table .desc {
            text-align: left;
        }

        table .unit {
            background: #DDDDDD;
        }

        table .qty {
        }

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks{
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices{
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <h1>Order Invoice</h1>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">INVOICE TO:</div>
            <h2 class="name">' . $orderDetails['name'] . '</h2>
            <div class="address">' . $orderDetails['address'] . ',' . $orderDetails['city'] . ',' . $orderDetails['state'] . '</div>
            <div class="address">' . $orderDetails['country'] . '-' . $orderDetails['pincode'] . '</div>
            <div class="email"><a href="' . $orderDetails['email'] . '">' . $orderDetails['email'] . '</a></div>
        </div>
        <div id="invoice">
            <h1>Order Id:- #' . $orderDetails['id'] . '</h1>
            <div class="date">OrderDate:- ' . date("d-m-Y", strtotime($orderDetails['name'])) . '</div>
            <div class="date">Order Amount:- INR' . $orderDetails['grand_total'] . '</div>
            <div class="date">Order Status:- ' . $orderDetails['order_status'] . '</div>
            <div class="date">Payment Method:- ' . $orderDetails['payment_method'] . '</div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">Product Code</th>
            <th class="desc">Size</th>
            <th class="unit">Color</th>
            <th class="qty">Price</th>
            <th class="qty">Qty</th>
            <th class="total">Totals</th>
        </tr>
        </thead>
        <tbody>
            '.$pfd.'
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>'.$subtotal.'</td>
        </tr>
        </tfoot>
    </table>
    <div id="thanks">Thank you!</div>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Faz Group LTD</div>
    </div>
</main>
<footer>
    Kawsar ahmed
</footer>
</body>
</html>

        ';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();

        return view('admin.orders.order_invoice', compact('orderDetails', 'userDetails'));
    }

}
