@extends('fontend.master')
@section('title', 'Chi tiết sản phẩm')
@section('content')

<div class="giohang" ng-controller="cartController">
	<div class="container">
		<div class="row text-left title-giohang text-center">
			<h4><i class="fa fa-shopping-cart icon-title-giohang"></i>GIỎ HÀNG CỦA BẠN</h4>
		</div>
		<div class="row content-giohang">
			<table class="table table-hover table-giohang">
				<thead>
					<tr>
						<th>Sản phẩm</th>
						<th>Xóa</th>
						<th>Đơn giá</th>
						<th>Số lượng</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>

					<tr class="box-giohang" ng-repeat="x in cart track by $index">
						<td class="td-tensanpham text-left">
							<div class="row">
								<div class="col-sm-4 col-xs-12"><img src="{{asset('/public/upload/img/img_products')}}/{%x.options.img%}" alt="" style="with:100%"></div>
								<div class="col-sm-8 col-xs-12 giohang-tensanpham"><span ng-bind="x.name"></span></div>
							</div>
						</td>
						<td>
							<span class="xoasanpham" ng-click="modalconfirm(x.rowid)"><a href="javascript:void(0)" title=""><i class="fa fa-times icon-xoasanpham"></i>Xóa sản phẩm</a></span>

						</td>
						<td ng-bind="x.price | number"></td>
						<td><input type="number" class="soluong-sp" min="1" max="100" ng-model="qty" value="{%x.qty%}" ng-change="changecart(x.rowid,qty)"></td>

						<td ng-bind="x.subtotal | number"></td>

					</tr>

				</tbody>
			</table>
			<div class="row text-center" style="margin-bottom: 20px;" ng-hide="emptycart">
				<span>Không có sản phẩm nào trong giỏ hàng</span>
			</div>
		</div>

		<div class="row content-tongtien">

			<div class="tongtien-giohang pull-right">
				<span>THÀNH TIỀN: </span><span style="font-size: 20px;color: red; font-weight: bold;" ng-bind="total | number"></span>
				<p>( Giá đã bao gồm VAT )</p>
				<button type="submit" class="btn btn-primary" ng-click="actionthanhtoan()">ĐẶT HÀNG</button>
				<button type="button" class="btn btn-danger" ng-click="xoagiohang()">XÓA GIỎ HÀNG</button>
			</div>

		</div>
	</div>

	<div class="modal fade" id="confirmDelete" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Xóa sản phẩm</h4>
				</div>
				<div class="modal-body">
					<p>Bạn có chắc chắn muốn xóa không ??</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" ng-click="confirmDelCart(idDelete)">Xóa</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>


	<div class="modal fade" id="modalCart" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header" style="background: #4caf50;color: #fff;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thông báo</h4>
				</div>
				<div class="modal-body text-center">
					<p>{%thongbao_giohang%}</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modalthanhtoan" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thanh toán giỏ hàng</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-9 col-md-offset-1">
							<form id="defaultForm" name="formThanhToan" action="" method="post" class="form-horizontal">

								<div class="form-group">
									<label class="col-sm-4 control-label">Họ và tên</label>
									<div class="col-sm-8">
										<input type="text" class="form-control hoten" name="fullname" ng-model="thanhtoan.fullname" ng-required="true" />
										<span class="error" ng-show="formThanhToan.hoten.$error.required && formUser.hoten.$touched">Vui lòng nhập họ tên</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Số điện thoại</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" name="fullname" ng-model="thanhtoan.fullname" ng-required="true">
										<span class="error" ng-show="formThanhToan.sdt.$error.required && formThanhToan.sdt.$touched">Vui lòng nhập đúng địa chỉ email</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Địa chỉ</label>
									<div class="col-sm-8">
										<textarea class="form-control" name="address" ng-model="thanhtoan.address" required="true"></textarea>
										<span class="error" ng-show="formThanhToan.diachi.$error.required && formThanhToan.diachi.$touched">Vui lòng nhập password</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Ghi chú</label>
									<div class="col-sm-8">
										<textarea class="form-control" name="" ng-model="thanhtoan.ghichu"></textarea>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="col-md-6">
						<p class="ng-binding" style="font-size: 20px;color: #f73620;">TỔNG TIỀN: {%total | number %}</p>            	
					</div>
					<div class="col-md-2 col-md-offset-2">
						<input type="button" name="" value="THANH TOÁN" class="btn btn-success" ng-click="dathang()">
					</div>
				</div>
			</div>
		</div>
	</div>

	<flash-message></flash-message>
</div>				


@endsection