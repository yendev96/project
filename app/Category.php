<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	
    protected $table = 'category';


    public function mathang(){
    	return $this->hasMany('App\Mathang','id_category','id');
    }
}
