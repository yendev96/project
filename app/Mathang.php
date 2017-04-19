<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mathang extends Model
{
    protected $table = 'mat_hang';

    public function category(){
    	return $this->belongsTo('App\Category', 'id_category','id');
}
    public function hangsx(){
    	return $this->hasMany('App\Products','id_mathang','id');
    }
}
