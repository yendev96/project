@extends('backend.layouts.master')
@section('title','Danh sách mặt hàng')
@section('content')
<div flash-alert="success" active-class="in alert-flash flash-angular" class="fade ">
   <button type="button" class="close" ng-click="hide()">&times;</button>
   <strong class="alert-heading">Thông báo!</strong>
   <span class="alert-message" ng-bind="flash.message"></span>
</div>
<div class="content" ng-controller="hangsxController">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading myheading">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <h4><i class="fa fa-folder"></i>QUẢN LÝ HÃNG SX<span class="count"></span></h4>
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
                        <p>Có <span style="color:red;font-size:20px" ng-bind="countsearch"></span> kết quả được tìm thấy</p>
                    </div>
                    <div class="col-md-3 col-sm-7 col-xs-12  pull-right">
                        <div class="row search">
                            <form action="" method="get" role="form">
                                <input type="text" class="form-control" name="s" placeholder="Tìm kiếm nhà sản xuất..." ng-model="search" ng-keyup="searchHangsx()">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="main-table">
                    <table id="example2" class="table table-hover table-bordered tbl-admin">
                        <thead>
                            <tr>
                                <th><input id="checkall" type="checkbox" value="0"></th>
                                <th>Tên</th>
                                <th>Danh mục</th>
                                <th>Mặt hàng</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody ng-hide="hideCat">
                            <tr class="" ng-repeat="x in data | orderBy:sortColumn:reverse | orderBy: '-id'">
                                <td><input id='checkbox' type="checkbox" value=""></td>
                                <td ng-bind="x.name"></td>
                                <td ng-bind="x.category_name"></td>
                                <td ng-bind="x.mathang_name"></td>
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
                                        <input type="text" class="form-control" name="name" ng-model="hangsx.name" ng-required="true" value="{{old('name')}}" placeholder="Nhập tên danh mục" />
                                        <span class="error" ng-show="formCat.name.$error.required && formCat.name.$touched">Tên danh mục không được để trống</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Từ khóa</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="keywords" ng-model="hangsx.keywords" placeholder="Nhập từ khóa" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Mô tả</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description" ng-model="hangsx.description" placeholder="Nhập mô tả" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Danh mục</label>
                                    <div class="col-sm-9">
                                        <select name="id_category" class="form-control" ng-model="hangsx.id_category" ng-required="true" ng-change="changeCategory(hangsx.id_category)">

                                            <option value="">CHỌN DANH MỤC</option>
                                            <option ng-repeat="cat in cats" value="{%cat.id%}" ng-selected="cat.id_category == hangsx.id_category">{%cat.name%}</option>
                                            
                                        </select>
                                        <span class="error" ng-show="formCat.parent_id.$error.required && formCat.parent_id.$touched">Danh mục cha không được để trống</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Mặt hàng</label>
                                    <div class="col-sm-9">
                                        <select name="id_mathang" class="form-control" ng-model="hangsx.id_mathang" ng-required="true" ng-change="changeMathang()">

                                            <option value="">CHỌN MẶT HÀNG</option>
                                            <option ng-repeat="cat in mathang" value="{%cat.id%}" ng-selected="cat.id_mathang == hangsx.id_mathang">{%cat.name%}</option>
                                            
                                        </select>
                                        <span class="error" ng-show="formCat.parent_id.$error.required && formCat.parent_id.$touched">Danh mục cha không được để trống</span>
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
<script type="text/javascript" src="{{asset('/public/backend/js/angular/hangsx.js')}}"></script>
@endsection

