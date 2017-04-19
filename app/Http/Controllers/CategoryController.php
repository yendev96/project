<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Mathang;
use App\Hangsx;
use App\Laptop;
use Auth;
use DateTime;
class CategoryController extends Controller
{
    // HIỂN THỊ DANH SÁCH DANH MỤC
    public function index(){
    	return view('backend.category.category');
    }

    // Lấy danh sách danh mục có status là 1 để hiện thị
    public function ngList(){
        $listCat = Category::where('status', 1)->get();
        return $listCat;
    }

    public function ngAdd(Request $request){
        $addCategory            = new Category;
        $addCategory->name      = $request->name;
        $addCategory->slug      = changeTitle($request->name);
        $addCategory->cat_order = $request->cat_order;
        $addCategory->show_nav  = $request->show_nav;
        $addCategory->status  = 1;
		
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
		$addCategory->created_at  = new DateTime();;
		$addCategory->save();
    }

    public function ngEdit($id){
    	$dataCategory = Category::find($id);
        return $dataCategory;
    }

    public function ngPostEdit(Request $request,$id){
    	$data_cat = Category::find($id);
    	$data_cat->name        = $request->name;
		$data_cat->slug        = changeTitle($request->slug);
        $data_cat->cat_order   = $request->cat_order;
        $data_cat->show_nav    = $request->show_nav;
        $data_cat->status      = 1;
		$data_cat->keywords    = $request->keywords;
		$data_cat->description = $request->description;
		$data_cat->updated_at  = new DateTime();;
		$data_cat->save();
    }

    public function ngDelete($id){
        // Tìm danh mục theo ID
    	$delete = Category::find($id);
        // Gán cột status = 0 là ẩn
        $delete->status = 0;
        $delete->show_nav = 0;
        // Tiến hành cập nhật
        $delete->save();

        // Lấy thông tin của tất cả các mặt hàng có id của danh mục đang xóa
        $mathang = Mathang::where('id_category', $id)->get();
        // Tiến hành lặp
        foreach($mathang as $data){
            // Lấy id của từng mặt hàng
            $idMh = $data->id;
            // Tìm mặt hàng có id ở trên
            $deleteMh = Mathang::find($idMh);
            // Gán cột status bằng 0
            $deleteMh->status = 0;
            // Tiến hành cập nhật
            $deleteMh->save();
        }

        // Lấy thông tin của hãng sx có id danh mục đang xóa
        $hangsx = Hangsx::where('id_category', $id)->get();
        // Tiến hành lặp
        foreach($hangsx as $data){
            // Lấy id của hãng sx
            $idHangsx = $data->id;
            // Tìm thông tin của hãng sx vs id tìm dk
            $deleteHangsx = Hangsx::find($idHangsx);
            // Gán cột status bằng 0
            $deleteHangsx->status = 0;
            // Tiến hành cập nhật
            $deleteHangsx->save();
        }

        $product = Laptop::where('id_category', $id)->get();
        foreach($product as $data){
            $idPr = $data->id;
            $deletePr = Laptop::find($idPr);
            $deletePr->status = 0;
            $deletePr->save();
        }

        
    }

    public function ngSearch($txt){
        return Category::where('name','like','%'.$txt.'%')->get();
    }

    public function ngGetAllCount(){
        return Category::where('status',1)->count();
    }

    public function ngCountSearch($txt){
        return Category::where('name','like','%'.$txt.'%')->count();
    }

//     public function getShow($value){;
//         $data = Category::paginate($value);
//          $count = Category::all()->count();
//         $count_show = $value;
//         return view('backend.category.list', compact('count', 'data'));
// }
//     // HIỆN FORM THÊM DANH MỤC
//     public function getAdd()
//     {   
//         // Nếu level != 1 tức là k phải supper thì k có quyền thêm danh mục
//         if(Auth::user()->level != 1){
//             // Chuyển hướng về trang danh sách
//             return redirect(url('backend/category/list'))->with('danger','Bạn không được thêm danh mục');
//         }else
//         // Lấy danh sach danh mục
//         $data = Category::all();
//         // Hiển thị trang thêm danh mục
//     	return view('backend.category.add')->with('data', $data);
//     }
    
// // XỬ LÝ THÊM DANH MỤC
//     public function postAdd(Request $request){
//         // Tiến hành validate
//     	$this->validate($request,
            
//             [
//                 'name'   => 'unique:category,name',
//             ],[
//                 'name.unique'     => 'Tên tồn tại',
//     		]

//     	);
//         // Gán các giá trị
//         $category              = new Category;
//         $category->name        = $request->name;
//         $category->cat_order   = $request->cat_order;
//         $category->slug        = changeTitle($request->name);
//         $category->parent_id   = $request->parent;
//         $category->keywords    = $request->keywords;
//         $category->description = $request->description;
//         $category->created_at     = new dateTime(); 
//         // Tiến hành thêm
// 		$category->save();
//         // Chuyển hướng đên trang danh sách sau khi thêm thành công
//     	return redirect(url('backend/category/list'))->with('success','Thêm mới thành công');

//     }
// // XỬ LÝ EDIT DANH MỤC
//     public function getEdit($id){
//         // Kiêm tra xem người đăng nhập có phải là SupperAdmin hay không
//         if(Auth::user()->level != 1){
//             // Chuyển hướng về trang danh sách
//             return redirect(url('backend/category/list'))->with('danger','Bạn không có quyền truy cập');
//         }else
//         // Lấy danh sách danh mục
//         $category = Category::all();
//         // Lấy dữ liệu danh mục cần sửa
//     	$edit_category = Category::find($id);
//         // Hiển thị trang sửa danh mục
//     	return view('backend.category.edit')->with(['data' => $category, 'edit_category' => $edit_category]);
//     }
// // XỬ LÝ EDIT DANH MỤC
//     public function postEdit(Request $request,$id){
//             // lấy danh sách danh mục
//             $category = Category::find($id);
//             // Lấy tên danh mục
//             $name_cat = $category->name;
//             //Nếu tên nhập vào khác tên trong cơ sở dữ liệu thì tiến hành validate
//             if($name_cat != $request->name){
//                 // validate
//                 $this->validate($request,
//                     [
//                         'name' => 'unique:category,name'
//                     ],

//                     [
//                         'name.unique' => 'Tên đã tồn tại',
//                     ]
//                 );

//                 $category->name        = $request->name;
//             } 
//             // Gán các giá trị
//             $category->slug        = changeTitle($request->name);
//             $category->keywords    = $request->keywords;
//             $category->cat_order   = $request->cat_order;
//             $category->description = $request->description;
//             $category->parent_id   = $request->parent;
//             $category->updated_at  = new dateTime();
//             // Tiến hành sửa danh mục
//             $category->save();
//             // Sửa thành công tiến hành chuyển hướng
//             return redirect(url('backend/category/list'))->with('success','Chỉnh sửa thành công');
            
//     }

// // XỬ LÝ XÓA DANH MỤC
//     public function delete($id){
//         // Kiểm tra level người đăng nhập
//         if(Auth::user()->level != 1){
//             // Chuyển hướng về trang danh sách nếu không phải admin
//             return redirect(url('backend/category/list'))->with('danger','Bạn không có quyền xóa');
//         }else
//         // Kiểm tra xem danh mục cần xóa có danh mục còn hay không
//         $parent = Category::where('parent_id', $id)->count();
//         // Nếu không có danh mục con ở trong thì xóa
//         if($parent == 0){
//             // Tìm danh mục cần xóa và tiến hành xóa
//             Category::find($id)->delete();
//             // Xóa xong chuyển hướng về trang danh sách
//             return redirect(url('backend/category/list'))->with('success','Bạn đã xóa thành công');
//         }else{
//             // Nếu có danh mục con thì ko cho xóa
//             return redirect(url('backend/category/list'))->with('danger','Bạn không thể xóa vì có chứa danh mục con');
//         }
//     }

//     public function deleteAjax($id){
//         //var_dump($id);
//         //$hihi = explode(',', $id);
//         //var_dump($hihi);
//         //foreach($hihi as $hehe){
//             //$delte = Category::find($hehe)->delete();
//         //}
//     }

//     public function getSearch(Request $request){
//         $key = \Request::get('s'); 
//         $data = Category::where('name','like','%'.$key.'%')->get();
//         $count = Category::where('name','like','%'.$key.'%')->count();
//         return view('backend.search.search_cat', compact('key','data','count'));
//     }
}
