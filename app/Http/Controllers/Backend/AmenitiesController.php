<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.amenities.add_amenities');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated =  $request->validate([
            'amenities_name' => 'required|unique:amenities|max:200',            
        ]);

        Amenities::insert([
            'amenities_name' => $request->amenities_name,          
        ]);

        $notification = array(
            'message' => 'Amenities Create Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Amenities $amenities)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Amenities $amenity)
    {        
        
        return view('backend.amenities.edit_amenities', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Amenities $amenity)
    {
       $validated =  $request->validate([
            'amenities_name' => 'required|max:200',
           
        ]);

        $amenity->update([ 
            'amenities_name' => $request->amenities_name,
           
        ]);
        $notification = array(
            'message' => 'Amenities Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenities $amenity)
    {
         $amenity->delete();
         $notification = array(
            'message' => 'Amenities Deleted successfully',
            'alert-type' => 'success',
        );
         return redirect()->route('amenities.index')->with($notification);
    }
}
