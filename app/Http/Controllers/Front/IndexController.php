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
        $feturedItemCount = Product::where('is_featured','Yes')->count();
        $feturedItems = Product::where('is_featured','Yes')->get()->toArray();
        $feturedItemChunk  = array_chunk($feturedItems,4);
//        echo "<pre>";print_r($feturedItemChunk);die;

        $page_name = 'index';
        return view('front.index',compact('page_name','feturedItemChunk','feturedItemCount'));
    }
}
