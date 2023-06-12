<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::latest()->get();
        return view('backend.country.all_country', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.country.add_country');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:countries|max:200',
        ]);

        Country::insert([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Country Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('backend.country.edit_country', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);

        $country->update([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Country Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        $notification = array(
            'message' => 'Country Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function StatusUpdate(Request $request, Country $country)
    {

        $country->update([
            'status' => ($country->status == 1) ? 0 : 1,
        ]);
        $notification = array(
            'message' => 'Country  Status Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('countries.index')->with($notification);
    }
}
