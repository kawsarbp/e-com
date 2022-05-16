<?php use App\Models\Product; ?>
@extends('front.include.layouts')
@section('title') Orders Details @endsection

@section('content')

    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
            <li class="active"><a href="{{ url('/orders') }}">Orders</a></li>
        </ul>
        <h3>ORDERS DETAILS</h3>
        @if(session()->has('message'))
            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
        @endif
        <hr class="soft"/>


        <div class="row">
            <div class="span4">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td colspan="2"><strong>Order Details</strong></td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td>{{ date('d-m-y',strtotime($orderDetails['created_at'])) }}</td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td>{{ $orderDetails['order_status'] }}</td>
                    </tr>
                    <tr>
                        <td>Order Total</td>
                        <td>INR {{ $orderDetails['grand_total'] }}</td>
                    </tr>
                    <tr>
                        <td>Shipping Charges</td>
                        <td>INR {{ $orderDetails['shipping_charges'] }}</td>
                    </tr>
                    <tr>
                        <td>Coupon Code</td>
                        <td>INR {{ $orderDetails['coupon_code'] }}</td>
                    </tr>
                    <tr>
                        <td>Coupon Amount</td>
                        <td>INR {{ $orderDetails['coupon_amount'] }}</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>INR {{ $orderDetails['payment_method'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="span4">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td colspan="2"><strong>Delivery Address</strong></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $orderDetails['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $orderDetails['address'] }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ $orderDetails['city'] }}</td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>{{ $orderDetails['state'] }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $orderDetails['country'] }}</td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td>{{ $orderDetails['pincode'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $orderDetails['mobile'] }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="span8">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Qty</th>
                    </tr>
                    @foreach($orderDetails['orders_products'] as $product)
                        <tr>
                            <td style="width: 30%; text-align:center;">
                                <?php $getProductImage = Product::getProductImage($product['product_id']) ?>
                                <a href="{{ url('product/'.$product['product_id']) }}" target="_blank"><img
                                        src="/image/admin/product_images/{{$getProductImage}}" alt=""
                                        style="width: 25%;"></a>
                            </td>
                            <td>{{ $product['product_code'] }}</td>
                            <td>{{ $product['product_name'] }}</td>
                            <td>{{ $product['product_size'] }}</td>
                            <td>{{ $product['product_color'] }}</td>
                            <td>{{ $product['product_qty'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
