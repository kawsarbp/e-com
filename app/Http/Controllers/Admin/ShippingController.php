<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function shippingCharges()
    {
        $shipping_charges = ShippingCharge::get();
        return view('admin.shipping.view_shipping_charges',compact('shipping_charges'));
    }
    /*editShippingCharges*/
    public function editShippingCharges($id, Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            ShippingCharge::where('id',$id)->update(['shopping_charges'=>$data['shopping_charges']]);
            return redirect('admin/view-shipping-charges')->with(['message'=>'Shopping Charges updated Successfully! ','type'=>'success']);
        }
        $shippingDetails = ShippingCharge::where('id',$id)->first();
        return view('admin.shipping.edit_shipping_charges',compact('shippingDetails'));
    }

    public function updateShippingStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ShippingCharge::where('id', $data['shipping_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'shipping_id' => $data['shipping_id']]);
        }
    }
}
