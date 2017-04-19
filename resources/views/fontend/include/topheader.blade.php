<div class="top-header" ng-controller="headerController">
	<div class="container">
		<div class="row">
			<div class="pull-left hotline">
				<h6><i class="fa fa-phone icon-hotline"></i>Đường dây nóng: 1900 96 96</h6>
			</div>
			<div class="pull-right login-register">
				<ul>

					@if(Auth::guard('web')->check())
					<li><a href="{{url('mycart/')}}"><i class="fa fa-shopping-cart"></i> Đơn hàng của tôi</a></li>
					<li><a href="{{url('/dangky')}}"><i class="fa fa-user"></i> {{Auth::guard('web')->user()->fullname}}</a></li>
					<li><a href="{{url('/dangxuat')}}"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
					@else
					<li ng-click="modalRegister()"><a href="javascript:void(0)"><span class="fa fa-user"></span> Đăng ký</a></li>
					<li ng-click="modalLogin()"><a href="javascript:void(0)"><i class="fa fa-lock"></i> Đăng nhập</a></li>
					@endif
				</ul>
			</div>
		</div>	
	</div>
	<div id="modalRegister" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Đăng ký thành viên</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<form id="defaultForm" name="formDangky" class="form-horizontal" method="post" action="{{url('/dangky')}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2">Fullname</label>
									<div class="col-md-10 col-sm-10">
										<input type="text" class="form-control" required="true" name="fullname" ng-model="dangky.fullname">
										<span class="error" ng-show="formDangky.fullname.$error.required && formDangky.fullname.$touched">Vui lòng nhập họ tên</span>
									</div>
								</div>
								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2">Password</label>
									<div class="col-md-10 col-sm-10">
										<input type="password" class="form-control" required="true" name="password" ng-model="dangky.password" ng-minlength="6" ng-maxlength="24">
										<span class="error" ng-show="formDangky.password.$error.required && formDangky.password.$touched">Vui lòng nhập password</span>
										<span class="error" ng-show="formDangky.password.$error.minlength">Password phải nhiều hơn 6 ký tự</span>
										<span class="error" ng-show="formDangky.password.$error.maxlength">Password phải dài không quá 24 ký tự</span>
									</div>
								</div>
								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2">Re-password</label>
									<div class="col-md-10 col-sm-10">
										<input type="password" class="form-control" required="true" name="re_password" ng-model="dangky.re_password">
										<span class="error" ng-show="formDangky.re_password.$error.required && formDangky.re_password.$touched">Vui lòng nhập lại password</span>
									</div>
								</div>
								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2">Email</label>
									<div class="col-md-10 col-sm-10">
										<input type="email" class="form-control" required="true" name="email" ng-model="dangky.email">
										<span class="error" ng-show="formDangky.email.$error.required && formDangky.email.$touched">Vui lòng nhập email</span>
										<span class="error" ng-show="formDangky.email.$error.email">Vui lòng nhập email đúng định dạng</span>
									</div>
								</div>

								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2"></label>				
									<div class="col-md-10 col-sm-10">
										<input type="button" class="btn btn-primary" name="add-user" value="Đăng ký" ng-disabled="formDangky.$invalid" ng-click="register()">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<div id="modalLogin" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Đăng nhập thành viên</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<form id="defaultForm" name="formDangnhap" class="form-horizontal" action="{{url('/dangnhap')}}" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2">Email</label>
									<div class="col-md-10 col-sm-10">
										<input type="email" class="form-control" name="email" ng-required="true" ng-model="login.email">
										<span class="error" ng-show="formDangnhap.email.$error.required && formDangnhap.email.$touched">Password phải nhiều hơn 6 ký tự</span>
										<span class="error" ng-show="formDangnhap.email.$error.email">Vui lòng nhập email</span>
									</div>
								</div>
								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2">Password</label>
									<div class="col-md-10 col-sm-10">
										<input type="password" class="form-control" name="password" ng-required="true" ng-model="login.password" ng-minlength="6" ng-maxlength="24">
										<span ng-show="formDangnhap.password.$error.required && formDangky.password.$touched">Vui lòng nhập password</span>
										<span class="error" ng-show="formDangnhap.password.$error.required && formDangnhap.password.$touched">Password phải nhiều hơn 6 ký tự</span>
										<span class="error" ng-show="formDangnhap.password.$error.minlength">Password phải nhiều hơn 6 ký tự</span>
										<span class="error" ng-show="formDangnhap.password.$error.maxlength">Password phải dài không quá 24 ký tự</span>
									</div>
								</div>
								<div class="form-group my-form-group">
									<label class="col-md-2 col-sm-2"></label>				
									<div class="col-md-10 col-sm-10">
										<input type="checkbox" name="remember" >&nbsp;Nhớ đăng nhập
									</div>
								</div>
								<div class="form-group my-form-group" style="margin-top:10px;">
									<label class="col-md-2 col-sm-2"></label>				
									<div class="col-md-10 col-sm-10">
										<button type="button" class="btn btn-primary" name="login-user" ng-click="dangnhap()" ng-disabled="formDangnhap.$invalid">Đăng nhập</button>
										<a style="margin-left:4px" href="" title="">Quên mật khẩu</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	
</div>

	<div flash-alert="success" active-class="in alert-flash flash-angular" class="fade" style="background:#209704">
		<button type="button" class="close" ng-click="hide()">&times;</button>
		<strong class="alert-heading">Thông báo!</strong>
		<span class="alert-message" ng-bind="flash.message"></span>
	</div>


