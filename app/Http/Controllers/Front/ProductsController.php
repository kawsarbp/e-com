<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function listing($url, Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $url = $data['url'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $catagoryDetails = Category::catDetails($url);
                $catProducts = Product::with('brand')->whereIn('category_id', $catagoryDetails['catIds'])->where('status', 1);
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
                $categoryProducts = $catProducts->paginate(3);
                return view('front.products.ajax_products_listing', compact('catagoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        } else {
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $catagoryDetails = Category::catDetails($url);
                $catProducts = Product::with('brand')->whereIn('category_id', $catagoryDetails['catIds'])->where('status', 1);
                $categoryProducts = $catProducts->paginate(3);

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
}
