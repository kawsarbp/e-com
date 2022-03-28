<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        /*Featured Item*/
        $feturedItemCount = Product::where(['is_featured'=>'Yes','status'=>1])->count();
        $feturedItems = Product::where(['is_featured'=>'Yes','status'=>1])->get()->toArray();
        $feturedItemChunk  = array_chunk($feturedItems,4);
        /*New Products*/
        $newProducts = Product::orderBy('id','desc')->where('status',1)->limit(6)->get()->toArray();

//        echo "<pre>";print_r($newProducts);die;

        $page_name = 'index';
        return view('front.index',compact('page_name','feturedItemChunk','feturedItemCount','newProducts'));
    }
}
