<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mathang;
use App\Hangsx;
use App\Laptop;
use DateTime;
use App\Category;
class MathangController extends Controller
{
    public function index()
    {   $data = Mathang::all();
    	return view('backend.category.mathang', compact('data'));
    }

    public function ngList(){
        return Mathang::where('status', 1)->get();;
        
    }

    public function ngAdd(Request $request){
    	$addCategory = new Mathang;
		$addCategory->name        = $request->name;
		$addCategory->slug        = changeTitle($request->name);
		$addCategory->id_category   = $request->id_category;
        if($request->id_category == 0){
            $addCategory->parent_name    = 'Trống';
        }else{
            $nameCat    = Category::find($request->id_category)->name;
            $addCategory->parent_name   = $nameCat;
        }
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
    	$dataCategory = Mathang::find($id);
        return $dataCategory;
    }

    public function ngPostEdit(Request $request,$id){
    	$edit_mathang = Mathang::find($id);
		$edit_mathang->name        = $request->name;
		$edit_mathang->slug        = changeTitle($request->name);
		$edit_mathang->id_category   = $request->id_category;
        if($request->id_category == 0){
            $edit_mathang->parent_name    = 'Trống';
        }else{
            $nameCat    = Category::find($request->id_category)->name;
            $edit_mathang->parent_name   = $nameCat;
        }
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
        $addCategory->status  = 1;
		$edit_mathang->created_at  = new DateTime();;
		$edit_mathang->save();
    }

    public function ngDelete($id){
    	$mathang = Mathang::find($id);
        $mathang->status = 0;
        $mathang->save();
        $hangsx = Hangsx::where('id_mathang', $id)->get();
        foreach($hangsx as $data){
            $idHangsx = $data->id;
            $delHangsx = Hangsx::find($idHangsx);
            $delHangsx->status = 0;
            $delHangsx->save();
        }

        $pro = Laptop::where('id_mathang', $id)->get();
        foreach($pro as $data){
            $idPr = $data->id;
            $delPr = Laptop::find($idPr);
            $delPr->status = 0;
            $delPr->save();
        }
    }

// Laasy danh sách mặt hàng theo id danh mục
    public function ngGetMatHangInCat($id){
        return Mathang::where('id_category', $id)->where('status', 1)->get();
    }

// Lấy số lượng mặt hàng
    public function ngGetCountMh(){
        return Mathang::where('status', 1)->count();
    }

// Tìm kiếm mặt hàng
    public function ngSearch($txt){
        return Mathang::where('name','like','%'.$txt.'%')->get();
    }

// Lấy kết quản tìm kiếm mặt hàng
    public function searchCount($txt){
        return Mathang::where('name','like','%'.$txt.'%')->count();
    }
}
