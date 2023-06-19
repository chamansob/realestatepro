<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Plan;
use App\Models\PlanFeatures;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::latest()->get();

        return view('backend.plan.all_plan', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = PlanFeatures::pluck('features_name', 'id')->toArray();
        return view('backend.plan.add_plan', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $plan_features = $request->plan_pack_id;
        $plan_feature_all = implode(",", $plan_features);
        $validated =  $request->validate([
            'plan_name' => 'required|unique:plans|max:200',
            'plan_icon' => 'required|max:100',
            'plan_heading' => 'required|max:100',
            'plan_subheading' => 'required|max:100',
            'plan_pack_id' => 'required',
            'plan_amount' => 'required',
        ]);

        Plan::insert([
            'plan_name' => $request->plan_name,
            'plan_icon' => $request->plan_icon,
            'plan_heading' => $request->plan_heading,
            'plan_subheading' => $request->plan_subheading,
            'plan_pack_id' => $plan_feature_all,
            'plan_amount' => $request->plan_amount,
        ]);
        $notification = array(
            'message' => 'Property Plan Create Successfully',
            'alert-plan' => 'success',
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
    public function edit(Plan $plan)
    {
        
         $features = PlanFeatures::pluck('features_name', 'id')->toArray();
        return view('backend.plan.edit_plan', compact('plan','features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $plan_features = $request->plan_pack_id;
        $plan_feature_all = implode(",", $plan_features);
        $validated =  $request->validate([
            'plan_name' => 'required|max:200',
            'plan_icon' => 'required|max:100',
            'plan_heading' => 'required|max:100',
            'plan_subheading' => 'required|max:100',
            'plan_pack_id' => 'required',
            'plan_amount' => 'required',
        ]);

        $plan->update([
            'plan_name' => $request->plan_name,
            'plan_icon' => $request->plan_icon,
            'plan_heading' => $request->plan_heading,
            'plan_subheading' => $request->plan_subheading,
            'plan_pack_id' => $plan_feature_all,
            'plan_amount' => $request->plan_amount,
            'plan_credit' => $request->plan_credit,
            'plan_color' => $request->plan_color,
        ]);
        $notification = array(
            'message' => 'Property Plan Updated Successfully',
            'alert-plan' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        $notification = array(
            'message' => 'Property Plan Deleted successfully',
            'alert-plan' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
