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
        if($request->isMethod('post'))
        {
            $data = $request->all();
            echo '<pre>';print_r($data);die;
        }

        //sections with categories and sub categories
        $categories = Section::with('categories')->get();
        //users
        $users = User::select('email')->where('status',1)->get()->toArray();

        return view('admin.coupons.add_edit_coupon',compact('title','coupon','categories','users'));
    }

}
