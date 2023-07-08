<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\testimonial;
use App\Models\ImagePreset;
use Illuminate\Http\Request;
use App\Traits\ImageGenTrait;

class TestimonialController extends Controller
{
    public $path = "upload/testimonail/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [1])->get();
        $this->image_preset_main = ImagePreset::find(3);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.testimonial.add_testimonial');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:countries|max:200',
        ]);
        $image = $request->file('image');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);

        Testimonial::insert([
            'name' => $request->name,
            'position' => $request->position,
            'image' =>  $save_url,
            'message' => $request->message,
        ]);
        $notification = array(
            'message' => 'Testimonial Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(testimonial $testimonial)
    {
        return view('backend.testimonial.edit_testimonial', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);
        $image = $request->file('image');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);


        $testimonial->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' =>  $save_url,
            'message' => $request->message,
        ]);
        $notification = array(
            'message' => 'Testimonial Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(testimonial $testimonial)
    {
        $testimonial->delete();
        $notification = array(
            'message' => 'Testimonial Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
