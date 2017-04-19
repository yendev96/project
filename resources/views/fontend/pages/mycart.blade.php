@extends('fontend.master')
@section('title', 'Đơn hàng của tôi')
@section('content')

<div class="giohang" ng-controller="myCartController">
	<div class="container">
		<div class="row text-left title-giohang text-center">
			<h4><i class="fa fa-shopping-cart icon-title-giohang"></i>GIỎ HÀNG CỦA BẠN</h4>
		</div>
		{%value%}
		<div class="row content-giohang">
			<table class="table table-hover table-giohang">
				<thead>
					<tr>
						<th>Sản phẩm</th>
						<th>Xóa</th>
						<th>Đơn giá</th>
						<th>Số lượng</th>
						<th>Ngày đặt</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>

					<tr class="box-giohang" ng-repeat="x in cart track by $index">
						<td class="td-tensanpham text-left">
							<div class="row">
								<div class="col-sm-4 col-xs-12"><img src="{{asset('/public/upload/img/img_products')}}/{%x.options.img%}" alt="" style="with:100%"></div>
								<div class="col-sm-8 col-xs-12 giohang-tensanpham"><span>{%x.name%}</span></div>
							</div>
						</td>
						<td>
							<span class="xoasanpham" ng-click="modalconfirm(x.rowid)"><a href="javascript:void(0)" title=""><i class="fa fa-times icon-xoasanpham"></i>Xóa sản phẩm</a></span>

						</td>
						<td>{%x.price | number%}</td>
						<td><input type="number" class="soluong-sp" min="1" max="100" ng-model="qty" value="{%x.qty%}" ng-change="changecart(x.rowid,qty)"></td>

						<td>{%x.subtotal | number%}</td>
						<td>fasdfsd</td>
					</tr>

				</tbody>
			</table>
			<div class="row text-center" style="margin-bottom: 20px;" ng-hide="emptycart">
				<span>Không có sản phẩm nào trong giỏ hàng</span>
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

</div>				


@endsection