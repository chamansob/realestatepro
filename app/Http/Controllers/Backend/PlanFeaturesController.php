<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\PlanFeatures;
use Illuminate\Http\Request;

class PlanFeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = PlanFeatures::all();
        return view('backend.plan_features.all_plan_features', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.plan_features.add_plan_features');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'features_name' => 'required|unique:plan_features|max:255'
        ]);

        PlanFeatures::insert([
            'features_name' => $request->features_name

        ]);
        $notification = array(
            'message' => 'PLan Feature Create Successfully',
            'alert-plan_features' => 'success',
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
    public function edit(string $id)
    {
        $planFeatures = PlanFeatures::findOrFail($id)->first();
        return view('backend.plan_features.edit_plan_features', compact('planFeatures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated =  $request->validate([
            'features_name' => 'required|max:255',
        ]);
        $planFeatures = PlanFeatures::findOrFail($id)->first();
        $planFeatures->update([
            'features_name' => $request->features_name,
        ]);
        $notification = array(
            'message' => 'PLan Feature Updated Successfully',
            'alert-plan_features' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $planFeatures = PlanFeatures::findOrFail($id)->first();
        $planFeatures->delete();
        $notification = array(
            'message' => 'PLan Feature Deleted successfully',
            'alert-plan_features' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function StatusUpdate(Request $request, PlanFeatures $planFeatures)
    {

        $planFeatures->update([
            'status' => ($planFeatures->status == 1) ? 0 : 1,
        ]);
        $notification = array(
            'message' => 'Plan Features Status Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('planFeatures.index')->with($notification);
    }
}
