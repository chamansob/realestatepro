<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\City;
use App\Models\Plan;
use App\Models\Facility;
use App\Models\ImagePreset;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\PlanFeatures;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\User;
use App\Traits\ImageGenTrait;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AgentPropertyController extends Controller
{
    public $path = "upload/property/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [1, 4])->get();
        $this->image_preset_main = ImagePreset::find(6);
    }
    //
    public function AgentProperty()
    {
        $properties = Property::where('agent_id', Auth::user()->id)->get();

        return view('agent.property.all_property', compact('properties'));
    }
    public function create()
    {
        if (Auth::user()->role == 'agent') {
            $type = PropertyType::pluck('type_name', 'id')->toArray();
            $state = State::pluck('name', 'id')->toArray();
            $agent = User::where('role', 'agent')->pluck('name', 'id')->toArray();
            $amenities = Amenities::pluck('amenities_name')->toArray();
            $plans = PackagePlan::where('user_id', Auth::user()->id)->get();
            $property = Property::where('agent_id', Auth::user()->id)->get();
          
             //dd( (int)Auth::user()->credit);
            if ((int)Auth::user()->credit <= $property->count()) {
                $notification = array(
                    'message' => 'You can add only ' . (Auth::user()->credit) . ' Property',
                    'alert-type' => 'warning',
                );
                return redirect()->route('agent.buy.package')->with($notification);
            } else {
                return view('agent.property.add_property', compact('type', 'state', 'agent', 'amenities'));
            }
        }
        return view('/');
    }

    public function store(Request $request)
    {
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);
        $image = $request->file('property_thumbnail');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
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
            'city_id' => $request->city,
            'state_id' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => 0,
            'hot' => 0,
            'agent_id' => Auth::user()->id,
            'status' => 1,
            'property_thumbnail' => $save_url,
        ]);
        $images = $request->file('multi_img');
        foreach ($images as $image) {

            $image_preset = ImagePreset::whereIn('id', [1])->get();
            $image_preset_main = ImagePreset::find(7);
            $path = "upload/property/multi-image/";
            $upload_img = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);

            $multi = MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $upload_img,
            ]);
        } // End Foreach
        // Facility Added Here //
        $i = 1;
        $facilities = count($request->facility_name);
        while ($i != $facilities) {
            $multi = Facility::insert([
                'property_id' => $property_id,
                'facility_name' => $request->facility_name[$i],
                'distance' => $request->distance[$i],
            ]);
            $i++;
        } // End White

        User::findOrFail(Auth::user()->id)->update([
            'credit' => Auth::user()->credit + 1,
        ]);
        $notification = array(
            'message' => 'Agent Property Created Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('agent.properties')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $type = PropertyType::pluck('type_name', 'id')->toArray();
        $state = State::pluck('name', 'id')->toArray();
        $agent = ($property->agent_id != null) ? (User::find($property->agent_id)->name) : '-';
        $amenities = Amenities::pluck('amenities_name')->toArray();
        $cityinfo = City::find($property->city)->name;

        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $facilities = Facility::where('property_id', $property->id)->get();
        return view('agent.property.show_property', compact('property', 'cityinfo', 'type', 'state', 'agent', 'amenities'));
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
        $cities = City::pluck('name', 'id')->toArray();
        $multiImage = MultiImage::where('property_id', $property->id)->get();
        $facilities = Facility::where('property_id', $property->id)->get();
        return view('agent.property.edit_property', compact('property', 'cities', 'type', 'state', 'agent', 'amenities', 'multiImage', 'facilities'));
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
            'city_id' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,           

        ]);

        $notification = array(
            'message' => 'Agent Property Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function update_img(Request $request, Property $property)
    {
        $image = $request->file('property_thumbnail');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        $this->imageRemove($image, $this->image_preset);
        $property->update([
            'property_thumbnail' => $save_url,
        ]);
        $notification = array(
            'message' => 'Agent Property Image Thumbnail Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $img = explode('.', $property->property_thumbnail);
        $small_img = $img[0] . "_small." . $img[1];
        if (file_exists($property->property_thumbnail)) {
            unlink($property->property_thumbnail);
        }
        if (file_exists($small_img)) {
            unlink($small_img);
        }
        $multi = MultiImage::where('property_id', $property->id)->get();
        foreach ($multi as $mu) {
            if (file_exists($mu->photo_name)) {
                unlink($mu->photo_name);
            }
            $mu->delete();
        }
        $property->delete();
        if (Auth::user()->credit > 0) {
            User::findOrFail(Auth::user()->id)->update([
                'credit' => Auth::user()->credit - 1,
            ]);
        }
        $notification = array(
            'message' => 'Agent Property Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function multiImageDestory($id)
    {
        $multi = MultiImage::findOrFail($id);
        if (file_exists($multi->photo_name)) {
            unlink($multi->photo_name);
        }
        $img = explode('.', $multi->photo_name);
        $small_img = $img[0] . "_small." . $img[1];
        if (file_exists($small_img)) {
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
        foreach ($images as $image) {
            $image_preset = ImagePreset::whereIn('id', [1])->get();
            $image_preset_main = ImagePreset::find(7);
            $path = "upload/property/multi-image/";
            $upload_img = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
            $this->imageRemove($image, $image_preset);
            $multi = MultiImage::insert([
                'property_id' => $property->id,
                'photo_name' => $upload_img,
            ]);
        } // End Foreach
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
        $multis = MultiImage::where('id', $id)->first();
        $image = $request->file('multi_img');
        $image_preset = ImagePreset::whereIn('id', [1])->get();
        $image_preset_main = ImagePreset::find(7);
        $path = "upload/property/multi-image/";
        $upload_img = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);
        $this->imageRemove($multis->photo_name, $image_preset);
        $multi = MultiImage::where('id', $id);
        $multi->update([
            'photo_name' => $upload_img,
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

    public function facilityUpdate(Request $request, Property $property)
    {
        $i = 0;
        $facilities = count($request->facility_name);

        $facility_list = ['Hospital', 'SuperMarket', 'School', 'Entertainment', 'Pharmacy', 'Airport', 'Railways', 'Bus Stop', 'Beach', 'Mall', 'Bank'];
        if ($request->facility_name == null) {
            return redirect()->back();
        } else {
            Facility::where('property_id', $property->id)->delete();

            while ($i != $facilities) {
                $multi = Facility::insert([
                    'property_id' => $property->id,
                    'facility_name' => $facility_list[$request->facility_name[$i]],
                    'distance' => $request->distance[$i],
                ]);
                $i++;
            } // End White
        }
        $notification = array(
            'message' => 'Facilities Updated successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function facilityDestory($id)
    {

        $fact = Facility::find($id);
        Facility::where("id", $id)->delete();
        $notification = array(
            'message' => 'Facility Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('properties.edit', $fact->property_id)->with($notification);
    }
    public function BuyPackage()
    {
        $plans = Plan::get();        
        return view('agent.package.buy_package', compact('plans'));
    }
    public function BuyPlan($id)
    {
        $data = User::find(Auth::user()->id)->first();
        $plan = Plan::findOrFail($id);
        return view('agent.package.buy_plan', compact('data', 'plan'));
    }
    public function BuyPlanStore(Request $request)
    {
        $plan=Plan::find($request->plan_id);
        $user =User::find(Auth::user()->id)->first();
        
         $packagehistory = PackagePlan::where('user_id', Auth::user()->id)->where('package_name', $plan->plan_name)->get();

     
        if($request->plan_id!=1 && $packagehistory->count()==0)
        {
        $current_plan =  Plan::findOrFail($request->plan_id);
        $id = Auth::user()->id;
        $uid = User::findOrFail($id);
        $nid = $uid->credit;
        PackagePlan::insert([
            'user_id' => $id,
            'package_name' => $current_plan->plan_name,
            'package_credits' => $current_plan->plan_credit,
            'invoice' => 'ERS' . mt_rand(10000000, 99999999),
            'package_amount' => $current_plan->plan_amount,
            'created_at' => Carbon::now(),
        ]);
        User::where('id', $id)->update([
            'credit' =>  $current_plan->plan_credit + $nid,
        ]);

        $notification = array(
            'message' => 'You have purchase Basic Package Successfully',
            'alert-type' => 'success'
        );
    }else
    {
           $notification = array(
            'message' => 'Free Plan Already Added',
            'alert-type' => 'warning'
        ); 
    }

        return redirect()->route('agent.buy.package.package_history')->with($notification);
    }

    public function PackageHistory()
    {
        $id = Auth::user()->id;
        $packagehistory = PackagePlan::where('user_id', $id)->get();
        return view('agent.package.package_history', compact('packagehistory'));
    } // End Method 
    public function PackageInvoice($id)
    {

        $packagehistory = PackagePlan::where('id', $id)->first();
        $pdf = Pdf::loadView('agent.package.packae_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption(['tempDir' => public_path(), 'chroot' => public_path()]);
        return $pdf->download('invoice.pdf');
    }
}
