<div class="logo-search" ng-controller="boxheaderController">
			<div class="container">
				<div class="row">
					<!-- Phan logo -->
					<div class="col-md-3 logo">
						<a href="{{url('/')}}" title=""><img src="{{asset('public/fontend/img/logo.png')}}" alt=""></a>
					</div>


					<!-- Phan tim kiem -->
					<div class="col-md-6 timkiem">
						<div>
							<input class="form-timkiem form-control" type="text" name="timkiem" value="" ng-model="timkiemmd" placeholder="Nhập tên sản phẩm cần tìm..." ng-keyup="timkiem(timkiemmd)">
							<input class="btn btn-primary btn-timkiem" type="submit" name="" value="Tìm kiếm">
						</div>
						<div class="ketquatimkiem"  ng-hide="showketquatimkiem">
							<p>Tìm kiếm: <span ng-bind="timkiemmd"></span></p>
							<ul>
								<li ng-repeat="x in hihihi"><a href="{{url('product/detail')}}/{%x.id%}" ng-bind="x.name"></a></li>
							</ul>
						</div>

					</div>
					
					<!-- Phan gio hang -->
					<div class="col-md-2 col-md-offset-1 countgiohang">
							<a href="{{url('/cart')}}" title=""><i class="fa fa-shopping-cart icon-giohang" ng-click=""></i><span style="margin-left: 7px; font-size: 15px;">Giỏ hàng</span> (<span style="font-size: 19px" ng-bind="countbuy"></span>)</a>
					</div>

				</div>
			</div>
		</div>