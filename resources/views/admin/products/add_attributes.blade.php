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
                            <li class="breadcrumb-item active">Products</li>
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
                <form name="attributeForm" id="attributeForm" action="{{url('admin/add-attributes/'.$productdata['id'])}}" method="POST" enctype="multipart/form-data">
                    @csrf
{{--                    <input type="hidden" name="product_id" value="{{$productdata['id']}}">--}}
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
                                    <div class="form-group">
                                        <label for="product_name">product Name: &nbsp;&nbsp;&nbsp;</label> {{$productdata['product_name']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">product Code: &nbsp;&nbsp;&nbsp;</label> {{$productdata['product_code']}}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">product Color: &nbsp;&nbsp;&nbsp;</label> {{$productdata['product_color']}}
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        @if(!empty($productdata['main_image']))
                                            <div>
                                                <img style="width: 150px; height: 180px;" src="{{'/image/admin/product_images/'.$productdata['main_image']}}" alt="">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div>
                                                <input style="width: 100px;" type="text" required="" id="size"  name="size[]" value="" placeholder="Size" />
                                                <input style="width: 100px;" type="text" required="" id="sku"  name="sku[]" value="" placeholder="SKU" />
                                                <input style="width: 100px;" type="number" required="" id="price"  name="price[]" value="" placeholder="Price" />
                                                <input style="width: 100px;" type="number" required="" id="stock"  name="stock[]" value="" placeholder="Stock" />
                                                <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Added Product Attributes</h3>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="attributes"
                                               class="table table-bordered table-striped dataTable dtr-inline">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Size</th>
                                                <th>SKU</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($productdata['attributes'] as $attribute)
                                                <tr>
                                                    <td>{{$attribute->id}}</td>
                                                    <td>{{$attribute->size}}</td>
                                                    <td>{{$attribute->sku}}</td>
                                                    <td>{{$attribute->price}}</td>
                                                    <td>{{$attribute->stock}}</td>
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
        </section>
    </div>
@endsection

