<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Wishlist;
use App\Models\Amenities;
use App\Models\PackagePlan;
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

        $property = Property::where('status', '1')->where('property_status', 'rent')->get();

        return view('frontend.property.rent_property', compact('property'));
    } // End Method 
    public function BuyProperty()
    {

        $property = Property::where('status', '1')->where('property_status', 'buy')->get();

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
 public function PropertyType($id){

        $property = Property::where('status','1')->where('ptype_id',$id)->get();

        $pbread = PropertyType::where('id',$id)->first();

        return view('frontend.property.property_type',compact('property','pbread'));

    }// End Method 
}
