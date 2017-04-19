<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hangsx;
use App\Mathang;
use App\Laptop;
use App\Ram;
use DateTime;
use App\Category;
class HangsxController extends Controller
{
    public function index()
    {   $data = Hangsx::all();
    	return view('backend.category.hangsx', compact('data'));
    }

    public function ngList(){
        return Hangsx::where('status',1)->get();
        
    }

    public function ngAdd(Request $request){
		$addCategory                = new Hangsx;
		$addCategory->name          = $request->name;
		$addCategory->slug          = changeTitle($request->name);
		$addCategory->id_category   = $request->id_category;
		$nameCat                    = Category::find($request->id_category)->name;
		$addCategory->category_name = $nameCat;
		$addCategory->id_mathang    = $request->id_mathang;
		$nameMh                     = Mathang::find($request->id_mathang)->name;
		$addCategory->mathang_name  = $nameMh;
        if($request->keywords != ""){
    		$addCategory->keywords    = $request->keywords;
        }else{
            $addCategory->keywords = '';
        }
        if($request->description != ""){
            $addCategory->description    = $request->description;
        }else{
            $addCategory->description = '';
        }
        $addCategory->status  = 1;
		$addCategory->created_at  = new DateTime();;
		$addCategory->save();
    }

    public function ngEdit($id){
    	$dataCategory = Hangsx::find($id);
        return $dataCategory;
    }

    public function ngPostEdit(Request $request,$id){
		$edit_mathang                = Hangsx::find($id);
		$edit_mathang->name          = $request->name;
		$edit_mathang->slug          = changeTitle($request->name);
		$edit_mathang->id_category   = $request->id_category;
		$nameCat                    = Category::find($request->id_category)->name;
		$edit_mathang->category_name = $nameCat;
		$edit_mathang->id_mathang    = $request->id_mathang;
		$nameMh                     = Mathang::find($request->id_mathang)->name;
		$edit_mathang->mathang_name  = $nameMh;
        
        if($request->keywords != ""){
    		$edit_mathang->keywords    = $request->keywords;
        }else{
            $edit_mathang->keywords = '';
        }
        if($request->description != ""){
            $edit_mathang->description    = $request->description;
        }else{
            $edit_mathang->description = '';
        }

        $edit_mathang->status  = 1;
		$edit_mathang->created_at  = new DateTime();;
		$edit_mathang->save();
    }

    public function ngDelete($id){
    	$hangsx = Hangsx::find($id);
        $hangsx->status = 0;
        $hangsx->save();
        $laptop = Laptop::where('id_hangsx', $id)->get();
        foreach($laptop as $data){
            $idlap = $data->id;
            $dellap = Laptop::find($idlap);
            $dellap->status = 0;
            $dellap->save();
        }

        $ram = Ram::where('id_hangsx', $id)->get();
        foreach($ram as $data){
            $idram = $data->id;
            $delram = Ram::find($idram);
            $delram->status = 0;
            $delram->save();
        }
    }

    

    public function ngGetHangsxInMh($id){
    	return Hangsx::where('id_mathang', $id)->where('status', 1)->get();
    }

    public function ngSearch($txt){
        return Hangsx::where('name','like','%'.$txt.'%')->get();
    }

    public function ngCount(){
        return Hangsx::where('status', 1)->count();
    }

    public function searchCount($txt){
        return Hangsx::where('name','like','%'.$txt.'%')->count();
    }
}
