<?php

use App\Models\Section;

$sections = Section::sections();
?>
<!-- Sidebar ================================================== -->
<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="/assets/front/images/ico-cart.png"
                                                                                 alt="cart">3 Items in your cart</a>
    </div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($sections as $section)
            @if(count($section['categories'])>0)
                <li class="subMenu"><a>{{$section['name']}}</a>
                    @foreach($section['categories'] as $category)
                        <ul>
                            <li><a href="{{url($category['url'])}}"><i
                                        class="icon-chevron-right"></i><strong>{{$category['category_name']}}</strong></a>
                            </li>
                            @foreach($category['subcategories'] as $subcategory)
                                <li><a href="{{url($subcategory['url'])}}"><i
                                            class="icon-chevron-right"></i>{{$subcategory['category_name']}}</a></li>
                            @endforeach
                        </ul>
                    @endforeach
                </li>
            @endif
        @endforeach
    </ul>
    <br>
    @if(isset($page_name) && $page_name=='listing')
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach($fabricArray as $fabric)
                <input style="margin-top: -3px;" type="checkbox" name="fabric[]" id="{{$fabric}}" value="{{$fabric}}"> {{$fabric}} <br>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach($sleeveArray as $sleeve)
                <input style="margin-top: -3px;" type="checkbox" name="sleeve[]" id="{{$sleeve}}" value="{{$sleeve}}"> {{$sleeve}} <br>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach($patternArray as $pattern)
                <input style="margin-top: -3px;" type="checkbox" name="pattern[]" id="{{$pattern}}" value="{{$pattern}}"> {{$pattern}} <br>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach($fitArray as $fit)
                <input style="margin-top: -3px;" type="checkbox" name="fit[]" id="{{$fit}}" value="{{$fit}}"> {{$fit}} <br>
            @endforeach
        </div>
        <div class="well well-small">
            <h5>Fabric</h5>
            @foreach($occasionArray as $occasion)
                <input style="margin-top: -3px;" type="checkbox" name="occasion[]" id="{{$occasion}}" value="{{$occasion}}"> {{$occasion}} <br>
            @endforeach
        </div>
    @endif
    <br/>
    <div class="thumbnail">
        <img src="/assets/front/images/payment_methods.png" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
<!-- Sidebar end=============================================== -->
