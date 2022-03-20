<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
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


    });
});
