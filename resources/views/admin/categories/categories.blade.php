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
                                <a href="{{url('admin/add-edit-category')}}" class="btn btn-success btn-sm float-right">Add Category</a>
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
                                                    <th>Category</th>
                                                    <th>Parent Category</th>
                                                    <th>Section</th>
                                                    <th>Url</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($category as $categories)

                                                    <tr>
                                                        <td>{{$categories->id}}</td>
                                                        <td>{{$categories->category_name}}</td>
                                                        <td>
                                                            @if(!isset($categories->parentcategory->category_name))
                                                                {{$parent_category = 'Root'}}
                                                            @else
                                                                {{$parent_category = $categories->parentcategory->category_name}}
                                                            @endif
                                                        </td>
                                                        <td>{{$categories->section->name}}</td>
                                                        <td>{{$categories->url}}</td>
                                                        <td>
                                                            @if($categories->status == 1)
                                                                <a class="updateCategoryStatus" id="category-{{$categories->id}}" category_id="{{$categories->id}}" href="javascript:void (0)">Active</a>
                                                            @else
                                                                <a class="updateCategoryStatus" id="category-{{$categories->id}}" category_id="{{$categories->id}}" href="javascript:void (0)">Inactive</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{url('admin/add-edit-category/'.$categories->id)}}" class="btn btn-info btn-sm">Edit</a>
                                                            <a class="confirmDelete btn btn-danger btn-sm" href="javascript:void (0)" record="category" recordid="{{$categories->id}}" {{--href="{{url('admin/delete-category/'.$categories->id)}}"--}}>Delete</a>
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

