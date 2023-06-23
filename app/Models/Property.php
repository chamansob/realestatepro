<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function type()
    {
        return  $this->belongsTo(PropertyType::class, 'ptype_id');
    }
    public function user()
    {
        return  $this->belongsTo(User::class, 'agent_id');
    }
    public function city()
    {       
         return  $this->belongsTo(City::class, 'city_id');
    }
    public function state()
    {
      return  $this->belongsTo(State::class, 'state_id');
    }
     public function amenities()
    {
        return $this->belongsToMany(Amenities::class,'amenities_id','id');
    }

    public function wishlist($id)
    {
        $exists = 0;
        if (Auth::check()) {
            $wish = Wishlist::where('user_id', Auth::id())
                ->where('property_id', $id)
                ->get();

            $exists = count($wish);
        }

        return $exists;
    }
    public function compare($id)
    {
        $exists = 0;
        if (Auth::check()) {
            $wish = Compare::where('user_id', Auth::id())
                ->where('property_id', $id)
                ->get();

            $exists = count($wish);
        }

        return $exists;
    }
}
