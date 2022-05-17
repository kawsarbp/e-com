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
                            <li class="breadcrumb-item active">Shipping Charges</li>
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
                                <h3 class="card-title">Shipping Charges</h3>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="orders"
                                                   class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Country</th>
                                                    <th>Shipping Charges</th>
                                                    <th>Updated At</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($shipping_charges as $shipping)
                                                    <tr>
                                                        <td>{{ $shipping['id'] }}</td>
                                                        <td>{{ $shipping['country'] }}</td>
                                                        <td>INR {{ $shipping['shopping_charges'] }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($shipping['updated_at'])) }}</td>
                                                        <td>
                                                            @if($shipping['status'] == 1)
                                                                <a class="updateShippingStatus" id="shipping-{{$shipping['id']}}" shipping_id="{{$shipping['id']}}" href="javascript:void (0)">
                                                                    <i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>
                                                                </a>
                                                            @else
                                                                <a class="updateShippingStatus" id="shipping-{{$shipping['id']}}" shipping_id="{{$shipping['id']}}" href="javascript:void (0)">
                                                                    <i class="fa fa-toggle-off" aria-hidden="true" status="Inactive"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a title="Update Shipping Charges" href="{{ url('admin/edit-shipping-charges/'.$shipping['id']) }}"><i class="fa fa-edit"></i></a>
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
