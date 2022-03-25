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
                            <li class="breadcrumb-item active">Brands</li>
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
                    {{--action="{{url('admin/add-edit-category')}}"--}}

                    @if(empty($categorydata['id'])) action="{{url('admin/add-edit-brand')}}" @else
                    action="{{url('admin/add-edit-brand/'.$categorydata['id'])}}"
                    @endif
                    name="brandForm" id="brandForm" method="POST">
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
                                    <div class="form-group">
                                        <label for="name">Brand Name</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($brand['name']))
                                               value="{{$brand['name']}}"
                                               @else
                                               value="{{old('brand')}}"
                                               @endif
                                               name="name" id="name" placeholder="Enter Brand Name">
                                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
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
