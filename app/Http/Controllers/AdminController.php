<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

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
}
