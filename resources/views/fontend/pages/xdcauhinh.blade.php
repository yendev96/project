@extends('fontend.master')
@section('title','Xây dựng cấu hình')
@section('content')

<div class="xdcauhinh" ng-controller="xdchController">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<div class="list-group">
					<p href="javascript:voide(0)" class="list-group-item active">Lọc sản phẩm</p>
					<p ng-repeat="ram in rams" href="#" class="list-group-item"><input type="checkbox"> {%ram.name%}</p>
				</div>
			</div>
			<div class="col-md-7">
				<div class="row">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Thông tin sản phẩm</th>
								<th>Giá sản phẩm</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="product in products">
								<td>{%product.name%}</td>
								<td>{%product.price%}</td>
								<td>Chọn sản phẩm</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-3">
				<div class="list-group">
					<p href="javascript:voide(0)" class="list-group-item active">Sản phẩm đã chọn</p>
					<p href="#" class="list-group-item">Chọn mainboard</p>
					<p href="#" class="list-group-item">Chọn mainboard</p>
					<p href="#" class="list-group-item">Chọn mainboard</p>
					<p href="#" class="list-group-item">Chọn mainboard</p>
					<p href="#" class="list-group-item">Chọn mainboard</p>
				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection
