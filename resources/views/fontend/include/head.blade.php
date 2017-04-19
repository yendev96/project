<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> @yield('title')</title>
	<link rel="stylesheet" href="{{asset('/public/fontend/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/slick.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/slick-theme.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/nav.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/reponsive.css')}}">
	<link rel="stylesheet" href="{{asset('/public/fontend/css/loading-bar.min.css')}}">
	<script type="text/javascript" src="{{asset('/public/fontend/js/jQuery-2.2.0.min.js')}}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script type="text/javascript" src="{{url('/public/fontend/js/angular/app.js')}}"></script>

	<script type="text/javascript">
		
		$(document).ready(function(){
			$('.slider').slick({
				autoplay:true,
				fade: true,
				prevArrow: '<i class="fa fa-arrow-left pre-slider"></i>',
				nextArrow: '<i class="fa fa-arrow-right next-slider"></i>'
			});

			$('.btn-toggle-menu').click(function(){
				$('.main-menu').slideToggle(500);
				if($('.main-menu').css('display') == 'block'){
					$(this).attr('class','fa fa-times btn-toggle-menu');
				}else{
					$(this).attr('class','fa fa-align-justify btn-toggle-menu');
				}
			})


			var ww = document.body.clientWidth;
			if(ww < 768){
				$('.main-menu ul li > a:not(:only-child)').click(function(e) {
					$(this).siblings('.sub-menu').slideToggle();
					$('.sub-menu').not($(this).siblings()).slideUp();
					e.stopPropagation();
				})
				
			}
		});

	</script>
</head>