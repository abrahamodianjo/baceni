<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('index',compact('userData'));

    } //End Method

    public function HomeMain(){
        return view('frontend.index');

    }// End Home method

    
    public function UserProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;

        }
        $data->save();

        $notification = array(
            'message' => 'Admin profile updated successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }//End Method

    public function UserLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $notification = array(
            'message' => 'User Logout successfully', 
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }//End logout Method

    public function UserUpdatePassword(Request $request){
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
}
