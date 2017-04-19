

app.controller('ramController', function($rootScope,$scope, $http, flash,API){
	$scope.loadRam = function(){
		$http.get(API + 'products/ram/list').success(function(data){
			$scope.data = data;
		});
	}

	// Chạy hàm hiển thị sản phẩm
	$scope.loadRam();
	// Hiển thị modal thêm hoặc sửa sản phẩm
	$scope.modalRam = function(state, id){
		// Lấy id của sản phẩm
		$scope.id = id;

		$scope.state = state;
		// Nếu state là addRam
		if(state == 'addRam'){
			$scope.action = API + 'products/ram/add'
			$scope.title = "Thêm mới sản phẩm";
			$scope.button = 'Thêm mới';
		}
		else{
			$scope.action = API + 'products/ram/edit/' + id;
			$scope.title = 'Sửa thông tin sản phẩm';
			$scope.button = 'Chỉnh sửa';
		}

		// Lấy dữ liệu của sản phẩm theo id để hiện lên form chỉnh sửa
		$http.get(API + 'products/ram/edit/' + id).success(function(data){
			$scope.pro = data;
		});

		// Lấy danh sách sách danh mục để show len form thêm ram
		$http.get(API + 'categorys/list').success(function(data){
			$scope.cats = data;
		});
		// Lấy danh sách sách mặng hàng để show len form thêm ram
		$http.get(API + 'mathang/list').success(function(data){
			$scope.mathang = data;
		});
		// Lấy danh sách sách hãng sản xuất để show len form thêm ram
		$http.get(API + 'hangsx/list').success(function(data){
			$scope.hangsx = data;
		});

		// Lấy các hình ảnh kèm theo ảnh bảng image_product
		$http.get(API + 'products/ram/getimage/' + id).success(function(data){
			$scope.image = data;
		});

		// thực hiện hđ khi change select option thì lấy các mặt hàng có id là id của danh mục
		$scope.changeCategory = function(id){
			$http.get(API + 'mathang/getMatHangInCat/' + id).success(function(data){
				$scope.mathang = data;
			});

		}

		$scope.changeMathang = function(id){
			$http.get(API + 'hangsx/getHangsxInMh/' + id).success(function(data){
				$scope.hangsx = data;
			});

		}

		// Hiển thị model để thêm hoặc chỉnh sửa Ram
		$('#modalRam').modal('show');
	}

	// Thêm mới Ram

	$scope.save = function(state,id){
		if(state == 'addRam'){
			var data = $scope.pro;
			var uploadUrl = API + "products/ram/add";
			var fd = new FormData();
			for(var key in data){
				fd.append(key, data[key]);
			}
			$http.post(uploadUrl, fd, {
				transformRequest: angular.identity,
				headers: {'Content-Type': undefined,'Process-Data': false}
			})
			.success(function(){
				$('#modalRam').modal('hide');
				$scope.loadRam();
				flash.success = 'Bạn đã xóa mới thành công';
				// Gọi đến AsideController với giá trị call
				$rootScope.$broadcast('load-count-ram');
			})
			.error(function(){
				alert('Sửa thất bại');
			});
		}else{
			var data = $scope.pro;
			var uploadUrl = API + "products/ram/edit/" + id;
			var fd = new FormData();
			for(var key in data){
				fd.append(key, data[key]);
			}
			$http.post(uploadUrl, fd, {
				transformRequest: angular.identity,
				headers: {'Content-Type': undefined,'Process-Data': false}
			})
			.success(function(){
				$('#modalRam').modal('hide');
				flash.success = 'Bạn đã sửa mới thành công';
				$scope.loadRam();
			})
			.error(function(){
				alert('Sửa thất bại');
			});
		}
	}

	// Hiển thị modal xác nhận xóa sản phẩm
	$scope.modalDelete = function(id){
		$scope.idDelete = id;
		$('#confirmDelete').modal('show');
	}
// Xóa sản phẩm
$scope.delete = function(id){
	var id = id;
	$http.get(API + 'products/ram/delete/' + id).success(function(response) {
			// Gủi flash thông báo xóa thành công
			flash.success = 'Bạn đã xóa mới thành công';
			// Ẩn modal xác nhận xóa
			$('#confirmDelete').modal('hide');
			// Gọi hàm loadRam để cập nhật sản phẩm sau khi xóa
			$scope.loadRam();
		}).error(function(response) {
			alert('Xóa thành viên thất bại');
		});

	}

})



