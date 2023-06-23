<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Plan extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

     public function fe_In($id)
    {
        $features_list=explode(",",$id);
       $features =PlanFeatures::whereIn('id',$features_list)->get();
       return $features;
       
    }
 public function fe_Not_In($id)
    {
        $features_list=explode(",",$id);
       $features =PlanFeatures::whereNotIn('id',$features_list)->get();
       return $features;
       
    }
}
