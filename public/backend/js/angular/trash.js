app.controller('categoryTrashController',function($rootScope,$scope,$http,API,flash){
	$scope.loadTrashCat = function(){
		$http.get(API + 'trash/categorys/get-trash-category').success(function(data){
			$scope.trashCat = data;
		})
	}

	$scope.loadTrashCat();

	$scope.modalCategorys = function(state,id){
		$scope.idrC = id;
		$scope.state = state;
		if(state == 'recovery'){
			$scope.title_trash = 'Khôi phục danh mục';
			$scope.text_trash = 'Bạn có muốn khôi phục không';
			$('#confirmRc').modal('show');
		}else{
			$scope.title_trash = 'Xóa vĩnh viễn danh mục';
			$scope.text_trash = 'Tất cả những gì trong danh mục sẽ bị xóa';
			$('#confirmRc').modal('show');
		}
	}

	$scope.recovery = function(state,id){
		if(state == 'recovery'){

			$http.get(API + 'trash/categorys/recovery-cat/' + id).success(function(data){
				$scope.loadTrashCat();
				$('#confirmRc').modal('hide');
				flash.success = 'Bạn đã khôi phục thành công';
				// Gọi đến AsideController với giá trị load-count-cat
				$rootScope.$broadcast('load-count-cat');
			})
		}else{

			$http.get(API + 'trash/categorys/delete-cat/' + id).success(function(data){
				$scope.loadTrashCat();
				flash.success = 'Bạn đã xóa thành công';
				$('#confirmRc').modal('hide');
				// Gọi đến AsideController với giá trị load-count-trash-cat
				$rootScope.$broadcast('load-count-trash-cat');
			})
		}
	}
})

// Xử lý phần mặt hàng

app.controller('mhTrashController', function($rootScope,$scope,$http,API,flash){
	$scope.loadTrashMh = function(){

		$http.get(API + 'trash/mathang/get-trash-mh').success(function(data){
			$scope.trashMh = data;
		})
	}

	$scope.loadTrashMh();

	$scope.modalMh = function(state,id){
		$scope.state = state;
		$scope.idrC = id;
		if(state == 'recovery'){
			$('#confirmRc').modal('show');
			$scope.title_trash = 'Khôi phục mặt hàng';
			$scope.text_trash = 'Bạn có muốn khôi phục mặt hàng này';
		}else{
			$('#confirmRc').modal('show');
			$scope.title_trash = 'Xóa vĩnh viên';
			$scope.text_trash = 'Bạn có muốn xóa mặt hàng này';
		}
		
	}


	$scope.recovery = function(state,id){
		if(state =='recovery'){
			
			$http.get(API + 'trash/mathang/recovery-mh/' + id).success(function(data){
				$('#confirmRc').modal('hide');
				$scope.loadTrashMh();
				flash.success = 'Bạn đã khôi phục thành công';
				// Gọi đến AsideController với giá trị load-count-mh
				$rootScope.$broadcast('load-count-mh');
			})

		}else{

			$http.get(API + 'trash/mathang/delete-mh/' + id).success(function(data){
				flash.success = 'Bạn đã xóa phục thành công';
				$('#confirmRc').modal('hide');
				$scope.loadTrashMh();
				// Gọi đến AsideController với giá trị load-count-trash-mh
				$rootScope.$broadcast('load-count-trash-mh');
			})
		}
	}

})

// Xử lý phần hãng sx
app.controller('trashHangsxController',function($rootScope,$scope,$http,API,flash){
	$scope.loadTrashSx = function(){

		$http.get(API + 'trash/hangsx/get-trash-sx').success(function(data){
			$scope.trashSx = data;
		})
	}

	$scope.loadTrashSx();

	$scope.modalSx = function(state, id){
		$scope.state = state;
		$scope.idrC = id;
		if(state == 'recovery'){
			$scope.title_trash = 'Khôi phục hãng sx';
			$scope.text_trash = 'Bạn có muốn khôi phục không';
			$('#confirmRc').modal('show');
		}else{
			$scope.title_trash = 'Xóa hãng sx';
			$scope.text_trash = 'Bạn có muốn xóa không';
			$('#confirmRc').modal('show');
		}
	}

	$scope.recovery = function(state, id){
		if(state == 'recovery'){
			$http.get(API + 'trash/hangsx/recovery-sx/' + id).success(function(data){
				$('#confirmRc').modal('hide');
				$scope.loadTrashSx();
				flash.success = 'Bạn đã khôi phục thành công';
				// Gọi đến AsideController với giá trị load-count-sx
				$rootScope.$broadcast('load-count-sx');
			})
		}else{
			$http.get(API + 'trash/hangsx/delete-mh/' + id).success(function(data){
				flash.success = 'Bạn đã xóa thành công';
				$('#confirmRc').modal('hide');
				$scope.loadTrashSx();
				// Gọi đến AsideController với giá trị load-count-trash-sx
				$rootScope.$broadcast('load-count-trash-sx');
			})
		}
	}


})