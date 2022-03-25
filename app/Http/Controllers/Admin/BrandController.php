<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brands()
    {
        $brands = Brand::get();
        return view('admin.brands.brands', compact('brands'));
    }

    /*status*/
    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }

    /*addEditBrand*/
    public function addEditBrand(Request $request, $id = null)
    {
        if ($id == "") {
            $title = 'Add Brand';
            $brand = new Brand;
            $message = 'Brand Added Successfully!';

        } else {
            $title = 'Edit Brand';
            $message = 'Brand Update Successfully!';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            $this->validate($request, [
                'name' => 'required'
            ]);
            $brandcoutn = Brand::where(['name' => $data['name']])->count();
            if ($brandcoutn > 0) {
                return redirect()->back()->with(['message' => 'This brand is alrady exist', 'type' => 'warning']);
            }

            $brand->name = $data['name'];
            $brand->status = 1;
            $brand->save();

            return redirect()->back()->with(['message' => 'Brand Save successfully !', 'type' => 'success']);
        }

        return view('admin.brands.add_edit_brand', compact('title','brand'));
    }
    /*delete brand*/
    public function deleteBrand($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back()->with(['message' => 'Brand Delete Successfully!', 'type' => 'success']);
    }

}
