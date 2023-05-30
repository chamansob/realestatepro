<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $image_path ='admin_images/'.$data->photo;
        if($image = $request->file('photo'))
        {            
         $image=$request->file('photo');        
         $ext=$image->extension();
         $file=time().'.'.$ext;          
         
        
         if( Storage::disk('public')->exists($image_path)){
             Storage::disk('public')->delete($image_path);
             $inputs['photo']=$image->storeAs('public/admin_images',$file);
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
//         if ($request->hasFile('photo')) {
//            $file = $request->file('photo');
//             $filename = date('YmdHi').$file->getClientOriginalName(); 
//             $file->move(public_path('upload/admin_images'),$filename);
//             $data['photo'] = $filename;  
// }
         $pp=$data->save();      
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
