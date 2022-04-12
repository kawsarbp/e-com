<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
//use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Route;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            /*echo "<pre>";print_r($data);die;*/
            $url = $data['url'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $catagoryDetails = Category::catDetails($url);
                $catProducts = Product::with('brand')->whereIn('category_id', $catagoryDetails['catIds'])->where('status', 1);
                /*check for fabric*/
                if (isset($data['fabric']) && !empty($data['fabric'])) {
                    $catProducts->whereIn('products.fabric',$data['fabric']);
                }
                /*check for sleeve*/
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $catProducts->whereIn('products.sleeve',$data['sleeve']);
                }
                /*check for pattern*/
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $catProducts->whereIn('products.pattern',$data['pattern']);
                }
                /*check for fit*/
                if (isset($data['fit']) && !empty($data['fit'])) {
                    $catProducts->whereIn('products.fit',$data['fit']);
                }
                /*check for occasion*/
                if (isset($data['occasion']) && !empty($data['occasion'])) {
                    $catProducts->whereIn('products.occasion',$data['occasion']);
                }
                /*sort*/
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == 'latest_product') {
                        $catProducts->orderBy('id', 'Desc');
                    } else if ($data['sort'] == 'product_name_a_z') {
                        $catProducts->orderBy('product_name', 'Asc');
                    } else if ($data['sort'] == 'product_name_z_a') {
                        $catProducts->orderBy('product_name', 'Desc');
                    } else if ($data['sort'] == 'product_price_lowest') {
                        $catProducts->orderBy('product_price', 'Asc');
                    } else if ($data['sort'] == 'product_price_highest') {
                        $catProducts->orderBy('product_price', 'Desc');
                    }
                } else {
                    $catProducts->orderBy('id', 'Asc');
                }
                $categoryProducts = $catProducts->paginate(18);
                return view('front.products.ajax_products_listing', compact('catagoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }
        else {
            /*dynamic url*/
            $url = Route::getFacadeRoot()->current()->uri();

            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $catagoryDetails = Category::catDetails($url);
                $catProducts = Product::with('brand')->whereIn('category_id', $catagoryDetails['catIds'])->where('status', 1);
                $categoryProducts = $catProducts->paginate(18);

                $productFilters = Product::productFilters();
                $fabricArray = $productFilters['fabricArray'];
                $sleeveArray = $productFilters['sleeveArray'];
                $patternArray = $productFilters['patternArray'];
                $fitArray = $productFilters['fitArray'];
                $occasionArray = $productFilters['occasionArray'];

                $page_name = "listing";
                return view('front.products.listing', compact('catagoryDetails', 'categoryProducts', 'url','fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray','page_name'));
            } else {
                abort(404);
            }
        }
    }
    /*product details page*/
    public function details($id)
    {
        $productDetails = Product::with('category','brand','attributes','images')->find($id);

        if(empty($productDetails))
            return redirect()->back();
        else
        return view('front.products.details',compact('productDetails'));
    }

}
