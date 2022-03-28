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
                <form
                    {{--action="{{url('admin/add-edit-product')}}"--}}
                    @if(empty($banner['id'])) action="{{url('admin/add-edit-banner')}}" @else
                    action="{{url('admin/add-edit-banner/'.$banner['id'])}}"
                    @endif
                    name="bannerForm" id="bannerForm" method="POST" enctype="multipart/form-data">
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
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($banner['title']))
                                               value="{{$banner['title']}}"
                                               @else
                                               value="{{old('title')}}"
                                               @endif
                                               name="title" id="title" placeholder="Enter Title" required="">
                                        @error('title') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Banner Link</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($banner['link']))
                                               value="{{$banner['link']}}"
                                               @else
                                               value="{{old('link')}}"
                                               @endif
                                               name="link" id="link" placeholder="Enter Link" required="">
                                        @error('link') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alt">Banner Alternate Text</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($banner['alt']))
                                               value="{{$banner['alt']}}"
                                               @else
                                               value="{{old('alt')}}"
                                               @endif
                                               name="alt" id="alt" placeholder="Enter Alternate Text" required="">
                                        @error('alt') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Banner Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="image" required="">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                        </div>
                                        @if(!empty($banner['image']))
                                            <img style="width: 200px; height: 85px;" src="{{'/image/admin/banner_images/'.$banner['image']}}" alt="">
                                        @endif
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

