<nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{asset('/public/backend/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">Xin chào {{ucwords(Auth::guard('admin')->user()->fullname)}}<i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{asset('/public/backend/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                                    <p>
                                     {{ucwords(Auth::guard('admin')->user()->fullname)}} - Quản trị viên
                                     <small>Created: 12- 13- 2016</small>
                                 </p>
                             </li>
                             <!-- Menu Footer-->
                             <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('backend/user/edit',Auth::guard('admin')->user()->id)}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('logout')}}" class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>