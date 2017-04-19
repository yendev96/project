<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $table = 'laptop';

    public function category(){
    	return $this->belongsTo('App\Category','id_category','id');
    }

    public function user(){
    	return $this->belongsTo('App\User','id_user','id');
    }

    public function imgProducts(){
    	return $this->hasMany('App\ImgProduct','id_product','id');
    }
}
