@extends('admin.include.layouts')
@section('title')
    Categories
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title">Categories</h3>
                                <a href="{{route('admin.addEditCategory')}}" class="btn btn-success btn-sm float-right">Add Category</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="categories"
                                                   class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Url</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($category as $categories)
                                                    <tr>
                                                        <td>{{$categories->id}}</td>
                                                        <td>{{$categories->category_name}}</td>
                                                        <td>{{$categories->url}}</td>
                                                        <td>
                                                            @if($categories->status == 1)
                                                                <a class="updateCategoryStatus" id="category-{{$categories->id}}" category_id="{{$categories->id}}" href="javascript:void (0)">Active</a>
                                                            @else
                                                                <a class="updateCategoryStatus" id="category-{{$categories->id}}" category_id="{{$categories->id}}" href="javascript:void (0)">Inactive</a>
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

