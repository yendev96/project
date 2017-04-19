@extends('fontend.master')
@section('title', 'Danh mục sản phẩm')
@section('content')

<!-- Phan san pham dien thoai -->
<section class="main-sanpham" ng-controller="dmController">
	<input type="hidden" name="" value="{{$idcat}}" id="idcathidden">
	<div class="container">
		<div class="row">
			<!-- <div class="col-md-2 aside-filter">
				<div class="title-filter text-center">
					<p>HÃNG SẢN XUẤT</p>
				</div>
				<div class="content-filter">
					<ul>
						<li ng-repeat="hsx in dshangsx">
							<input type="radio" value="{%hsx.id%}" name="hangsx" ng-model="filterdm.id_hangsx"><span ng-bind="hsx.name"></span>
						</li>
					</ul>
				</div>
				
				<div class="title-filter text-center">
					<p>RAM</p>
				</div>
				<div class="content-filter">
					<ul>

						<li ng-repeat="x in listram">
							<input type="radio" value="{%x.memmory%}" name="filterram" ng-model="filterdm.value_ram"><span ng-bind="x.name"></span>
						</li>
						
					</ul>
				</div>

				<div class="title-filter text-center">
					<p>Ổ CỨNG</p>
				</div>
				<div class="content-filter">
					<ul>

						<li ng-repeat="x in listocung">
							<input type="radio" value="{%x.hard_drive%}" name="filterocung" ng-model="filterdm.value_hard_drive"><span ng-bind="x.name"></span>
						</li>
						
					</ul>
				</div>
			</div> -->

			<div class="col-md-12 main-product">
				<div class="row title-danhmuc">
					<h5 class="pull-left" style="margin-right: 10px;"><i class="fa fa-laptop"></i>LAPTOP</h5>( Có tất cả <span class="count-total-product" ng-bind="totalproduct"></span> sản phẩm )

				</div>
				<div class="row filterCat">
					<div class="col-md-2">
						<input type="text" class="form-control filterpricefrom" ng-model="filterpirce.from"  placeholder="Giá từ:">
						<input type="text" class="form-control filterpriceto" ng-model="filterpirce.to" placeholder="Đến:" ng-keyup="clickfilterprice(filterpirce.from, filterpirce.to)">
					</div>
					<div class="col-md-2 col-xs-7 box-filter">
						<select class="form-control" name="searchbyhangram" ng-model="filterdm.id_hangsx">
							<option value="">Nhà sản xuất</option>}
							<option ng-repeat="y in dshangsx" value="{%y.id%}" ng-bind="y.name"></option>
						</select>
					</div>
					<div class="col-md-2 col-xs-7 box-filter">
						<select class="form-control" name="searchbyhangram" ng-model="filterdm.value_ram">
							<option value="">RAM</option>}
							<option ng-repeat="y in listram" value="{%y.memmory%}" ng-bind="y.name"></option>
						</select>
					</div>
					<div class="col-md-2 col-xs-7 box-filter">
						<select class="form-control" name="searchbyhangram" ng-model="filterdm.value_hard_drive">
							<option value="">Ổ cứng</option>}
							<option ng-repeat="y in listocung" value="{%y.hard_drive%}" ng-bind="y.name"></option>
						</select>
					</div>
					<div class="col-md-2 col-xs-7 box-filter">
						<select class="form-control" name="searchbyhangram" ng-model="filterdm.value_cpu">
							<option value="">CPU</option>}
							<option ng-repeat="y in listcpu" value="{%y.value%}" ng-bind="y.name"></option>
						</select>
					</div>
					<div class="col-md-1 pull-right">
						<select name="" class="form-control" ng-model="filterPrice">
							<option value="">Sắp sếp</option>
							<option value="-created_at">Sản phẩm mới nhất</option>
							<option value="+price">Giá từ thấp đến cao</option>
							<option value="-price">Giá từ cao đến thấp</option>
						</select>
					</div>
				</div>

				<!-- danh sach san pham -->
				<div class="row content-sanpham">
					<div class="col-md-3 col-sm-6 col-sanpham" ng-repeat="data in dmlaptop | orderBy:filterPrice | filter:filterdm">
						<div class="box-discount" ng-if="data.discount > 0">
							<img src="{{asset('public/fontend/img/discount.png')}}" class="img-discount" alt="">
							<span class="text-discount">- {%data.discount%}%</span>
						</div>
						<div infinite-scroll="loadMore()" infinite-scroll-distance="1">
							<a href="{{url('product/detail')}}/{%data.id%}" title="">
								<div class="view-hover">
									<p class="name-hover-product" ng-bind="data.name"></p>
									<p style="margin-top: -15px; border-bottom: 1px solid #CFCFCF; padding-bottom: 15px">
										<span class="new-price-hover" ng-bind="data.price - (data.price * data.discount /100 ) | number"></span>
										<span ng-if="data.discount > 0" class="old-price-hover" ng-bind="data.price | number"></span></p>
										<p>Hãng: <span ng-bind="data.name_hangsx">faksdfjaskf</span></p>
										<p>CPU: <span ng-bind="data.cpu">faksdfjaskf</span></p>
										<p>RAM: <span ng-bind="data.ram">faksdfjaskf</span></p>
										<p>Ổ cứng: <span ng-bind="data.hard_drive">faksdfjaskf</span></p>
									</div>
									<!-- mot box san pham -->
									<div class="box-sanpham">
										<div class="img-sanpham">
											<img src="{{asset('/public/upload/img/img_products')}}/{%data.img%}" alt="">
										</div>
										<div class="name-sanpham">
											<h5 ng-bind="data.name"></h5>
										</div>
										<div class="price-sanpham">
											<span class="new-price" ng-bind="data.price - (data.price * data.discount / 100) | number"></span>
											<span ng-if="data.discount > 0">
												<span class="old-price" ng-bind="data.price | currency:'đ'"></span>
											</span>
										</div>
										<div class="option-sanpham">
											<a href="javascript:void(0)" class="btn btn-primary" ng-click="muahang(data.id, 1)"><i class="fa fa-cart-plus"></i> Thêm vào giỏ</a>
										</div>

									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /danh sach san pham -->
			</div>

		</div>
	</div>
	<!-- Phan tieu de san pham dien thoai -->

</div>


</section>

@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){

		$('.slider').slick({
			autoplay:true,
			fade: true,
			prevArrow:'<i class="fa fa-arrow-circle-o-left pre-slider"></i>',
			nextArrow:'<i class="fa fa-arrow-circle-o-right next-slider"></i>',
		});

		$('.toggle-menu').click(function(){
			$('.main-menu').slideToggle(500);
		})

		$('.main-menu ul li').click(function(e){
				//e.preventDefault();
				$(this).find('ul.sub-menu').slideToggle(300);
			})
	});
</script>
@endsection