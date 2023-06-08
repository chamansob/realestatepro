<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function type()
    {
    return  $this->belongsTo(PropertyType::class,'ptype_id');
       
    }
    public function city($id)
    {
       $city= City::find($id)->first();
        return ucfirst($city->name);
    }
     public function state($id)
    {
       $city= City::find($id)->first();
        return ucfirst($city->state_id);
    }
      public function amenities($id)
    {
        $new= explode(",",$id);
       $amenities= Amenities::whereIn('id',$new)->pluck('id')->toArray();

        return $amenities;
    }
    
}
