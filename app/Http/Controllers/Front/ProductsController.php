<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\User;
use Faker\Provider\Address;
use Illuminate\Http\Request;

//use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Auth;

//use Illuminate\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;


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
//            $getProductPrice = ProductsAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first();
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'], $data['size']);
            return $getDiscountedAttrPrice;
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
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => Auth::user()->id])->count();
            } else {
                /*User is not Logged in*/
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => Session::get('session_id')])->count();
            }
            if ($countProducts > 0) {
                $message = 'Product already Exists in Cart!';
                Session::flash('message', $message);
                Session::flash('type', 'danger');
                return redirect()->back();
            }

            if (Auth::check()) {
                $user_id = Auth::user()->id;
            } else {
                $user_id = 0;
            }
            /*save product in cart*/
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = 'Product has been added in cart !';
            Session::flash('message', $message);
            Session::flash('type', 'success');
            return redirect()->route('front.cart');
        }
    }

    /*hopping cart page*/
    public function cart()
    {
        $userCartItem = Cart::userCartItems();
        return view('front.products.cart', compact('userCartItem'));
    }

    /*update cart item qty*/
    public function updateCartItemQty(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            /*get cart details*/
            $cartDetails = Cart::find($data['cartid']);
            /*get available products*/
            $availableStock = ProductsAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first()->toArray();

            /*check available stock or not*/
            if ($data['qty'] > $availableStock['stock']) {
                $userCartItem = Cart::userCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product Stock is not Available!',
                    'view' => (string)View::make('front.products.cart_item', compact('userCartItem'))
                ]);
            }
            /*check size available or not*/
            $availableSize = ProductsAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size'], 'status' => 1])->count();
            if ($availableSize == 0) {
                $userCartItem = Cart::userCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product Size is not Available!',
                    'view' => (string)View::make('front.products.cart_item', compact('userCartItem'))
                ]);
            }
            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            $userCartItem = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status' => true,
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('front.products.cart_item', compact('userCartItem'))
            ]);

        }
    }

    /*delete cart item*/
    public function deleteCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cartid'])->delete();

            $userCartItem = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('front.products.cart_item', compact('userCartItem'))
            ]);
        }
    }

    /*apply Coupon*/
    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                $userCartItem = Cart::userCartItems();
                $totalCartItems = totalCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'This Coupon is not Valid',
                    'totalCartItems' => $totalCartItems,
                    'view' => (string)View::make('front.products.cart_item', compact('userCartItem'))
                ]);
            } else {
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                // coupon inactive
                if ($couponDetails->status == 0) {
                    $message = 'This coupon is not active!';
                }
                //expire date
                $expire_date = $couponDetails->expire_date;
                $current_date = date('Y-m-d');
                if ($expire_date < $current_date) {
                    $message = 'This coupon is Expired';
                }
                //coupon select form category
                //get all selected category
                $catArry = explode(",", $couponDetails->categories);
                //get cart items
                $userCartItem = Cart::userCartItems();
                // check if any cart item belong to coupon category

                //check if coupon belongs to logged in user
                //get all selected users of coupon
                if (!empty($couponDetails->users)) {
                    $userArry = explode(',', $couponDetails->users);
                    foreach ($userArry as $key => $user) {
                        $getUserID = User::select('id')->where('email', $user)->first()->toArray();
                        $userID[] = $getUserID['id'];
                    }
                }


                $total_amount = 0;
                foreach ($userCartItem as $key => $item) {
                    if (!in_array($item['product']['category_id'], $catArry)) {
                        $message = 'This Coupon code is not for one of the selected products!';
                    }
                    if (!empty($couponDetails->users)) {
                        if (!in_array($item['user_id'], $userID)) {
                            $message = 'This coupon is not for you !';
                        }
                    }
                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }

                if (isset($message)) {
                    $userCartItem = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json([
                        'status' => false,
                        'message' => $message,
                        'totalCartItems' => $totalCartItems,
                        'view' => (string)View::make('front.products.cart_item', compact('userCartItem'))
                    ]);
                } else {
                    //echo 'Coupon can be successfully ready !'; die;
                    //check if amount type is fixed or percentage
                    if ($couponDetails->amount_type == 'Fixed') {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }
                    $grand_total = $total_amount - $couponAmount;
                    // Add coupon code & amount in session variable
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);
                    $message = 'Coupon code successfully apply. You are available Discount!';
                    $userCartItem = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json([
                        'status' => true,
                        'message' => $message,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount' => $couponAmount,
                        'grand_total' => $grand_total,
                        'view' => (string)View::make('front.products.cart_item', compact('userCartItem'))
                    ]);
                }
            }
        }
    }

    /*checkout*/
    public function checkout(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['address_id'])) {
                $message = "Please Select Delivery Address !";
                return redirect()->back()->with(['message'=>$message,'type'=>'danger']);
            }
            if (empty($data['payment_method'])) {
                $message = "Please Select Payment Method !";
                return redirect()->back()->with(['message'=>$message,'type'=>'danger']);
            }
            return $data;
        }
        $userCartItem = Cart::userCartItems();
        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        return view('front.products.checkout', compact('userCartItem', 'deliveryAddresses'));
    }

    public function addEditDeliveryAddress(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Delivery Address";
            $address = new DeliveryAddress;
            $messsage = 'Your Delivery Address Added successfully !';
        } else {
            $title = "Edit Delivery Address";
            $address = DeliveryAddress::find($id);
            $messsage = 'Your Delivery Address Updated successfully !';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'pincode' => 'required|numeric',
            ];
            $customMessage = [
                'name.required' => 'This Name Field Is Required !',
                'name.alpha' => 'Valid name is required !',
                'mobile.required' => 'Mobile is required !',
                'address.required' => 'Address Field is required !',
                'address.city' => 'City Field is required !',
                'address.state' => 'State Field is required !',
                'address.country' => 'Country Field is required !',
                'address.pincode' => 'Pincode Field is required !',
            ];
            $this->validate($request, $rules, $customMessage);
            $address->user_id = Auth::user()->id;
            $address->name = $data['name'];
            $address->address = $data['address'];
            $address->city = $data['city'];
            $address->state = $data['state'];
            $address->country = $data['country'];
            $address->pincode = $data['pincode'];
            $address->mobile = $data['mobile'];
            $address->save();
            return redirect('/checkout')->with(['message' => $messsage, 'type' => 'success']);
        }
        $countries = Country::where('status', 1)->get();
        return view('front.products.add_edit_delivery_address', compact('countries', 'title', 'address'));
    }

    /*deleteDeliveryAddress*/
    public function deleteDeliveryAddress($id)
    {
        DeliveryAddress::where('id', $id)->delete();
        return redirect()->back()->with(['message' => 'Delivery Address Delete Successfully !', 'type' => 'success']);
    }

}
