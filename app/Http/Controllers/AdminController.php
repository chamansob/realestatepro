<?php

namespace App\Http\Controllers;

use App\Models\ImagePreset;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ImageGenTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{
    //Admin Dashboard
   public $path="upload/admin_images/";
   public $path_agent="upload/agent_images/";
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

    /////// Agent User All Methods ///////

    public function AllAgents()
    {
      $agents =User::where('role','agent')->get();     
      return view('backend.agents.all_agent',compact('agents'));
    }
    
     public function AgentStatusUpdate(Request $request)
    {
        
       $agent=User::find($request->user_id);
       $id= $agent->update([
            'status' => ($request->status == 1) ? 0 : 1,
        ]);
       
        return response()->json(['success'=>'Status changed Successfully']);
    }
     public function AgentDelete($id)
    {
      $agent=User::find($id);
        $agent->delete();
        $notification = array(
            'message' => 'Agent Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.agents')->with($notification);
    }
     public function AgentAdd()
     {
      return view('backend.agents.add_agent');
     }
     public function AgentStore(Request $request)
     {
      $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'agent',
        ]);

        event(new Registered($user));

         $notification = array(
            'message' => 'New Agent Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.agents')->with($notification);
     }
     public function AgentEdit($id)
     {
        $agent = User::find($id);
      return view('backend.agents.edit_agent',compact('agent'));
     }
      public function AgentUpdate(Request $request)
     {
       $agent = User::find($request->agent_id);
       $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],            
        ]);
        if($image = $request->file('photo'))
        {  
         // dd($request->file('photo'));
         $this->imageRemove($agent->photo,$this->image_preset);           
         $save_url=$this->imageGenrator($image,$this->image_preset_main,$this->image_preset,$this->path_agent);         
         }else
         {
         $save_url=$agent->photo;
         }   
           
        $agent->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => (empty($request->password)) ? $agent->password : Hash::make($request->password),
            'photo' => $save_url,
            'status' => $request->status,
        ]);
        

         $notification = array(
            'message' => 'Agent Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.agent_edit',$request->agent_id)->with($notification);
     }
}
