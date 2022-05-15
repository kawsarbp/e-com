<?php

use App\Models\Product;
use Illuminate\Support\Facades\Session;

?>
@extends('front.include.layouts')
@section('title')
    Thanks
@endsection
@section('content')
    <div class="span9">
        @if(session()->has('message'))
            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
        @endif
        <ul class="breadcrumb">
            <li><a href="{{ url('/cart') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> THANKS</li>
        </ul>
        <h3> THANKS </h3>
        <hr class="soft"/>

        <div align="center">
            <h3>YOUR ORDER HAS BEEN PLACE SUCCESSFULLY</h3>
            <p>Your order number is {{ Session::get('order_id') }} And grand total is
                INR {{ Session::get('grand_total') }} </p>
        </div>

    </div>
@endsection

<?php
Session::forget('grand_total');
Session::forget('order_id');
Session::forget('couponAmount');
?>
