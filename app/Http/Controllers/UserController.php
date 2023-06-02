<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    //

    public function Index()
    {
       return view('frontend.index');
    }
     public function UserProfile()
     {
        $id =Auth::user()->id;
        $profileData = User::find($id);
       return view('frontend.dashboard_edit_profile',compact('profileData'));
     }
    public function UserProfileStore(Request $request)
     { 
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username= $request->username;
        $data->name= $request->name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->address= $request->address;
        $image_path ='user_images/'.$data->photo;
        if($image = $request->file('photo'))
        {            
         $image=$request->file('photo');        
         $ext=$image->extension();
         $file=time().'.'.$ext;          
         
        
         if( Storage::disk('public')->exists($image_path)){
             Storage::disk('public')->delete($image_path);
             $inputs['photo']=$image->storeAs('public/user_images',$file);
         }else
         {
             $notification =array(
            'message' =>  'Image Not Updated Successfully',
            'alert-type' => 'error'
         );  
          return redirect()->back()->with($notification);
         }
         $data->photo=$file;  
         }
         $data->save();      
         $notification =array(
            'message' =>  'User Profile Updated Successfully',
            'alert-type' => 'success'
         );   
          return redirect()->back()->with($notification);
     }
     public function UserChangePassword()
    {      
         $id = Auth::user()->id;
        $profileData = User::find($id);
       return view('frontend.dashboard_change_profile_password',compact('profileData'));
    }
     public function UserPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);
        if(Hash::check($request->old_password,Auth::user()->password))
        {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->password= Hash::make($request->new_password);
        $pp=$data->save();      
         $notification =array(
            'message' =>  'User Password Updated Successfully',
            'alert-type' => 'success'
         );   
        }else
        {
             $notification =array(
            'message' =>  'Old Password does not Matched',
            'alert-type' => 'error'
         );  
        }
          return back()->with($notification);
    }
     public function UserLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
         $notification =array(
            'message' =>  'User Logout Successfully',
            'alert-type' => 'success'
         );
        return redirect('/login')->with($notification);
    }
}
