<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\ImagePreset;
use Illuminate\Http\Request;
use App\Traits\ImageGenTrait;
class StateController extends Controller
{
    public $path = "upload/state/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;    
    public function __construct(){
    $this->image_preset = ImagePreset::whereIn('id', [11,12])->get();
    $this->image_preset_main = ImagePreset::find(10);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::latest()->get();
        return view('backend.state.all_state', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $countries = Country::pluck('name', 'id')->toArray();
        return view('backend.state.add_state', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:countries|max:200',
            'country_id' => 'required',
        ]);
        $image = $request->file('state_image');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        
        State::insert([
            'name' => $request->name,
            'state_image' =>  $save_url,
            'country_id' => $request->country_id,
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'State Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $countries = Country::pluck('name', 'id')->toArray();
        return view('backend.state.edit_state', compact('state', 'countries'));
    }
     public function StatusUpdate(Request $request, State $state)
    {
        $state->update([
            'status' => ($state->status == 1) ? 0 : 1,
        ]);
        $notification = array(
            'message' => 'State Status Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('properties.show',$state->id)->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);
 $image = $request->file('state_image');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        
        $state->update([
            'name' => $request->name,
            'state_image' => $save_url,
            'country_id' => $request->country_id,           
        ]);
        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();
        $notification = array(
            'message' => 'State Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
