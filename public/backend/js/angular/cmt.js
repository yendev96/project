app.controller('cmtController', function($scope, $http, API, flash){
	$scope.loadCmt = function(){
		$http.get(API + 'comment/list').success(function(data){
			$scope.listcmt = data;
		})
	}

	$scope.loadCmt();

	$scope.modalCmt = function(state,id){
		$scope.state = state;
		$scope.idCmt = id;
		if(state == 'duyet'){
			$scope.showbutton = true;
			$scope.titlemodalcmt = 'Thông báo';
			$scope.textcontent = 'Bạn có muốn duyệt bình luận này';
			$scope.textbutton = "Duyệt";
		}else{
			$scope.showbutton = true;
			$scope.textcontent = "Bạn có muốn xóa không";
			$scope.titlemodalcmt = "Thông báo";
			$scope.textbutton = "Xóa";
		}
		$("#confirmModalCmt").modal('show');
		
	}



	$scope.actionClick = function(state,idcmt){
		if(state == 'duyet'){
			$http.post(API + 'comment/duyet/' + idcmt).success(function(data){
				$scope.loadCmt();
				$("#confirmModalCmt").modal('hide');
				flash.success = 'Bạn đã duyệt thành công';
			})
		}else{
			$http.post(API + 'comment/xoa/' + idcmt).success(function(data){
				$scope.loadCmt();
				$("#confirmModalCmt").modal('hide');
				flash.success = 'Bạn đã xóa thành công';
			})
		}
	}

// Trả lời bình luận
$scope.modalrepcmt = function(idpost,name, idcmt){
	$scope.name = name;
	$scope.idpost = idpost;
	$scope.idCmtRep = idcmt;
		// Lấy thông tin bình luận
		$http.get(API + 'comment/checkcmt/' + idcmt).success(function(data){
			// Nếu bình luận đã được phe duyệt rồi
			if(data == 'true'){
				$("#modalRepCmt").modal('show');
				$scope.contentrepcmt = name + ": ";
			}else{
				// Nếu bình luận chưa được phê duyệt
				$("#confirmModalCmt").modal('show');
				$scope.showbutton = false;
				$scope.titlemodalcmt = "Thông báo";
				$scope.textcontent = "Bạn chưa duyệt comment này";
			}
		})
	}

	$scope.showerror = true;

	$scope.actionRepCmt = function(name, idpost, idcmt){

		var txt = $scope.contentrepcmt;
		var txt_length = txt.length;
		var name_length = name.length;
		var check_length  = txt_length - name_length;
		if(check_length < 20){
			$scope.showerror = false;
		}else{
			$http.post(API + 'comment/repcmt/'+ idpost + '/' + idcmt, {content: $scope.contentrepcmt}).success(function(data){
				$("#modalRepCmt").modal('hide');
				flash.success = 'Trả lời thành công';
			})
		}


	}

})