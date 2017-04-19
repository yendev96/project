app.controller('hangsxController', function($rootScope,$scope,$timeout,$http,flash,API){
	
	$scope.loadCategory = function(){
		$http.get(API + 'hangsx/list').success(function(data){
			$scope.data = data;
		});
	}

	$scope.loadCategory();
	// $scope.hideCat = "true";
	
	// $timeout(function () 
	// {
	// 	$scope.$apply(function()
	// 	{
	// 		$scope.loadCategory();
	// 		$scope.hideCat = false;
	// 	});
	// }, 1600);
	// Chạy hàm hiển thị thành viên
	

	$scope.modalCategorys = function(state, id){
		$scope.state = state;
		$scope.id = id;
		if(state == 'addCategory'){
			$scope.title = 'Thêm mới hãng sản xuất';
			$scope.textSave = 'Thêm mới'
		}else{
			$scope.title = 'Chỉnh sửa hãng sản xuất';
			$scope.textSave = 'Chỉnh sửa';
		}

		$http.get(API + 'categorys/list').success(function(data){
			$scope.cats = data;
		});

		$http.get(API + 'mathang/list').success(function(data){
			$scope.mathang = data;
		});
		
		$http.get(API + 'hangsx/edit/' + id).success(function(data){
			$scope.hangsx = data;
		});

		$('#modalCategorys').modal('show');
	}

	// Lấy danh sách danh mục để hiện thị vào form thêm mặt hàng
	
	// Thêm mới danh mục
	$scope.save = function(state, id){
		if(state == 'addCategory'){
			$http({
				method: 'POST',
				url: API + 'hangsx/add',
				data: $.param($scope.hangsx),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				$('#modalCategorys').modal('hide');
				$scope.loadCategory();
				flash.success = 'Bạn đã thêm mới thành công';
			}).error(function(response) {
				alert('Thêm mới thất bại');
			});
		}

		// Sửa danh mục
		if(state == 'editCategory'){
			$http({
				method: 'POST',
				url: API + 'hangsx/edit/' + id,
				data: $.param($scope.hangsx),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				$('#modalCategorys').modal('hide');
				$scope.loadCategory();
				flash.success = 'Bạn đã sửa thành công';
			}).error(function(response) {
				alert('Thêm mới thất bại');
			});
		}
	}

	// Hiển thị modal xác nhận trước khi xóa
	$scope.showModalDelete = function(id){
		$scope.idDelete = id;
		$('#confirmDelete').modal('show');
	}

	// Xóa danh mục
	$scope.delete = function(id){
		var id = id;
		$http.get(API + 'hangsx/delete/' + id).success(function(response) {
			$scope.loadCategory();
			$('#confirmDelete').modal('hide');
			flash.success = 'Bạn đã xóa thành công';
		}).error(function(response) {
			alert('Xóa thất bại');
		});
	}

	$scope.changeCategory = function(id){
		$http.get(API + 'mathang/getMatHangInCat/' + id).success(function(response) {
			$scope.mathang = response;
		})
	}

	$scope.searchHangsx = function(){
		var txt = $scope.search;
		var leng = txt.length;
		if(leng == 0){
			$http.get(API + 'hangsx/list').success(function(data){
				$scope.data = data;
			});

			$('.count-search').hide();
		}else{
			$http.get(API + 'hangsx/search/' + txt).success(function(data){
				$scope.data = data;
			});

			$('.count-search').show();
		}

		$http.get(API + 'hangsx/count_search/' + txt).success(function(data){
			$scope.countsearch = data;
		});
	}


})