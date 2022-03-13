<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
//use App\Http\Middleware\Admin as AdminMiddleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use function Spatie\LaravelIgnition\ContextProviders\resolveUpdates;
use function Symfony\Component\Console\Helper\removeDecoration;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

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

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function settings()
    {
        $auth = Auth::guard('admin')->user();
//        $auth = \App\Models\Admin::where('email','kawsarfaz100@gmail.com');
        return view('admin.settings', compact('auth'));
    }

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
//                    $admin = Admin::find(Auth('admin')->user()->id);

                    return redirect()->back()->with(['message' => 'Password Change Successfully !', 'type' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Password dont match !', 'type' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Your current Password is incorrect !', 'type' => 'danger']);
            }
        }
    }
}

