app.controller('categoryController', function($rootScope,$scope,$http,flash,API,$timeout){

	// Lấy danh sách danh mục
	$scope.loadCategory = function(){
		$http.get(API + 'categorys/list').success(function(data){
			$scope.data = data;
		});
	}
	$scope.loadCategory();

	// Khi bấm vào modalCategorys thêm mới và sửa
	$scope.modalCategorys = function(state, id){
		// Gán tham số id ở bên button sửa bằng id của danh mục cần sửa 
		$scope.id = id;
		$scope.state = state;
		// 
		if(state == 'addCategory'){
			$scope.title = 'Thêm mới dannh mục';
			$scope.textSave = 'Thêm mới'
		}else{
			$scope.title = 'Chỉnh sửa danh mục';
			$scope.textSave = 'Chỉnh sửa';
		}

		$http.get(API + 'categorys/edit/' + id).success(function(data){
			$scope.cat = data;
		});

		$('#modalCategorys').modal('show');
	}

	// Thêm mới danh mục
	$scope.save = function(state, id){
		if(state == 'addCategory'){
			$http({
				method: 'POST',
				url: API + 'categorys/add',
				data: $.param($scope.cat),
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
				url: API + 'categorys/edit/' + id,
				data: $.param($scope.cat),
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
		$http.get(API + 'categorys/delete/' + id).success(function(response) {
			$scope.loadCategory();
			flash.success = 'Bạn đã xóa thành công';
			$('#confirmDelete').modal('hide');
		}).error(function(response) {
			alert('Xóa thất bại');
		});
	}

	// Tìm kiếm khi keyup form search
	$scope.searchCat = function(){
		var txt = $scope.search;
		var leng = txt.length;
		// Nếu giá trị nhập vào lớn hơn 0 kí tự
		if(leng > 0){
			// Get data với từ khóa nhập vào
			$http.get(API + 'categorys/search/' + txt).success(function(data){
				$scope.data = data;
			});

			// Lấy số kết quả tìm dk khi tìm kiếm
			$http.get(API + 'categorys/count_search/' + txt).success(function(data){
				$scope.countsearch = data;
			});
			// Hiện thông vào số kết quả tìm dk
			$('.count-search').show();


		}else{ //Nếu giá trị nhập vào nhỏ hơn 0 kí tự
			// Thì lấy danh sách mặc định tất cả danh mục
			$http.get(API + 'categorys/list').success(function(data){
				$scope.data = data;
			});
			// Và ẩn thông báo số kết quả tìm dk
			$('.count-search').hide();

			
		}
		

	}

	


})