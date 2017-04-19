    <aside class="main-sidebar" ng-controller="asideController">

        <section class="sidebar mysidebar">
            <!-- Top aside -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/public/backend/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <!-- Hiện thị tên quản trị viên -->
                    <p><a href="{{url('backend/user/edit', Auth::guard('admin')->user()->id)}}" title="">{{ucwords(Auth::guard('admin')->user()->username)}}</a></p>
                    <a href="{{url('backend/user/edit', Auth::guard('admin')->user()->id)}}" class="id-admin"><i class="fa fa-circle text-success"></i>ID:&nbsp;<span>{{Auth::guard('admin')->user()->id}}</span></a>
                    <a href="{{url('backend/user/level', Auth::guard('admin')->user()->level)}}" class="lv-admin"><i class="fa fa-circle text-success"></i> Level:&nbsp;<span>{{Auth::guard('admin')->user()->level}}</span></a>
                </div>
            </div>
            <!-- Khu vực menu-->
            <ul class="sidebar-menu">
                <li class="header text-center"> 
                    @if(Auth::guard('admin')->check()) 
                    <span style="color:red; font-weight:bold;">Bạn là: {{"Supper Admin"}}</span>
                    @else
                    <span style="color:#FFFFFF">Bạn là: {{"Admin"}}</span>
                    @endif
                </li>
                <li><a href="{{url('/backend/order')}}"><i class="fa fa-circle-o text-red"></i> <span>Quản lý đơn hàng</span></a></li>
                <li><a href="{{url('/backend/categorys')}}"><i class="fa fa-circle-o text-red"></i> <span>Quản lý danh mục</span></a></li>
                <li><a href="{{url('/backend/mathang')}}"><i class="fa fa-circle-o text-red"></i> <span>Quản lý mặt hàng</span></a></li>
                <li><a href="{{url('/backend/hangsx')}}"><i class="fa fa-circle-o text-red"></i> <span>Quản lý hãng sản xuất</span></a></li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-circle-o text-red"></i> <span>Quản lý sản phẩm</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/backend/products/laptop')}}"><i class="fa fa-star"></i> Quản lý Laptop</a></li>
                        <li><a href="{{url('/backend/products/ram')}}"><i class="fa fa-star"></i> Quản lý Ram</a></li>
                    </ul>
                </li>
                <li><a href="{{url('/backend/users')}}"><i class="fa fa-circle-o text-red"></i> <span>Quản lý thành viên</span></a></li>
                <li><a href="{{url('/backend/comment')}}"><i class="fa fa-circle-o text-red"></i> <span>Quản lý comment</span></a></li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-trash-o"></i> <span>Trash</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/backend/trash/categorys')}}"><i class="fa fa-trash-o"></i> Danh mục đã xóa</a></li>
                        <li><a href="{{url('/backend/trash/mathang')}}"><i class="fa fa-trash-o"></i> Mặt hàng đã xóa</a></li>
                        <li><a href="{{url('/backend/trash/hangsx')}}"><i class="fa fa-trash-o"></i> Hãng sx đã xóa</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>
