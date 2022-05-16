<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Mail</title>
</head>
<body>

    <table style="width: 700px;">
        <tr><td>&nbsp;</td></tr>
        <tr><td><h1>Admin Photo</h1></td> </tr>
        <tr><td><img style="width: 30%;" src="{{ '/image/admin.jpg' }}" alt=""></td> </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Hello {{$name}},</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thank You for shopping with us. Your order details are as below:-</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Order no:- {{ $order_id }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>
            <table style="width: 95%;" callpadding="5" callpadding="5" bgcolor="#f7f4f4">
                <tr bgcolor="#ccc">
                    <td>Product Name</td>
                    <td>Product Code</td>
                    <td>Product Size</td>
                    <td>Product Color</td>
                    <td>Product Quantity</td>
                    <td>Product Price</td>
                </tr>
                @foreach($orderDetails['orders_products'] as $order)
                    <tr>
                        <td>{{ $order['product_name'] }}</td>
                        <td>{{ $order['product_code'] }}</td>
                        <td>{{ $order['product_size'] }}</td>
                        <td>{{ $order['product_color'] }}</td>
                        <td>{{ $order['product_qty'] }}</td>
                        <td>INR {{ $order['product_price'] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="right">Shopping Charges</td>
                    <td>INR {{$orderDetails['shopping_charges']}}</td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Coupon Discount</td>
                    <td>INR {{$orderDetails['coupon_amount']}}</td>
                </tr>
                <tr>
                    <td colspan="5" align="right">Grand Total</td>
                    <td>INR {{$orderDetails['grand_total']}}</td>
                </tr>
            </table>
            </td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>
                <table>
                    <tr><td><strong>Delivery Address:-</strong></td></tr>
                    <tr><td>{{ $orderDetails['name'] }}</td></tr>
                    <tr><td>{{ $orderDetails['address'] }}</td></tr>
                    <tr><td>{{ $orderDetails['city'] }}</td></tr>
                    <tr><td>{{ $orderDetails['state'] }}</td></tr>
                    <tr><td>{{ $orderDetails['country'] }}</td></tr>
                    <tr><td>{{ $orderDetails['pincode'] }}</td></tr>
                    <tr><td>{{ $orderDetails['mobile'] }}</td></tr>
                </table>
            </td></tr>
    </table>
</body>
</html>
