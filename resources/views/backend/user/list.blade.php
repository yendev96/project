@extends('backend.layouts.master')
@section('title','Danh Sách User')
@section('content')
<div class="content" ng-controller="userController">
	<div flash-alert="success" active-class="in alert-flash flash-angular" class="fade ">
		<button type="button" class="close" ng-click="hide()">&times;</button>
		<strong class="alert-heading">Thông báo!</strong>
		<span class="alert-message" ng-bind="flash.message"></span>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading myheading">
				<div class="col-lg-3 col-md-4 col-sm-12">
					<h4><i class="fa fa-users"></i>DANH SÁCH USER<span class="count"></span></h4>
				</div>
				
				<div class="right-heading">
					<button type="button" class="btn btn-primary" data-toggle="modal" ng-click="modalUser('addUser')"><i class="fa fa-plus"></i>Thêm mới</button>
					<button type="button" class="btn btn-danger btn-delete-checkall"  ng-click="deletemultil()"><i class="fa fa-trash-o"></i>XÓA</button>

				</div>
			</div>
			<!-- / panel-heading myheading -->
			<div class="panel-body ">
				<div class="row row-filter ">
					<div class="col-md-6 count-search">
						<p>Có <span style="color:red;font-size:20px">{%countsearch%}</span> kết quả được tìm thấy</p>
					</div>
					<div class="col-md-3 col-sm-7 col-xs-12  pull-right">
						<div class="row search">
							<form action="" method="get" role="form">
								<input type="text" class="form-control search" name="s" placeholder="Tìm kiếm danh mục..." ng-model="search" ng-keyup="searchUser()">
							</form>
						</div>
					</div>
				</div>
				<!-- / row-filter -->
				<div class="main-table">
					<table id="example2" class="table table-hover table-bordered tbl-admin ">
						<thead>
							<tr>
								<th><input id="checkall" type="checkbox" ng-model="x.selected" value="0"></th>
								<th>Fullname</th>
								<th>Email</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Level</th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody class="danhsach">
							<tr class="" ng-repeat="x in listuser |pagination:(currentPage - 1) * pageSize | orderBy:['-id']">
								<td><input id='checkbox' type="checkbox" ng-model="x.selected" value="{%x.id%}"></td>
								<td ng-bind="x.fullname"></td>
								<td ng-bind="x.email"></td>
								<td ng-bind="x.address"></td>
								<td ng-bind="x.phone"></td>
								<td ng-bind="x.level"></td>
								<td class="td-action" class="td-action">
									<a title="Chỉnh sửa thông tin" href="javascript:void(0)" ng-click="modalUser('editUser',x.id)"><i class="fa fa-pencil-square icon-edit"></i></a>
									<a title="Xóa thành viên" href="javascript:void(0)" ng-click="showModalDelete(x.id)"><i class="fa fa-trash icon-trash"></i></a>
								</td>
								

							</tr>
						</tbody>
						
					</table>
				</div>
				<div class="pull-right ">
					<ul uib-pagination total-items="data.length" ng-model="currentPage" ng-change="pageChanged()" items-per-page="pageSize"></ul>
				</div>
			</div>
			<!-- /panel-body -->
		</div>
		<!-- /panel-default -->
	</div>


	<div class="modal fade" id="confirmDelete" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete User</h4>
				</div>
				<div class="modal-body">
					<p>Bạn có chắc chắn muốn xóa không ??</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" ng-click="delete(idDelete)">Xóa</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="confirmDeletes" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete User</h4>
				</div>
				<div class="modal-body">
					<p>Bạn có chắc chắn muốn xóa không ??</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" ng-click="deletes()">Xóa</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

	<div id="modalUser" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center" >{%title%}</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-9 col-md-offset-1">
							<form id="defaultForm" name="formUser" action="" method="post" class="form-horizontal">

								<div class="form-group">
									<label class="col-sm-4 control-label">Fullname</label>
									<div class="col-sm-8">
										<input type="text" class="form-control fullname" name="fullname" ng-model="user.fullname" ng-required="true" placeholder="Nhập Username" />
										<span class="error" ng-show="formUser.fullname.$error.required && formUser.fullname.$touched">Vui lòng nhập họ tên</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Email</label>
									<div class="col-sm-8">
										<input type="email" class="form-control" name="email" ng-model="user.email" ng-required="true" placeholder="Nhập Email" >
										<span class="error" ng-show="formUser.email.$error.required && formUser.email.$touched">Vui lòng nhập email</span>
										<span class="error" ng-show="formUser.email.$error.email">Vui lòng nhập đúng địa chỉ email</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" name="password" ng-model="user.password" ng-minlength="6" ng-maxlength="24" ng-required="true" placeholder="Nhập Password" />
										<span class="error" ng-show="formUser.password.$error.required && formUser.password.$touched">Vui lòng nhập password</span>
										<span class="error" ng-show="formUser.password.$error.minlength">Password phải nhiều hơn 6 ký tự</span>
										<span class="error" ng-show="formUser.password.$error.maxlength">Password phải dài không quá 24 ký tự</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Nhập lại password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" math-pass="password" name="password2" ng-model="password2" ng-required="true" placeholder="Nhập lại password" />
										<span class="error" ng-show="formUser.password2.$error.required && formUser.password2.$touched">Vui lòng nhập lại password</span>
										<span class="error" ng-show="formUser.password2.$error.mathPass">Password không trùng nhau</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Address</label>
									<div class="col-sm-8">
										<input type="text" class="form-control address" name="address" ng-model="user.address" ng-required="true" placeholder="Nhập địa chỉ" />
										<span class="error" ng-show="formUser.address.$error.required && formUser.address.$touched">Vui lòng nhập địa chỉ</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Phone number</label>
									<div class="col-sm-8">
										<input type="text" class="form-control phone" name="phone" ng-model="user.phone" ng-required="true" placeholder="Nhập số điện thoại" />
										<span class="error" ng-show="formUser.phone.$error.required && formUser.phone.$touched">Vui lòng nhập số điện thoại</span>
									</div>
								</div>
								<div class="form-group form-inline">
									<label class="col-sm-4 control-label">Level</label>
									<div class="col-sm-8">
										<input type="radio" name="level" ng-required="true" ng-model="user.level" value="1" placeholder="">Admin
										<input type="radio" name="level" ng-required="true" ng-model="user.level" value="2" placeholder="">Member
										<p><span class="error" ng-show="formUser.level.$error.required && formUser.level.$touched">Vui lòng chọn level</span></p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label"></label>
									<div class="col-sm-8">
										<button id="submit" type="button" class="btn btn-primary" ng-disabled="formUser.$invalid" ng-click="save(state, id)">{%textSave%}</button>
										<button type="reset" class="btn btn-default">Làm mới</button>
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
</div>

@endsection
@section('script')
<script type="text/javascript" src="{{asset('/public/backend/js/angular/user.js')}}"></script>
@endsection


