<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //Admin Dashboard

    public function AdminDashboard()
    {
       return view('admin.index');
    }
    public function AdminLogin()
    {
       return view('admin.admin_login');
    }
    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
       return view('admin.admin_profile_view',compact('profileData'));
    }

     public function AdminProfileStore(Request  $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username= $request->username;
        $data->name= $request->name;
        $data->email= $request->email;
        $data->phone= $request->phone;
        $data->address= $request->address;
       
         if($image = $request->file('photo'))
        {    
         $code =hexdec(uniqid());
        $image = $request->file('photo');     
        $name_gen = $code.'.'.$image->getClientOriginalExtension();        
        Image::make($image)->resize(150,150)->save('upload/admin_images/'.$name_gen);
        $name_gen2 = $code.'_small.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(30,30)->save('upload/admin_images/'.$name_gen2);
        $save_url = 'upload/admin_images/'.$name_gen;  
        $img=explode('.',Auth::user()->photo);       
        $small_img =$img[0]."_small.".$img[1]; 
            
        if(file_exists(Auth::user()->photo))
        {
            unlink(Auth::user()->photo);           
        }  
       if(file_exists($small_img))
        {
            unlink($small_img);           
        }    
          
         $data->photo= $save_url;  
         }
         $data->save();       
         $notification =array(
            'message' =>  'Admin Profile Updated Successfully',
            'alert-type' => 'success'
         );   
          return redirect()->back()->with($notification);
    }
     public function AdminChangePassword()
    {      
         $id = Auth::user()->id;
        $profileData = User::find($id);
       return view('admin.admin_change_password',compact('profileData'));
    }
     public function AdminPasswordUpdate(Request $request)
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
            'message' =>  'Admin Password Updated Successfully',
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
}
