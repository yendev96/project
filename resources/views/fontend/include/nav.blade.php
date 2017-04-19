<div class="top-menu">
	<div class="container">
		<div class="toggle-menu">
			<i class="fa fa-align-justify btn-toggle-menu"></i>
		</div>
		<div class="row main-menu">
			<ul>
				<?php 
					$menu_level_1 = DB::table('category')->where('show_nav', 1)->orderBy('cat_order','ASC')->get();
				 ?>
				@foreach($menu_level_1 as $item_level_1)
				<li><a href="{{url('').'/'.'category'.'/'.'product_by_cat/'. $item_level_1->id}}">{{$item_level_1->name}}</a>
					<ul class="sub-menu">
					<?php 
						$menu_level_2 = DB::table('hang_sx')->where('id_category', $item_level_1->id)->get();
					 ?>
					@foreach($menu_level_2 as $item_level_2)
						<li><a href="{{asset('').'hangsx'.'?id='.$item_level_2->id}}" title="">{{$item_level_2->name}}</a></li>
					@endforeach
					</ul>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>