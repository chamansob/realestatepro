<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Wishlist;
use App\Models\Amenities;
use App\Models\PackagePlan;
use App\Models\State;
use App\Models\PropertyType;
use App\Models\PropertyMessage;
use App\Models\Facility;
use App\Models\User;
use App\Models\MultiImage;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function propertyDetails($id, $slug)
    {
        $exists = 0;
        $admin = User::find(1)->first();
        $property = Property::where('id', $id)->first();
        $property_related = Property::where('id', '!=', $id)->where('ptype_id', $property->ptype_id)->where('status', 1)->limit(3)->get();
        $multiImage = MultiImage::where('property_id', $id)->get();
        $amenities = $property->amenities_id;
        $property_amen_list = explode(',', $amenities);
        $property_amen = Amenities::whereIn('id', $property_amen_list)->get();
        $facility = Facility::where('property_id', $id)->get();
        if (!Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property->id)->first();
        }
        return view('frontend.property.property_details', compact('property', 'multiImage', 'property_amen', 'facility', 'admin', 'property_related', 'exists'));
    }
    public function PropertyMessage(Request $request)
    {

        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {

            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'agent_id' => $aid,
                'property_id' => $pid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message


            ]);

            $notification = array(
                'message' => 'Send Message Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Plz Login Your Account First',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method
    public function AgentDetails($id)
    {

        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->get();
        $featured = Property::where('featured', '1')->limit(3)->get();
        $rentproperty = Property::where('property_status', 'rent')->get();
        $buyproperty = Property::where('property_status', 'buy')->get();
        return view('frontend.agent.agent_details', compact('agent', 'property', 'featured', 'rentproperty', 'buyproperty'));
    } // End Method 
    public function RentProperty()
    {

        $property = Property::where('status', '1')->where('property_status', 'rent')->paginate(3);

        return view('frontend.property.rent_property', compact('property'));
    } // End Method 
    public function BuyProperty()
    {

        $property = Property::where('status', '1')->where('property_status', 'buy')->paginate(3);

        return view('frontend.property.buy_property', compact('property'));
    } // End Method 
    public function AgentDetailsMessage(Request $request)
    {

        $aid = $request->agent_id;

        if (Auth::check()) {

            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'agent_id' => $aid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,

            ]);

            $notification = array(
                'message' => 'Send Message Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            $notification = array(
                'message' => 'Plz Login Your Account First',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    } // End Method 
    public function PropertyType($id)
    {

        $property = Property::where('status', '1')->where('ptype_id', $id)->paginate(3);

        $pbread = PropertyType::where('id', $id)->first();


        return view('frontend.property.property_type', compact('property', 'pbread'));
    } // End Method 
    public function StateDetails($id)
    {

        $property = Property::where('status', '1')->where('state_id', $id)->paginate(3);

        $bstate = State::where('id', $id)->first();
        return view('frontend.property.state_property', compact('property', 'bstate'));
    } // End Method 
    public function BuyPropertySeach(Request $request)
    {
        //dd($request);

        $request->validate(
            [
                'ptype_id' => 'required',
            ]

        );
        $item = $request->search;
        $sstate = ($request->state == 0) ? '' : $request->state;
        $sstype = $request->type;
        $stype = ($request->ptype_id == 0) ? '' : $request->ptype_id;

        $property = Property::where('status', '1')
            ->where('property_name', 'like', '%' . $item . '%')
            ->where('property_status', $sstype)

            ->with('type', 'state')
            ->whereHas('state', function ($q) use ($sstate) {
                $q->where('name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })
            ->get();
        //dd($property->toSql(), $property->getBindings());
        return view('frontend.property.property_search', compact('property'));
    } // End Method 
    public function AllPropertySeach(Request $request)
    {

        // dd($request);
        $property_status = $request->property_status;
        $stype = ($request->ptype_id == 0) ? '' : $request->ptype_id;
        $sstate = ($request->state == 0) ? '' : $request->state;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        //  dd($request->price_range);
        if (isset($request->price_range) && $request->price_range != "10000 - 30001") {
            $x = explode("-", $request->price_range);
            //dd($x);
            $min_price = ltrim($x[0]);
            $max_price = ltrim($x[1]);

            $property = Property::where('status', '1')
                ->where('bedrooms', 'like', '%' . $bedrooms . '%')
                ->where('bathrooms', 'like', '%' . $bathrooms . '%')
                ->where('property_status', 'like', '%' . $property_status . '%')
                ->whereBetween('lowest_price', [$min_price, $max_price])
                ->with('type', 'state')
                ->whereHas('state', function ($q) use ($sstate) {
                    $q->where('name', 'like', '%' . $sstate . '%');
                })
                ->whereHas('type', function ($q) use ($stype) {
                    $q->where('type_name', 'like', '%' . $stype . '%');
                })->get();
        } else {
            $property = Property::where('status', '1')
                ->where('bedrooms', 'like', '%' . $bedrooms . '%')
                ->where('bathrooms', 'like', '%' . $bathrooms . '%')
                ->where('property_status', 'like', '%' . $property_status . '%')
                ->with('type', 'state')
                ->whereHas('state', function ($q) use ($sstate) {
                    $q->where('name', 'like', '%' . $sstate . '%');
                })
                ->whereHas('type', function ($q) use ($stype) {
                    $q->where('type_name', 'like', '%' . $stype . '%');
                })->get();
        }


        //  dd($property->toSql(), $property->getBindings());
        return view('frontend.property.property_search', compact('property'));
    } // End Method 
}
