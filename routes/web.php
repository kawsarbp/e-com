<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\UsersController;
use App\Http\Controllers\HomeController;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


//Auth::routes();

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('/admin')->name('admin.')->group(function () {
    /*Admin Routes*/
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('login');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
        Route::post('/check-current-password', [AdminController::class, 'checkcurrentpassword'])->name('checkcurrentpassword');
        Route::post('/update-current-password', [AdminController::class, 'checkupdatepassword'])->name('checkupdatepassword');
        Route::match(['get', 'post'], '/update-admin-details', [AdminController::class, 'admindetails'])->name('admindetails');
        /*Section Routes*/
        Route::get('/sections', [SectionController::class, 'sections'])->name('sections');
        Route::post('/update-section-status', [SectionController::class, 'updateSectionStatus'])->name('updateSectionStatus');
        /*Category Routes*/
        Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
        Route::post('/update-category-status', [CategoryController::class, 'updateCategoryStatus'])->name('updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory'])->name('addEditCategory');
        Route::post('/append-categories-level', [CategoryController::class, 'appendCategoriesLevel'])->name('appendCategoriesLevel');
        Route::get('/category-delete-image/{id}', [CategoryController::class, 'deleteCategoryImage'])->name('deleteCategoryImage');
        Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        /*Product Routes*/
        Route::get('/products', [ProductController::class, 'products'])->name('products');
        Route::post('/update-product-status', [ProductController::class, 'updateProductStatus'])->name('updateProductStatus');
        Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::match(['get', 'post'], '/add-edit-product/{id?}', [ProductController::class, 'addEditProduct'])->name('addEditProduct');
        Route::get('/product-delete-image/{id}', [ProductController::class, 'deleteProductImage'])->name('deleteProductImage');
        Route::get('/product-delete-video/{id}', [ProductController::class, 'deleteProductVideo'])->name('deleteProductVideo');
        /*Attribute Routes*/
        Route::match(['get', 'post'], '/add-attributes/{id}', [ProductController::class, 'addAttributes'])->name('addAttributes');
        Route::post('/edit-attributes/{id}', [ProductController::class, 'editAttributes'])->name('editAttributes');
        Route::post('/update-attribute-status', [ProductController::class, 'updateAttributeStatus'])->name('updateAttributeStatus');
        Route::get('/delete-attribute/{id}', [ProductController::class, 'deleteAttribute'])->name('deleteAttribute');
        /*Product Images Routes*/
        Route::match(['get', 'post'], '/add-images/{id}', [ProductController::class, 'addImages'])->name('addImages');
        Route::post('/update-image-status', [ProductController::class, 'updateImageStatus'])->name('updateImageStatus');
        Route::get('/delete-image/{id}', [ProductController::class, 'deleteImage'])->name('deleteImage');
        //Route::post('/edit-images/{id}',[ProductController::class,'editImage'])->name('editImage');
        /*Brand Routes*/
        Route::get('/brands', [BrandController::class, 'brands'])->name('brands');
        Route::post('/update-brand-status', [BrandController::class, 'updateBrandStatus'])->name('updateBrandStatus');
        Route::post('/update-brand-status', [BrandController::class, 'updateBrandStatus'])->name('updateBrandStatus');
        Route::match(['get', 'post'], '/add-edit-brand/{id?}', [BrandController::class, 'addEditBrand'])->name('addEditBrand');
        Route::get('/delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('deleteBrand');
        /*Banner Routes*/
        Route::get('/banners', [BannerController::class, 'banners'])->name('banners');
        Route::post('/update-banner-status', [BannerController::class, 'updateBannerStatus'])->name('updateBannerStatus');
        Route::get('/delete-banner/{id}', [BannerController::class, 'deleteBanner'])->name('deleteBanner');
        Route::match(['get', 'post'], '/add-edit-banner/{id?}', [BannerController::class, 'addEditBanner'])->name('addEditBanner');
        /*Coupons Route*/
        Route::get('/coupons',[CouponsController::class,'coupons'])->name('coupons');
        Route::post('/update-coupon-status',[CouponsController::class,'updateCouponStatus']);
        Route::match(['get','post'],'/add-edit-coupon/{id?}',[CouponsController::class,'addEditCoupon']);
        Route::get('delete-coupon/{id}',[CouponsController::class,'deleteCoupon']);
        /*orders*/
        Route::get('/orders',[OrderController::class,'orders'])->name('orders');
        Route::get('/orders/{id}',[OrderController::class,'orderDetails']);
        Route::post('/update-order-status',[OrderController::class,'updateOrderStatus']);
        Route::get('/view-order-invoice/{id}',[OrderController::class,'viewOrderInvoice']);
        Route::get('/print-pdf-invoice/{id}',[OrderController::class,'printPdfInvoice']);
        /*shipping charges*/
        Route::get('/view-shipping-charges',[ShippingController::class,'shippingCharges'])->name('shippingCharges');
        Route::match(['GET','POST'],'/edit-shipping-charges/{id}',[ShippingController::class,'editShippingCharges']);
        Route::post('/update-shipping-status',[ShippingController::class,'updateShippingStatus']);
    });
});

/*Front End Routes*/
Route::name('front.')->group(function () {
    /*Home Page Route*/
    Route::get('/', [IndexController::class, 'index'])->name('index');
    /*Listing Route*/
    /*get category urls dynamic*/
    $catUrls = Category::select('url')->where(['status' => 1])->get()->pluck('url')->toArray();
    foreach ($catUrls as $url) {
        Route::get('/' . $url, [ProductsController::class, 'listing'])->name('listing');
    }
    /*product details route*/
    Route::get('/product/{id}',[ProductsController::class,'details'])->name('details');
    /*get product attribute price*/
    Route::post('/get-product-price',[ProductsController::class,'getProductPrice']);
    /*add to cart route*/
    Route::post('/add-to-cart',[ProductsController::class,'addTocCart']);
    /*shopping cart route*/
    Route::get('/cart',[ProductsController::class,'cart'])->name('cart');
    /*update cart item qty*/
    Route::post('/update-cart-item-qty',[ProductsController::class,'updateCartItemQty']);
    /*Delete cart item*/
    Route::post('/delete-cart-item',[ProductsController::class,'deleteCartItem']);
    /*login register route for users*/
    Route::get('/login-register',[UsersController::class,'loginRegister'])->name('loginRegister')->middleware('guest:web');
    /*register user*/
    Route::post('/register',[UsersController::class,'registerUser'])->name('registerUser');
    /*login user*/
    Route::post('/login-user',[UsersController::class,'loginUser'])->name('loginUser');
    /*logout user*/
    Route::get('/logout',[UsersController::class,'logoutUser'])->name('logoutUser');
    /*check-email*/
    Route::match(['get','post'],'/check-email',[UsersController::class,'checkEmail']);
    /*confirm email user*/
    Route::match(['GET','POST'],'/confirm/{code}',[UsersController::class,'confirmAccount']);
    /*forgot-password route*/
    Route::match(['GET','POST'],'/forgot-password',[UsersController::class,'forgotPassword']);

});

/*login register route for users*/
Route::get('/login',[UsersController::class,'loginRegister'])->name('login')->middleware('guest:web');

Route::middleware('auth:web')->group(function (){
    /*my account route*/
    Route::match(['GET','POST'],'/account',[UsersController::class,'account']);
    Route::get('/orders',[OrdersController::class,'orders']);
    Route::get('/orders/{id}',[OrdersController::class,'orderDetails']);

    /*my account change password route*/
    Route::post('/check-user-password',[UsersController::class,'checkUserPassword']);
    Route::post('/update-user-password',[UsersController::class,'updateUserPassword']);
    Route::post('/apply-coupon',[ProductsController::class,'applyCoupon']);
    /*checkout*/
    Route::match(['GET','POST'],'/checkout',[ProductsController::class,'checkout']);
    Route::match(['GET','POST'],'/add-edit-delivery-address/{id?}',[ProductsController::class,'addEditDeliveryAddress']);
    Route::get('/delete-delivery-address/{id}',[ProductsController::class,'deleteDeliveryAddress']);
    /*thanks page*/
    Route::get('/thanks',[ProductsController::class,'thanks']);

});

