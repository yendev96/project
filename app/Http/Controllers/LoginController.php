<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;


class LoginController extends Controller
{

	public function getAdmin(){
		if(Auth::guard('admin')->check()){
			return redirect(url('/backend'))->with('success','Đăng nhập thành công');
		}else{
			return view('auth.login');
			
		}
		
	}

	public function postAdmin(Request $request){

		if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'level' => 1])) {
			return redirect(url('backend'))->with('success', "Đăng nhập thành công");
		}else{
			return redirect(url('login'));
			//echo $request->email;
		}

	}

	public function getLogout(){
		Auth::guard('admin')->logout();
		return redirect(url('/login'));
	}
}
