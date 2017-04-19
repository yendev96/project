var app = angular.module('myApp', [
    'ui.bootstrap',
    'ngFlash',
    'angular-loading-bar',
    'infinite-scroll'
]).constant('API', 'http://localhost:8888/project/');

app.config(function($interpolateProvider, cfpLoadingBarProvider) {
    $interpolateProvider.startSymbol('{%').endSymbol('%}');
    cfpLoadingBarProvider.includeSpinner = true;
});

// Loc theo phân trang
app.filter('pagination', function() {
    return function(data, start) {
        return data.slice(start);
    }
});



// =============================================================================================

// myController bao tất cả các Controller con
app.controller('myController', function($rootScope, $scope, $http, API, Flash, $timeout) {

    // Lấy số lượng sản phẩm
    $scope.loadGetCount = function() {
        $http.get(API + 'getcount').success(function(data) {
            $scope.countbuy = data;
        });
    }
    $scope.loadGetCount();
    // Nhận request từ cartController
    $scope.$on('load-count-buy', function(event, args) {
        $scope.loadGetCount();
    })



    // Thực hiện hành động khi click vào button thêm giỏ hàng
    $scope.muahang = function(id, count) {
        $http({
            method: 'GET',
            url: API + 'muahang/' + id + '/' + count,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(response) {
            // Nếu thêm thành công thì lại gọi hàm lấy số lượng sp để hiện thị
            $scope.loadGetCount();
            // In ra thông báo thêm thành công
            var message = '<strong> Thông báo!</strong>  Sản phẩm đã được thêm vào giỏ hàng';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            // Nếu thêm không thành công thì...
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
        }).error(function(response) {
            alert('Thêm thành viên thất bại');
        });
    }

    // Thực hiện hành động khi click vào button thêm giỏ hàng
    $scope.addram = function(id, count) {
        $http({
            method: 'GET',
            url: API + 'addram/' + id + '/' + count,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(response) {
            // Nếu thêm thành công thì lại gọi hàm lấy số lượng sp để hiện thị
            $scope.loadGetCount();
            // In ra thông báo thêm thành công
            var message = '<strong> Thông báo!</strong>  Sản phẩm đã được thêm vào giỏ hàng';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            // Nếu thêm không thành công thì...
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
        }).error(function(response) {
            alert('Thêm vào giỏ hàng thất bại');
        });
    }

    $scope.addcountdetail = function(count, id) {
        if (!count) {
            $('#modalChitiet').modal('show');
            $scope.textModel = "Chọn số lượng sản phẩm cần mua";
        } else {
            $http({
                method: 'GET',
                url: API + 'muahang/' + id + '/' + count,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).success(function(response) {
                // Nếu thêm thành công thì lại gọi hàm lấy số lượng sp để hiện thị
                $http.get(API + 'getcount').success(function(data) {
                    $scope.countbuy = data;
                });
                // In ra thông báo thêm thành công
                var message = '<strong> Thông báo!</strong>  Sản phẩm đã được thêm vào giỏ hàng';
                var id = Flash.create('success', message, 0, {
                    class: 'flash-success',
                    id: 'custom-id'
                }, true);
                // clear flash thông báo
                $timeout(function() {
                    Flash.clear();
                }, 3500);
            }).error(function(response) {
                alert('Thêm thành viên thất bại');
            });
        }


    }
})


// ===========================================================================

// Controller xử lý phần topHeader (Đăng nhập, Đăng ký)
app.controller('headerController', function($scope, $http, Flash, API, $timeout) {
    // Hiện modal đăng ký
    $scope.modalRegister = function() {
        $('#modalRegister').modal('show');
    }

    // Hiện modal đăng nhập
    $scope.modalLogin = function() {
        $('#modalLogin').modal('show');
    }

    $scope.register = function() {
        $http({
            method: 'POST',
            url: API + 'dangky',
            data: $.param($scope.dangky),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(response) {
            $('#modalRegister').modal('hide');
            $('#modalLogin').modal('show');
            var message = '<strong> Thông báo!</strong>  Đăng ký thành công';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
        }).error(function(response) {
            alert('Thêm thành viên thất bại');
        });
    }

    $scope.dangnhap = function(){
        $http({
            method: 'POST',
            url: API + 'dangnhap',
            data: $.param($scope.login),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(response) {
            if(response == 'true'){


            window.location.href = API;
            $('#modalLogin').modal('hide');
            var message = '<strong> Thông báo!</strong>  Đăng ký thành công';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
        }else{
            alert("Email hoặc password không đúng");
            return false;
            //alert(response);
        }
        }).error(function(response) {
            alert('Đăng nhập thất bại');
        });
    }


})

// ==========================================================================

// Controller xử lý các sản phẩm ở trang chủ
app.controller('homeController', function($scope, $http, Flash, API) {
    // Lấy sản phẩm mua nhiều nhất
    $http.get(API + 'getbanchay').success(function(data) {
        $scope.banchay = data;
    });
    // Lấy sản phẩm mới 
    $http.get(API + 'getxemnhieu').success(function(data) {
        $scope.muanhieu = data;
    })

    // Lấy sản phẩm mới về
    $http.get(API + 'getmoive').success(function(data) {
        $scope.moive = data;
    })

    $http.get(API + 'getram').success(function(data) {
        $scope.rams = data;
    });

})


// ===============================================================================


// Controller xử lý phần chi tiết sản phẩm
app.controller('chitietController', function($scope, $http, API, Flash, $rootScope, $timeout) {
    var idpro = document.getElementById("idproduct").value;
    // Lấy số lượng bình luận về sản phẩm
    $http.get(API + 'gettotalcountcmt/' + idpro).success(function(data) {
        $scope.totalcmt = data;
    })

    $http.get(API + 'getiduser').success(function(data) {
        $scope.idusercmt = data;
    })

    // Lấy id của sản phẩm
    // Lấy dữ liệu sản phẩm theo id
    $http.get(API + 'getproductbyid/' + idpro).success(function(data) {
        $scope.product = data;
    })



    // Lấy cmt để hiện thị
    $scope.loadCmt = function() {
        // Lấy cmt theo id sản phẩm
        $http.get(API + 'getcmtbyid/' + idpro).success(function(data) {
            $scope.listcmt = data;
        })
    }

    $scope.loadCmt();

    $scope.orderNewCmt = function(idpro) {
        $http.get(API + 'getcmtbydate/' + idpro).success(function(data) {
            $scope.listcmt = data;
        })


    }

    $scope.orderLikeCmt = function(idpro) {
        $http.get(API + 'getcmtbylike/' + idpro).success(function(data) {
            $scope.listcmt = data;
        })


    }


    // Thực hiện bình luận
    $scope.actionCmt = function(idpro) {
        var txt = $scope.textcmt;
        // Kiểm tra đăng nhập hay chưa
        $http.get(API + 'getsession').success(function(data) {
            // Nếu đã đăng nhập rồi
            if (data) {
                if (!txt) {
                    $('#modalChitiet').modal('show');
                    $scope.textModel = "Vui lòng nhập bình luận";
                } else {
                    $http.post(API + 'addcomment/' + idpro, {
                        content: $scope.textcmt
                    }).success(function(data) {
                        // Clear form sau khi bình luận
                        $scope.textcmt = "";
                        // Gọi hàm load lại cmt
                        $scope.loadCmt();
                        // In ra thông báo thêm thành công
                        var message = '<strong> Thông báo!</strong>  Bình luận của bạn sẽ hiển thị sau khi được phê duyệt';
                        var id = Flash.create('success', message, 0, {
                            class: 'flash-success',
                            id: 'custom-id'
                        }, true);
                        // clear flash thông báo
                        $timeout(function() {
                            Flash.clear();
                        }, 3500);
                    })
                }
            } else {
                // Nếu chưa đăng nhập xuất hiện thông báo
                $('#modalChitiet').modal('show');
                $scope.textModel = "Đăng nhập để bình luận";
            }
        });

    }


    // Hiển thị box các trả lời cho cmt
    $scope.viewrepcmt = function(x, id) {
        // Hiển thị box commet khi click
        angular.forEach($scope.listcmt, function(currentItem) {
            currentItem.showboxrepcmt = currentItem === x && !currentItem.showboxrepcmt;

        });

        // lấy danh sách các trả lời theo id cmt
        $http.get(API + 'getsubcmt/' + id).success(function(data) {
            $scope.listsubcmt = data;

        })
    }


    // Ẩn hiện form trả lời cmt
    $scope.repcmt = function(x, idcmt, fullname) {
        $scope.idcmt = idcmt;
        $scope.hideboxrepcmt = true;
        angular.forEach($scope.listcmt, function(currentItem) {
            currentItem.hideboxrepcmt = currentItem === x && !currentItem.hideboxrepcmt;

        });

    }




    // Xử lý trả lời bình luận

    $scope.actionRepCmt = function(idpro, idcmt, textrepcmt) {
        $http.get(API + 'getsession').success(function(data) {
            if (data) {
                $http.post(API + 'addrepcmt/' + idpro + '/' + idcmt, {
                    txt: textrepcmt
                }).success(function(data) {
                    $scope.textrepcmt = "";
                    // In ra thông báo thêm thành công
                    var message = '<strong> Thông báo!</strong>  Bình luận của bạn sẽ hiển thị sau khi được phê duyệt';
                    var id = Flash.create('success', message, 0, {
                        class: 'flash-success',
                        id: 'custom-id'
                    }, true);
                    // clear flash thông báo
                    $timeout(function() {
                        Flash.clear();
                    }, 3500);
                });
            } else {
                // Nếu chưa đăng nhập xuất hiện thông báo
                $('#modalChitiet').modal('show');
                $scope.textModel = "Đăng nhập để bình luận";
            }
        })


    }

    // Xử lý like cmt
    $scope.likecmt = function(idcmt) {
        $http.post(API + 'likecmt/' + idcmt).success(function(data) {
            $scope.loadCmt();
            $scope.bolikecmt != $scope.bolikecmt;
            // 
        })
    }

    $scope.showerror = true;
    // Chỉnh sửa bình luận
    $scope.modalSua = function(content, id) {
        $scope.idcmtedit = id;
        $("#modalEditCmt").modal('show');
        $scope.contentrepcmt = content;
    }

    $scope.actionEditCmt = function(idcmtedit) {
        $http.post(API + 'editcmt/' + idcmtedit, {
            content: $scope.contentrepcmt
        }).success(function(data) {
            $scope.loadCmt();
            $scope.showboxrepcmt = true;
            $("#modalEditCmt").modal('hide');
            // In ra thông báo thêm thành công
            var message = '<strong> Thông báo!</strong>  Chỉnh sửa thành công';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
        })
    }

    // Xóa bình luận
    $scope.modalDelCmt = function(idcmt, parent) {
        $scope.iddelcmt = idcmt;
        $("#modalChitiet").modal('show');
        $scope.textModel = "Xóa bình luận này";
        $scope.showbutton = true;
    }

    $scope.actionDelCmt = function(idcmt, parent) {
        $http.post(API + 'delcmt/' + idcmt).success(function(data) {

            $scope.loadCmt();
            $("#modalChitiet").modal('hide');
            // In ra thông báo thêm thành công
            var message = '<strong> Thông báo!</strong>  Chỉnh sửa thành công';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
        })
    }

    $scope.rating = function(rate) {
        $http.get(API + 'getsession').success(function(data) {
            // Nếu đã đăng nhập rồi
            if (data) {
                $http.get(API + 'getiduser').success(function(dataid) {
                    $http.post(API + 'rating/' + idpro + '/' + dataid + '/' + rate).success(function(res) {

                        if (res == 'false') {
                            //alert('Bạn đã đánh giá sản phẩm này rồi');
                            $("#modalChitiet").modal('show');
                            $scope.textModel = "Bạn đã đánh giá sản phẩm này rồi";
                        } else {
                            $scope.loadCmt();
                            $("#modalChitiet").modal('hide');
                            // In ra thông báo thêm thành công
                            var message = '<strong> Thông báo!</strong>  Đánh giá thành công';
                            var id = Flash.create('success', message, 0, {
                                class: 'flash-success',
                                id: 'custom-id'
                            }, true);
                            // clear flash thông báo
                            $timeout(function() {
                                Flash.clear();
                            }, 3500);
                            //console.log(res);
                        }
                    })
                });

            } else {
                // Nếu chưa đăng nhập xuất hiện thông báo
                $('#modalChitiet').modal('show');
                $scope.textModel = "Đăng nhập để bình luận";
            }
        });

    }

    $scope.modalRating = function(idpro) {
        $("#modalRating").modal('show');
        $http.get(API + 'gettotalrate/' + idpro).success(function(data) {
            if (data) {
                $scope.total_rate = data;
            }

        })
    }

    $http.get(API + 'getcountrate/' + idpro).success(function(data) {
        $scope.countrate = data;
    })



})


// =======================================================================


// Controller xử lý phần xây dựng cấu hinh
app.controller('xdchController', function($scope, $http) {
    $http.get(API + 'getram').success(function(data) {
        $scope.rams = data;
    });


})


// ================================================================================

// Contrller xử lý phần danh mục sản phẩm
app.controller('dmController', function($scope, $http, Flash, API) {
    var idcathidden = document.getElementById("idcathidden").value;
    // $scope.currentPage = 1;
    // $scope.pageSize = 5;
    // Lấy danh sách sản phẩm theo danh mục
    $http.get(API + 'category/get_product_by_cat/' + idcathidden).success(function(data) {
        $scope.dmlaptop = data;
    });

    $http.get(API + 'product/gettotal/' + idcathidden).success(function(data) {
        $scope.totalproduct = data;
    })

    $http.get(API + 'get_sx_by_mh').success(function(data) {
        $scope.dshangsx = data;
    });

    //   $scope.loadMore = function() {
    //   var last = $scope.dmlaptop[$scope.dmlaptop.length - 1];
    //   for(var i = 1; i <= 2; i++) {
    //     $scope.dmlaptop.push(last + i);
    //   }
    // };

    ram = [{
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
        {
            "name": "32GB",
            "memmory": 32
        }
    ];

    $scope.listram = ram;

    ocung = [{
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

    var cpu = [{
            "name": "Core i3",
            "value": "i3"
        },
        {
            "name": "Core i5",
            "value": "i5"
        },
        {
            "name": "Core i7",
            "value": "i7"
        },
    ];

    $scope.listcpu = cpu;

    $scope.clickfilterprice = function(from, to) {
        if (typeof from != 'undefined' && typeof to != 'undefined') {
            $http.get(API + 'filter/price/' + from + '/' + to).success(function(data) {
                if (data) {

                    $scope.dmlaptop = data;
                }
            })
        }

    }

})

// =========================================================================================

// Controller xử lý phần 
app.controller('boxheaderController', function($scope, $http, API) {
    $scope.showketquatimkiem = true;
    $scope.timkiem = function(txt) {
        if (txt.length > 0) {
            $http.get(API + 'timkiem/' + txt).success(function(data) {
                if (data) {
                    $scope.hihihi = data;
                    $scope.showketquatimkiem = false;
                }
            })
        } else {
            $scope.showketquatimkiem = true;
        }
    }

})

// =============================================================================================

app.controller('cartController', function($rootScope, $scope, $timeout, $http, Flash, API) {
    // Khi truy cập vào giỏ hàng thì đếm số lượng sp trong giỏ
    $http.get(API + 'getcount').success(function(data) {
        // Nếu số lượng bằng 0 thì hiện modal thông báo
        if (data == 0) {
            // set giá trị true cho ng-hide bên view để ẩn thông báo k có sản phẩm trong giỏ
            $scope.emptycart = flase;
        } else {
            $scope.emptycart = true;
        }

    });


    // Hàm hiển thị giỏ hàng
    $scope.loadCart = function() {
        $http.get(API + 'get_data_cart').success(function(data) {
            $scope.cart = data;
        });
    }
    // Gọi hàm hiển thị giỏ hàng
    $scope.loadCart();


    // Hiện bảng xác nhận xóa
    $scope.modalconfirm = function(id) {

        $('#confirmDelete').modal('show');
        $scope.idDelete = id;

    }


    // Thực hiện hành động khi bấm vào button xóa
    $scope.confirmDelCart = function(id) {

        // Tiến hành xóa
        $http.get(API + 'delete_cart/' + id).success(function(data) {
            // Xóa xong ẩn modal xác nhận xóa
            $('#confirmDelete').modal('hide');
            $scope.tongtien();
            // Hiển thị thông báo xóa thành công
            var message = '<strong> Thông báo!</strong>  Sản phẩm đã xóa thành công';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            $scope.loadCart();
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
            // Load lại giỏ hàng

            // Gọi function đếm số lượng sản phẩm trong giỏ hàng
            $http.get(API + 'getcount').success(function(data) {
                // Nếu số lượng bằng 0 thì hiện modal thông báo
                if (data == 0) {

                    $('#modalCart').modal('show');
                    $scope.thongbao_giohang = 'Giỏ hàng không có sản phẩm nào';
                    $scope.emptycart = true;
                }

            });

            // Gọi đến myController với giá trị load-count-buy để cập nhật số lượng trong giỏ
            $rootScope.$broadcast('load-count-buy');

        });
    }


    // Tính tổng tiền trong giỏ hàng

    $scope.tongtien = function() {
        $http.get(API + 'cart/total').success(function(data) {
            $scope.total = data;
        });
    }

    $scope.tongtien();

    // Thực hiện hành động khi người dùng click vào thay đổi số lượng
    $scope.changecart = function(id, qty) {
        // Gọi đến controller cập nhật giỏ hàng
        $http.get(API + 'update_cart/' + id + '/' + qty).success(function(data) {
            // Nếu cập nhật thành công thì load lại giỏ hàng
            $scope.loadCart();
            // Và load lại tổng số tiền
            $scope.tongtien();
            // Và gọi đến hàm đếm số lượng giỏ hàng
            $rootScope.$broadcast('load-count-buy');
        });

    }

    // Thực hiện xóa giỏ hàng
    $scope.xoagiohang = function() {
        // Hiện ra modal xác nhận
        $('#confirmDelete').modal('show');
        // Thực hiện hành động khi click vào button xóa
        $scope.confirmDelCart = function(id) {
            // Gọi đến controller xóa
            $http.get(API + 'clear_cart').success(function(data) {
                // Nếu xóa thành công thì ẩn modal xác nhận
                $('#confirmDelete').modal('hide');
                // Load lại giỏ hàng
                $scope.loadCart();
                $scope.tongtien();
                // Gửi flash
                var message = '<strong> Thông báo!</strong> Xóa giỏ hàng thành công';
                var id = Flash.create('success', message, 0, {
                    class: 'flash-success',
                    id: 'custom-id'
                }, true);
                // clear flash thông báo
                $timeout(function() {
                    Flash.clear();
                }, 3500);
                // Thực hiện đếm lại số lượng giỏ hàng
                $http.get(API + 'getcount').success(function(data) {
                    // Nếu số lượng bằng 0 thì hiện modal thông báo
                    if (data == 0) {
                        $('#modalCart').modal('show');
                        $scope.thongbao_giohang = 'Giỏ hàng không có sản phẩm nào';
                    }
                    // Gọi hàm đếm số lượng giỏ hàng
                    $rootScope.$broadcast('load-count-buy');

                });
            });
        }

    }

    $scope.actionthanhtoan = function() {
        $http.get(API + 'getcount').success(function(data) {
            // Nếu số lượng bằng 0 thì hiện modal thông báo
            if (data == 0) {
                $('#modalCart').modal('show');
                // Hiện modal thông báo không có sản phẩm
                $scope.thongbao_giohang = 'Giỏ hàng không có sản phẩm nào';
            } else {
                $http.get(API + 'getsession').success(function(data) {
                    if (data) {

                        $scope.thanhtoan = data;
                        // Nếu có sản phẩm hiện modal đặt hàng
                        $('#modalthanhtoan').modal('show');

                    } else {
                        // Hiejn modal thông báo đăng nhập
                        $('#modalCart').modal('show');
                        $scope.thongbao_giohang = 'Vui lòng đăng nhập để mua hàng';
                    }
                });

            }


        });

    }


    // Xử lý đặt hàng thêm thông tin người mua
    $scope.dathang = function() {
        $http({
            method: 'POST',
            url: API + 'dathang',
            data: $.param($scope.thanhtoan),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        }).success(function(data) {
            $('#modalthanhtoan').modal('hide');
            // Gọi hàm hiển thị giỏ hàng
            $scope.loadCart();
            $scope.tongtien();
            $rootScope.$broadcast('load-count-buy');
            $scope.emptycart = false;
            var message = '<strong> Thông báo!</strong> Đặt hàng thành công';
            var id = Flash.create('success', message, 0, {
                class: 'flash-success',
                id: 'custom-id'
            }, true);
            // clear flash thông báo
            $timeout(function() {
                Flash.clear();
            }, 3500);
        }).error(function(response) {
            alert('Đặt hàng thất bại');
        });

    }



})


app.controller('myCartController', function($rootScope, $scope, $timeout, $http, Flash, API) {


})