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
                    @if(empty($productdata['id'])) action="{{url('admin/add-edit-product')}}" @else
                    action="{{url('admin/add-edit-product/'.$productdata['id'])}}"
                    @endif
                    name="productForm" id="productForm" method="POST" enctype="multipart/form-data">
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
                                        <label for="category_id">Select Category</label>
                                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                            <option value=""> -- Select Category -- </option>
                                            @foreach($categories as $section)
                                                <optgroup label="{{$section['name']}}"></optgroup>
                                                @foreach($section['categories'] as $category)
                                                    <option value="{{$category['id']}}" @if(!empty(@old('category_id')) && $category['id'] == @old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$category['id'] ) selected=""  @endif > &nbsp;-- {{$category['category_name']}}</option>
                                                    @foreach($category['subcategories'] as $subcategory)
                                                        <option value="{{$subcategory['id']}}" @if(!empty(@old('category_id')) && $subcategory['id'] == @old('category_id')) selected="" @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$subcategory['id'] ) selected=""  @endif > &nbsp;&nbsp;&nbsp;&raquo; {{$subcategory['category_name']}}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('category_id') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="product_name">product Name</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($productdata['product_name']))
                                               value="{{$productdata['product_name']}}"
                                               @else
                                               value="{{old('product_name')}}"
                                               @endif
                                               name="product_name" id="product_name" placeholder="Enter product Name">
                                        @error('product_name') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">product Code</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($productdata['product_code']))
                                               value="{{$productdata['product_code']}}"
                                               @else
                                               value="{{old('product_code')}}"
                                               @endif
                                               name="product_code" id="product_code" placeholder="Enter product Code">
                                        @error('product_code') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">product Color</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($productdata['product_color']))
                                               value="{{$productdata['product_color']}}"
                                               @else
                                               value="{{old('product_color')}}"
                                               @endif
                                               name="product_color" id="product_color" placeholder="Enter product Color">
                                        @error('product_color') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_code">product Price</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($productdata['product_price']))
                                               value="{{$productdata['product_price']}}"
                                               @else
                                               value="{{old('product_price')}}"
                                               @endif
                                               name="product_price" id="product_price" placeholder="Enter product Price">
                                        @error('product_price') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_discount">product Discount (%)</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($productdata['product_discount']))
                                               value="{{$productdata['product_discount']}}"
                                               @else
                                               value="{{old('product_discount')}}"
                                               @endif
                                               name="product_discount" id="product_discount" placeholder="Enter product Discount">
                                        @error('product_discount') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_weight">product Weight</label>
                                        <input type="text" class="form-control"
                                               @if(!empty($productdata['product_weight']))
                                               value="{{$productdata['product_weight']}}"
                                               @else
                                               value="{{old('product_weight')}}"
                                               @endif
                                               name="product_weight" id="product_weight" placeholder="Enter product Weight">
                                        @error('product_weight') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="main_image">product Main Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="main_image" id="main_image">
                                                <label class="custom-file-label" for="main_image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="product_video">product Video</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="product_video" id="product_video">
                                                <label class="custom-file-label" for="product_video">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">product Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Description">
                                            @if(!empty($productdata['description']))
                                                {{$productdata['description']}}
                                            @else
                                                {{old('description')}}
                                            @endif
                                        </textarea>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="wash_care">Wash Care</label>
                                        <textarea id="wash_care" name="wash_care" class="form-control" rows="3" placeholder="Wash Care">
                                            @if(!empty($productdata['wash_care']))
                                                {{$productdata['wash_care']}}
                                            @else
                                                {{old('wash_care')}}
                                            @endif
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="fabric">Select Fabric</label>
                                        <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                                            <option value=""> -- Select Fabric -- </option>
                                            @foreach($fabricArray as $fabric)
                                                <option value="{{$fabric}}" @if(!empty($productdata['fabric']) && $productdata['fabric']==$fabric) selected="" @endif> {{$fabric}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="sleeve">Select Sleeve</label>
                                            <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                                                <option value=""> -- Select Occasion -- </option>
                                                @foreach($sleeveArray as $sleeve)
                                                    <option value="{{$sleeve}}" @if(!empty($productdata['sleeve']) && $productdata['sleeve']==$sleeve) selected="" @endif> {{$sleeve}} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="pattern">Select Pattern</label>
                                            <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                                                <option value=""> -- Select -- </option>
                                                @foreach($patternArray as $pattern)
                                                    <option value="{{$pattern}}" @if(!empty($productdata['pattern']) && $productdata['pattern']==$pattern) selected="" @endif >  {{$pattern}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="fit">Select Fit</label>
                                            <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                                                <option value=""> -- Select -- </option>
                                                @foreach($fitArray as $fit)
                                                    <option value="{{$fit}}" @if(!empty($productdata['fit']) && $productdata['fit']==$fit) selected="" @endif> {{$fit}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="occasion">Select Occasion</label>
                                            <select name="occasion" id="occasion" class="form-control select2" style="width: 100%;">
                                                <option value=""> -- Select -- </option>
                                                @foreach($occasionArray as $occasion)
                                                    <option value="{{$occasion}}" @if(!empty($productdata['occasion']) && $productdata['occasion']==$occasion) selected="" @endif> {{$occasion}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea id="meta_title" name="meta_title" class="form-control" rows="3" placeholder="Meta Title">
                                            @if(!empty($productdata['meta_title']))
                                                {{$productdata['meta_title']}}
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
                                            @if(!empty($productdata['meta_description']))
                                                {{$productdata['meta_description']}}
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
                                            @if(!empty($productdata['meta_keywords']))
                                                {{$productdata['meta_keywords']}}
                                            @else
                                                {{old('meta_keywords')}}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_featured">Featured Item</label>
                                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if(!empty($productdata['is_featured']) && $productdata['is_featured']=="Yes") checked="" @endif>
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

