<?php
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//
Route::get('login', 'LoginController@getAdmin');
Route::post('login','LoginController@postAdmin');
Route::get('logout', 'LoginController@getLogout');
Route::get('test','UserController@test');
Route::get('test2','FontendController@hihi');

Route::group(['middleware' => 'adminlogin'], function(){
	Route::group(['prefix' => 'backend'], function() {
		Route::get('/', 'OrderController@index');
		// ========= ĐƠN HÀNG =============
		Route::group(['prefix' => 'order'], function() {
		    Route::get('/', 'OrderController@index');
		    Route::get('list','OrderController@ngList');
		    Route::get('list-order-detail/{id}','OrderController@getListOrderDatail');
		    Route::post('xuly-donhang/{id}','OrderController@XlDonHang');
		    Route::get('getcount','OrderController@getCount');
		});
		// ====== DANH MỤC SẢN PHẨM ===========
		Route::group(['prefix' => 'categorys'], function() {

			Route::get('/', 'CategoryController@index');
			Route::get('list', 'CategoryController@ngList');
			Route::post('add', 'CategoryController@ngAdd');
			Route::get('edit/{id}', 'CategoryController@ngEdit');
			Route::post('edit/{id}', 'CategoryController@ngPostEdit');
			Route::get('delete/{id}', 'CategoryController@ngDelete');
			Route::get('search/{id}', 'CategoryController@ngSearch');
			Route::get('getcount', 'CategoryController@ngGetAllCount');
			Route::get('count_search/{txt}', 'CategoryController@ngCountSearch');
		});

		Route::group(['prefix' => 'mathang'], function() {

			Route::get('/', 'MathangController@index');
			Route::get('list', 'MathangController@ngList');
			Route::post('add', 'MathangController@ngAdd');
			Route::get('edit/{id}', 'MathangController@ngEdit');
			Route::post('edit/{id}', 'MathangController@ngPostEdit');
			Route::get('delete/{id}', 'MathangController@ngDelete');
			Route::get('getMatHangInCat/{id}', 'MathangController@ngGetMatHangInCat');
			Route::get('getcount', 'MathangController@ngGetCountMh');
			Route::get('search/{txt}', 'MathangController@ngSearch');
			Route::get('count_search/{txt}', 'MathangController@searchCount');

		});


		Route::group(['prefix' => 'hangsx'], function() {

			Route::get('/', 'HangsxController@index');
			Route::get('list', 'HangsxController@ngList');
			Route::post('add', 'HangsxController@ngAdd');
			Route::get('edit/{id}', 'HangsxController@ngEdit');
			Route::post('edit/{id}', 'HangsxController@ngPostEdit');
			Route::get('delete/{id}', 'HangsxController@ngDelete');
			Route::get('getHangsxInMh/{id}', 'HangsxController@ngGetHangsxInMh');
			Route::get('search/{txt}', 'HangsxController@ngSearch');
			Route::get('getcount', 'HangsxController@ngCount');
			Route::get('count_search/{txt}', 'HangsxController@searchCount');
			
			
		});
		// ========= PRODUCTS ===================
		Route::group(['prefix' => 'products'], function() {

			Route::group(['prefix' => 'laptop'], function(){
				Route::get('','LaptopController@index');
				Route::get('list', 'LaptopController@ngList');
				Route::post('add', 'LaptopController@ngAdd');
				Route::get('edit/{id}', 'LaptopController@ngEdit');
				Route::post('edit/{id}', 'LaptopController@ngPostEdit');
				Route::get('getimage/{id}', 'LaptopController@ngGetImage');
				Route::post('delete/{id}', 'LaptopController@ngDelete');
				Route::get('getcat', 'LaptopController@getCat');
				Route::get('search/{txt}', 'LaptopController@ngSearch');
				Route::get('getcount', 'LaptopController@ngCount');
				Route::get('count_search/{txt}', 'LaptopController@ngCountSearch');
			});

			Route::group(['prefix' => 'ram'], function(){
				Route::get('','RamController@index');
				Route::get('list', 'RamController@listRam');
				Route::post('add', 'RamController@ngAdd');
				Route::get('edit/{id}', 'RamController@ngEdit');
				Route::post('edit/{id}', 'RamController@ngPostEdit');
				Route::get('getimage/{id}', 'RamController@ngGetImage');
				Route::get('delete/{id}', 'RamController@ngDelete');
				Route::get('getcount', 'RamController@ngCount');
			});
			
		});

	// ========= USER ===================
		Route::group(['prefix' => 'users'],function(){

			Route::get('/', 'UserController@index');
			Route::get('list', 'UserController@ngList');
			Route::post('add', 'UserController@ngAdd');
			Route::get('edit/{id}', 'UserController@ngEdit');
			Route::post('edit/{id}', 'UserController@postNgEdit');
			Route::post('delete/{id}', 'UserController@ngDelete');
			Route::post('deletes', 'UserController@ngDeletes');
			Route::get('search/{id}', 'UserController@ngSearch');
			Route::get('count_search/{id}', 'UserController@ngCountSearch');
			Route::get('getcount', 'UserController@ngCount');
			Route::post('hello', 'UserController@hello');
			Route::get('getiduser', 'UserController@getIdUser');
		});

	// =========== COMMENT ============

		Route::group(['prefix' => 'comment'], function() {
		    Route::get('', 'CmtController@index');
		    Route::get('list', 'CmtController@ngList');
		    Route::post('duyet/{idcmt}', 'CmtController@ngDuyet');
		    Route::post('xoa/{idcmt}', 'CmtController@ngXoa');
		    Route::get('checkcmt/{idcmt}', 'CmtController@ngCheck');
		    Route::post('repcmt/{idpost}/{idcmt}', 'CmtController@ngRep');
		});

		// ======= TRASH ===============

		Route::group(['prefix' => 'trash'], function(){
			Route::group(['prefix' => 'categorys'], function() {
				Route::get('/', 'TrashController@catTrash');
				Route::get('get-trash-category', 'TrashController@getCatTrash');
				Route::get('recovery-cat/{id}', 'TrashController@recoveryCat');
				Route::get('delete-cat/{id}', 'TrashController@deleteCat');
				Route::get('getcount', 'TrashController@getCountCatDel');
			});
			

			Route::group(['prefix' => 'mathang'], function() {
				Route::get('/', 'TrashController@mhTrash');
				Route::get('get-trash-mh', 'TrashController@getCatMh');
				Route::get('recovery-mh/{id}', 'TrashController@recoveryMh');
				Route::get('delete-mh/{id}', 'TrashController@deleteMh');
				Route::get('getcount', 'TrashController@getCountMhDel');
			});


			Route::group(['prefix' => 'hangsx'], function() {
				Route::get('/', 'TrashController@sxTrash');
				Route::get('get-trash-sx', 'TrashController@getCatSx');
				Route::get('recovery-sx/{id}', 'TrashController@recoverySx');
				Route::get('delete-mh/{id}', 'TrashController@deleteSx');
				Route::get('getcount', 'TrashController@getCountSxDel');
			});
			

		});
	});

});

Route::get('/', 'FontendController@index');
Route::get('/dangky', 'FontendController@getDangky');
Route::post('/dangky', 'FontendController@postDangky');
Route::get('/dangnhap', 'FontendController@getDangnhap');
Route::post('/dangnhap', 'FontendController@postDangnhap');
Route::get('/dangxuat', 'FontendController@getDangxuat');
// Lấy dữ liệu sản phẩm theo id
Route::get('getproductbyid/{id}', 'FontendController@getProductById');
Route::get('getimgproductbyid/{id}/{cat}', 'FontendController@getImgProductById');
// Xử lý bình luận
Route::post('addcomment/{id}', 'FontendController@addCmt');
Route::get('getcmt', 'FontendController@getCmt');
Route::get('getsubcmt/{id}', 'FontendController@getSubCmt');
Route::post('likecmt/{idcmt}', 'FontendController@likeCmt');
Route::get('getcmtbyid/{id}', 'FontendController@getCmtProductById');
Route::get('getcmtbydate/{idpro}', 'FontendController@getCmtProductByDate');
Route::get('getcmtbylike/{idpro}', 'FontendController@getCmtProductByLike');
Route::get('getsubcmt/{id}', 'FontendController@getSubCmt');
Route::get('getcountrepcmt/{id}', 'FontendController@getCountRepCmt');
Route::get('gettotalcountcmt/{id}', 'FontendController@getTotalCmt');
Route::post('addrepcmt/{idpro}/{idcmt}', 'FontendController@addRepCmt');
Route::post('editcmt/{idcmt}', 'FontendController@editCmt');
Route::get('getiduser', 'FontendController@getIdUser');
Route::post('delcmt/{idcmt}', 'FontendController@delCmt');
// Đánh giá sản phẩm
Route::post('rating/{idpro}/{iduser}/{rateuser}', 'FontendController@addRate');
Route::get('gettotalrate/{idpro}', 'FontendController@getTotalRate');
Route::get('getcountrate/{idpro}', 'FontendController@getCountRate');
//Route::get('testcmt', 'FontendController@testCmt');
// Get sản phẩm bán chạy
Route::get('getbanchay', 'FontendController@getBanChay');
// Ghét sản phẩm xem nhiều
Route::get('getxemnhieu', 'FontendController@getXemNhieu');
// Get sản phẩm mới về
Route::get('getmoive', 'FontendController@getMoiVe');
Route::get('getram', 'FontendController@getRam');
Route::get('xay-dung-cau-hinh', 'FontendController@xdCauHinh');
Route::get('get_sx_by_mh', 'FontendController@getSxByMh');
// lấy sản phẩm khi click vào link
Route::get('product/detail/{id}', 'FontendController@getViewProduct');
Route::get('category/product_by_cat/{idcat}', 'FontendController@getViewDm');
Route::get('category/get_product_by_cat/{id}', 'FontendController@getLaptop');
Route::get('muahang/{id}/{count}', 'FontendController@muahang');
Route::get('addram/{id}/{count}', 'FontendController@addram');
Route::get('getcount', 'FontendController@getCount');
Route::get('cart', 'FontendController@getGioHang');
Route::get('get_data_cart', 'FontendController@getDataCart');
Route::get('clear_cart', 'FontendController@destroyCart');
Route::get('delete_cart/{id}', 'FontendController@deleteCart');
Route::get('cart/total', 'FontendController@totalCart');
Route::get('update_cart/{id}/{qty}', 'FontendController@updateCart');

// Tiếm kiểm tra đăng nhập bằng check session
Route::get('getsession', 'FontendController@checksession');
// Thanh toán
Route::post('dathang', 'FontendController@dathang');
Route::post('chitietdonhang', 'FontendController@chiTietDonHang');
Route::get('chitietdonhang', 'FontendController@chiTietDonHang');
// Người dùng kiểm tra đơn hàng
Route::group(['prefix' => 'mycart'], function() {
    Route::get('/','FontendController@donHangCuaToi');
	Route::get('list-order','FontendController@donHangCuaToi');
});

// Lọc và tìm kiếm
Route::get('timkiem/{txt}', 'FontendController@timkiem');
Route::get('filter/price/{from}/{to}', 'FontendController@filterPrice');
Route::post('filtermultil', 'FontendController@filterMultil');

Route::get('product/gettotal/{idcat}', 'FontendController@getTotalProduct');








