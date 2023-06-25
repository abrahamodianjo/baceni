<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
class VendorController extends Controller
{
    public function VendorDashboard(){
        
        return view('vendor.index');

    }//End AdminDashboard Method

    public function VendorLogin(){

        return view('vendor.vendor_login');
    }//End VendorLogin Method

    
    public function VendorDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }//End logout Method

    public function VendorProfile(){
        
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.vendor_profile_view', compact('vendorData'));

    } //End Vendor Profile method

    public function VendorProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'),$filename);
            $data['photo'] = $filename;

        }
        $data->save();

        $notification = array(
            'message' => 'Vendor profile updated successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//End AdminProfileStore method

}
