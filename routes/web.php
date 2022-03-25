<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('/admin')->name('admin.')->group(function (){
    /*Admin Route*/
    Route::match(['get','post'],'/login',[AdminController::class,'login'])->name('login');

    Route::group(['middleware'=>['admin']],function (){
        Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
        Route::get('/settings',[AdminController::class,'settings'])->name('settings');
        Route::get('/logout',[AdminController::class,'logout'])->name('logout');
        Route::post('/check-current-password',[AdminController::class,'checkcurrentpassword'])->name('checkcurrentpassword');
        Route::post('/update-current-password',[AdminController::class,'checkupdatepassword'])->name('checkupdatepassword');
        Route::match(['get','post'],'/update-admin-details',[AdminController::class,'admindetails'])->name('admindetails');
        /*Section Route*/
        Route::get('/sections',[SectionController::class,'sections'])->name('sections');
        Route::post('/update-section-status',[SectionController::class,'updateSectionStatus'])->name('updateSectionStatus');
        /*Category Route*/
        Route::get('/categories',[CategoryController::class,'categories'])->name('categories');
        Route::post('/update-category-status',[CategoryController::class,'updateCategoryStatus'])->name('updateCategoryStatus');
        Route::match(['get','post'],'add-edit-category/{id?}',[CategoryController::class,'addEditCategory'])->name('addEditCategory');
        Route::post('/append-categories-level',[CategoryController::class,'appendCategoriesLevel'])->name('appendCategoriesLevel');
        Route::get('/category-delete-image/{id}',[CategoryController::class,'deleteCategoryImage'])->name('deleteCategoryImage');
        Route::get('/delete-category/{id}',[CategoryController::class,'deleteCategory'])->name('deleteCategory');
        /*Product Route*/
        Route::get('/products',[ProductController::class,'products'])->name('products');
        Route::post('/update-product-status',[ProductController::class,'updateProductStatus'])->name('updateProductStatus');
        Route::get('/delete-product/{id}',[ProductController::class,'deleteProduct'])->name('deleteProduct');
        Route::match(['get','post'],'/add-edit-product/{id?}',[ProductController::class,'addEditProduct'])->name('addEditProduct');
        Route::get('/product-delete-image/{id}',[ProductController::class,'deleteProductImage'])->name('deleteProductImage');
        Route::get('/product-delete-video/{id}',[ProductController::class,'deleteProductVideo'])->name('deleteProductVideo');
        /*Attribute Route*/
        Route::match(['get','post'],'/add-attributes/{id}',[ProductController::class,'addAttributes'])->name('addAttributes');
        Route::post('/edit-attributes/{id}',[ProductController::class,'editAttributes'])->name('editAttributes');
        Route::post('/update-attribute-status',[ProductController::class,'updateAttributeStatus'])->name('updateAttributeStatus');
        Route::get('/delete-attribute/{id}',[ProductController::class,'deleteAttribute'])->name('deleteAttribute');
        /*Product Images Route*/

        Route::match(['get','post'],'/add-images/{id}',[ProductController::class,'addImages'])->name('addImages');
        Route::post('/update-image-status',[ProductController::class,'updateImageStatus'])->name('updateImageStatus');
        Route::get('/delete-image/{id}',[ProductController::class,'deleteImage'])->name('deleteImage');


    });
});
