<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
                $user->status = 0;
                $user->save();

                /*send confirmation email*/
                $email = $data['email'];
                $messageData = [
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'code' => base64_encode($data['email'])
                ];
                Mail::send('emails.confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm your E-commerce Account');
                });
                // redirect back success message
                $message = 'Please Check your email to activate your account!';
                return redirect()->back()->with(['message' => $message, 'type' => 'success']);

//                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
//                    /*update user cart with userid*/
//                    if (!empty(Session::get('session_id'))) {
//                        $user_id = Auth::user()->id;
//                        $session_id = Session::get('session_id');
//                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
//                    }
//                    /*send register sms*/
//                    /*$message = 'This is the test SMS from Faz Group LTD';
//                    $mobile = $data['mobile'];
//                    Sms::sendSms($message,$mobile);*/
//
//                    /*send register email offline*/
//                    $email = $data['email'];
//                    $messageData = ['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
//                    Mail::send('emails.register',$messageData,function ($message) use ($email){
//                        $message->to($email)->subject('Welcome to Faz Group LTD');
//                    });
//
//                    return redirect('t-shirt')/*->route('front.index')*/ ;
//                }

            }
        }
    }

    /*login user*/
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                /*check email active or not*/
                $userStatus = User::where('email', $data['email'])->first();
                if ($userStatus->status == 0) {
                    Auth::logout();
                    return redirect()->back()->with(['message' => 'You account is not activate yet ! Please confirm your email to active account', 'type' => 'danger']);
                }

                /*update user cart with userid*/
                if (!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }

                /*send login email offline*/
                /*$email = $data['email'];
                $messageData = ['email'=>$data['email']];
                Mail::send('emails.login',$messageData,function ($message) use ($email){
                    $message->to($email)->subject('Welcome to Faz Group LTD');
                });*/


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

    /*confirmAccount user with email*/
    public function confirmAccount($email)
    {
        /*decode email*/
        $email = base64_decode($email);
        /*email exists*/
        $userCount = User::where('email', $email)->count();
        if ($userCount > 0) {
            $userDetails = User::where('email', $email)->first();
            if ($userDetails->status == 1) {
                return redirect('login-register')->with(['message' => 'Your email account is already active. You can login', 'type' => 'success']);
            } else {
                User::where('email', $email)->update(['status' => 1]);

                /*send register email offline*/
                $messageData = ['name' => $userDetails['name'], 'mobile' => $userDetails['mobile'], 'email' => $email];
                Mail::send('emails.register', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Welcome to Faz Group LTD');
                });
                /*redirect login / register page with success message*/
                return redirect('login-register')->with(['message' => 'Your Email Account is Activate. You can login now.', 'type' => 'success']);

            }
        } else {
            abort(404);
        }
    }

    /*forgotPassword user*/
    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
//            echo '<pre>'; print_r($data); die;
            $emailCount = User::where('email', $data['email'])->count();
            if ($emailCount == 0) {
                return redirect()->back()->with(['message'=>'Email Dose not Exists !','type'=>'danger']);
            }
            /*generate new random password*/
            $random_password = str_random(8);
            /*encode secure password*/
            $new_password = bcrypt($random_password);
            /*update password*/
            User::where('email',$data['email'])->update(['password'=>$new_password]);
            /*get user name*/
            $userName = User::select('name')->where('email',$data['email'])->first();
            /*send forgot password email*/
            $email = $data['email'];
            $name = $userName->name;
            $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$random_password
            ];
            Mail::send('emails.forgot_password',$messageData,function ($message) use ($email){
                $message->to($email)->subject('New Password');
            });
            return redirect('login-register')->with(['message'=>'Please check your email for new password !','type'=>'success']);
        }
        return view('front.users.forgot_password');
    }
    /*my account*/
    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        if($request->isMethod('post'))
        {
            $data = $request->all();

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with(['message'=>'Your Account details update success !','type'=>'success']);
        }

        return view('front.users.account',compact('userDetails'));
    }


}
