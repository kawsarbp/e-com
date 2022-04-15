<?php
use App\Models\Product;
?>
<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
        @foreach($categoryProducts as $product)
            <li class="span3">
                <div class="thumbnail">
                    <a href="product/{{$product['id']}}">
                        @if(!empty($product['main_image']))
                            <img style="height: 230px;" src="/image/admin/product_images/{{$product['main_image']}}"
                                 alt=""/>
                        @else
                            <img style="height: 230px;" src="/image/admin/product_images/no_image.png" alt="">
                        @endif
                    </a>
                    <?php $product_discount = Product::getDiscountedPrice($product['id']); ?>
                    <div class="caption">
                        <h5>{{$product['product_name']}} {{$product['id']}}</h5>
                        <p>
                            {{$product['brand']['name']}}
                        </p>
                        <h4 style="text-align:center">
                            <a class="btn" href="product/{{$product['id']}}"> <i class="icon-zoom-in"></i></a>
                            <a class="btn" href="javascript:void (0)">Add to <i class="icon-shopping-cart"></i></a>
                            <a class="btn btn-primary" href="javascript:void (0)">
                                @if($product_discount>0)
                                Rs. <del>{{$product['product_price']}}</del>
                                @else
                                Rs.{{$product['product_price']}}
                                @endif
                            </a>
                        </h4>
                        <p>
                            @if($product_discount>0)
                                Discounted Price:  Rs.{{$product_discount}}
                            @else
                                No Discount.
                            @endif
                        </p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <hr class="soft"/>
</div>
