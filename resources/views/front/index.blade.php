<?php
use App\Models\Product;
?>
@extends('front.include.layouts')
@section('title')
    Home Page
@endsection
@section('content')
    <div class="span9">
        <div class="well well-small">
            <h4>Featured Products <small class="pull-right">{{$feturedItemCount}} featured products</small></h4>
            <div class="row-fluid">
                <div id="featured"  @if($feturedItemCount > 4) class="carousel slide" @endif >
                    <div class="carousel-inner">
                        @foreach($feturedItemChunk as $key=>$featuredItem)
                            <div class="item @if($key == 1) active @endif ">
                                <ul class="thumbnails">
                                    @foreach($featuredItem as $item)
                                        <?php $product_discount = Product::getDiscountedPrice($item['id']); ?>
                                        <li class="span3">
                                            <div class="thumbnail">
                                                <i class="tag"></i>
                                                <a href="/product/{{$item['id']}}">
                                                    @if(!empty($item['main_image']))
                                                        <img src="/image/admin/product_images/{{$item['main_image']}}"
                                                             alt="">
                                                    @else
                                                        <img src="/image/admin/product_images/no_image.png" alt="">
                                                    @endif
                                                </a>
                                                <div class="caption">
                                                    <h5>{{$item['product_name']}}</h5>
                                                    <h4>
                                                        <a class="btn" href="/product/{{$item['id']}}">VIEW</a>
                                                        <span class="pull-right">
                                                            @if($product_discount>0)
                                                                Rs. <del>{{$item['product_price']}}</del>
                                                            @else
                                                                Rs.{{$item['product_price']}}
                                                            @endif
                                                        </span>
                                                    </h4>
                                                    @if($product_discount>0)
                                                        <div style="text-align: center; font-weight: bold; font-style: italic;">Discounted Price:  Rs. <font color="green">{{$product_discount}}</font> </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    {{--<a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#featured" data-slide="next">›</a>--}}
                </div>
            </div>
        </div>
        <h4>Latest Products </h4>
        <ul class="thumbnails">
            @foreach($newProducts as $product)
                <?php $discounted_price = Product::getDiscountedPrice($product['id']); ?>
                <li class="span3">
                    <div class="thumbnail">
                        <a href="/product/{{$product['id']}}">
                            @if(!empty($product['main_image']))
                                <img style="height: 250px;" src="/image/admin/product_images/{{$product['main_image']}}"
                                     alt="">
                            @else
                                <img style="height: 250px;" src="/image/admin/product_images/no_image.png" alt="">
                            @endif
                        </a>
                        <div class="caption">
                            <h5>{{$product['product_name']}}</h5>
                            <p>
                                {{$product['product_code']}}
                                ({{$product['product_color']}})
                            </p>

                            <h4 style="text-align:center">
{{--                                <a class="btn" href="/product/{{$product['id']}}"> <i class="icon-zoom-in"></i></a>--}}
                                <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
                                <a class="btn btn-primary" href="javascript:void (0)">
                                    @if($discounted_price>0)
                                        Rs. <del>{{$product['product_price']}}</del>
                                        <font color="yellow">{{$discounted_price}}</font>
                                    @else
                                        Rs.{{$product['product_price']}}
                                    @endif
                                </a>
                            </h4>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
