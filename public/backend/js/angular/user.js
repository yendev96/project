// Controller về User
app.controller('userController', function($rootScope,$scope, $http, flash, API){
	$scope.currentPage = 1;
	$scope.pageSize = 10;

	//=====================  THÀNH VIÊN  ==================
	// Hiển thị danh sách thành viên
	$scope.loadUser = function(){
		$http.get(API + 'users/list').success(function(data){
			$scope.listuser = data;
		});
	}


	// Chạy hàm hiển thị thành viên
	$scope.loadUser();

	// Hiển thị model thêm và sửa thành viên
	$scope.modalUser = function(state, id){
		$scope.state = state;
		$scope.id = id;
		var id = id;
		if(state == 'addUser'){
			$scope.title = 'Thêm mới thành viên';
			$scope.textSave = 'Thêm mới'
		}else{
			$scope.title = 'Chỉnh sửa thông tin';
			$scope.textSave = 'Chỉnh sửa';
		}

		$http.get(API + 'users/edit/' + id).success(function(data){
			$scope.user = data;
		});

		$('#modalUser').modal('show');


	};

	// Thêm thành viên
	$scope.save = function(state, id){
		if(state == 'addUser'){
			$http({
				method: 'POST',
				url: API + 'users/add',
				data: $.param($scope.user),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				$('#modalUser').modal('hide');
				$scope.loadUser();
				flash.success = 'Bạn đã thêm mới thành công';
				// Gọi đến AsideController với giá trị load-count-user
				$rootScope.$broadcast('load-count-user');
			}).error(function(response) {
				alert('Thêm thành viên thất bại');
			});
		}

// Chỉnh sửa thông tin thành viên
if(state == 'editUser'){
	$http({
		method: 'POST',
		url: API + 'users/edit/' + id,
		data: $.param($scope.user),
		headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	}).success(function(response) {
		$('#modalUser').modal('hide');
		$scope.loadUser();
		flash.success = 'Bạn đã sửa mới thành công';
	}).error(function(response) {
		alert('Sửa thành viên thất bại');
	});
}
}

$scope.showModalDelete = function(id){
	$scope.idDelete = id;
	$('#confirmDelete').modal('show');


}





// Xóa thành viên
$scope.delete = function(id){
	var id = id;
	$http.post(API + 'users/delete/' + id).success(function(response) {
		if(response == 'false'){
			$('#confirmDelete').modal('hide');
			alert('Bạn đang đăng nhập');
		}else{
			$scope.loadUser();
			$('#confirmDelete').modal('hide');
			flash.success = 'Bạn đã xóa mới thành công';
		}
	}).error(function(response) {
		alert('Xóa thành viên thất bại');
	});

}


$scope.deletemultil = function(){
	
		$('#confirmDeletes').modal('show');
	
}




$scope.deletes = function(){
	$scope.list_id = [];
	angular.forEach($scope.listuser, function(x){
		if (x.selected) $scope.list_id.push(x.id);
	});
	//console.log($scope.list_id);
	angular.forEach($scope.list_id, function(value){

		$http.post(API + 'users/deletes', {id: value}).success(function(data){
			if(data == 'false'){
				alert("Bạn đang đăng nhập");
				$('#confirmDeletes').modal('hide');
			}else{
				$('#confirmDeletes').modal('hide');
				flash.success = 'Bạn đã xóa mới thành công';
				$scope.loadUser();
			}

		})
	})


}

$scope.searchUser = function(){
	var txt = $scope.search;
	var leng = txt.length;
	if(leng == 0){
		$http.get(API + 'users/list').success(function(data){
			$scope.listuser = data;
		});
		$('.count-search').hide();
	}else{
		$http.get(API + 'users/search/' + txt).success(function(data){
			$scope.listuser = data;
		});

		$('.count-search').show();

		$http.get(API + 'users/count_search/' + txt).success(function(data){
			$scope.countsearch = data;
		});

	}
}

});