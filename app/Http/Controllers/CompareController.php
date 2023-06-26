<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Amenities;
use App\Models\Compare;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AddToCompare(Request $request, $property_id)
    {

        if (Auth::check()) {
            $total = Compare::where('user_id', Auth::id())->get();
           // dd(count($total));
            if (count($total) >= 3) {
                return response()->json(['error' => 'You can compare only three property']);
            }
            $exists = Compare::where('user_id', Auth::id())->where('property_id', $property_id)->first();
            if (!$exists) {
                Compare::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully Added On Your Compare']);
            } else {
                return response()->json(['error' => 'This Property Has Already in your CompareList']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    } // End Method 
    public function UserCompare()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard_compare', compact('userData'));
    }
    public function GetCompareProperty()
    {

        $compare = Compare::with(['property' => function ($query) {
            $query->select('id', 'amenities_id', 'property_name','property_slug','lowest_price', 'property_thumbnail', 'bedrooms', 'bathrooms', 'garage', 'address', 'property_size', 'city_id', 'state_id', 'agent_id', 'created_at');
            $query->with('city:id,name');
            $query->with('state:id,name');
        }])

            ->where('user_id', Auth::id())->latest()->get();
        $compare->each(function ($compare) {
            $amenitiesIds = explode(",", $compare->property->amenities_id);
            $amenities = Amenities::select('id', 'amenities_name')->whereIn('id', $amenitiesIds)->get();
            $compare->property->amenities = $amenities;
            // Retrieve amenities not included in amenities_id array
            $amenitiesNotIncluded = Amenities::select('id', 'amenities_name')->whereNotIn('id', $amenitiesIds)->get();
            
            $compare->property->amenities = $amenities;
            $compare->property->amenitiesNotIncluded = $amenitiesNotIncluded;
            $facilities = Facility::select('facility_name','distance')->where('property_id', $compare->property->id)->get();
            $compare->property->facilities = $facilities;
            $compare->property->lowest_price = number_format($compare->property->lowest_price, 2); // Applying number_format() to lowest_price
        });

        return response()->json($compare);
    } // End Method 
    public function CompareRemove($id)
    {

        Compare::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Successfully Property Remove']);
    } // End Method 


}
