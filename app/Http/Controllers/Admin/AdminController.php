<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
//use App\Http\Middleware\Admin as AdminMiddleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Intervention\Image\Facades\Image;
//use Image;
//use Intervention\Image\Image;
use function Spatie\LaravelIgnition\ContextProviders\resolveUpdates;
use function Symfony\Component\Console\Helper\removeDecoration;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    /*login*/
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('message', 'Incorrect Information !');
            }
        }
        return view('admin.login');
    }
    /*logout*/
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    /*settings*/
    public function settings()
    {
        $auth = Auth::guard('admin')->user();
        return view('admin.settings', compact('auth'));
    }
    /*password*/
    public function checkcurrentpassword(Request $request)
    {
        $data = $request->all();
        if (password_verify($data['current_password'], Auth::guard('admin')->user()->password)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function checkupdatepassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (password_verify($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => Hash::make($data['new_password'])]);
                    return redirect()->back()->with(['message' => 'Password Change Successfully !', 'type' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Password dont match !', 'type' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Your current Password is incorrect !', 'type' => 'danger']);
            }
        }
    }
    /*admin details*/
    public function admindetails(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $rules = [
              'name' => 'required|regex:/^[\pL\s\-]+$/u',
              'mobile' => 'required|numeric',
              'photo' => 'image',
            ];
            $customMessage = [
                'name.required' => 'This Name Field Is Required !',
                'name.alpha' => 'Valid name is required !',
                'mobile.required' => 'Mobile is required !',
                'photo.image' => 'Valid Image required !',
            ];
            $this->validate($request,$rules,$customMessage);
            /*upload image*/
            if($request->hasFile('photo'))
            {
                $image_tmp = $request->file('photo');
                if ($image_tmp->isValid())
                {
                   $extenstion = $image_tmp->getClientOriginalExtension();
                    $image_name = rand(111111111,999999999).date('dmyhis.').$extenstion;
                    $image_path = 'image/admin/admin_image';
//                    Image::make($image_tmp)->save($image_path);
                    $image_tmp->move($image_path,$image_name);
                }elseif (!empty($data['current_admin_image']))
                {
                    $image_name = $data['current_admin_image'];
                }else
                {
                    $image_name = "";
                }
            }
            /*update admin details*/
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'photo'=>$image_name]);
            session()->flash('message','update successfully!');
            session()->flash('type','success');
            return  redirect()->back();
        }
        return view('admin.update-admin-details');
    }
}

