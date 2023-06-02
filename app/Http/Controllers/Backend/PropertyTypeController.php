<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.type.add_type');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required|max:100',
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = array(
            'message' => 'Property Type Create Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyType $property_type)
    {
        $propert=  $property_type;
        return view('backend.type.edit_type', compact('propert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyType $property_type)
    {
      $validated =  $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required|max:100',
        ]);

        $property_type->update([ 
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyType $property_type)
    {
        $property_type->delete();
        $notification = array(
            'message' => 'Property Type Deleted successfully',
            'alert-type' => 'success',
        );
         return redirect()->back()->with($notification);
    }
}
