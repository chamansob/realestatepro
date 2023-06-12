<?php

namespace App\Http\Controllers;

use App\Models\ImagePreset;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ImageGenTrait;

use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
   public $path = "upload/user_images/";
   public $image_preset;
   public $image_preset_main;
   use ImageGenTrait;
    public function __construct(){
    $this->image_preset = ImagePreset::whereIn('id', [2])->get();
    $this->image_preset_main = ImagePreset::find(3);
  }
   public function Index()
   {
      return view('frontend.index');
   }
   public function UserProfile()
   {
      $id = Auth::user()->id;
      $profileData = User::find($id);
      return view('frontend.dashboard_edit_profile', compact('profileData'));
   }
   public function UserProfileStore(Request $request)
   {
      $id = Auth::user()->id;
      $data = User::find($id);
      $data->username = $request->username;
      $data->name = $request->name;
      $data->email = $request->email;
      $data->phone = $request->phone;
      $data->address = $request->address;     
      

      if ($image = $request->file('photo')) {

         $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
         $this->imageRemove(Auth::user()->photo, $this->image_preset);
         $data->photo = $save_url;
      }
      $data->save();
      $notification = array(
         'message' =>  'User Profile Updated Successfully',
         'alert-type' => 'success'
      );
      return redirect()->back()->with($notification);
   }
   public function UserChangePassword()
   {
      $id = Auth::user()->id;
      $profileData = User::find($id);
      return view('frontend.dashboard_change_profile_password', compact('profileData'));
   }
   public function UserPasswordUpdate(Request $request)
   {
      $request->validate([
         'old_password' => 'required',
         'new_password' => 'required|confirmed'

      ]);
      if (Hash::check($request->old_password, Auth::user()->password)) {
         $id = Auth::user()->id;
         $data = User::find($id);
         $data->password = Hash::make($request->new_password);
         $pp = $data->save();
         $notification = array(
            'message' =>  'User Password Updated Successfully',
            'alert-type' => 'success'
         );
      } else {
         $notification = array(
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
      $notification = array(
         'message' =>  'User Logout Successfully',
         'alert-type' => 'success'
      );
      return redirect('/login')->with($notification);
   }
}
