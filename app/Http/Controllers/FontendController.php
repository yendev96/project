<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Mathang;
use App\Hangsx;
use Cart;
Use App\Order;
Use App\Orderdetail;
use DateTime;
use App\ImgProduct;
use App\Laptop;
use App\Ram;
use App\User;
use Hash;
use App\Comment;
use Input;
use App\Rate;
class FontendController extends Controller
{
    public function __construct(){
// Lấy danh sách Navigation
        $nav = Category::where('show_nav',1)->get();
// Share cho các function khác
        view()->share('nav', $nav);
    }

    public function hihi(){
        $a = Laptop::find(32)->img_product;
        return '$a';
    }
// Hiển thị trang chủ website
    public function index(){
// load view
        return view('fontend.home');
    }
    // Lấy số lượng tất cả sản phẩm
    public function getTotalProduct($idcat){
        return Laptop::where('id_category', $idcat)->count();
    }
// Get sản phẩm bán chạy
    public function getBanChay(){
        return Laptop::where('status', 1)->orderBy('countbuy', 'DESC')->take(4)->get();
    }
// Get sản phẩm xem nhiều
    public function getXemNhieu(){
        return Laptop::where('status', 1)->orderBy('view', 'DESC')->take(4)->get();
    }
// Get sản phẩm mới về
    public function getMoiVe(){
        return Laptop::where('status', 1)->orderBy('created_at', 'DESC')->take(4)->get();
    }
// Get danh sach laptop để hiện thị ở trang danh sách
    public function viewCat(){
        return Laptop::all();
    }

// Tiến hành xử lý đăng ký
    public function postDangky(Request $request){
        $add_user = new User;
        $add_user->fullname = $request->fullname;
        $add_user->password = Hash::make($request->password);;
        $add_user->address = '';
        $add_user->phone = '';
        $add_user->email = $request->email;
// Người dùng có level = 3
        $add_user->level = 3;
        $add_user->save();
    }

// Tiến hành xử lý đăng nhập
    public function postDangnhap(Request $request){
// Lấy thông tin email
        $email = $request->email;
// Lấy thông tin password
        $password = $request->password;
// Xử lý đăng nhập
// Nếu đăng nhập thành công thì chuyển về trang chủ vs thông báo
        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password, 'level' => 3])) {
            //return redirect(url('/'));
            echo 'true';
        }else{
// Nếu đăng nhập không thành công thì load lại trang đăng nhập
            //return redirect(url('/'));
            echo 'false';
        }
    }

    public function getRam(){
        return Ram::where('status', 1)->get();
    }
    public function getViewProduct($id){

        $list_img = ImgProduct::where('id_product',$id)->where('category', 'laptop')->get();
        return view('fontend.pages.chitiet', compact('id', 'list_img'));
    }
    public function getProductById($id){
        return Laptop::find($id);
    }
    public function getImgProductById($id,$cat){
        return ImgProduct::where('id_product', $id)->where('category', $cat)->get();
    }
    public function getViewDm($idcat){
        return view('fontend.pages.danhmuc', compact('idcat'));
    }
    public function getLaptop($id){
        return Laptop::where('id_category', $id)->where('status', 1)->get();
    }
    public function getSxByMh(){
        return Hangsx::where('id_mathang', 8)->get();
    }
    public function getDangxuat(){
        Auth::guard('web')->logout();
        return redirect(url('/'));
    }
    public function muahang($id,$count){
        $laptop = Laptop::where('id',$id)->first();
        Cart::add(array('id' => $id,'name' => $laptop->name, 'qty' => $count, 'price' => $laptop->price - ($laptop->price * $laptop->discount / 100), 'options' => array('img' => $laptop->img)));
// $content = Cart::content();
// return $content;
    }
    public function addram($id,$count){
        $ram = Ram::where('id',$id)->first();
        Cart::add(array('id' => $id,'name' => $ram->name, 'qty' => $count, 'price' => $ram->price - ($ram->price * $ram->discount / 100), 'options' => array('img' => $ram->img)));
// $content = Cart::content();
// return $content;
    }
    public function getCount(){
        return Cart::count();
    }
    public function getGioHang(){
        return view('fontend.pages.cart');
    }
    public function getDataCart(){
        return Cart::content();
    }
    public function destroyCart(){
        Cart::destroy();
    }
    public function deleteCart($id){
        Cart::remove($id);
    }
    public function totalCart(){
        return Cart::total();
    }
    public function updateCart($id,$qty){
        if(isset($id) and $qty > 0){
            Cart::update($id, $qty);
        }
    }
    public function filterLaptopCheckbox($sx,$ram,$ocung){
        return Laptop::where('id_hangsx', $sx)->orWhere('ram', $ram)->get();
    }
    public function checksession(){
        return Auth::guard('web')->user();
    }
    public function dathang(Request $request){
        $dathang             = new Order;
        $dathang->fullname   = $request->fullname;
        $dathang->phone      =  $request->phone;
        $dathang->address    = $request->address;
        $dathang->note       = $request->ghichu;
        $dathang->total      = Cart::total();
        $dathang->created_at = new DateTime();
        $dathang->updated_at = NULL;
        $dathang->status     = 1;
        $dathang->save();
        $carts = Cart::content();
        foreach($carts as $cart){
            $chitietdonhang               = new Orderdetail;
            $chitietdonhang->name_product = $cart->name;
            $chitietdonhang->price        = $cart->price;
            $chitietdonhang->qty          = $cart->qty;
            $chitietdonhang->id_order      = $dathang->id;
            $chitietdonhang->subtotal     = $cart->subtotal;
            $chitietdonhang->img          = $cart->options->img;
            $chitietdonhang->status       = 1;
            $chitietdonhang->created_at   = new DateTime();
            $chitietdonhang->save();
            $countbuy = Laptop::find($cart->id);
            $countbuy->countbuy = + $cart->qty;
            $countbuy->save();
            Cart::destroy();
// print($cart->options->img);
        }
    }
    public function donHangCuaToi(){
        return view('fontend.pages.mycart');
    }
    public function timkiem($txt){
        $laptop = Laptop::where('name','like', '%'.$txt.'%')->get();
        return $laptop;
    }
    public function filterPrice($from,$to){
        return Laptop::whereBetween('price', [$from, $to])->get();
    }
    public function filterMultil(Request $request){
        $id_sx = $request->id_hangsx;
        $ram = $request->ram;
        $ocung = $request->hard_drive;
// return Laptop::where('id_hangsx', $id_sx)->get();
        echo $id_sx;
        echo $ram;
        echo $ocung;
    }
    public function getCmtProductById($id){
        $cmt = Comment::where('id_post', $id)->where('parent_cmt', 0)->where('status', 0)->get();
        return $cmt;
    }

    public function getCmtProductByDate($idpro){
        $cmt = Comment::where('id_post', $idpro)->where('status', 0)->where('parent_cmt', 0)->orderBy('created_at', 'DESC')->get();
        return $cmt;
    }

    public function getCmtProductByLike($idpro){
        $cmt = Comment::where('id_post', $idpro)->where('status', 0)->where('parent_cmt', 0)->orderBy('like', 'DESC')->get();
        return $cmt;
    }
    public function getSubCmt($id){
        return Comment::where('parent_cmt', $id)->where('status', 0)->get();
    }
    public function addCmt(Request $request, $id){
        $addcmt = new Comment;
        $addcmt->fullname = Auth::user()->fullname;
        $addcmt->content_cmt = $request->content;
        $addcmt->parent_cmt = 0;
        $name_post = Laptop::where('id', $id)->first()->name;
        $addcmt->post = $name_post;
        $addcmt->id_post = $id;
        $addcmt->status = 1;
        $addcmt->like = 0;
        $addcmt->count_rep = 0;
        $addcmt->level_user = Auth::user()->level;
        $addcmt->id_user = Auth::user()->id;
        $addcmt->created_at = new DateTime();
        $addcmt->save();
    }
    public function getCountRepCmt($id){
        $cmt = Comment::where('parent_cmt', $id)->where('status', 0)->count();
        return $cmt;
    }
    public function testCmt(){
        $a = Comment::where('parent_cmt', 0)->get();
//return $a;
        foreach($a as $b){
            $c = Comment::where('parent_cmt', $b->id)->get();
            $result = $a->merge($c);
            return $result;
        }
    }
    public function addRepCmt($idpro, $idcmt){
        $textrep = Input::get('txt');
        $addcmt = new Comment;
        $addcmt->fullname = Auth::user()->fullname;
        $addcmt->content_cmt = $textrep;
        $addcmt->parent_cmt = $idcmt;
        $name_post = Laptop::where('id', $idpro)->first()->name;
        $addcmt->post = $name_post;
        $addcmt->id_post = $idpro;
        $addcmt->status = 1;
        $addcmt->like = 0;
        $addcmt->count_rep = 0;
        $addcmt->level_user = Auth::user()->level;
        $addcmt->id_user = Auth::user()->id;
        $addcmt->created_at = new DateTime();
        $addcmt->save();
    }
    public function likeCmt($idcmt){
        $cmt = Comment::find($idcmt);
        $cmt->like = $cmt->like + 1;
        $cmt->save();
    }
    public function editCmt(Request $request,$idcmt){
        $edit = Comment::find($idcmt);
        $edit->content_cmt = $request->content;
        $edit->save();
    }
    public function getIdUser(){
        $id = Auth::user()->id;
        return $id;
    }
    public function delCmt($idcmt){
        $cmt = Comment::find($idcmt);
        $idcmt = $cmt->id;
        $parent_cmt = $cmt->parent_cmt;
        $count_rep = $cmt->count_rep;
        if($parent_cmt == 0){
            if($count_rep > 0){
                $subcmts = Comment::where('parent_cmt', $idcmt)->get();
                foreach($subcmts as $subcmt){
                    $idsubcmt = $subcmt->id;
                    Comment::find($idsubcmt)->delete();
                }

            }
        }else{

            $cmtcha = Comment::where('id', $parent_cmt)->first();
            $cmtcha->count_rep = $cmtcha->count_rep - 1;
            $cmtcha->save();
        }

        $cmt->delete();
    }

    public function getTotalCmt($id){
      return Comment::where('id_post', $id)->where('status', 0)->count();
  }

  public function addRate($idpro, $iduser, $rateuser){
    $rate = new Rate;
    // Kiểm tra xem sản phẩm đã đánh giá trước đó hay chưa
    $pro = Rate::where('id_product', $idpro)->first();
    // Nếu sản phẩm đã dk đánh giá rồi
    if(!empty($pro)){
        // Lấy danh sách isd user đã đánh giá
        $user_rate = $pro->id_user;
        // Kiểm tra xem user vừa đánh giá đã tồn tại chưa
        $array = explode(',', $user_rate);
        // Nếu iduser đã tồn tại
        if (in_array($iduser, $array))
        {
          echo 'false';
      }else
      // Nếu id user không tồn tại
      {
          switch ($rateuser) {
            case 5:
            $pro->id_product = $idpro;
            $pro->id_user    = $pro->id_user . ',' . $iduser;
            $pro->nam_sao    = $pro->nam_sao + 1;
            $pro->bon_sao    = $pro->bon_sao;
            $pro->ba_sao     = $pro->ba_sao;
            $pro->hai_sao    = $pro->hai_sao;
            $pro->mot_sao    = $pro->mot_sao;
            $pro->save();
            break;
            case 4:
            $pro->id_product = $idpro;
            $pro->id_user    = $pro->id_user . ',' . $iduser;
            $pro->nam_sao    =  $pro->nam_sao;
            $pro->bon_sao    = $pro->bon_sao + 1;
            $pro->ba_sao     = $pro->ba_sao;
            $pro->hai_sao    = $pro->hai_sao;
            $pro->mot_sao    = $pro->mot_sao;
            $pro->save();
            break;
            case 3:
            $pro->id_product = $idpro;
            $pro->id_user    = $pro->id_user . ',' . $iduser;
            $pro->nam_sao    = $pro->nam_sao;
            $pro->bon_sao    = $pro->bon_sao;
            $pro->ba_sao     = $pro->ba_sao + 1;
            $pro->hai_sao    = $pro->hai_sao;
            $pro->mot_sao    = $pro->mot_sao;
            $pro->save();
            break;
            case 2:
            $pro->id_product = $idpro;
            $pro->id_user    = $pro->id_user . ',' . $iduser;
            $pro->nam_sao    = $pro->nam_sao;
            $pro->bon_sao    = $pro->bon_sao;
            $pro->ba_sao     = $pro->ba_sao;
            $pro->hai_sao    = $pro->hai_sao + 1;
            $pro->mot_sao    = $pro->mot_sao;
            $pro->save();
            break;
            case 1:
            $pro->id_product = $idpro;
            $pro->id_user    = $pro->id_user . ',' . $iduser;
            $pro->nam_sao    = $pro->nam_sao;
            $pro->bon_sao    = $pro->bon_sao;
            $pro->ba_sao     = $pro->ba_sao;
            $pro->hai_sao    = $pro->hai_sao;
            $pro->mot_sao    = $pro->mot_sao + 1;
            $pro->save();
            break;
            default:

        }
    }
}else{
    // Nếu sản phẩm chưa được đánh giá lần nào
    switch ($rateuser) {
        case 5:
        $rate->id_product = $idpro;
        $rate->id_user    = $iduser;
        $rate->nam_sao    = 1;
        $rate->bon_sao    = 0;
        $rate->ba_sao     = 0;
        $rate->hai_sao    = 0;
        $rate->mot_sao    = 0;
        $rate->save();
        break;
        case 4:
        $rate->id_product = $idpro;
        $rate->id_user    = $iduser;
        $rate->nam_sao    = 0;
        $rate->bon_sao    = 1;
        $rate->ba_sao     = 0;
        $rate->hai_sao    = 0;
        $rate->mot_sao    = 0;
        $rate->save();
        break;
        case 3:
        $raterate->id_product = $idpro;
        $raterate->id_user    = $iduser;
        $raterate->nam_sao    = 0;
        $raterate->bon_sao    = 0;
        $raterate->ba_sao     = 1;
        $raterate->hai_sao    = 0;
        $raterate->mot_sao    = 0;
        $raterate->save();
        break;
        case 2:
        $rate->id_product = $idpro;
        $rate->id_user    = $iduser;
        $rate->nam_sao    = 0;
        $rate->bon_sao    = 0;
        $rate->ba_sao     = 0;
        $rate->hai_sao    = 1;
        $rate->mot_sao    = 0;
        $rate->save();
        break;
        case 1:
        $rate->id_product = $idpro;
        $rate->id_user    = $iduser;
        $rate->nam_sao    = 0;
        $rate->bon_sao    = 0;
        $rate->ba_sao     = 0;
        $rate->hai_sao    = 0;
        $rate->mot_sao    = 1;
        $rate->save();
        break;
        default:

    }
}




}

public function getCountRate($idpro){
    $pro    = Rate::where('id_product', $idpro)->first();
    if($pro){
        $motsao = $pro->mot_sao;
        $haisao = $pro->hai_sao;
        $basao  = $pro->ba_sao;
        $bonsao = $pro->bon_sao;
        $namsao = $pro->nam_sao;
        $total  = $motsao + $haisao + $basao + $bonsao + $namsao;
        return $total;
    }else{
        return 0;
    }
}

public function getTotalRate($idpro){
    return  Rate::where('id_product', $idpro)->first();
    
}
}
