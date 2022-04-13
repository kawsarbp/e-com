<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use Illuminate\Http\Request;

//use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Auth;
//use Illuminate\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


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
                    $catProducts->whereIn('products.fabric', $data['fabric']);
                }
                /*check for sleeve*/
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $catProducts->whereIn('products.sleeve', $data['sleeve']);
                }
                /*check for pattern*/
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $catProducts->whereIn('products.pattern', $data['pattern']);
                }
                /*check for fit*/
                if (isset($data['fit']) && !empty($data['fit'])) {
                    $catProducts->whereIn('products.fit', $data['fit']);
                }
                /*check for occasion*/
                if (isset($data['occasion']) && !empty($data['occasion'])) {
                    $catProducts->whereIn('products.occasion', $data['occasion']);
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
        } else {
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
                return view('front.products.listing', compact('catagoryDetails', 'categoryProducts', 'url', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'page_name'));
            } else {
                abort(404);
            }
        }
    }

    /*product details page*/
    public function details($id)
    {
        $productDetails = Product::with(['category', 'brand', 'attributes' => function ($query) {
            $query->where('status', 1);
        }, 'images'])->find($id)->toArray();
        $total_stoke = ProductsAttribute::where('product_id', $id)->sum('stock');
        $relatedProducts = Product::where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(3)->inRandomOrder()->get()->toArray();

        if (empty($productDetails))
            return redirect()->back();
        else
            return view('front.products.details', compact('productDetails', 'total_stoke', 'relatedProducts'));
    }

    /*get product details page price*/
    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getProductPrice = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first();
            return $getProductPrice->price;
        }
    }

    /*add to cart*/
    public function addTocCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*product available in stock*/
            $getProductStock = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first();
            if ($getProductStock['stock'] < $data['quantity']) {
                $message = 'Quantity is not Available!';
                Session::flash('message', $message);
                Session::flash('type', 'danger');
                return redirect()->back();
            }
            /*generate session id if not exist*/
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }
            /*product already exists session_id or User_id*/
            if (Auth::check()) {
                /*User is Logged in*/
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'],'user_id'=>Auth::user()->id ])->count();
            } else {
                /*User is not Logged in*/
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'],'session_id'=>Session::get('session_id')])->count();
            }
            if ($countProducts > 0) {
                $message = 'Product already Exists in Cart!';
                Session::flash('message', $message);
                Session::flash('type', 'danger');
                return redirect()->back();
            }
            /*save product in cart*/
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = 'Product has been added in cart !';
            Session::flash('message', $message);
            Session::flash('type', 'success');
            return redirect()->back();
        }
    }

    /*hopping cart page*/
    public function cart()
    {
        $userCartItem = Cart::userCartItems();

        return view('front.products.cart',compact('userCartItem'));
    }

}
