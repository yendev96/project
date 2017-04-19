<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Mathang;
use App\Hangsx;
use App\Laptop;
use App\Ram;
class TrashController extends Controller
{

	// XỬ LÝ PHẦN DANH MỤC
	public function catTrash(){
		return view('backend.trash.trash_cat');
	}

	public function getCatTrash(){
		return Category::where('status',0)->get();
	}

	public function recoveryCat($id){
		$delete = Category::find($id);
		$delete->status = 1;
		$delete->save();
		$idCat = $delete->id;
		$mathang = Mathang::where('id_category', $idCat)->get();

		foreach($mathang as $data){
			$idMh = $data->id;
			$deleteMh = Mathang::find($idMh);
			$deleteMh->status = 1;
			$deleteMh->save();
		}

		$hangsx = Hangsx::where('id_category', $idCat)->get();
		foreach($hangsx as $data){
			$idHangsx = $data->id;
			$deleteHangsx = Hangsx::find($idHangsx);
			$deleteHangsx->status = 1;
			$deleteHangsx->save();
		}

		$product = Laptop::where('id_category', $id)->get();
		foreach($product as $data){
			$idPr = $data->id;
			$deletePr = Laptop::find($idPr);
			$deletePr->status = 1;
			$deletePr->save();
		}
	}


	public function deleteCat($id){
		Category::find($id)->delete();

		$list_mh = Mathang::where('id_category', $id)->get();
		foreach($list_mh as $data){
			$idMh = $data->id;
			Mathang::find($idMh)->delete();
		}

		$list_sx = Hangsx::where('id_category', $id)->get();
		foreach($list_sx as $data){
			$idSx = $data->id;
			Hangsx::find($idSx)->delete();
		}

		$list_laptop = Laptop::where('id_category', $id)->get();
		foreach($list_laptop as $data){
			$idLap = $data->id;
			Laptop::find($idLap)->delete();
		}

		$list_ram = Ram::where('id_category', $id)->get();
		foreach($list_ram as $data){
			$idRam = $data->id;
			Ram::find($idRam)->delete();
		}
	}

	public function getCountCatDel(){
		return Category::where('status', 0)->count();
	}

    // XỬ LÝ MẶT HÀNG

	public function mhTrash(){
		return view('backend.trash.trash_mh');
	}


	public function getCatMh(){
		return Mathang::where('status', 0)->get();
	}

// Khôi phục mặt hàng
	public function recoveryMh($id){
		$mathang = Mathang::find($id);
		$mathang->status = 1;
		$mathang->save();

		$hangsx = Hangsx::where('id_mathang', $id)->get();
		foreach($hangsx as $data){
			$idHangsx = $data->id;
			$rcHangsx = Hangsx::find($idHangsx);
			$rcHangsx->status = 1;
			$rcHangsx->save();
		}

		$lap = Laptop::where('id_mathang', $id)->get();
		foreach($lap as $data){
			$idlap = $data->id;
			$rclap = Laptop::find($idlap);
			$rclap->status = 1;
			$rclap->save();
		}

		
		
	}

// Xóa vĩnh viễn danh mục mặt hàng và các danh  mục nằm trong
	public function deleteMh($id){
		$delmathang = Mathang::find($id);
		$delmathang->delete();
		$list_sx = Hangsx::where('id_category', $id)->get();
		foreach($list_sx as $data){
			$idSx = $data->id;
			Hangsx::find($idSx)->delete();
		}

		$list_laptop = Laptop::where('id_category', $id)->get();
		foreach($list_laptop as $data){
			$idLap = $data->id;
			Laptop::find($idLap)->delete();
		}

		$list_ram = Ram::where('id_category', $id)->get();
		foreach($list_ram as $data){
			$idRam = $data->id;
			Ram::find($idRam)->delete();
		}
	}

	public function getCountMhDel(){
		return Mathang::where('status', 0)->count();
	}

	// Xử lý phần hãng sx

	public function sxTrash(){
		return view('backend.trash.trash_sx');
	}

	public function getCatSx(){
		return Hangsx::where('status', 0)->get();
	}

	public function recoverySx($id){
		$hangsx = Hangsx::find($id);
		$hangsx->status = 1;
		$hangsx->save();

		$lap = Laptop::where('id_hangsx', $id)->get();
		foreach($lap as $data){
			$idsx = $data->id;
			$dellap = Laptop::find($idsx);
			$dellap->status = 1;
			$dellap->save();
		}
	}

	public function deleteSx($id){
		$hangsx = Hangsx::find($id);
		$hangsx->delete();

		$lap = Laptop::where('id_hangsx', $id)->get();
		foreach($lap as $data){
			$idlap = $data->id;
			$dellap = Laptop::find($idlap);
			$dellap->delete();
		}

		$lap = Ram::where('id_hangsx', $id)->get();
		foreach($lap as $data){
			$idlap = $data->id;
			$dellap = Ram::find($idlap);
			$dellap->delete();
		}
	}

	public function getCountSxDel(){
		return Hangsx::where('status', 0)->count();
	}
}
