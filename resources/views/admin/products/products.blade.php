@extends('admin.include.layouts')
@section('title')
    Products
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                <a href="{{url('admin/add-edit-product')}}" class="btn btn-success btn-sm float-right">Add product</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="products"
                                                   class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Product Name</th>
                                                    <th>Product Code</th>
                                                    <th>Product Color</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($product as $products)

                                                    <tr>
                                                        <td>{{$products->id}}</td>
                                                        <td>{{$products->product_name}}</td>
                                                        <td>{{$products->product_code}}</td>
                                                        <td>{{$products->product_color}}</td>
                                                        <td>
                                                            @if($products->status == 1)
                                                                <a class="updateProductStatus" id="product-{{$products->id}}" product_id="{{$products->id}}" href="javascript:void (0)">Active</a>
                                                            @else
                                                                <a class="updateProductStatus" id="product-{{$products->id}}" product_id="{{$products->id}}" href="javascript:void (0)">Inactive</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{url('admin/add-edit-product/'.$products->id)}}" class="btn btn-info btn-sm">Edit</a>
                                                            <a class="confirmDelete btn btn-danger btn-sm" href="javascript:void (0)" record="product" recordid="{{$products->id}}" {{--href="{{url('admin/delete-product/'.$categories->id)}}"--}}>Delete</a>
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

