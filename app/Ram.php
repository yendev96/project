<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    protected $table = 'ram';

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
