@extends('front.include.layouts')
@section('title') Orders Pages @endsection

@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
            <li class="active">Orders</li>
        </ul>
        <h3>ORDERS PAGES</h3>
        @if(session()->has('message'))
            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
        @endif
        <hr class="soft"/>

        <div class="row">
            <div class="span8">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Order ID</th>
                        <th>Payment Method</th>
                        <th>Grand Total</th>
                        <th>Create On</th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order['id'] }}</td>
                            <td>{{ $order['payment_method'] }}</td>
                            <td>{{ $order['grand_total'] }}</td>
                            <td>{{ date('d-m-y',strtotime($order['created_at'])) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
