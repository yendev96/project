@extends('fontend.master')
@section('title', ' Trang chủ')
@section('content')
<div ng-controller="homeController">
	
	<div class="box-slider">
		<div class="container">
			<div class="row">
				<div class="slider">
					<div><img style="width: 100%" src="{{asset('/public/fontend/img/slider/slider1.jpg')}}" alt=""></div>
					<div><img style="width: 100%" src="{{asset('/public/fontend/img/slider/slider2.jpg')}}" alt=""></div>
					<div><img style="width: 100%" src="{{asset('/public/fontend/img/slider/slider3.jpg')}}" alt=""></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Phan san pham ban chay - san pham moi ve -->
	<div class="sanpham-banchay">
		<div class="container">
			<div class="row">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">SẢN PHẨM BÁN CHẠY</a></li>
					<li><a data-toggle="tab" href="#moive">SẢN PHẨM MỚI VỀ</a></li>
					<li><a data-toggle="tab" href="#xemnhieu">SẢN PHẨM XEM NHIÊU</a></li>
				</ul>

				<div class="tab-content my-tab-content">
					<div id="home" class="tab-pane fade in active">
						<div class="slider-banchay">
							<div class="col-md-3" ng-repeat="laptop in banchay">
								<a href="{{url('product/detail')}}/{%laptop.id%}">
									<div class="box-sp text-center">
										<div class="img-sanpham">
											<img src="{{asset('public/upload/img/img_products')}}/{%laptop.img%}" alt="">
										</div>
										<div class="name-sanpham">
											<h5 ng-bind="laptop.name"></h5>
										</div>
										<div class="price-sanpham">
											<span class="new-price" ng-bind="laptop.price - (laptop.price * laptop.discount / 100) | number"></span>
											<span ng-if="laptop.discount > 0">
												<span class="old-price" ng-bind="laptop.price | currency:'đ'"></span>
											</span>
										</div>
										<div class="option-sanpham">
											<a href="javascript:void(0)" class="btn btn-primary" ng-click="muahang(laptop.id, 1)"><i class="fa fa-cart-plus"></i> Thêm vào giỏ</a>
										</div>
									</div>
								</a>
							</div>
							
						</div>
					</div>
					<div id="moive" class="tab-pane fade in">
						<div class="slider-banchay">

							<div class="col-md-3" ng-repeat="x in moive">
								<div class="box-sp text-center">
									<div class="img-sanpham">
										<img src="{{asset('public/upload/img/img_products')}}/{%x.img%}" alt="">
									</div>
									<div class="name-sanpham">
										<h5 ng-bind="x.name"></h5>
									</div>
									<div class="price-sanpham">
										<span class="new-price" ng-bind="x.price - (x.price * x.discount / 100) | number">4.550.000 đ</span>
										<div ng-if="x.discount > 0">
											<span class="old-price" ng-bind="x.price | number"></span>
										</div>
									</div>
									<div class="option-sanpham">
										<input type="submit" class="btn btn-primary" value="Mua ngay">
										<input type="submit" class="btn btn-danger" value="Chi tiết">
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div id="xemnhieu" class="tab-pane fade in">
						<div class="slider-banchay">

							<div class="col-md-3" ng-repeat="x in muanhieu">
								<div class="box-sp text-center">
									<div class="img-sanpham">
										<img src="{{asset('public/upload/img/img_products')}}/{%x.img%}" alt="">
									</div>
									<div class="name-sanpham">
										<h5 ng-bind="x.name"></h5>
									</div>
									<div class="price-sanpham">
										<span class="new-price" ng-bind="x.price - (x.price * x.discount / 100) | number">4.550.000 đ</span>
										<div ng-if="x.discount > 0">
											<span class="old-price" ng-bind="x.price | number"></span>
										</div>
									</div>
									<div class="option-sanpham">
										<input type="submit" class="btn btn-primary" value="Mua ngay">
										<input type="submit" class="btn btn-danger" value="Chi tiết">
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- // Slider ban chay- moi ve -->


	<!-- Phan san pham dien thoai -->
	<section class="main-sanpham">
		<div class="container">
			<!-- Phan tieu de san pham dien thoai -->
			<div class="row title-danhmuc">
				<h4 class="pull-left"><i class="fa fa-laptop icon-title"></i>RAM</h4>
				<a class="pull-right" href="#" title="">Xem tất cả...</a>
			</div>

			<!-- danh sach san pham -->
			<div class="row content-sanpham">
				<!-- mot box san pham -->
				<div class="col-md-3" ng-repeat="ram in rams">
					<div class="box-sp text-center">
						<div class="img-sanpham">
							<img src="{{asset('public/upload/img/img_products')}}/{%ram.img%}" alt="">
						</div>
						<div class="name-sanpham">
							<h5>{%ram.name%}</h5>
						</div>
						<div class="price-sanpham">
							<span class="new-price" ng-bind="ram.price - (ram.price * ram.discount / 100) | number "></span>đ
							<div ng-if="ram.discount > 0">
								<span class="old-price" ng-bind="ram.price - (ram.price * ram.discount / 100) | number"></span>đ
							</div>
						</div>
						<div class="option-sanpham">
							<a href="javascript:void(0)" class="btn btn-primary" ng-click="addram(ram.id, 1)"><i class="fa fa-cart-plus"></i> Thêm vào giỏ</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /danh sach san pham -->
		</div>
	</section>

	<!--May tinh bang -->

	
</div>
<!-- /Phu kien -->
@endsection

