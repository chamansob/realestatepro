<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AddToWishList(Request $request, $property_id)
    {
        //
        if (!Auth::check()) {
            return response()->json(['error' => 'At First Login Your Account']);
        } else {
            $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property_id)->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            } else {
                return response()->json(['error' => 'This Property Has Alreday On Your Wishlist']);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function UserWishlist()
    {

        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard_wishlist', compact('userData'));
    }
    public function GetWishlistProperty()
    {

        $wishlist = Wishlist::with('property')->where('user_id', Auth::id())->latest()->get();

        $wishQty = wishlist::count();

        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }
    public function WishlistRemove($id)
    {

        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Successfully Property Remove']);
    } // End Method 

}
