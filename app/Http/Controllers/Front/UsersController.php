<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
//            echo '<pre>'; print_r($data); die;
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
                    return redirect()->route('front.index');
                }
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
            echo "false";
        } else {
            echo "true";die;
        }
    }

}
