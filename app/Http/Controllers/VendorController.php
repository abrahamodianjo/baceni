<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

}
