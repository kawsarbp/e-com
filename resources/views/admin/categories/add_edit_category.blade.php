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
                            <li class="breadcrumb-item active">Categories</li>
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
                    @if(empty($categorydata['id'])) action="{{url('admin/add-edit-category')}}" @else
                action="{{url('admin/add-edit-category/'.$categorydata['id'])}}"
                @endif
                    name="CategoryForm" id="CategoryForm" method="POST" enctype="multipart/form-data">
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
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($categorydata['category_name']))
                                                   value="{{$categorydata['category_name']}}"
                                               @else
                                               value="{{old('category_name')}}"
                                                   @endif
                                               name="category_name" id="category_name" placeholder="Enter Category Name">
                                        @error('category_name') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div id="appendCategoriesLevel">
                                        @include('admin.categories.append_categories_level')
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="section_id">Select Section</label>
                                        <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                                            <option value=""> -- Select -- </option>
                                            @foreach($getSection as $section)
                                                <option
                                                    @if (!empty($categorydata['section_id']) && $categorydata['section_id'] == $section->id) selected @endif value="{{$section->id}}">
                                                    {{$section->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('section_id') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="category_image">Category Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="category_image" id="category_image">
                                                <label class="custom-file-label" for="category_image">Choose file</label>
                                            </div>
                                            {{--<div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>--}}
                                        </div>
                                        @if(!empty($categorydata['category_images']))
                                        <img style="width: 100px; height: 85px;" src="{{'/image/admin/category_images/'.$categorydata['category_images']}}" alt="">
                                            <a href="{{url('admin/category-delete-image/'.$categorydata['id'])}}">Delete Image</a>
                                        @endif
                                        @error('category_image') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="category_discount">Category Discount</label>
                                        <input type="text" class="form-control" name="category_discount" id="category_discount" placeholder="Enter Category Discount"
                                               @if(!empty($categorydata['category_discount']))
                                               value="{{$categorydata['category_discount']}}"
                                               @else
                                               value="{{old('category_discount')}}"
                                            @endif
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Category Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Description">
                                            @if(!empty($categorydata['description']))
                                                {{$categorydata['description']}}
                                            @else
                                                {{old('description')}}
                                            @endif
                                        </textarea>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="url">Category Url</label>
                                        <input type="text" class="form-control" id="url" name="url" placeholder="Enter Category Url"
                                               @if(!empty($categorydata['url']))
                                               value="{{$categorydata['url']}}"
                                               @else
                                               value="{{old('url')}}"
                                            @endif
                                        >
                                        @error('url') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea id="meta_title" name="meta_title" class="form-control" rows="3" placeholder="Meta Title">
                                            @if(!empty($categorydata['meta_title']))
                                                {{$categorydata['meta_title']}}
                                            @else
                                                {{old('meta_title')}}
                                            @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Description">
                                            @if(!empty($categorydata['meta_description']))
                                                {{$categorydata['meta_description']}}
                                            @else
                                                {{old('meta_description')}}
                                            @endif
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea id="meta_keywords" name="meta_keywords" class="form-control" rows="3" placeholder="Description">
                                            @if(!empty($categorydata['meta_keywords']))
                                                {{$categorydata['meta_keywords']}}
                                            @else
                                                {{old('meta_keywords')}}
                                            @endif
                                        </textarea>
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
