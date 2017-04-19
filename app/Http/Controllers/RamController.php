<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Mathang;
use App\Hangsx;
use App\Ram;
use Auth;
use Input;
use App\ImgProduct;
use dateTime;
class RamController extends Controller
{
	public function index(){
		$data = Category::all();
		return view('backend.products.ram', compact('data','data'));
	}

	public function listRam(){
		return Ram::all();
	}

	public function ngAdd(){
		$addRam                = new Ram;
		$file                  = Input::file('img');
		$addRam->name          = Input::get('name');
		$addRam->slug          = changeTitle(Input::get('name'));
		$addRam->id_category   = Input::get('category');
		$addRam->name_category = Category::find($addRam->id_category)->name;
		$addRam->id_mathang    = Input::get('mathang');
		$addRam->name_mathang  = Mathang::find($addRam->id_mathang)->name;
		$addRam->id_hangsx     = Input::get('hangsx');
		$addRam->name_hangsx   = Hangsx::find($addRam->id_hangsx)->name;
		$addRam->price         = Input::get('price');
		$addRam->discount      = Input::get('discount');
		$addRam->memory        = Input::get('memory');
		$addRam->bus           = Input::get('bus');
		$addRam->status        = Input::get('status');
		$addRam->created_at    = new DateTime();

		if ($file!=null) {

			$ext = $file->getClientOriginalExtension();
			$image_name = str_random(15).'.'.$ext;
			$upload_success = $file->move('public/upload/img/img_products/', $image_name);
			$addRam->img = $image_name;
		}

		$addRam->save();
	}

	public function ngEdit($id){
		return Ram::find($id);
	}

	public function ngGetImage($id){
		$images = ImgProduct::where('id_product' , $id)->where('category', 'ram')->get();
		return $images;
	}

	public function ngPostEdit($id){
		// Lấy dữ liệu từ form chuyền sang
		$editRam              = Ram::find($id);
		$file                  = Input::file('img');
		$editRam->name          = Input::get('name');
		$editRam->slug          = changeTitle(Input::get('name'));
		$editRam->id_category   = Input::get('category');
		$editRam->name_category = Category::find($editRam->id_category)->name;
		$editRam->id_mathang    = Input::get('mathang');
		$editRam->name_mathang  = Mathang::find($editRam->id_mathang)->name;
		$editRam->id_hangsx     = Input::get('hangsx');
		$editRam->name_hangsx   = Hangsx::find($editRam->id_hangsx)->name;
		$editRam->price         = Input::get('price');
		$editRam->discount      = Input::get('discount');
		$editRam->memory        = Input::get('memory');
		$editRam->bus           = Input::get('bus');
		$editRam->status        = Input::get('status');
		$editRam->updated_at    = new DateTime();
		
		

		if ($file!=null) {
			if(file_exists('public/upload/img/img_products/'.$editRam->img)){
    		// Nếu tồn tại thì tiến hành xóa
				unlink('public/upload/img/img_products/'.$editRam->img);
			}
			$ext = $file->getClientOriginalExtension();
			$image_name = str_random(15).'.'.$ext;
			$upload_success = $file->move('public/upload/img/img_products/', $image_name);
			$editRam->img = $image_name;
		}else{
			$editRam->img = '';
		}

		$editRam->save(); 

	}

	// Tiến hành xóa sản phẩm
	public function ngDelete($id){
		$delete = Ram::find($id);
		$img = $delete->img;
    	//Kiểm tra xem file ảnh có tồn tại hay không
		if(file_exists('public/upload/img/img_products/'.$img)){
    		// Nếu tồn tại thì tiến hành xóa
			unlink('public/upload/img/img_products/'.$img);
		}

		// Lấy dữ liệu cũ trong database
		$list_img = ImgProduct::where('id_product' , $id)->where('category', 'ram')->get();
		ImgProduct::where('id_product' , $id)->where('category', 'ram')->delete();
		foreach($list_img as $item){
			$name_img = $item->name;
			if(file_exists('public/upload/img/img_products/hihi/'.$name_img)){
				unlink('public/upload/img/img_products/hihi/'.$name_img);
			}
		}
    	//Tiến hành xóa sản phẩm
		$delete->delete();
	}


	public function ngCount(){
		return Ram::all()->count();
	}
}
