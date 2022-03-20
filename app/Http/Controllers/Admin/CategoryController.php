<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $category = Category::get();
        return view('admin.categories.categories', compact('category'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id = null)
    {
        if ($id == "") {
            $title = 'Add Category';
            /*add category funtionality*/
        } else {
            $title = 'Edit Category';
            /*edit category funtionality*/
        }
        $getSection = Section::get();
        return view('admin.categories.add_edit_category',compact('title','getSection'));
    }
}
