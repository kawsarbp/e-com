@extends('admin.include.layouts')
@section('title')
    Banners
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
                            <li class="breadcrumb-item active">Banners</li>
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
                                <h3 class="card-title">Banners</h3>
                                <a href="{{url('admin/add-edit-banner')}}" class="btn btn-success btn-sm float-right">Add
                                    banner</a>
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="banners"
                                                   class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Link</th>
                                                    <th>Title</th>
                                                    <th>ALt</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($banners as $banner)
                                                    <tr>
                                                        <td>{{$banner['id']}}</td>
                                                        <td>
                                                            <img style="width: 100px;" src="/image/admin/banner_images/{{$banner['image']}}" alt="">
                                                        </td>
                                                        <td>{{$banner['link']}}</td>
                                                        <td>{{$banner['title']}}</td>
                                                        <td>{{$banner['alt']}}</td>
                                                        <td>
                                                            @if($banner['status'] == 1)
                                                                <a class="updateBannerStatus"
                                                                   id="banner-{{$banner['id']}}"
                                                                   banner_id="{{$banner['id']}}"
                                                                   href="javascript:void (0)">
                                                                    Active
                                                                </a>
                                                            @else
                                                                <a class="updateBannerStatus"
                                                                   id="banner-{{$banner['id']}}"
                                                                   banner_id="{{$banner['id']}}"
                                                                   href="javascript:void (0)">
                                                                    Inactive
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{url('admin/add-edit-banner/'.$banner['id'])}}"
                                                               class="btn btn-info btn-sm">Edit</a>
                                                            <a class="confirmDelete btn btn-danger btn-sm"
                                                               href="javascript:void (0)" record="banner"
                                                               recordid="{{$banner['id']}}">Delete</a>
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

