<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::latest()->get();
        return view('backend.city.all_city', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $states = [];
        return view('backend.city.add_city',compact('states','countries'));
    }
     
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:countries|max:200',
        ]);

        City::insert([
            'name' => $request->name,
            'state_id' => $request->state_id,
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'City Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        return view('backend.city.edit_city', compact('countries','states','city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function StatusUpdate(City $city)
    {
        $city->update([
            'status' => ($city->status == 1) ? 0 : 1,
        ]);
        $notification = array(
            'message' => 'City Status Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('states.index')->with($notification);
    }
    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
        ]);

        $city->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'status' => $request->status,
        ]);
        $notification = array(
            'message' => 'City Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        $notification = array(
            'message' => 'City Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
     public function states()
    {
        $allstates = '';
        $id = $_POST['country_id'];
        $states = State::where('country_id', $id)->get();

        echo '<option selected="selected">---Select State---</option>';
        foreach ($states as $state) {
            $allstates .= '<option value="' . $state->id . '">' . $state->id . '. ' . ucfirst($state->name) . '</option>';

        }
        return ($allstates);
    }
    public function cities()
    {
        $city = '';
        $id = $_POST['country_id'];
        $cities = City::where('state_id', $id)->get();

        echo '<option selected="selected">---Select State---</option>';
        foreach ($cities as $coss) {
            $city .= '<option value="' . $coss->id . '">' . $coss->id . '. ' . ucfirst($coss->name) . '</option>';

        }
        return ($city);
    }
}
