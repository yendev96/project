@extends('backend.layouts.master')
@section('title','Danh sách đơn hàng')
@section('content')
<div class="" ng-controller="orderController">
	<div class="panel panel-default">
		<div class="panel-heading"><h4><i class="fa fa-exchange" style="margin-right: 10px;"></i>Danh sách đơn hàng</h4></div>
		<div class="panel-body">
			<div class="row" style="margin-bottom: 20px; margin-top: 10px;">
				<input type="radio" name="status" ng-model="stt.status" value="0">Đã xử lý
				<input type="radio" name="status" ng-model="stt.status" value="1">Chưa xử lý
			</div>
			<div class="main-table">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Tên khác hàng</th>
							<th>Số điện thoại</th>
							<th>Địa chỉ</th>
							<th>Thời gian đặt hàng</th>
							<th>Tiền</th>
							<th>Tình trạng đơn hàng</th>
							<th>Sản phẩm</th>
							<th>Xử lý</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="order in orders | filter:stt | orderBy: '-id'">
							<td ng-bind="order.fullname"></td>
							<td ng-bind="order.phone"></td>
							<td ng-bind="order.address"></td>
							<td ng-bind="order.created_at"></td>
							<td>
								<div ng-if="order.status == 1">
									<span style="color:red">Chưa xử lý</span>
								</div>
								<div ng-if="order.status == 0">
									<span style="color:#248A09">Đã thanh toán</span>
								</div>
							</td>
							<td ng-bind="order.total"></td>
							<td>
								<a href="javascript:void(0)" title="" ng-click="chitietdonhang(order.id,order.total)">Chi tiết</a>
							</td>

							<td>
								<a href="javascript:void(0)" title="" ng-click="xulydonhang(order.id)"><i class="fa fa-check-square-o icon-checkorder"></i></a>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div class="modal fade" id="confirmxlorder" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Xử lý đơn hàng</h4>
				</div>
				<div class="modal-body">
					<p>Bạn có chắc đơn hàng đã được xử lý ??</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" ng-click="actionxlydonhang(idxl)">Có</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="modalDonHang" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Chi tiết đơn hàng</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<table class="table table-giohang">
								<thead>
									<tr>
										<th>Sản phẩm</th>
										<th>Đơn giá</th>
										<th>Số lượng</th>
										<th>Thành tiền</th>
									</tr>
								</thead>
								<tbody>

									<tr class="box-giohang" ng-repeat="x in listorder">
										<td class="td-tensanpham text-left">
											<div class="row">
												<div class="col-sm-4 col-xs-12"><img src="{{asset('/public/upload/img/img_products')}}/{%x.img%}" alt="" style="width:80px"></div>
												<div class="col-sm-8 col-xs-12 giohang-tensanpham"><span>{%x.name_product%}</span></div>
											</div>
										</td>
										<td>{%x.price | number%}</td>
										<td>{%x.qty%}</td>

										<td>{%x.subtotal | number%}</td>

									</tr>

								</tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-4 col-md-offset-4 lead">TỔNG TIỀN : <span style="color:red">{%total | number%} đ</span></div>
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
<script type="text/javascript" src="{{asset('/public/backend/js/angular/order.js')}}"></script>
@endsection
