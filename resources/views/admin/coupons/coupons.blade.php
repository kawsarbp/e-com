@extends('admin.include.layouts')
@section('title')
    Coupons
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(session()->has('message'))
                    <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Coupons</h3>
                                <a href="{{url('admin/add-edit-coupon')}}" class="btn btn-success btn-sm float-right">Add
                                    coupon</a>
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="coupons"
                                                   class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Coupon Code</th>
                                                    <th>Coupon Type</th>
                                                    <th>Amount Type</th>
                                                    <th>Expire Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($coupons as $coupon)
                                                    <tr>
                                                        <td>{{$coupon['id']}}</td>
                                                        <td>{{$coupon['coupon_code']}}</td>
                                                        <td>{{$coupon['coupon_type']}}</td>
                                                        <td>
                                                            {{$coupon['amount']}}
                                                            @if($coupon['amount_type']=='Percentage')
                                                                %
                                                            @else
                                                                INR
                                                            @endif
                                                        </td>
                                                        <td>{{$coupon['expire_date']}}</td>
                                                        <td>
                                                            @if($coupon['status'] == 1)
                                                                <a class="updateCouponStatus" id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}" href="javascript:void (0)">
                                                                    <i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>
                                                                </a>
                                                            @else
                                                                <a class="updateCouponStatus" id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}" href="javascript:void (0)">
                                                                    <i class="fa fa-toggle-off" aria-hidden="true" status="Inactive"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{url('admin/add-edit-coupon/'.$coupon['id'])}}"
                                                               class="btn btn-info btn-sm">Edit</a>
                                                            <a class="confirmDelete btn btn-danger btn-sm"
                                                               href="javascript:void (0)" record="coupon"
                                                               recordid="{{$coupon['id']}}">Delete</a>
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


