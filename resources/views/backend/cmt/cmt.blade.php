@extends('backend.layouts.master')
@section('title','Danh Sách Bình luận')
@section('content')
<div class="content" ng-controller="cmtController">
	<div flash-alert="success" active-class="in alert-flash flash-angular" class="fade ">
		<button type="button" class="close" ng-click="hide()">&times;</button>
		<strong class="alert-heading">Thông báo!</strong>
		<span class="alert-message" ng-bind="flash.message"></span>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading myheading">
				<div class="col-lg-4 col-md-4 col-sm-12">
					<h4><i class="fa fa-users"></i>DANH SÁCH COMMENT<span class="count"></span></h4>
				</div>
				
				<div class="right-heading">
					<button type="button" class="btn btn-primary" data-toggle="modal" ng-click="modalUser('addUser')"><i class="fa fa-plus"></i>Thêm mới</button>
					<button type="button" class="btn btn-danger btn-delete-checkall"  ng-click="deletemultil()"><i class="fa fa-trash-o"></i>XÓA</button>

				</div>
			</div>
			<!-- / panel-heading myheading -->
			<div class="panel-body ">
				<div class="row" style="margin-bottom: 20px; margin-top: 10px;">
					<input type="radio" name="status" ng-model="stt.status" value="0">Đã duyệt
					<input type="radio" name="status" ng-model="stt.status" value="1">Chưa duyệt
				</div>
				<!-- / row-filter -->
				<div class="main-table">
					<table id="example2" class="table table-hover table-bordered tbl-admin ">
						<thead>
							<tr>
								<th><input id="checkall" type="checkbox" ng-model="list.listuser"></th>
								<th>Tên</th>
								<th>Nội dung</th>
								<th>Trả lời cho</th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody class="danhsach">
							<tr class="" ng-repeat="x in listcmt | orderBy:['-id'] | filter:stt">
								<td><input id='checkbox' type="checkbox" checklist-model="list.listuser" checklist-value="x.id"></td>
								<td>
									<p ng-bind="x.fullname"></p>
									<p ng-bind="x.created_at"></p>
									<div ng-if="x.status == 1">
										<span style="color:red">Chưa duyệt</span>
									</div>
									<div ng-if="x.status == 0">
										<span style="color:#069D06">Đã duyệt</span>
									</div>
								</td>
								<td ng-bind="x.content_cmt"></td>
								<td>
									<p><span>Post: </span><span ng-bind="x.post"></span></p>
									<p><span>Comment ID: </span><span ng-bind="x.parent_cmt"></span></p>
								</td>
								
								<td class="td-action" class="td-action">
									<a title="Phê duyệt" href="javascript:void(0)" ng-click="modalCmt('duyet',x.id)"><i class="fa fa-check-square-o icon-edit"></i></a>
									<a title="Trả lời" href="javascript:void(0)" ng-click="modalrepcmt(x.id_post,x.fullname,x.id)"><i class="fa fa-comment-o icon-rep"></i></a>
									<a title="Xóa bình luận" href="javascript:void(0)" ng-click="modalCmt('xoa',x.id)"><i class="fa fa-trash icon-trash"></i></a>
								</td>
								

							</tr>
						</tbody>
						
					</table>
				</div>
				<!-- <div class="pull-right ">
					<ul uib-pagination total-items="x.length" ng-model="currentPage" ng-change="pageChanged()" items-per-page="pageSize"></ul>
				</div> -->
			</div>
			<!-- /panel-body -->
		</div>
		<!-- /panel-default -->
	</div>


	<div class="modal fade" id="confirmModalCmt" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" ng-bind="titlemodalcmt"></h4>
				</div>
				<div class="modal-body">
					<p ng-bind="textcontent"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" ng-click="actionClick(state,idCmt)" ng-bind="textbutton" ng-show="showbutton"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="modalRepCmt" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Bình luận</h4>
				</div>
				<div class="modal-body">
					<textarea class="form-control" ng-model="contentrepcmt"></textarea>
					<span style="color:red" ng-hide="showerror">Bình luận quá ngắn</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" ng-click="actionRepCmt(name, idpost, idCmtRep)">Trả lời</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

</div>

@endsection
@section('script')
<script type="text/javascript" src="{{asset('/public/backend/js/angular/cmt.js')}}"></script>
@endsection


