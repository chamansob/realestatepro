<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Wishlist;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\User;
use App\Models\MultiImage;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function propertyDetails($id,$slug)
    {
         $exists=0;
       $admin=User::find(1)->first();
       $property=Property::where('id',$id)->first();
       $property_related=Property::where('id','!=',$id)->where('ptype_id',$property->ptype_id)->where('status',1)->limit(3)->get();
       $multiImage= MultiImage::where('property_id',$id)->get();
       $amenities = $property->amenities_id;
       $property_amen_list = explode(',',$amenities);
       $property_amen= Amenities::whereIn('id',$property_amen_list)->get();
       $facility = Facility::where('property_id',$id)->get();
        if (!Auth::check()) {
       $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property->id)->first();
        }
       return view('frontend.property.property_details',compact( 'property','multiImage','property_amen','facility','admin','property_related','exists'));
    }
}
