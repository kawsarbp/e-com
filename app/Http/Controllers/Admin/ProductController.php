<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use function Spatie\Ignition\ErrorPage\jsonEncode;

class ProductController extends Controller
{
    public function products()
    {
        $product = Product::with(['category', 'section'])->get();
        return view('admin.products.products', compact('product'));
    }

    /*product status*/
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
        $product = Product::find($id);
        $image_parth = 'image/admin/product_images/' . $product->main_image;
        $video_parth = 'videos/product_videos/' . $product->product_video;
        if (File::exists($image_parth) || File::delete($video_parth)) {
            [File::delete($image_parth), File::delete($video_parth)];
        }
//        if (File::exists($video_parth)) {
//            File::delete($video_parth);
//        }
        $product->delete();
        return redirect()->back()->with(['message' => 'Product Delete Successfully!', 'type' => 'success']);
    }

    /*add product*/
    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Product";
            $product = new Product;
            $productdata = array();
            $message = "Product Save Successfully!";
        } else {
            $title = "Edit Product";
            $productdata = Product::find($id);
            $product = Product::find($id);
            if (!$product)
                return redirect()->back();
            $message = "Product Update Successfully !";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*product validation*/
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessage = [
                'category_id.required' => 'Category is required !',
                'product_name.required' => 'Product name is required !',
                'product_name.regex' => 'Valid Product name is required !',
                'product_price.required' => 'Product Price is required !',
                'product_price.numeric' => 'Valid Product Price is required !',
                'product_color.required' => 'Product Color is required !',
                'product_color.regex' => 'Valid Product Color is required !',
            ];
            $this->validate($request, $rules, $customMessage);
            /*save product details*/
            if (empty($data['is_featured'])) {
                $is_featured = "No";
            } else {
                $is_featured = "Yes";
            }
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];
            $product->occasion = $data['occasion'];
            $product->is_featured = $is_featured;
            $product->status = 1;
            /*image upload*/
            if ($request->hasFile('main_image')) {
                $image_tmp = $request->file('main_image');
                if ($image_tmp->isValid()) {
                    $extenstion = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111111111, 999999999) . date('dmyhis.') . $extenstion;
                    $image_path = 'image/admin/product_images/';
                    $image_tmp->move($image_path, $image_name);

                    $product->main_image = $image_name;
                }
            }
            /*upload product video*/
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    $extenstion = $video_tmp->getClientOriginalExtension();
                    $video_name = rand(111111111, 999999999) . date('dmyhis.') . $extenstion;
                    $video_path = 'videos/product_videos/';
                    $video_tmp->move($video_path, $video_name);
                    $product->product_video = $video_name;
                }
            }

            $product->save();
            Session::flash('message', $message);
            Session::flash('type', 'success');
            return redirect()->route('admin.products');
        }

        $fabricArray = array('Cotton', 'Polyester', 'Wool');
        $sleeveArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fitArray = array('Regular', 'Slim');
        $occasionArray = array('Casual', 'Formal');
        //sections with categories and sub categories
        $categories = Section::with('categories')->get();

        return view('admin.products.add_edit_products', compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'categories', 'productdata'));
    }

    /*product delete image*/
    public function deleteProductImage($id)
    {
        $productImage = Product::select('main_image')->where('id', $id)->first();
        $image_parth = 'image/admin/product_images/';
        if (file_exists($image_parth . $productImage->main_image)) {
            unlink($image_parth . $productImage->main_image);
        }
        Product::where('id', $id)->update(['main_image' => '']);
        return redirect()->back()->with(['message' => 'Product Image Deleted!', 'type' => 'success']);
    }

    /*product delete video*/
    public function deleteProductVideo($id)
    {
        $productImage = Product::select('product_video')->where('id', $id)->first();
        $image_parth = 'videos/product_videos/';
        if (file_exists($image_parth . $productImage->product_video)) {
            unlink($image_parth . $productImage->product_video);
        }
        Product::where('id', $id)->update(['product_video' => '']);
        return redirect()->back()->with(['message' => 'Product Video Deleted!', 'type' => 'success']);
    }

    /*addAttributes*/
    public function addAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    $attrCountSize = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSize > 0) {
                        return redirect()->back()->with(['message' => 'This Size already Exists, Please try another Size.', 'type' => 'warning']);
                    }
                    $attrCountSku = ProductsAttribute::where(['product_id' => $id, 'sku' => $value])->count();
                    if ($attrCountSku > 0) {
                        return redirect()->back()->with(['message' => 'This SKU already Exists, Please try another SKU.', 'type' => 'warning']);
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            return redirect()->back()->with(['message' => 'Products Attributes Save Successfully !', 'type' => 'success']);
        }

        $productdata = Product::select('id', 'product_name', 'product_code', 'product_color', 'main_image')->with('attributes')->find($id);
        if (empty($productdata))
            return redirect()->back();
        else

            $title = 'Products Attributes';
        return view('admin.products.add_attributes', compact('productdata', 'title'));
    }

    /*edit attributes*/
    public function editAttributes(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['attrId'] as $key => $attr) {
                if (!empty($attr)) {
                    ProductsAttribute::where(['id' => $data['attrId'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect()->back()->with(['message' => 'Products Attributes Update Successfully !', 'type' => 'success']);
        }
    }

    /*attribute status*/
    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    /*delete product attribute*/
    public function deleteAttribute($id)
    {
        $product = ProductsAttribute::find($id);
        $product->delete();
        return redirect()->back()->with(['message' => 'Product Attribute Delete Successfully!', 'type' => 'success']);
    }

    /*product addImages*/
    public function addImages(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $key => $image) {
                    $productImage = new ProductsImage;
                    $extenstion = $image->getClientOriginalExtension();
                    $image_name = rand(111111111, 999999999) . date('dmyhis.') . $extenstion;
                    $image_path = 'image/admin/product_images/';
                    $image->move($image_path, $image_name);

                    $productImage->image = $image_name;
                    $productImage->product_id = $id;
                    $productImage->status = 1;
                    $productImage->save();
                }
            }
            return redirect()->back()->with(['message' => 'Product Image Add Successfully!', 'type' => 'success']);
        }

        $title = "Product Images";
        $productdata = Product::with('images')->select('id', 'product_name', 'product_code', 'product_color', 'main_image')->find($id);
        if (empty($productdata))
            return redirect()->back();
        else
            return view('admin.products.add_images', compact('productdata', 'title'));
    }

    /*Image status*/
    public function updateImageStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }

    /*delete image*/
    public function deleteImage($id)
    {
        $productImage = ProductsImage::select('image')->where('id', $id)->first();
        $image_parth = 'image/admin/product_images/';
        if (file_exists($image_parth . $productImage->image)) {
            unlink($image_parth . $productImage->image);
        }
        ProductsImage::where('id', $id)->delete();
        return redirect()->back()->with(['message' => 'Product Image Deleted!', 'type' => 'success']);
    }
    /*edit image*/
    public function editImage($id)
    {
        return $id;
    }

}
