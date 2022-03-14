@extends('admin.include.layouts')
@section('title')
    Settings
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.admindetails')}}">Home</a></li>
                            <li class="breadcrumb-item active">Admin details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Admin Details</h3>
                            </div>
                            @if(session()->has('message'))
                                <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
                            @endif
                            <form action="{{route('admin.admindetails')}}" method="POST" name="Updateadmindetails" id="Updateadmindetails" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="email">Admin Email address</label>
                                        <input type="text" readonly="" value="{{Auth::guard('admin')->user()->email}}" name="email" class="form-control" id="email" placeholder="Enter Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Admin Type</label>
                                        <input type="text" readonly="" value="{{Auth::guard('admin')->user()->type}}" name="type" class="form-control" id="type" placeholder="Enter Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Admin Name</label>
                                        <input type="text" value="{{Auth::guard('admin')->user()->name}}" class="form-control" name="name" id="name" placeholder="Enter Admin Name">
                                        @error('name') <span class="text-danger font-italic">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="number" value="{{Auth::guard('admin')->user()->mobile}}" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number">
                                        @error('mobile') <span class="text-danger font-italic">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control" name="photo" id="photo">
                                        @if(!empty(Auth::guard('admin')->user()->photo))
                                            <a target="_blank" href="{{url('image/admin/admin_image/'.Auth::guard('admin')->user()->photo)}}">View Image</a>
                                            <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->photo}}">
                                        @endif
                                        @error('photo') <span class="text-danger font-italic">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
