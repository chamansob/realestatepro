<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
   //

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
         $code = hexdec(uniqid());
         $image = $request->file('photo');
         $name_gen = $code . '.' . $image->getClientOriginalExtension();
         Image::make($image)->resize(370, 250)->save('upload/user_image/' . $name_gen);
         $name_gen3 = $code . '_table.' . $image->getClientOriginalExtension();
         Image::make($image)->resize(36, 36)->save('upload/user_image/' . $name_gen3);
         $save_url = 'upload/user_image/' . $name_gen;
         $img = explode('.', Auth::user()->photo);
         $small_img = $img[0] . "_small." . $img[1];
         $table_img = $img[0] . "_table." . $img[1];
         if (file_exists(Auth::user()->photo)) {
            unlink(Auth::user()->photo);
         }
         if (file_exists($small_img)) {
            unlink($small_img);
         }
         if (file_exists($table_img)) {
            unlink($table_img);
         }
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
