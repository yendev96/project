app.controller('orderController', function($rootScope,$scope,$http,API,flash){
	$scope.loadOrder = function(){
		$http.get(API + 'order/list').success(function(data){
			$scope.orders = data;
		})
	}

	$scope.loadOrder();

	// Thực hiện hiển thị chi tiết đơn hàng ra modal
	$scope.chitietdonhang = function(id, total){
		$http.get(API + 'order/list-order-detail/' + id).success(function(data){
			$scope.listorder = data;
		})

		$scope.total = total;
		$('#modalDonHang').modal('show');
	}

	// Xử lý đơn hàng khi đã thanh toán
	$scope.xulydonhang = function(id){
		$scope.idxl = id;
		$('#confirmxlorder').modal('show');
	}

	$scope.actionxlydonhang = function(id){
		$http.post(API + 'order/xuly-donhang/' + id).success(function(data){

			$('#confirmxlorder').modal('hide');
			flash.success = 'Xử lý thành công';
			$scope.loadOrder();
			
		})
	}
})