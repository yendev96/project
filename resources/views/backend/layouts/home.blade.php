@extends('backend.layouts.master')
@section('title','Home')
@section('content')

<section class="content">
	
	<!-- Small boxes (Stat box) -->
	<div class="row total-home">
		<div class="col-md-3 col-sm-6 col-xs-12 homebox">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-pencil"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Tổng số bài viết</span>
					<span class="info-box-number">{{$count_products}}</span>
				</div>
				<a style="margin-left: 10px;" href="{{url('backend/products/list')}}" title="">Xem tất cả...</a>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 homebox">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-folder"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Tổng số danh mục</span>
					<span class="info-box-number">{{$count_category}}</span>
				</div>
				<a style="margin-left: 10px;" href="{{url('backend/category/list')}}" title="">Xem tất cả...</a>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 homebox">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Tổng số thành viên</span>
					<span class="info-box-number">{{$count_user}}</span>
				</div>
				<a style="margin-left: 10px;" href="{{url('backend/user/list')}}" title="">Xem tất cả...</a>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 homebox">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-shopping-cart"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Tổng số đơn hàng</span>
					<span class="info-box-number">2,000</span>
				</div>
				<a style="margin-left: 10px;" href="{{url('backend/')}}" title="">Xem tất cả...</a>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>

	</div>
	<!-- /.row -->
	<div class="row">

		


		<div class="panel panel-default">
			<div class="panel-heading"><h4><i class="fa fa-exchange" style="margin-right: 10px;"></i>Danh sách đơn hàng</h4></div>
			<div class="panel-body">
				<div class="main-table">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>STT</th>
								<th>Mã đơn hàng</th>
								<th>Tên sản phẩm</th>
								<th>Giá sản phẩm</th>
								<th>Giảm giá (%)</th>
								<th>Thuế</th>
								<th>Tên khác hàng</th>
								<th>Số điện thoại</th>
								<th>Địa chỉ</th>
								<th>Thời gian đặt hàng</th>
								<th>Tình trạng đơn hàng</th>
								<th>Tổng tiền</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>4542136454</td>
								<td>IPhone 6 Plus</td>
								<td>16.000.000</td>
								<td>2</td>
								<td>10</td>
								<td>Nguyễn Văn Yên</td>
								<td>01679190035</td>
								<td>Mê Linh - Hà Nội</td>
								<td>1/1/2017</td>
								<td>Đã xử lý</td>
								<td>17.000.000</td>
							</tr>
							<tr>
								<td>1</td>
								<td>4542136454</td>
								<td>IPhone 6 Plus</td>
								<td>16.000.000</td>
								<td>2</td>
								<td>10</td>
								<td>Nguyễn Văn Yên</td>
								<td>01679190035</td>
								<td>Mê Linh - Hà Nội</td>
								<td>1/1/2017</td>
								<td>Đã xử lý</td>
								<td>17.000.000</td>
							</tr>
							<tr>
								<td>1</td>
								<td>4542136454</td>
								<td>IPhone 6 Plus</td>
								<td>16.000.000</td>
								<td>2</td>
								<td>10</td>
								<td>Nguyễn Văn Yên</td>
								<td>01679190035</td>
								<td>Mê Linh - Hà Nội</td>
								<td>1/1/2017</td>
								<td>Đã xử lý</td>
								<td>17.000.000</td>
							</tr>
							<tr>
								<td>1</td>
								<td>4542136454</td>
								<td>IPhone 6 Plus</td>
								<td>16.000.000</td>
								<td>2</td>
								<td>10</td>
								<td>Nguyễn Văn Yên</td>
								<td>01679190035</td>
								<td>Mê Linh - Hà Nội</td>
								<td>1/1/2017</td>
								<td>Đã xử lý</td>
								<td>17.000.000</td>
							</tr>
							<tr>
								<td>1</td>
								<td>4542136454</td>
								<td>IPhone 6 Plus</td>
								<td>16.000.000</td>
								<td>2</td>
								<td>10</td>
								<td>Nguyễn Văn Yên</td>
								<td>01679190035</td>
								<td>Mê Linh - Hà Nội</td>
								<td>1/1/2017</td>
								<td>Đã xử lý</td>
								<td>17.000.000</td>
							</tr>
							<tr>
								<td>1</td>
								<td>4542136454</td>
								<td>IPhone 6 Plus</td>
								<td>16.000.000</td>
								<td>2</td>
								<td>10</td>
								<td>Nguyễn Văn Yên</td>
								<td>01679190035</td>
								<td>Mê Linh - Hà Nội</td>
								<td>1/1/2017</td>
								<td>Đã xử lý</td>
								<td>17.000.000</td>
							</tr>
							<tr>
								<td>1</td>
								<td>4542136454</td>
								<td>IPhone 6 Plus</td>
								<td>16.000.000</td>
								<td>2</td>
								<td>10</td>
								<td>Nguyễn Văn Yên</td>
								<td>01679190035</td>
								<td>Mê Linh - Hà Nội</td>
								<td>1/1/2017</td>
								<td>Đã xử lý</td>
								<td>17.000.000</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.Left col -->

@endsection
