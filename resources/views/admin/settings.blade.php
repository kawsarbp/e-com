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
                        <h1 class="m-0">Admin Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.settings')}}">Home</a></li>
                            <li class="breadcrumb-item active">Admin Settings</li>
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
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            @if(session()->has('message'))
                                <div class="alert alert-{{session('type')}} text-center">{{session('message')}}</div>
                            @endif
                            <form action="{{route('admin.checkupdatepassword')}}" method="POST" name="UpdatePasswordForm" id="UpdatePasswordForm">
                                @csrf
                                <div class="card-body">
                                    {{--<div class="form-group">
                                        <label for="admin_name">Admin Name</label>
                                        <input type="text" readonly="" class="form-control" value="{{$auth->name}}" name="admin_name" id="admin_name" placeholder="Admin Name/Subname">
                                    </div>--}}
                                    <div class="form-group">
                                        <label for="email">Admin Email address</label>
                                        <input type="text" readonly="" value="{{$auth->email}}" class="form-control" id="email" placeholder="Enter Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Admin Type</label>
                                        <input type="text" readonly="" value="{{$auth->type}}" class="form-control" id="type" placeholder="Enter Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" required="" class="form-control" name="current_password" id="current_password" placeholder="Enter Current Password">
                                        <span id="check_current_pwd"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" required="" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" required="" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password">
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
