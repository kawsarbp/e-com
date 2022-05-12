<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function coupons()
    {
        $coupons = Coupon::get()->toArray();

        return view('admin.coupons.coupons', compact('coupons'));
    }

    /*status*/
    public function updateCouponStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'coupon_id' => $data['coupon_id']]);
        }
    }

    /*addEditCoupon*/
    public function addEditCoupon(Request $request, $id = null)
    {
        if ($id == "") {
            /*add coupon*/
            $coupon = new Coupon;
            $title = 'Add Coupon';

        } else {
            /*update coupon*/
            $coupon = Coupon::find($id);
            $title = 'Update Coupon';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            /*$rules = [
                'coupon_option' => 'required',
                'coupon_code' => 'required',
                'categories' => 'required',
                'user' => 'required',
                'coupon_type' => 'required',
                'amount_type' => 'required',
                'amount' => 'required',
                'expire_date' => 'required',
            ];
            $customMessage = [
                'coupon_option.required' => 'This Field required !',
                'coupon_code.required' => 'This Field required !',
                'categories.required' => 'This Field required !',
                'user.required' => 'This Field required !',
                'coupon_type.required' => 'This Field required !',
                'amount_type.required' => 'This Field required !',
                'amount.required' => 'This Field required !',
                'expire_date.required' => 'This Field required !',
            ];
            $this->validate($request, $rules, $customMessage);*/

//            echo "<pre>";print_r($data);die;
            if (isset($data['user'])) {
                $users = implode(',', $data['user']);
            }
            if (isset($data['categories'])) {
                $categories = implode(',', $data['categories']);
            }
            if ($data['coupon_option'] == "Automatic") {
                $coupon_code = str_random(8);
            } else {
                $coupon_code = $data['coupon_option'];
            }

            $coupon->coupon_option = $data['coupon_option'];
            $coupon->coupon_code = $coupon_code;
            $coupon->categories = $categories;
            $coupon->users = $users;
            $coupon->coupon_type = $data['coupon_type'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->amount = $data['amount'];
            $coupon->expire_date = $data['expire_date'];
            $coupon->status = 1;
            $coupon->save();
            return redirect()->back()->with(['message'=>'successfully added !','type'=>'success']);

        }

        //sections with categories and sub categories
        $categories = Section::with('categories')->get();
        //users
        $users = User::select('email')->where('status', 1)->get()->toArray();

        return view('admin.coupons.add_edit_coupon', compact('title', 'coupon', 'categories', 'users'));
    }

}
