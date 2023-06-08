<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::latest()->get();
        return view('backend.property.all_property', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = PropertyType::pluck('type_name', 'id')->toArray();
        $state = State::pluck('name', 'id')->toArray();
        $agent = User::where('role', 'agent')->pluck('name', 'id')->toArray();
        $amenities = Amenities::pluck('amenities_name')->toArray();
        return view('backend.property.add_property', compact('type', 'state', 'agent','amenities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        // dd($amenites);
        

        $pcode = IdGenerator::generate(['table' => 'properties','field' => 'property_code','length' => 5, 'prefix' => 'PC' ]);


        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thambnail/'.$name_gen);
        $save_url = 'upload/property/thambnail/'.$name_gen;

        $property_id = Property::insertGetId([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => (isset($request->featured)?$request->featured : 0),
            'hot' => (isset($request->hot) ? $request->hot : 0 ),
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thambnail' => $save_url           
             ]);
            $images = $request->file('multi_img');
            foreach($images as $image)
            {
            $make_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_gen);
            $upload_img  = 'upload/property/multi-image/'.$make_gen;
            $multi= MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $upload_img                
            ]);
            }// End Foreach
        // Facility Added Here // 
          $i=1;
         $facilities = count($request->facility_name);
       while($i!=$facilities)
       {
         $multi= Facility::insert([
                'property_id' => $property_id,
                'facility_name' => $request->facility_name[$i],
                'distance' => $request->distance[$i],             
            ]);
            $i++;
        } // End White
           
            
            $notification = array(
            'message' => 'Property Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('properties.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
       $type = PropertyType::pluck('type_name', 'id')->toArray();
        $state = State::pluck('name', 'id')->toArray();
        $agent = User::where('role', 'agent')->pluck('name', 'id')->toArray();
        $amenities = Amenities::pluck('amenities_name')->toArray();
        $cities =City::pluck('name', 'id')->toArray();
        return view('backend.property.edit_property', compact('property','cities','type', 'state', 'agent','amenities'));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
         $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
           $property->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => (isset($request->featured)?$request->featured : 0),
            'hot' => (isset($request->hot) ? $request->hot : 0 ),
            'agent_id' => $request->agent_id          
                      
             ]);
            
            
            $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        $notification = array(
            'message' => 'City Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show all the states.
     */
   public function states(Property $property)
    {
        $city = '';
        $id = $_POST['state_id'];
        $cities = City::where('state_id', $id)->get();

        echo '<option selected="selected">---Select City---</option>';
        foreach ($cities as $coss) {
            $city .= '<option value="' . $coss->id . '">' . $coss->id . '. ' . ucfirst($coss->name) . '</option>';

        }
        return ($city);
    }

}
