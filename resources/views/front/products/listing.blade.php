@extends('front.include.layouts')
@section('title')
    Listing Page
@endsection
@section('content')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{route('front.index')}}">Home</a><span class="divider">/</span></li>
            <li class="active"><?php  echo $catagoryDetails['breadcrumbs']; ?></li>
        </ul>
        <h3> {{$catagoryDetails['catDetails']['category_name']}} <small class="pull-right"> {{count($categoryProducts)}}
                products are available </small></h3>
        <hr class="soft"/>
        <p>
            {{$catagoryDetails['catDetails']['description']}}
        </p>
        <hr class="soft"/>
        <form class="form-horizontal span6" name="sortProducts" id="sortProducts">
            <input type="hidden" name="url" id="url" value="{{$url}}">
            <div class="control-group">
                <label class="control-label alignL">Sort By </label>
                <select name="sort" id="sort">
                    <option value="">Default</option>
                    <option value="latest_product"
                            @if(isset($_GET['sort']) && $_GET['sort'] == 'latest_product') selected="" @endif >Latest
                        Products
                    </option>
                    <option value="product_name_a_z"
                            @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_z') selected="" @endif >Product
                        name A - Z
                    </option>
                    <option value="product_name_z_a"
                            @if(isset($_GET['sort']) && $_GET['sort'] == 'product_name_z_a') selected="" @endif >Product
                        name Z - A
                    </option>
                    <option value="product_price_lowest"
                            @if(isset($_GET['sort']) && $_GET['sort'] == 'product_price_lowest') selected="" @endif >
                        Lowest Price first
                    </option>
                    <option value="product_price_highest"
                            @if(isset($_GET['sort']) && $_GET['sort'] == 'product_price_highest') selected="" @endif >
                        Highest Price first
                    </option>
                </select>
            </div>
        </form>

        <br class="clr"/>
        <div class="tab-content filter_products">
            @include('front.products.ajax_products_listing')
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
