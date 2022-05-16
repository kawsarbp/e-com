<?php use App\Models\Product; ?>
@extends('admin.include.layouts')
@section('title')
    Order Details
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders Details</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>

        <div class="container">
            @if(session()->has('message'))
                <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
            @endif
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
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
                                    <tr>
                                        <td>Payment F</td>
                                        <td>INR {{ $orderDetails['payment_method'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Delivery Address</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Customer Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $userDetails['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $userDetails['email'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Billing Address</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $userDetails['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $userDetails['address'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $userDetails['city'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>{{ $userDetails['state'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>{{ $userDetails['country'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pincode</td>
                                        <td>{{ $userDetails['pincode'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>{{ $userDetails['mobile'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Order Status</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <form action="{{ url('admin/update-order-status') }}" method="POST">@csrf
                                                <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                                                <select name="order_status" required="" id="" class="form-control">
                                                    <option value="">Select Status</option>
                                                    @foreach($orderStatuses as $status)
                                                        <option
                                                            value="{{ $status['name'] }}" @if(isset($orderDetails['order_status']) && $orderDetails['order_status']==$status['name']) selected="" @endif >{{ $status['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <button class="btn btn-info btn-block btn-sm" type="submit">Update
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @foreach($orderLog as $log)
                                                <strong>{{ $log['order_status'] }}</strong><br>
                                                <strong>{{ date('j F,Y, g:i:a',strtotime($log['created_at'])) }}</strong><br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ordered Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Product Size</th>
                                        <th>Product Color</th>
                                        <th>Product Qty</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderDetails['orders_products'] as $product)
                                        <tr>
                                            <td style="width: 30%; text-align:center;">
                                                <?php $getProductImage = Product::getProductImage($product['product_id']) ?>
                                                <a href="{{ url('product/'.$product['product_id']) }}"
                                                   target="_blank"><img
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

    </div>
@endsection
