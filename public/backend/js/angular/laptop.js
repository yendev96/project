// Contrller của PC
app.controller('laptopController', function($rootScope, $scope,$http,flash, API){

	
	$scope.loadLaptop = function(){
		$http.get(API + 'products/laptop/list').success(function(data){
			$scope.listlaptop = data;
		});
	}

	// Chạy hàm hiển thị sản phẩm
	$scope.loadLaptop();

	$scope.modalDeletes = function(){
		$("#confirmDeletes").modal('show');
	}

	$scope.deletes = function(){
		$scope.list_id = [];
		angular.forEach($scope.listlaptop, function(x){
			if (x.selected) $scope.list_id.push(x.id);

		});

		angular.forEach($scope.list_id, function(value){
			$http.post(API + 'products/laptop/delete/' + value).success(function(response) {
				$('#confirmDeletes').modal('hide');
				$scope.loadLaptop();
				flash.success = 'Bạn đã xóa thành công';
			}).error(function(response) {
				alert('Xóa thất bại');
			});
		})

	}

	// Lấy danh sách hãng sản xuất
	$http.get(API + 'hangsx/list').success(function(data){
		$scope.hangsx = data;
	})

	var ram = [{
		"name": "2GB",
		"memmory": 2
	},
	{
		"name": "4GB",
		"memmory": 4
	},
	{
		"name": "8GB",
		"memmory": 8
	},
	{
		"name": "16GB",
		"memmory": 16
	},
	];

	$scope.listram = ram;

	var cpu = [{
		"value": "3",
		"name": "CPU i3"
	},
	{
		"value": "5",
		"name": "CPU i5"
	},
	{
		"value": "7",
		"name": "CPU i7"
	}
	];

	$scope.listcpu = cpu;

	var ocung = [{
		"name": "120GB",
		"hard_drive": 120
	},
	{
		"name": "250GB",
		"hard_drive": 250
	},
	{
		"name": "500GB",
		"hard_drive": 500
	},
	{
		"name": "1TB",
		"hard_drive": 1000
	},
	];

	$scope.listocung = ocung;



	// Hiển thị modal thêm hoặc sửa sản phẩm
	$scope.modalLaptop = function(state, id){
		$scope.id = id;
		$scope.state = state;
		if(state == 'addLaptop'){
			$scope.title = "Thêm mới sản phẩm";
			$scope.action = API + 'products/laptop/add';
			$scope.submit = 'Thêm mới';
		}
		else{
			$scope.title = 'Sửa thông tin sản phẩm';
			$scope.action = API + 'products/laptop/edit/' + id;
			$scope.submit = 'Chỉnh sửa';
		}

		// Lấy danh sách sách danh mục để show len form thêm laptop
		$http.get(API + 'categorys/list').success(function(data){
			$scope.cats = data;
		});
		// Lấy danh sách sách mặng hàng để show len form thêm laptop
		$http.get(API + 'mathang/list').success(function(data){
			$scope.mathang = data;
		});
		// Lấy danh sách sách hãng sản xuất để show len form thêm laptop
		$http.get(API + 'hangsx/list').success(function(data){
			$scope.hangsx = data;
		});

		// Lấy dữ liệu sản phẩm theo id để show lên form sửa sp
		$http.get(API + 'products/laptop/edit/' + id).success(function(data){
			$scope.pro = data;
			console.log(data);
		});

		// Lấy các hình ảnh kèm theo ảnh bảng image_product
		$http.get(API + 'products/laptop/getimage/' + id).success(function(data){
			$scope.images = data;
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

		$('#modalLaptop').modal('show');
	}

	$scope.save = function(state,id){
		if(state == 'addLaptop'){
			var data = $scope.pro;
			var imgs = $scope.imgs;
			var uploadUrl = API + "products/laptop/add";
			var fd = new FormData();

			angular.forEach(data, function(value,key){
				fd.append(key, value);
			});

			angular.forEach(imgs, function(file,key){
				fd.append('file[]', file);
				//console.log(key);
			});


			$http.post(uploadUrl, fd, {
				transformRequest: angular.identity,
				headers: {'Content-Type': undefined,'Process-Data': false}
			})
			.success(function(res){
				$('#modalLaptop').modal('hide');
				$scope.loadLaptop();
				flash.success = 'Bạn đã thêm mới thành công';

			})
			.error(function(){
				alert('Thêm thất bại');
			});
		}else{
			var data = $scope.pro;
			var imgs = $scope.imgs;
			var uploadUrl = API + "products/laptop/edit/" + id;
			var fd = new FormData();
			angular.forEach(data, function(value,key){
				fd.append(key, value);
			});
			
			angular.forEach(imgs, function(file,key){
				fd.append('file[]', file);
				//console.log(key);
			});
			$http.post(uploadUrl, fd, {
				transformRequest: angular.identity,
				headers: {'Content-Type': undefined,'Process-Data': false}
			})
			.success(function(data){
				$('#modalLaptop').modal('hide');
				flash.success = 'Bạn đã sửa thành công';
				$scope.loadLaptop();
				
			})
			.error(function(data){
				alert('Sửa thất bại');
			});
		}
	}


	$scope.modalDelete = function(id){
		$scope.idDelete = id;
		$('#confirmDelete').modal('show');

	}

	$scope.delete = function(id){
		var id = id;
		$http.post(API + 'products/laptop/delete/' + id).success(function(response) {
			$('#confirmDelete').modal('hide');
			$scope.loadLaptop();
			flash.success = 'Bạn đã xóa thành công';
		}).error(function(response) {
			alert('Xóa thất bại');
		});
	}

	$scope.sortColumn = 'name';
	$scope.reverse = false;

	$scope.sortData = function(column){
		if($scope.sortColumn == column){
			$scope.reverse = !$scope.reverse;
		}else{
			$scope.reverse = false;
			$scope.sortColumn = column;
		}
	}

	$scope.searchLaptop = function(){
		var txt = $scope.search;
		var leng = txt.length;
		if(leng == 0){
			$http.get(API + 'products/laptop/list').success(function(data){
				$scope.data = data;
			});
		}else{
			$http.get(API + 'products/laptop/search/' + txt).success(function(data){
				$scope.data = data;
			});

		}
	}
})
