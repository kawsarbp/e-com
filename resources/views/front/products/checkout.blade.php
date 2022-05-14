<?php
use App\Models\Product;
?>
@extends('front.include.layouts')
@section('title')
    Cart
@endsection
@section('content')
    <div class="span9">
        @if(session()->has('message'))
            <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
        @endif
        <ul class="breadcrumb">
            <li><a href="{{ url('/cart') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> CHECK OUT</li>
        </ul>
        <h3> CHECK OUT [<small><span class="totalCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a
                href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Back to Cart
            </a></h3>
        <hr class="soft"/>

        <table class="table table-bordered">
            <tr>
                <th> DELIVERY ADDRESSES</th>
            </tr>
            @foreach($deliveryAddresses as $address)
                <tr>
                    <td>
                        <div class="control-group" style="float: left; margin-top: -2px; margin-right: 5px;">
                            <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}">
                        </div>
                        <div class="control-group">
                            <label class="control-label">{{ $address['name'] }},{{ $address['address'] }}
                                ,{{ $address['city'] }},{{ $address['state'] }},{{ $address['country'] }}</label>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Product</th>
                <th colspan="2">Description</th>
                <th>Quantity/Update</th>
                <th>Unit Price</th>
                <th>Discount</th>
                <th>Sub Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $total_price = 0; ?>
            @foreach($userCartItem as $item)
                <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);  ?>
                <tr>
                    <td>
                        <img width="60" src="/image/admin/product_images/{{$item['product']['main_image']}}" alt=""/>
                    </td>
                    <td colspan="2">
                        {{$item['product']['product_name']}} ({{$item['product']['product_code']}})<br/>
                        Color : {{$item['product']['product_color']}}<br/>
                        Size : {{$item['size']}}
                    </td>
                    <td>
                        <div class="input-append">
                            <input class="span1" disabled style="max-width:34px" value="{{$item['quantity']}}"
                                   id="appendedInputButtons" size="16" type="text">
                            <button disabled class="btn btnItemUpdate qtyMinus" type="button" data-cartid="{{$item['id']}}"><i
                                    class="icon-minus"></i></button>
                            <button disabled class="btn btnItemUpdate qtyPlus" type="button" data-cartid="{{$item['id']}}"><i
                                    class="icon-plus"></i></button>
                            <button disabled class="btn btn-danger btnItemDelete" type="button" data-cartid="{{$item['id']}}"><i
                                    class="icon-remove icon-white"></i></button>
                        </div>
                    </td>
                    <td>Rs. {{$attrPrice['product_price']}}</td>
                    <td>Rs. {{$attrPrice['discount']}}</td>
                    <td>Rs. {{$attrPrice['final_price'] * $item['quantity']}}</td>
                </tr>
                <?php $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']); ?>
            @endforeach

            <tr>
                <td colspan="6" style="text-align:right">Sub Total:</td>
                <td> Rs. {{$total_price}}</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:right">Coupon Discount:</td>
                <td class="couponAmount">
                    @if(Session::has('CouponAmount'))
                        - Rs. <?php echo Session::get('CouponAmount');  ?>
                    @else
                        Rs. 0
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align:right"><strong>GRAND TOTAL (Rs. {{$total_price}} - <span
                            class="couponAmount">Rs.0 </span>) =</strong></td>
                <td class="label label-important" style="display:block">
                    <strong class="grand_total"> Rs. {{ $total_price - Session::get('CouponAmount') }} </strong>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                    <form @if(Auth::check()) user="1" @endif class="form-horizontal" id="ApplyCoupon" method="POST"
                          action="javascript:void (0);">@csrf
                        <div class="control-group">
                            <label class="control-label"><strong> PAYMENT METHODS: </strong> </label>
                            <div class="controls">

                            </div>
                        </div>
                    </form>
                </td>
            </tr>

            </tbody>
        </table>

        <a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back to Cart </a>
        <a href="{{ url('/checkout') }}" class="btn btn-large pull-right">Please Order <i class="icon-arrow-right"></i></a>
    </div>
@endsection
