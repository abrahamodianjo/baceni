<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');

    }//End AdminDashboard Method



    public function AdminLogin(){

        return view('admin.admin_login');
    }//End AdminLogin Method



    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//End logout Method

    public function AdminProfile(){
        
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.adimin_profile_view', compact('adminData'));

    } //End AdminProfile method

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;

        }
        $data->save();

        $notification = array(
            'message' => 'Admin profile updated successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//End AdminProfileStore method

    public function AdminChangePassword(){
        return view('admin.admin_change_password');

    }//End AdminChangePassword method

    public function AdminUpdatePassword(Request $request){
        //Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            
        ]);
        //Match old paswsword
        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with("error", "Old Password does not match!!");
        }

        //Updated the New password
        User::whereId(auth()->user()->id)->update([

            'password' => Hash::make($request->new_passowrd)
        ]);

        return back()->with("status", "Password Updated Successfully");

    }//End Admin Update Password Method

    public function InactiveVendor(){
        $inActiveVendor = User::where('status','inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inActiveVendor'));


    }//End Inactive Vendor Method

    public function ActiveVendor(){
        $activeVendor = User::where('status','active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));


    }//End Active Vendor Method
}
