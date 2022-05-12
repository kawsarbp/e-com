@extends('admin.include.layouts')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Coupons</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if(session()->has('message'))
                    <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
                @endif
                <form
                    {{--action="{{url('admin/add-edit-product')}}"--}}
                    @if(empty($coupon['id'])) action="{{url('admin/add-edit-coupon')}}" @else
                    action="{{url('admin/add-edit-coupon/'.$coupon['id'])}}"
                    @endif
                    name="couponForm" id="couponForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @if(empty($coupon['coupon_code']))
                                        <div class="form-group">
                                            <label>Coupon Option</label>
                                            <br>
                                            <span>
                                            <input type="radio" checked="" name="coupon_option" value="Automatic"
                                                   id="AutomaticCoupon"> <label for="AutomaticCoupon">Automatic</label> &nbsp;&nbsp;
                                            <input type="radio" name="coupon_option" value="Manual"
                                                   id="ManualCoupon"> <label for="ManualCoupon">Manual</label>
                                        </span>
                                            @error('coupon_option') <span
                                                class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                        <div class="form-group" style="display:none;" id="couponField">
                                            <label for="coupon_code">Coupon Code</label>
                                            <input type="text" class="form-control" name="coupon_code" id="coupon_code"
                                                   placeholder="Enter Coupon Code">
                                        </div>
                                    @else
                                        <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
{{--                                        <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">--}}
                                        <div class="form-group">
                                            <label for="coupon_code">Coupon Code</label>
                                            <span>{{ $coupon['coupon_code'] }} </span>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Coupon Type</label>
                                        <br>
                                        <span>
                                            <input type="radio" name="coupon_type" value="Multiple Times"
                                                   @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=='Multiple Times') checked=""
                                                   @elseif(!isset($coupon['coupon_type'])) checked=""
                                                   @endif id="Multiple_Times"> <label for="Multiple_Times">Multiple Times</label> &nbsp;&nbsp;
                                            <input type="radio" name="coupon_type" value="Single Times"
                                                   @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=='Single Times') checked=""
                                                   @endif id="Single_Times"> <label for="Single_Times">Single Times</label>
                                        </span>
                                        @error('coupon_type') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Amount Type</label>
                                        <br>
                                        <span>
                                            <input type="radio" name="amount_type" value="Percentage"
                                                   @if(isset($coupon['amount_type'])&&$coupon['amount_type']=='Percentage') checked="" @elseif(!isset($coupon['amount_type'])) checked="" @endif
                                                   id="Percentage"> <label for="Percentage">Percentage &nbsp; (in %)</label> &nbsp;&nbsp;
                                            <input type="radio" name="amount_type" value="Fixed"
                                                   @if(isset($coupon['amount_type'])&&$coupon['amount_type']=='Fixed') checked="" @endif
                                                   id="Fixed"> <label for="Fixed">Fixed &nbsp; (in INR or USD)</label>
                                        </span>
                                        @error('amount_type') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" required="" placeholder="Amount" name="amount" class="form-control" id="amount"
                                        @if(isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @endif
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="categories">Add Categories</label>
                                        <select required="" name="categories[]" multiple=""
                                                class="form-control select2">
                                            <option value="">Select Categories</option>
                                            @foreach($categories as $section)
                                                <optgroup label="{{$section['name']}}"></optgroup>
                                                @foreach($section['categories'] as $category)
                                                    <option value="{{$category['id']}}"
                                                            @if(in_array($category['id'],$sleCats)) selected="" @endif >
                                                        &nbsp;-- {{$category['category_name']}}</option>
                                                    @foreach($category['subcategories'] as $subcategory)
                                                        <option value="{{$subcategory['id']}}"
                                                                @if(in_array($subcategory['id'],$sleCats)) selected="" @endif >
                                                            &nbsp;&nbsp;&nbsp;&raquo; {{$subcategory['category_name']}}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>

                                        @error('categories') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="user">Select Users</label>
                                        <select required="" name="user[]" multiple="" class="form-control select2">
                                            <option value="">Select Users</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user['email'] }}"
                                                        @if(in_array($user['email'],$sleUsers)) selected="" @endif >{{ $user['email'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('users') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="expire_date">Expire Date</label>
                                        <input type="date" required="" id="expire_date" name="expire_date" class="form-control"
                                               @if(isset($coupon['expire_date'])) value="{{ $coupon['expire_date'] }}" @endif
                                        >
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
