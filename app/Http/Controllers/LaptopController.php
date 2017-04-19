<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laptop;
use App\Ram;
use App\Mathang;
use App\Hangsx;
use App\Category;
use App\ImgProduct;
use dateTime;
use Auth;
use Input;

class LaptopController extends Controller
{
    //========================================================
    
    public function index()
    {
        // Hiển thị danh sách
        return view('backend.products.laptop');
        
    }
    
    
    public function ngList()
    {
        return Laptop::all();
    }
    
    
    public function ngAdd(Request $request)
    {
        $products          = new Laptop;
        $products->name    = Input::get('name');
        $products->slug    = changeTitle(Input::file('name'));
        $products->content = '';
        $products->price   = Input::get('price');
        if (Input::get('discount') > 0) {
            $products->discount = Input::get('discount');
        } else {
            $products->discount = 0;
        }
        $products->hard_drive       = Input::get('hard_drive');
        $products->value_hard_drive = Input::get('value_hard_drive');
        $products->ram              = Input::get('ram');
        $products->value_ram        = Input::get('value_ram');
        $products->cpu              = Input::get('cpu');
        $products->value_cpu        = Input::get('value_cpu');
        $products->color            = Input::get('color');
        $products->view             = 0;
        $products->countbuy         = 0;
        $products->p                = 1;
        $products->status           = Input::get('status');
        $products->id_category      = Input::get('id_category');
        $products->name_category    = Category::find(Input::get('id_category'))->name;
        $products->id_mathang       = Input::get('id_mathang');
        $products->name_mathang     = Mathang::find(Input::get('id_mathang'))->name;
        $products->id_hangsx        = Input::get('id_hangsx');
        $products->name_hangsx      = Hangsx::find(Input::get('id_hangsx'))->name;
        $products->author           = Auth::user()->fullname;
        $products->created_at       = new dateTime();
        $file                       = Input::file('img');
        
        //Nếu file ảnh tồn tại
        if ($file != null) {
            // Lấy tên ảnh
            $file_name  = $file->getClientOriginalName();
            // gán tên ảnh
            $image_name = str_random(15) . '.' . $file_name;
            
            // Kiểm trả neu ten anh ton tai
            if (file_exists($image_name)) {
                // thì gán tiếp tên vs các kí tự ramdom
                $image_name = str_random(15) . '.' . $file_name;
            }
            // Upload ảnh
            
            $upload_success = $file->move('public/upload/img/img_products/', $image_name);
            $products->img  = $image_name;
        }
        
        $products->save();
        
        // Lấy dữ liệu files
        $files = Input::file('file');
        // Lặp
        foreach ($files as $file) {
            // Lấy tên file name
            $files_name  = $file->getClientOriginalName();
            // Gán tên file vs các kí tự random
            $images_name = str_random(15) . '.' . $files_name;
            // KIểm trả xem file có tồn tại k
            if (file_exists($images_name)) {
                // Nếu tồn tại gán tiếp tên vs các kí tự ramdom
                $images_name = str_random(15) . '.' . $files_name;
            }
            
            $images             = new ImgProduct;
            $images->name       = $images_name;
            $images->id_product = $products->id;
            $images->category   = 'laptop';
            // upload ảnh
            $upload_success     = $file->move('public/upload/img/img_products/hihi', $images_name);
            $images->save();
            
        }
        
        
    }
    
    public function ngEdit($id)
    {
        return Laptop::find($id);
    }
    
    public function ngPostEdit($id)
    {
        $products = Laptop::find($id);
        $file     = Input::file('img');
        // if (!$file) {
        //     $produts->img = $produts->img;
        // }
        $products->name    = Input::get('name');
        $products->slug    = changeTitle(Input::file('name'));
        $products->content = '';
        $products->price   = Input::get('price');
        
        if (Input::get('discount') > 0) {
            $products->discount = Input::get('discount');
        } else {
            $products->discount = 0;
        }
        
        $products->hard_drive       = Input::get('hard_drive');
        $products->value_hard_drive = Input::get('value_hard_drive');
        $products->ram              = Input::get('ram');
        $products->value_ram        = Input::get('value_ram');
        $products->cpu              = Input::get('cpu');
        $products->value_cpu        = Input::get('value_cpu');
        $products->color            = Input::get('color');
        $products->view             = 0;
        $products->p                = 1;
        $products->status           = Input::get('status');
        $products->id_category      = Input::get('id_category');
        $products->name_category    = Category::find(Input::get('id_category'))->name;
        $products->id_mathang       = Input::get('id_mathang');
        $products->name_mathang     = Mathang::find(Input::get('id_mathang'))->name;
        $products->id_hangsx        = Input::get('id_hangsx');
        $products->name_hangsx      = Hangsx::find(Input::get('id_hangsx'))->name;
        $products->author           = Auth::user()->fullname;
        $products->created_at       = new dateTime();
        
        
        // Nếu file ảnh tồn tại
        if ($file != null) {
            if (file_exists('public/upload/img/img_products/' . $products->img)) {
                // Nếu tồn tại thì tiến hành xóa
                unlink('public/upload/img/img_products/' . $products->img);
            }
            
            $ext            = $file->getClientOriginalExtension();
            $image_name     = str_random(15) . '.' . $ext;
            $upload_success = $file->move('public/upload/img/img_products/', $image_name);
            $products->img  = $image_name;
        }
        
        $products->save();
        
        // Lấy dữ liệu files
        $files = Input::file('file');
        
        if ($files) {
            $del_files = ImgProduct::where('id_product', $id)->where('category', 'laptop')->get();
            foreach ($del_files as $del_file) {
                $id_file_del  = $del_file->id;
                $filename_del = $del_file->name;
                if (file_exists('public/upload/img/img_products/hihi/' . $filename_del)) {
                    // Nếu tồn tại thì tiến hành xóa
                    unlink('public/upload/img/img_products/hihi/' . $filename_del);
                }
                
                ImgProduct::find($id_file_del)->delete();
            }
            // Lặp
            foreach ($files as $file) {
                // Lấy tên file name
                $files_name  = $file->getClientOriginalName();
                // Gán tên file vs các kí tự random
                $images_name = str_random(15) . '.' . $files_name;
                // KIểm trả xem file có tồn tại k
                if (file_exists($images_name)) {
                    // Nếu tồn tại gán tiếp tên vs các kí tự ramdom
                    $images_name = str_random(15) . '.' . $files_name;
                }
                
                $images             = new ImgProduct;
                $images->name       = $images_name;
                $images->id_product = $id;
                $images->category   = 'laptop';
                // upload ảnh
                $upload_success     = $file->move('public/upload/img/img_products/hihi', $images_name);
                $images->save();
                
            }
            
        }
    }
    
    public function ngGetImage($id)
    {
        return ImgProduct::where('id_product', $id)->where('category', 'laptop')->get();
    }
    
    public function ngDelete($id)
    {
        $delete = Laptop::find($id);
        $img    = $delete->img;
        //Kiểm tra xem file ảnh có tồn tại hay không
        if (file_exists('public/upload/img/img_products/' . $img)) {
            // Nếu tồn tại thì tiến hành xóa
            unlink('public/upload/img/img_products/' . $img);
        }
        
        // Lấy dữ liệu cũ trong database
        $list_img = ImgProduct::where('id_product', $id)->where('category', 'laptop')->get();
        ImgProduct::where('id_product', $id)->where('category', 'laptop')->delete();
        foreach ($list_img as $item) {
            $name_img = $item->name;
            if (file_exists('public/upload/img/img_products/hihi/' . $name_img)) {
                unlink('public/upload/img/img_products/hihi/' . $name_img);
            }
        }
        //Tiến hành xóa sản phẩm
        $delete->delete();
    }
    
    
    public function ngSearch($txt)
    {
        return Laptop::where('name', 'like', '%' . $txt . '%')->orWhere('name_hangsx', 'like', '%' . $txt . '%')->get();
    }
    
    
    public function ngCount()
    {
        return Laptop::all()->count();
    }
    
    public function ngCountSearch($txt)
    {
        return Laptop::where('name', 'like', '%' . $txt . '%')->orWhere('name_hangsx', 'like', '%' . $txt . '%')->count();
    }
    
    //===========================================
    
}
