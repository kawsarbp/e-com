<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            $category = new Category;
        } else {
            $title = 'Edit Category';
            /*edit category funtionality*/
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            /*category validation*/
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'image',
            ];
            $customMessage = [
                'category_name.required' => 'Category Name is required !',
                'category_name.regex' => 'Valid Category Name is required !',
                'section_id.required' => 'Please Select your Section !',
                'category_image.image' => 'Please Select your Image !',
                'url.required' => 'Please Enter your Url !',
            ];
            $this->validate($request, $rules, $customMessage);

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;

            /*upload Category image*/
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $extenstion = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111111111, 999999999) . date('dmyhis.') . $extenstion;
                    $image_path = 'image/admin/category_images';
                    // Image::make($image_tmp)->save($image_path);
                    $image_tmp->move($image_path, $image_name);

                    $category->category_image = $image_name;
                }
            }

            $category->save();

            Session::flash('message', 'Category Save Successfully!');
            Session::flash('type', 'success');
            return redirect()->route('admin.categories');
        }

        $getSection = Section::get();
        return view('admin.categories.add_edit_category', compact('title', 'getSection'));
    }

    /*category append level*/
    public function appendCategoriesLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $getCategories = Category::with('subcategories')->where(['section_id' => $data['section_id'],'parent_id'=>0,'status'=>1])->get();
            $getCategories = json_decode(json_encode($getCategories),true);

            return view('admin.categories.append_categories_level',compact('getCategories'));
        }
    }


}
