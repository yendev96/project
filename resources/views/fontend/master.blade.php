
<!DOCTYPE html>
<html ng-app="myApp">
@include('fontend.include.head')
<body ng-controller="myController">
	<flash-message></flash-message>
	@if(session('success'))
	<div class="alert alert-success thongbao">
		{{session('success')}}
	</div>
	@elseif(session('danger'))
	<div class="alert alert-danger thongbao">
		{{session('danger')}}
	</div>
	@endif
	<header>
		<!-- phan tren cung trang web -->
		@include('fontend.include.topheader')

		@include('fontend.include.logo')


		@include('fontend.include.nav')

	</header>
	<section class="content-website">
		@yield('content');
		
	</section>



	<!-- Phan footer -->
	@include('fontend.include.footer')

	<!-- /Footer -->
	@include('fontend.include.script')
	@yield('script')
	<script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",62892]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>
</body>
</html>
