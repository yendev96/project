@extends('fontend.master')
@section('title', 'Chi tiết sản phẩm')
@section('content')
<div ng-controller="chitietController">
	<input type="hidden" value="{{$id}}" id="idproduct"">
	
	<section class="main-chitiet">
		<div class="container">
			<div class="row">
				<!-- anh chi tiet san pam -->
				<div class="col-md-4 col-sm-4 col-xs-12 left-main-chitiet">
					<p ng-click="modalRating(product.id)">Có <span ng-bind="countrate"></span> đánh giá</p>
					<div class="slider slider-for text-center">

						<div class="item-big-chitiet"><img src="{{asset('/public/upload/img/img_products')}}/{%product.img%}" alt=""></div>
						@foreach($list_img as $itemimg)
						<div class="item-big-chitiet"><img src="{{asset('/public/upload/img/img_products/hihi/')}}/{{$itemimg->name}}" alt=""></div>
						@endforeach
					</div>

					<div class="slider slider-nav">
						<div class="item-slider-chitiet text-center"><img src="{{asset('/public/upload/img/img_products/')}}/{%product.img%}" alt="" width="60px"></div>
						@foreach($list_img as $itemimg)
						<div class="item-slider-chitiet text-center"><img src="{{asset('/public/upload/img/img_products/hihi/')}}/{{$itemimg->name}}" alt="" width="60px"></div>
						@endforeach
						
					</div>
				</div>
				<!-- end anh chi tiet san pham -->


				<!-- Thong tin san pham -->
				<div class="col-md-8 col-sm-8 col-xs-12 right-main-chitiet">
					<div class="box-chitiet-1">
						<div class="ten-chitiet-sp">
							<h3 ng-bind="product.name"></h3>
						</div>

						<div class="price-chitiet-sp">
							<span class="price-moi-sp" ng-bind="product.price - (product.price * product.discount / 100)"></span>
							<span ng-if="product.discount > 0">
								<span class="price-cu-sp" ng-bind="product.price"></span>
							</span>
							
						</div>
					</div>

					<div class="box-chitiet-2">
						<ul class="khuyen-mai">
							<li>
								<p><i class="fa fa-gift"></i>Cơ hội trúng 3 xe khi mua iPhone tại khu vực Hà Nội</p>
							</li>
							<li>
								<p><i class="fa fa-gift"></i>Cơ hội trúng 3 xe khi mua iPhone tại khu vực Hà Nội</p>
							</li>
							<li>
								<p><i class="fa fa-gift"></i>Cơ hội trúng 3 xe khi mua iPhone tại khu vực Hà Nội</p>
							</li>
							<li>
								<p><i class="fa fa-gift"></i>Cơ hội trúng 3 xe khi mua iPhone tại khu vực Hà Nội</p>
							</li>
						</ul>
					</div>

					<div class="box-chitiet-3">
						<ul class="khuyen-mai">
							<li>
								<p><i class="fa fa-check"></i>Bộ sản phẩm gồm: Hộp, Sạc, Tai nghe, Sách hướng dẫn, Cáp, Cây lấy sim </p>
							</li>
							<li>
								<p><i class="fa fa-check"></i>Bảo hành chính hãng: thân máy 12 tháng, pin 12 tháng, sạc 12 tháng - Xem điểm bảo hành</p>
							</li>
							<li>
								<p><i class="fa fa-check"></i>Giao hàng tận nơi miễn phí trong 30 phút. Tìm hiểu</p>
							</li>
							<li>
								<p><i class="fa fa-check"></i>1 đổi 1 trong 1 tháng với sản phẩm lỗi. Tìm hiểu</p>
							</li>
							<li>
								<p><i class="fa fa-check"></i>Tư vấn miễn phí 24/7 18006601 (cả dịp Lễ, Tết)</p>
							</li>
						</ul>
					</div>
					<div class="chonmau-buysp">
						<div class="row">
							<div class="col-md-3 col-sm-12 col-xs-12 chonmau">
								<select name="chonmau" class="form-control" ng-model="countbuydetail">
									<option value="">Chọn số lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</div>

							<div class="col-md-8 col-sm-12 col-xs-12 buysp">
								<button type="button" class="btn btn-primary btn-muangay">Mua ngay</button>
								<button type="button" class="btn btn-danger btn-themvao-giohang" ng-click="addcountdetail(countbuydetail, product.id)">Thêm vào giỏ hàng</button>
							</div>
						</div>

					</div>
					<p><i class="fa fa-phone" style="color:#13938e;"></i>Gọi đặt mua 1800.1060 hoặc (08) 38 102.102 (7h30 - 22h)</p>
				</div>
				<!-- End thong tin chi tiet san pham -->
			</div>
		</div>
	</section>

	<!-- Phan thong so ky thuat -->
	<section class="tab-thongtinsanpham">
		<div class="container">
			<div class="row">
				<ul class="nav nav-tabs" style="margin-bottom: 10px;">
					<li class="active"><a data-toggle="tab" href="#home">Thông số kỹ thuật</a></li>
					<li><a data-toggle="tab" href="#menu1">Thông tin sản phẩm</a></li>
					<li style="position: relative;"><a data-toggle="tab" href="#menu2">Bình luận đánh giá <span class="total-count-comment" ng-bind="totalcmt"></span></a></li>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">

						<table class="table table-bordered">

							<tr>
								<td>Tên sản phẩm</td>
								<td ng-bind="product.name"></td>
							</tr>

							<tr>
								<td>CPU</td>
								<td ng-bind="product.cpu"></td>
							</tr>
							
							<tr>
								<td>Hệ điều hành</td>
								<td ng-bind="product.os"></td>
							</tr>

							
							<tr>
								<td>RAM</td>
								<td  ng-bind="product.ram"></td>
							</tr>
							<tr>
								<td>Ổ cứng</td>
								<td ng-bind="product.hard_drive"></td>
							</tr>
						</table>
						<div class="row">
							<p class="xemdayduthongtin" ng-click="showModal()"><i class="fa fa-eye"></i>Bấm vào đây để xem đầy đủ thông tin</p>
						</div>



					</div>



					<div id="menu1" class="tab-pane fade text-center thongtin-sanpham">
						
					</div>


					<div id="menu2" class="tab-pane fade">
						<div class="row">
							<div class="title-rating">
								<p>Gửi đánh giá của bạn:</p>
							</div>
							<fieldset class="rating">
								<input type="radio" id="star5" name="rating" value="5" ng-model="namsao" ng-click="rating(namsao)"/><label  class = "full" for="star5" title="Tuyệt vời"></label>
								<input type="radio" id="star4" name="rating" value="4" ng-model="bonsao" ng-click="rating(bonsao)" /><label class = "full" for="star4" title="Tốt"></label>
								<input type="radio" id="star3" name="rating" value="3" ng-model="basao" ng-click="rating(basao)" /><label class = "full" for="star3" title="Bình thường"></label>
								<input type="radio" id="star2" name="rating" value="2" ng-model="haisao" ng-click="rating(haisao)" /><label class = "full" for="star2" title="Tạm được"></label>
								<input type="radio" id="star1" name="rating" value="1" ng-model="motsao" ng-click="rating(motsao)" /><label class = "full" for="star1" title="Không tốt"></label>
							</fieldset>
							<div class="text-rating" ng-if="countrate > 0">
								<a href="javascript:void(0)" title="Xem đánh giá" ng-click="modalRating(product.id)"><i class="fa fa-eye"></i> Xem thống kê đánh giá</a>
							</div>
						</div>
						<div class="row form-comment">
							<div class="col-md-1 avatar-cmt">
								<img src="{{asset('/public/avatar.png')}}" alt="">
							</div>
							<div class="col-md-11">
								<textarea name="" class="form-control" placeholder="Nhập bình luận" ng-model="textcmt"></textarea>
							</div>
							<input type="button" class="btn btn-primary pull-right btn-cmt" name="" ng-click="actionCmt(product.id)" value="Bình luận">
						</div>
						
						<div class="row">
							<p>Sắp xếp bình luận: <span style="margin:0 10px; cursor: pointer" ng-click="orderNewCmt(product.id)">Mới nhất</span> | <span style="margin-left: 10px; cursor: pointer" ng-click="orderLikeCmt(product.id)">Thích nhất</span></p>
						</div>

						<div class="row txt-comment" ng-repeat="x in listcmt">
							<div class="col-md-1 avatar-cmt">
								<img src="{{asset('/public/avatar.png')}}" alt="">
							</div>
							
							<div class="col-md-11 main-cmt">

								<span ng-if="x.level_user != 3">
									<span style="color:red" ng-bind="x.fullname" class="username-cmt"></span>
								</span>

								<span ng-if="x.level_user == 3">
									<span ng-bind="x.fullname" class="username-cmt"></span>
								</span>

								<span ng-bind="x.content_cmt"></span>

								<div class="option-cmt">
									<a href="javascript:void(0)" title="" class="traloi-cmt" ng-click="repcmt(x,x.id)">Trả lời</a>
									<a href="javascript:void(0)" title="" class="thich-cmt" ng-show="likecmt" ng-click="likecmt(x.id)">Like&nbsp;<span ng-bind="x.like"></span></a>
									<a href="javascript:void(0)" title="" class="thich-cmt" ng-show="bolikecmt" ng-click="likecmt(x.id)">Bỏ like&nbsp;<span ng-bind="x.like"></span></a>
									
								</div>

								<div class="count-rep" ng-if="x.count_rep > 0">
									<i class="fa fa-share"></i><span ng-click="viewrepcmt(x, x.id)">Xem <span ng-bind="x.count_rep"></span> trả lời</span>
								</div>

								<!-- Box trả lời cmt -->
								<div class="box-rep-cmt" ng-show="x.hideboxrepcmt">
									<textarea type="text" class="form-control form-repcmt" placeholder="Nhập bình luận" ng-model="textrepcmt"></textarea>
									<input type="button" class="btn btn-primary pull-right btn-cmt" ng-click="actionRepCmt(product.id, idcmt, textrepcmt)" value="Bình luận">
								</div>

								<div class="dropdown eidt-delete-cmt" ng-if="idusercmt == x.id_user">
									<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="box-shadow: none">
										<span class="caret"></span></button>
										<ul class="dropdown-menu drop-action-cmt">
											<li><a href="javascript:void(0)" ng-click="modalSua(x.content_cmt,x.id)">Chỉnh sửa</a></li>
											<li><a href="javascript:void(0)" ng-click="modalDelCmt(x.id)">Xóa</a></li>
										</ul>
									</div>

									<ul class="rep-cmt" ng-show="x.showboxrepcmt">
										<li ng-repeat="subcmt in listsubcmt">
											<div class="row">
												<div class="col-md-1">
													<img src="{{asset('/public/avatar.png')}}" alt=""></p>
												</div>

												<div class="col-md-11">
													<div class="dropdown eidt-delete-cmt" ng-if="idusercmt == subcmt.id_user">
														<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="box-shadow: none">
															<span class="caret"></span></button>
															<ul class="dropdown-menu drop-action-cmt">
																<li><a href="javascript:void(0)" ng-click="modalSua(subcmt.content_cmt,subcmt.id)">Chỉnh sửa</a></li>
																<li><a href="javascript:void(0)" ng-click="modalDelCmt(subcmt.id)">Xóa</a></li>
															</ul>
														</div>
														<span ng-if="subcmt.level_user != 3">
															<span style="color:red" ng-bind="subcmt.fullname" class="username-cmt"></span>
														</span>

														<span ng-if="subcmt.level_user == 3">
															<span ng-bind="subcmt.fullname" class="username-cmt"></span>
														</span>

														<span ng-bind="subcmt.content_cmt"></span>

														<div ng-if="idusercmt == subcmt.id_user">
															<a href="javascript:void(0)" title="" class="sua-cmt" ng-click="modalSua(subcmt.content_cmt,subcmt.id)">Chỉnh sửa</a>
														</div>

													</div>
												</div>
											</li>
										</ul>


										<!-- /Box trả lời cmt -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End thong so ky thuat -->


			<div class="modal fade" id="modalChitiet" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Thông báo</h4>
						</div>
						<div class="modal-body">
							<p ng-bind="textModel"></p>
						</div>
						<div class="modal-footer">

							<button type="button" class="btn btn-success" ng-show="showbutton" ng-click="actionDelCmt(iddelcmt)">Xóa</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>

			<div class="modal fade" id="modalEditCmt" role="dialog">
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
							<button type="button" class="btn btn-success" ng-click="actionEditCmt(idcmtedit)">Chỉnh sửa</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>

			<div class="modal fade" id="modalRating" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Đánh giá sản phẩm</h4>
						</div>
						<div class="modal-body">
							<ul class="view-rating">
								<li>(<span ng-bind="total_rate.mot_sao"></span>) <img src="{{asset('public/fontend/img/rate/1.png')}}" class="motsao" alt=""></li>
								<li>(<span ng-bind="total_rate.hai_sao"></span>) <img src="{{asset('public/fontend/img/rate/2.png')}}" class="haisao" alt=""></li>
								<li>(<span ng-bind="total_rate.ba_sao"></span>) <img src="{{asset('public/fontend/img/rate/3.png')}}" class="basao" alt=""></li>
								<li>(<span ng-bind="total_rate.bon_sao"></span>) <img src="{{asset('public/fontend/img/rate/4.jpg')}}" class="bonsao" alt=""></li>
								<li>(<span ng-bind="total_rate.nam_sao"></span>) <img src="{{asset('public/fontend/img/rate/5.png')}}" class="namsao" alt=""></li>
							</ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

		</div>		
		<!-- Phan footer -->
		@endsection
		@section('script')
		<script type="text/javascript">
			$(".gh").click(function(){
				alert('hi');

			})

			$('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				centerMode: true,
				focusOnSelect: true,
				prevArrow:'<i class="fa fa-chevron-left pre-slider-sp"></i>',
				nextArrow:'<i class="fa fa-chevron-right next-slider-sp"></i>',
			});

			


		</script>
		@endsection