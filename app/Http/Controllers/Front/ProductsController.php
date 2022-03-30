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
            $catProducts = Product::with('brand')->whereIn('category_id', $catagoryDetails['catIds'])->where('status', 1);
            /*sort*/
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                if ($_GET['sort'] == 'latest_product') {
                    $catProducts->orderBy('id', 'Desc');
                }else if ($_GET['sort'] == 'product_name_a_z') {
                    $catProducts->orderBy('product_name', 'Asc');
                }else if ($_GET['sort'] == 'product_name_z_a') {
                    $catProducts->orderBy('product_name', 'Desc');
                }else if ($_GET['sort'] == 'product_price_lowest') {
                    $catProducts->orderBy('product_price', 'Asc');
                }else if ($_GET['sort'] == 'product_price_highest') {
                    $catProducts->orderBy('product_price', 'Desc');
                }
            } else {
                $catProducts->orderBy('id', 'Asc');
            }
            $categoryProducts = $catProducts->paginate(3);
            return view('front.products.listing', compact('catagoryDetails', 'categoryProducts'));
        } else {
            abort(404);
        }
    }
}
