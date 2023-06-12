<?php

namespace App\Http\Controllers;

use App\Models\ImagePreset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ImageGenTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //Admin Dashboard
   public $path="upload/admin_images/";
   public $image_preset;
   public $image_preset_main;
    use ImageGenTrait;
    public function __construct(){
    $this->image_preset = ImagePreset::whereIn('id', [2,4])->get();
    $this->image_preset_main = ImagePreset::find(3);
  }
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
         $this->imageRemove(Auth::user()->photo,$this->image_preset);           
         $save_url=$this->imageGenrator($image,$this->image_preset_main,$this->image_preset,$this->path);         
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
