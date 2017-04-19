<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Orderdetail;

class OrderController extends Controller
{
    public function index(){
    	return view('backend.order.order');
    }

// Lấy danh sách đơn hàng
    public function ngList(){
    	return Order::all();
    }

// Lấy đơn hàng chưa thanh toán theo id người mua
    public function getListOrderDatail($id){
    	return Orderdetail::where('id_order', $id)->where('status', 1)->get();
    }

// Xử lý thanh toán giỏ hàng
    public function XlDonHang($id){
    	$order = Order::find($id);
    	$order->status = 0;
    	$order->save();
    }

    public function getCount(){
    	return Order::all()->count();
    }

    public function hihi(Request $request){
        echo 'hi';
    }
}
