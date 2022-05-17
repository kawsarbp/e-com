@extends('admin.include.layouts')
@section('title')
    Orders
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if(session()->has('message'))
                            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="orders"
                                                   class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Order Date</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Email</th>
                                                    <th>Ordered Products</th>
                                                    <th>Order Amount</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Method</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{ $order['id'] }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($order['created_at'])) }}</td>
                                                        <td>{{ $order['name'] }}</td>
                                                        <td>{{ $order['email'] }}</td>
                                                        <td>
                                                            @foreach($order['orders_products'] as $pro)
                                                                {{ $pro['product_code'] }} ({{ $pro['product_qty'] }})
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $order['grand_total'] }}</td>
                                                        <td>{{ $order['order_status'] }}</td>
                                                        <td>{{ $order['payment_method'] }}</td>
                                                        <td>
                                                            <a href="{{ url('/admin/orders/'.$order['id']) }}" title="View Order Details">View</a>&nbsp;&nbsp;
                                                            @if($order['order_status']=="Shipped" || $order['order_status']=="Delivered" )
                                                            <a href="{{ url('/admin/view-order-invoice/'.$order['id']) }}" title="View Order Invoice"><i class="fa fa-print"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
