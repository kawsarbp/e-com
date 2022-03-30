@extends('front.include.layouts')
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a><span class="divider">/</span></li>
            <li class="active"><?php  echo $catagoryDetails['breadcrumbs']; ?></li>
        </ul>
        <h3> {{$catagoryDetails['catDetails']['category_name']}} <small class="pull-right"> {{count($categoryProducts)}} products are available </small></h3>
        <hr class="soft"/>
        <p>
            {{$catagoryDetails['catDetails']['description']}}
        </p>
        <hr class="soft"/>
        <form class="form-horizontal span6" name="sortProducts" id="sortProducts">
            <div class="control-group">
                <label class="control-label alignL">Sort By </label>
                <select name="sort" id="sort">
                    <option value="">Default</option>
                    <option value="latest_product" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest_product') selected="" @endif >Latest Products</option>
                    <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_z') selected="" @endif >Product name A - Z</option>
                    <option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_z_a') selected="" @endif >Product name Z - A</option>
                    <option value="product_price_lowest" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_price_lowest') selected="" @endif >Lowest Price first</option>
                    <option value="product_price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_price_highest') selected="" @endif >Highest Price first</option>
                </select>
            </div>
        </form>

        <div id="myTab" class="pull-right">
            <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
            <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
        </div>
        <br class="clr"/>
        <div class="tab-content">
            <div class="tab-pane" id="listView">
                @foreach($categoryProducts as $product)

                <div class="row">
                    <div class="span2">
                        @if(!empty($product['main_image']))
                            <img style="height: 160px;" src="/image/admin/product_images/{{$product['main_image']}}" alt=""/>
                        @else
                            <img  style="height: 230px;" src="/image/admin/product_images/no_image.png" alt="">
                        @endif
                    </div>
                    <div class="span4">
                        <h3>{{$product['product_name']}} </h3>
                        <hr class="soft"/>
                        <h5>{{$product['brand']['name']}}</h5>
                        <p>
                            {{$product['description']}}
                        </p>
                        <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                        <br class="clr"/>
                    </div>
                    <div class="span3 alignR">
                        <form class="form-horizontal qtyFrm">
                            <h3> ${{$product['product_price']}}</h3>
                            <label class="checkbox">
                                <input type="checkbox"> Adds product to compair
                            </label><br/>

                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i
                                    class=" icon-shopping-cart"></i></a>
                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                        </form>
                    </div>
                </div>
                <hr class="soft"/>

                @endforeach
            </div>
            <div class="tab-pane  active" id="blockView">
                <ul class="thumbnails">
                    @foreach($categoryProducts as $product)
                    <li class="span3">
                        <div class="thumbnail">
                            <a href="product_details.html">
                                @if(!empty($product['main_image']))
                                    <img style="height: 230px;" src="/image/admin/product_images/{{$product['main_image']}}" alt=""/>
                                @else
                                    <img  style="height: 230px;" src="/image/admin/product_images/no_image.png" alt="">
                                @endif
                            </a>
                            <div class="caption">
                                <h5>{{$product['product_name']}} {{$product['id']}}</h5>
                                <p>
                                    {{$product['brand']['name']}}
                                </p>
                                <h4 style="text-align:center"><a class="btn" href="javascript:void (0) "> <i
                                            class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i
                                            class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.{{$product['product_price']}}</a>
                                </h4>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <hr class="soft"/>
            </div>
        </div>
        <a href="javascript:void (0);" class="btn btn-large pull-right">Compare Product</a>
        <div class="pagination">
            @if(isset($_GET['sort']) && !empty($_GET['sort']))
                {{ $categoryProducts->appends(['sort' => $_GET['sort'] ]) }}
            @else
                {{ $categoryProducts->links() }}
            @endif
        </div>
        <br class="clr"/>
    </div>
@endsection
