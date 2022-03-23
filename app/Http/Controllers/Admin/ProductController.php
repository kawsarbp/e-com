<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function products()
    {
        $product = Product::with(['category', 'section'])->get();
        return view('admin.products.products', compact('product'));
    }

    /*status*/
    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    /*delete product*/
    public function deleteProduct($id)
    {
        $category = Product::find($id);
        $category->delete();
        return redirect()->back()->with(['message' => 'Product Delete Successfully!', 'type' => 'success']);
    }

    /*add product*/
    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Product";
        } else {
            $title = "Edit Product";
        }

        $fabricArry = array('Cotton','Polyester','Wool');
        $sleeveArry = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless');
        $patternArry = array('Checked','Plain','Printed','Self','Solid');
        $fitArry = array('Regular','Slim');
        $occasionArry = array('Casual','Formal');
        return view('admin.products.add_edit_products',compact('title','fabricArry','sleeveArry','patternArry','fitArry','occasionArry'));
    }
}
