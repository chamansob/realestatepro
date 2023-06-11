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

        $code =hexdec(uniqid());
        $image = $request->file('property_thumbnail');       
        $name_gen = $code.'.'.$image->getClientOriginalExtension();        
        Image::make($image)->resize(370,250)->save('upload/property/thumbnail/'.$name_gen);
        $name_gen2 = $code.'_small.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(138,93)->save('upload/property/thumbnail/'.$name_gen2);
        $name_gen3 = $code.'_table.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(36,36)->save('upload/property/thumbnail/'.$name_gen3);
        $save_url = 'upload/property/thumbnail/'.$name_gen;

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
            'property_thumbnail' => $save_url           
             ]);
            $images = $request->file('multi_img');
            foreach($images as $image)
            {
            $ucode =hexdec(uniqid());
            $make_gen = $ucode.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_gen);
            $make_gen2 = $ucode.'_small.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(36,36)->save('upload/property/multi-image/'.$make_gen2);
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
        $multiImage=MultiImage::where('property_id', $property->id)->get();
        $facilities =Facility::where('property_id', $property->id)->get();        
        return view('backend.property.edit_property', compact('property','cities','type', 'state', 'agent','amenities','multiImage','facilities'));
   
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
    public function update_img(Request $request, Property $property)
    {
        $img=explode('.',$property->property_thumbnail);       
        $small_img =$img[0]."_small.".$img[1];  
        $table_img =$img[0]."_table.".$img[1];  
        if(file_exists($property->property_thumbnail))
        {
            unlink($property->property_thumbnail);           
        }  
       if(file_exists($small_img))
        {
            unlink($small_img);           
        }    
          if(file_exists($table_img))
        {
            unlink($table_img);           
        }
        $code =hexdec(uniqid());
        $image = $request->file('property_thumbnail');     
        $name_gen = $code.'.'.$image->getClientOriginalExtension();        
        Image::make($image)->resize(370,250)->save('upload/property/thumbnail/'.$name_gen);
        $name_gen2 = $code.'_small.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(138,93)->save('upload/property/thumbnail/'.$name_gen2);
        $name_gen3 = $code.'_table.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(36,36)->save('upload/property/thumbnail/'.$name_gen3);
        $save_url = 'upload/property/thumbnail/'.$name_gen;

         $property->update([
             'property_thumbnail' => $save_url    
         ]);
          $notification = array(
            'message' => 'Property Image Thumbnail Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $img=explode('.',$property->property_thumbnail);       
        $small_img =$img[0]."_small.".$img[1];              
        if(file_exists($property->property_thumbnail))
        {
            unlink($property->property_thumbnail);           
        }  
        if(file_exists($small_img))
        {
            unlink($small_img);           
        }
        $multi=MultiImage::where('property_id',$property->id)->get();
        foreach($multi as $mu)
        {
            if(file_exists($mu->photo_name))
        {
            unlink($mu->photo_name);           
        } 
            $mu->delete();
        }
        $property->delete();
        $notification = array(
            'message' => 'Property Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function multiImageDestory($id)
    {
        $multi =MultiImage::findOrFail($id);
        if(file_exists($multi->photo_name))
        {
            unlink($multi->photo_name);
        }
        $img=explode('.',$multi->photo_name);  
        $small_img =$img[0]."_small.".$img[1];  
        if(file_exists($small_img))
        {
            unlink($small_img);           
        }
        $multi->delete();
        $notification = array(
            'message' => 'Image Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Upload More Multiple Images.
     */
    public function multiImageUpdate(Request $request, Property $property)
    {
        
        $images = $request->file('multi_img');
           foreach($images as $image)
            {
            $ucode =hexdec(uniqid());
            $make_gen = $ucode.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_gen);
            $make_gen2 = $ucode.'_small.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(36,36)->save('upload/property/multi-image/'.$make_gen2);
            $upload_img  = 'upload/property/multi-image/'.$make_gen;

            
            $multi= MultiImage::insert([
                'property_id' => $property->id,
                'photo_name' => $upload_img                
            ]);
            }// End Foreach 
           $notification = array(
            'message' => 'Multiple Images Updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);  
    }
    /**
     * Update Single Multiple Image.
     */
       public function multiImageUpdateOne(Request $request, $id)
       {    
        
        $multis= MultiImage::where('id',$id)->first(); 
               
         if(file_exists($multis->photo_name))
        {
            unlink($multis->photo_name);
        }
        $img=explode('.',$multis->photo_name);  
        $small_img =$img[0]."_small.".$img[1];  
        if(file_exists($small_img))
        {
            unlink($small_img);           
        }
            $image = $request->file('multi_img');           
            $ucode =hexdec(uniqid());
            $make_gen = $ucode.'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_gen);
            $make_gen2 = $ucode.'_small.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(36,36)->save('upload/property/multi-image/'.$make_gen2);
            $upload_img  = 'upload/property/multi-image/'.$make_gen;
            $multi= MultiImage::where('id',$id);
            $multi->update([                
                'photo_name' => $upload_img                
            ]);
            
           $notification = array(
            'message' => 'Multiple Single Images Updated successfully',
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
