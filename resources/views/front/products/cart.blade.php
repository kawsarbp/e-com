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
            <li class="active"> SHOPPING CART</li>
        </ul>
        <h3>  SHOPPING CART [ <small><span class="totalCartItems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{ url('/') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>
        <hr class="soft"/>

        <div id="AppendCartItems">
            @include('front.products.cart_item')
        </div>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>
                    <form @if(Auth::check()) user="1" @endif class="form-horizontal" id="ApplyCoupon" method="POST" action="javascript:void (0);">@csrf
                        <div class="control-group">
                            <label class="control-label"><strong> COUPON CODE: </strong> </label>
                            <div class="controls">
                                <input type="text" required="" name="code" id="code" class="input-medium" placeholder="Enter Coupon Code">
                                <button type="submit" class="btn"> APPLY </button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>

            </tbody>
        </table>

        <a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
        <a href="{{ url('/checkout') }}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
    </div>
@endsection
