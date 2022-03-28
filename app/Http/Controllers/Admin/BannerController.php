<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    public function banners()
    {
        $banners = Banner::get();
        return view('admin.banners.banners', compact('banners'));
    }

    /*status*/
    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    /*delete banner*/
    public function deleteBanner($id)
    {
        $banner = Banner::find($id);
        $image_parth = 'image/admin/banner_images/' . $banner->image;
        if (File::exists($image_parth)) {
            File::delete($image_parth);
        }
        $banner->delete();
        return redirect()->back()->with(['message' => 'Banner Delete Successfully!', 'type' => 'success']);
    }

    /*addEditBanner*/
    public function addEditBanner(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Banner Image";
            $banner = new Banner;
            $message = 'Banner Added Successfully';
        } else {
            $title = "Edit Banner Image";
            $banner = Banner::find($id);
            $message = 'Banner Update Successfully';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $banner->title = $data['title'];
            $banner->link = $data['link'];
            $banner->alt = $data['alt'];

            if ($request->hasFile('image')) {
                $images = $request->file('image');
                if($images->isValid())
                {
                    $extenstion = $images->getClientOriginalExtension();
                    $image_name = rand(111111111, 999999999) . date('dmyhis.') . $extenstion;
                    $image_path = 'image/admin/banner_images/';
                    $images->move($image_path, $image_name);
                    $banner->image = $image_name;
                }
            }
            $banner->status = 1;
            $banner->save();

            Session::flash('message', $message);
            Session::flash('type', 'success');
            return redirect()->route('admin.banners');
        }
        return view('admin.banners.add_edit_banner', compact('title', 'banner'));
    }
}
