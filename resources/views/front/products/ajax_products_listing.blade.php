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
                    <div class="caption">
                        <h5>{{$product['product_name']}} {{$product['id']}}</h5>
                        <p>
                            {{$product['brand']['name']}}
                        </p>
                        <h4 style="text-align:center"><a class="btn" href="product/{{$product['id']}}"> <i
                                    class="icon-zoom-in"></i></a> <a class="btn" href="javascript:void (0)">Add to <i
                                    class="icon-shopping-cart"></i></a> <a class="btn btn-primary"
                                                                           href="javascript:void (0)">Rs.{{$product['product_price']}}</a>
                        </h4>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <hr class="soft"/>
</div>
