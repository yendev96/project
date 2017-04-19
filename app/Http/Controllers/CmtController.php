<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use App\Laptop;
use DateTime;
class CmtController extends Controller
{
	public function index(){
		return view('backend.cmt.cmt');
	}

	public function ngList(){
		return Comment::all();
	}

	public function ngDuyet($idcmt){
		$cmt = Comment::find($idcmt);
		$cmt->status = 0;
		$cmt->save();
		if($cmt->parent_cmt != 0){
			$data_sub_cmt = Comment::find($cmt->parent_cmt);
			$data_sub_cmt->count_rep = $data_sub_cmt->count_rep + 1;
			$data_sub_cmt->save();
		}
	}

	public function ngXoa($idcmt){
		$cmt = Comment::find($idcmt);
		$idcmt = $cmt->id;
		$parent_cmt = $cmt->parent_cmt;
		$count_rep = $cmt->count_rep;
		if($parent_cmt == 0){
			if($count_rep > 0){
				$subcmt = Comment::where('parent_cmt', $id)->delete();
			}
		}else{
			$cmt_cha = Comment::find($parent_cmt);
			$cmt_cha->count_rep = $cmt_cha->count_rep - 1;
			$cmt_cha->save();
		}
		
		$cmt->delete();
	}

	public function ngCheck($idcmt){
		$cmt = Comment::find($idcmt);
		$status = $cmt->status;
		if($status == 1){
			return 'false';
		}else{
			return 'true';
		}
	}

	public function ngRep(Request $request,$idpost,$idcmt){
		$repcmt = new Comment;
		$repcmt->fullname = Auth::user()->fullname;
		$repcmt->content_cmt = $request->content;
		// Lấy thông tin của cmt
		$data_cmt = Comment::find($idcmt);
		// Nếu parent_cmt của cmt đó bằng 0, tức là nó là comment cha
		if($data_cmt->parent_cmt == 0){
			// thì gán parent_cmt của trả lời bằng với id của comment cha đó
			$repcmt->parent_cmt = $idcmt;
			$data_cmt->count_rep = $data_cmt->count_rep + 1;
			$data_cmt->save();
		}else{
			// Nếu parent_cmt của nó không tức là nó là sub cmt
			// Thì gán parent_cmt của trả lời bằng với parent_cmt(id của cmt cha)
			$repcmt->parent_cmt = $data_cmt->parent_cmt;
			$addcountrep = Comment::where('id', $data_cmt->parent_cmt)->first();
			$addcountrep->count_rep = $addcountrep->count_rep + 1;
			$addcountrep->save();
		}



		$name_post = Laptop::where('id', $idpost)->first()->name;
		$repcmt->post = $name_post;
		$repcmt->id_post = $idpost;
		$repcmt->status = 0;
		$repcmt->like = 0;
		$repcmt->count_rep = 0;
		$repcmt->level_user = Auth::user()->level;
		$repcmt->created_at = new DateTime();
		$repcmt->save();
	}
}
