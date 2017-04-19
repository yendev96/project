<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgProduct extends Model
{
    public $timestamps = false;
    protected $table = 'img_product';

    public function products(){
    	return $this->belongsTo('App\Products','id_product','id');
    }
}
