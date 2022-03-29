<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function listing($url)
    {
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $catagoryDetails = Category::catDetails($url);
            $categoryProducts = Product::with('brand')->whereIn('category_id', $catagoryDetails['catIds'])->where('status', 1)->get()->toArray();

            return view('front.products.listing', compact('catagoryDetails', 'categoryProducts'));
        } else {
            abort(404);
        }
    }
}
