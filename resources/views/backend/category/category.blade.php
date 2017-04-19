@extends('backend.layouts.master')
@section('title','Danh sách Category')
@section('content')
<div flash-alert="success" active-class="in alert-flash flash-angular" class="fade ">
 <button type="button" class="close" ng-click="hide()">&times;</button>
 <strong class="alert-heading">Thông báo!</strong>
 <span class="alert-message" ng-bind="flash.message"></span>
</div>
<div class="content" ng-controller="categoryController">

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading myheading">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <h4><i class="fa fa-folder"></i>QUẢN LÝ DANH MỤC<span class="count"></span></h4>
                </div>

                <div class="right-heading">

                    <a href="javascipt:void(0)" class="btn btn-primary" title="" ng-click="modalCategorys('addCategory')"><i class="fa fa-plus"></i>Thêm mới</a>
                    <button type="button" class="btn btn-danger btn-delete-checkall"><i class="fa fa-trash-o"></i>XÓA</button>

                </div>
            </div>
            <!-- / panel-heading myheading -->
            <div class="panel-body">
                <div class="row row-filter ">
                    <div class="col-md-6 count-search">
                        <p>Có <span style="color:red;font-size:20px"><span ng-bind="countsearch"></span></span> kết quả được tìm thấy</p>
                    </div>
                    <div class="col-md-3 col-sm-7 col-xs-12  pull-right">
                        <div class="row search">
                            <form action="" method="get" role="form">
                                <input type="text" class="form-control" name="s" placeholder="Tìm kiếm danh mục..." ng-model="search" ng-keyup="searchCat()">
                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="main-table">
                    <table id="example2" class="table table-hover table-bordered tbl-admin">
                        <thead>
                            <tr>
                                <th><input id="checkall" type="checkbox" value="0"></th>
                                <th>Name</th>
                                <th>Keyworks</th>
                                <th>Description</th>
                                <th>Show</th>
                                <th>Thứ tự</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody ng-hide="hideCat">
                            <tr class="" ng-repeat="x in data | orderBy:sortColumn:reverse | orderBy: '-id'">
                                <td><input id='checkbox' type="checkbox" value=""></td>
                                <td ng-bind="x.name"></td>
                                <td ng-bind="x.keywords"></td>
                                <td ng-bind="x.description"></td>
                                <td>
                                    <div ng-if="x.show_nav == 1">
                                        <span>Có</span>
                                    </div>
                                    <div ng-if="x.show_nav == 0">
                                        <span>Không</span>
                                    </div>
                                </td>
                                <td ng-bind="x.cat_order"></td>
                                <td class="td-action" class="td-action">
                                    <a data-toggle="tooltip" title="Chỉnh sửa thông tin" href="" ng-click="modalCategorys('editCategory', x.id)"><i class="fa fa-pencil-square icon-edit"></i></a>
                                    <a data-toggle="tooltip" title="Xóa danh mục" href="javascipt:void(0)" ng-click="showModalDelete(x.id)"><i class="fa fa-trash icon-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
        <!-- /panel-body -->


        <div class="modal fade" id="confirmDelete" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Delete Category</h4>
                  </div>
                  <div class="modal-body">
                      <p>Bạn có chắc chắn muốn xóa không ??</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-success" ng-click="delete(idDelete)">Xóa</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

              </div>
          </div>
      </div>


      <div id="modalCategorys" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{%title%}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form id="formCat" name="formCat" action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Tên danh mục</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" ng-model="cat.name" ng-required="true" value="{{old('name')}}" placeholder="Nhập tên danh mục" />
                                        <span class="error" ng-show="formCat.name.$error.required && formCat.name.$touched">Tên danh mục không được để trống</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Từ khóa</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="keywords" ng-model="cat.keywords" placeholder="Nhập từ khóa" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Mô tả</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" ng-model="cat.description" placeholder="Nhập mô tả" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Thứ tự</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="cat_order" ng-model="cat.cat_order" value="{{old('cat_order')}}" placeholder="Nhập category order" />
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">Trạng thái</label>
                                    <div class="col-sm-10">
                                        <input ng-model="cat.show_nav" ng-required="true" type="radio" name="show_nav" value="1" class="form-control" checked>Có
                                        <input ng-model="cat.show_nav" ng-required="true" type="radio" name="show_nav" value="0" class="form-control">Không
                                        <span class="error" ng-show="formProduct.status.$error.required && formProduct.status.$touched">Vui lòng chọn trạng thái sản phẩm</span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">

                                        <button type="button" class="btn btn-primary" ng-disabled="formCat.$invalid" ng-click="save(state, id)">{%textSave%}</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /panel-default -->

</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('/public/backend/js/angular/cat.js')}}"></script>
@endsection

