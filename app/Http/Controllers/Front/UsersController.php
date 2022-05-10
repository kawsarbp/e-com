<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /*login register pages*/
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    /*user register*/
    public function registerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /*check user already exists*/
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                return redirect()->back()->with(['message' => 'Email already exists!', 'type' => 'danger']);
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();
//                return redirect()->back()->with(['message'=>'user registration successfully !','type'=>'success']);
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    /*update user cart with userid*/
                    if (!empty(Session::get('session_id'))) {
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    }
                    
                    return redirect('t-shirt')/*->route('front.index')*/ ;
                }
            }
        }
    }

    /*login user*/
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
//            echo '<pre>'; print_r($data); die;
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                /*update user cart with userid*/
                if (!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }
                return redirect('/cart');
            } else {
                return redirect()->back()->with(['message' => 'Username or Password Invalid', 'type' => 'danger']);
            }
        }
    }

    /*user logout*/
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/');
    }

    /*validation user register page with jquery validator checkEmail*/
    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        if ($emailCount > 0) {
            return "false";
        } else {
            return "true";
        }
    }


}
