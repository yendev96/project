<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Laptop;
use App\Category;
class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_user     = User::all()->count();
        $count_products = Laptop::all()->count();
        $count_category = Category::all()->count();
        return view('backend.layouts.home', compact('count_user', 'count_category','count_products'));
    }
}
