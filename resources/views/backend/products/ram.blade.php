@extends('backend.layouts.master')
@section('title','Quản lý ram')
@section('content')
<div class="content" ng-controller="ramController">
    <div flash-alert="success" active-class="in alert-flash flash-angular" class="fade ">
       <button type="button" class="close" ng-click="hide()">&times;</button>
       <strong class="alert-heading">Thông báo!</strong>
       <span class="alert-message" ng-bind="flash.message"></span>
   </div>
   <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading myheading">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <h4><i class="fa fa-users"></i>QUẢN LÝ RAM</h4>
            </div>

            <div class="right-heading">

                <a href="javascript:void(0)" class="btn btn-primary" title="" ng-click="modalRam('addRam')"><i class="fa fa-plus"></i>Thêm mới</a>
                <button type="button" class="btn btn-danger btn-delete-checkall"><i class="fa fa-trash-o"></i>XÓA</button>

            </div>
        </div>
        <!-- / panel-heading myheading -->
        <div class="panel-body">
            <div class="row row-filter ">
                 <div class="col-md-6 count-search">
                    <p>Có <span style="color:red;font-size:20px" ng-bind="countsearch"></span> kết quả được tìm thấy</p>
                </div>
                <div class="col-md-3 col-xs-7 col-xs-offset-1 pull-right">
                    <div class="row search">
                        <form action="" method="get" role="form">
                            <input type="text" class="form-control" name="s" ng-model="search.name" placeholder="Tìm kiếm danh mục..." value="">
                        </form>
                    </div>
                </div>
            </div>
            <!-- / row-filter -->
            <div class="main-table">
                <table id="example2" class="table table-hover table-bordered tbl-admin">
                    <thead>
                        <tr>
                            <th><input id="checkall" type="checkbox"></th>
                            <th class="th-username">Thông tin sản phẩm</th>
                            <th class="th-username">Dung lượng</th>
                            <th class="th-username">Bus</th>
                            <th class="th-username">Thuộc danh mục</th>
                            <th class="th-username">Trạng thái</th>
                            <th class="th-username">Người đăng</th>
                            <th class="th-action">Hành động</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="" ng-repeat="x in data | filter:search:search | orderBy:'-id'">
                            <td><input id='checkbox' type="checkbox" value=""></td>
                            <td>
                                <div class="row img_product">
                                    <img style="width: 120px; height:auto;" src="{{asset('/public/upload/img/img_products')}}/{%x.img%}" alt="">
                                </div>
                                <div class="row title-product">
                                    <p ng-bind="x.name"><a href="" title=""></a></p>
                                </div>
                                <div class="row info-product">
                                    <span ng-bind="x.view"><i class="fa fa-eye"></i></span>
                                    <span ng-bind="x.price"><i class="fa fa-money"></i></span>
                                    <span ng-bind="x.discount"><i class="fa fa-long-arrow-down"></i></span>
                                </div>
                            </td>
                            <td ng-bind="x.memory">
                            </td>
                            <td ng-bind="x.bus">
                            </td>
                            <td ng-bind="x.id_category">
                            </td>
                            
                            
                            
                            <td>
                                <div ng-if="x.status == 1">
                                    <span style="color:#05d600">Hiện</span>
                                </div>
                                <div ng-if="x.status == 0">
                                    <span style="color:red">Ẩn</span>
                                </div>
                            </td>
                            <td>
                                {%x.author%}
                            </td>
                            <td class="td-action" class="td-action">
                                <a data-toggle="tooltip" href="javascript:void(0)" ng-click="modalRam('editRam', x.id)"><i class="fa fa-pencil-square icon-edit"></i></a>
                                <a data-toggle="tooltip" href="javascript:void(0)" ng-click="modalDelete(x.id)"><i class="fa fa-trash icon-trash"></i></a>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /panel-body -->
    </div>
    <!-- /panel-default -->
</div>
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
<div id="modalRam" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content" style="height:600px;overflow:auto;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center" >{%title%}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form name="formProduct" action="{%action%}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên sản phẩm</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control name" name="name" ng-model="pro.name" ng-required="true" placeholder="Nhập tên sản phẩm" />
                                    <span class="error" ng-show="formProduct.name.$error.required && formProduct.name.$touched">Vui lòng nhập tên sản phẩm</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Danh mục</label>
                                <div class="col-sm-10">
                                    <select ng-model="pro.category" ng-required="true" name="category" class="form-control" ng-change="changeCategory(pro.category)">
                                        <option value="">THUỘC DANH MỤC</option>
                                        <option ng-repeat="cat in cats" value="{%cat.id%}">{%cat.name%}</option>

                                    </select>
                                    <span class="error" ng-show="formProduct.category.$error.required && formProduct.category.$touched">Vui lòng chọn danh mục</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mặt hàng</label>
                                <div class="col-sm-10">
                                    <select ng-model="pro.mathang" ng-required="true" name="mathang" class="form-control"  ng-change="changeMathang(pro.mathang)">
                                        <option value="">THUỘC MẶT HÀNG</option>
                                        <option ng-repeat="cat in mathang" value="{%cat.id%}">{%cat.name%}</option>
                                    </select>
                                    <span class="error" ng-show="formProduct.mathang.$error.required && formProduct.mathang.$touched">Vui lòng chọn danh mục</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Hãng sản xuất</label>
                                <div class="col-sm-10">
                                    <select ng-model="pro.hangsx" ng-required="true" name="hangsx" class="form-control">
                                        <option value="">THUỘC HÃNG SX</option>
                                        <option ng-repeat="cat in hangsx" value="{%cat.id%}">{%cat.name%}</option>

                                    </select>
                                    <span class="error" ng-show="formProduct.hangsx.$error.required && formProduct.hangsx.$touched">Vui lòng chọn danh mục</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Giá</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.price" ng-required="true" type="text" class="form-control price" name="price" value="{{old('price')}}" placeholder="Nhập giá sản phẩm" />
                                    <span class="error" ng-show="formProduct.price.$error.required && formProduct.price.$touched">Vui lòng nhập giá sản phẩm</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Giảm giá</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.discount" type="text" class="form-control" name="discount" placeholder="Phần trăm giảm giá" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ảnh sản phẩm</label>
                                <div class="col-sm-10">
                                    <input type="file" valid-file name="image" class="form-control upload_img" file-model="pro.img"/>
                                    <div class="show-img">
                                        <img style="width: 100px" src="{{asset('/public/upload/img/img_products')}}/{%pro.img%}" class="" alt="">
                                    </div>
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dung lượng Ram</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.memory" ng-required="true" type="text" class="form-control" name="memory" placeholder="Dung lượng RAM (Nhập số)" />
                                    <span class="error" ng-show="formProduct.memory.$error.required && formProduct.memory.$touched">Vui lòng nhập dung lượng ram</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tốc độ Bus</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.bus" ng-required="true" type="text" class="form-control" name="bus" placeholder="Dung lượng RAM (Nhập số)" />
                                    <span class="error" ng-show="formProduct.bus.$error.required && formProduct.bus.$touched">Vui lòng nhập dung lượng ram</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea ng-model="$pro.content" class="form-control" rows="5" name="content"  placeholder="Nhập mô tả"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace( 'content', {
                                            filebrowserBrowseUrl: '../../public/backend/js/ckfinder/ckfinder.html',
                                            filebrowserUploadUrl: '../../public/backend/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                                        } );
                                    </script>

                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="col-sm-2 control-label">Trạng thái</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.status" ng-required="true" type="radio" name="status" value="1" class="form-control" checked>Hiện
                                    <input ng-model="pro.status" ng-required="true" type="radio" name="status" value="0" class="form-control">Ẩn
                                    <span class="error" ng-show="formProduct.status.$error.required && formProduct.status.$touched">Vui lòng chọn trạng thái sản phẩm</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-primary" ng-disabled="formProduct.$invalid" ng-click="save(state,id)">{%button%}</button>
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
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('/public/backend/js/angular/ram.js')}}"></script>
@endsection