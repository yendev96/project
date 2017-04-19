<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use dateTime;

class UserController extends Controller
{
    public function index(){
        // Lấy danh sách user theo level từ nhỏ đên lớn
        
        return view('backend.user.list');
    }

    public function nglist(){
        
        return User::orderBy('created_at', 'ASC')->get();
        
    }

    public function ngAdd(Request $request){
        $addUser           = new User;
        $addUser->fullname = $request->fullname;
        $addUser->email    = $request->email;
        $addUser->password = $request->password;
        $addUser->address  = $request->address;
        $addUser->phone    = $request->phone;
        $addUser->level    = $request->level;
        $addUser->created_at    = new DateTime();
        $addUser->save();
        
    }

    public function ngEdit($id){
        $dataUser = User::find($id);
        return $dataUser;
    }

    public function postNgEdit(Request $request,$id){
        $dataUser          = User::find($id);
        $dataUser->fullname = $request->fullname;
        $dataUser->email    = $request->email;
        $dataUser->password = $request->password;
        $dataUser->address  = $request->address;
        $dataUser->phone    = $request->phone;
        $dataUser->level    = $request->level;
        $dataUser->updated_at    = new DateTime();
        $dataUser->remember_token    = '';
        $dataUser->save();
    }

    public function ngDelete($id){
        if($id == Auth::user()->id){
            echo 'false';
        }else{
            $deleteUser  = User::find($id)->delete();
        }
    }

    public function ngDeletes(Request $request){
        if($request->id == Auth::user()->id){
            echo 'false';
        }else{
            User::find($request->id)->delete();
        }
    }

    public function ngSearch($txt){
        return User::where('fullname','like','%'.$txt.'%')->orWhere('address','like','%'.$txt.'%')->get();
    }

    public function ngCountSearch($txt){
        return User::where('fullname','like','%'.$txt.'%')->orWhere('address','like','%'.$txt.'%')->count();
    }

    public function test(){
        echo Hash::make('vanyen96');
    }

    public function ngCount(){
        return User::all()->count();
    }

    public function hello(Request $request){
      echo $request->id;
  }
  

  
}
