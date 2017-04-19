@extends('backend.layouts.master')
@section('title','Danh sách laptop')
@section('content')
<div class="content" ng-controller="laptopController">
    <div flash-alert="success" active-class="in alert-flash flash-angular" class="fade ">
     <button type="button" class="close" ng-click="hide()">&times;</button>
     <strong class="alert-heading">Thông báo!</strong>
     <span class="alert-message" ng-bind="flash.message"></span>
 </div>
 <div class="row">
    <div class="panel panel-default">
        <div class="panel-heading myheading">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <h4><i class="fa fa-users"></i>QUẢN LÝ LAPTOP</h4>
            </div>

            <div class="right-heading">

                <a href="javascript:void(0)" class="btn btn-primary" title="" ng-click="modalLaptop('addLaptop')"><i class="fa fa-plus"></i>Thêm mới</a>
                <button type="button" class="btn btn-danger btn-delete-checkall" ng-click="modalDeletes()"><i class="fa fa-trash-o"></i>XÓA</button>

            </div>
        </div>
        <!-- / panel-heading myheading -->
        <div class="panel-body">
            <div class="row row-filter ">

                <div class="col-md-3 col-xs-7 box-search">
                    <input type="text" class="form-control timkiemten" name="s" placeholder="Nhập thông tin sản phẩm..." ng-model="tk.name" ng-keyup="searchLaptop()">
                </div>
                <div class="col-md-2 col-xs-7 box-search">
                    <select class="form-control" name="searchbyhangsx" ng-model="tk.id_hangsx">
                        <option value="">Hãng sản xuất</option>
                        <option ng-repeat="x in hangsx" value="{%x.id%}" ng-bind="x.name"></option>}
                    </select>
                </div>
                <div class="col-md-2 col-xs-7 box-search">
                    <select class="form-control" name="searchbyhangram" ng-model="tk.value_ram">
                        <option value="">RAM</option>}
                        <option ng-repeat="y in listram" value="{%y.memmory%}" ng-bind="y.name"></option>
                    </select>
                </div>
                <div class="col-md-2 col-xs-7 box-search">
                    <select class="form-control" name="searchbyhangcpu" ng-model="tk.value_cpu">
                        <option value="">CPU</option>
                        <option ng-repeat="x in listcpu" value="{%x.value%}" ng-bind="x.name"></option>
                    </select>
                </div>
                <div class="col-md-2 col-xs-7 box-search">
                    <select class="form-control" name="searchbyhangcpu" ng-model="tk.value_hard_drive">
                        <option value="">Ổ cứng</option>
                        <option ng-repeat="x in listocung" value="{%x.hard_drive%}" ng-bind="x.name"></option>
                    </select>
                </div>
            </div>
            <!-- / row-filter -->
            <div class="main-table">
                <table id="example2" class="table table-bordered tbl-admin">
                    <thead>
                        <tr>
                            <th><input id="checkall" type="checkbox"></th>
                            <th class="th-username">Thông tin sản phẩm</th>
                            <th class="th-username">Hãng SX</th>
                            <th class="th-username">Người đăng</th>
                            <th class="th-username">Trạng thái</th>
                            <th class="th-action">Hành động</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="" ng-repeat="x in listlaptop | orderBy:sortColumn:reverse | orderBy: '-id' | filter:tk">
                            <td><input id='checkbox' type="checkbox" ng-model="x.selected" value="{%x.id%}"></td>
                            <td>
                                <div class="row img_product">
                                    <img style="width: 120px; height:auto;" src="{{asset('/public/upload/img/img_products')}}/{%x.img%}" alt="">
                                </div>
                                <div class="row title-product">
                                    <p ng-bind="x.name"><a href="{{url('product/detail')}}/{%x.id%}" title=""></a></p>
                                </div>
                                <div class="row info-product">
                                    <i class="fa fa-eye"></i><span ng-bind="x.view"></span>
                                    <i class="fa fa-money"></i><span ng-bind="x.price"></span>
                                    <i class="fa fa-long-arrow-down"></i><span ng-bind="x.discount"></span>
                                </div>
                            </td>
                            
                            <td ng-bind="x.name_hangsx">

                            </td>
                            <td>
                                <span style="color:red;font-weight: bold;">{%x.author%}</span>
                            </td>
                            <td>
                                <div ng-if="x.status == 1">
                                    <span>Hiện</span>
                                </div>
                                <div ng-if="x.status == 0">
                                    <span>Ẩn</span>
                                </div>
                            </td>
                            <td class="td-action" class="td-action">
                                <a data-toggle="tooltip" href="javascript:void(0)" ng-click="modalLaptop('editLaptop', x.id)"><i class="fa fa-pencil-square icon-edit"></i></a>
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

<div class="modal fade" id="confirmDeletes" role="dialog">
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
              <button type="button" class="btn btn-success" ng-click="deletes()">Xóa</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

      </div>
  </div>
</div>

<div id="modalLaptop" class="modal fade" role="dialog">
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
                                    <select ng-model="pro.id_category" ng-required="true" name="category" class="form-control" ng-change="changeCategory(pro.id_category)">
                                        <option value="">THUỘC DANH MỤC</option>
                                        <option ng-repeat="cat in cats" value="{%cat.id%}" ng-selected="cat.id == pro.id_category">{%cat.name%}</option>

                                    </select>
                                    <span class="error" ng-show="formProduct.category.$error.required && formProduct.category.$touched">Vui lòng chọn danh mục</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mặt hàng</label>
                                <div class="col-sm-10">
                                    <select ng-model="pro.id_mathang" ng-required="true" name="mathang" class="form-control"  ng-change="changeMathang(pro.id_mathang)">
                                        <option value="">THUỘC MẶT HÀNG</option>
                                        <option ng-repeat="cat in mathang" value="{%cat.id%}" ng-selected="cat.id == pro.id_mathang">{%cat.name%}</option>
                                    </select>
                                    <span class="error" ng-show="formProduct.mathang.$error.required && formProduct.mathang.$touched">Vui lòng chọn danh mục</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Hãng sản xuất</label>
                                <div class="col-sm-10">
                                    <select ng-model="pro.id_hangsx" ng-required="true" name="hangsx" class="form-control">
                                        <option value="">THUỘC HÃNG SX</option>
                                        <option ng-repeat="cat in hangsx" value="{%cat.id%}" ng-selected="cat.id == pro.id_hangsx">{%cat.name%}</option>

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
                                <label class="col-sm-2 control-label">Màu sản phẩm</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.color" ng-required="true" type="text" class="form-control" name="color" value="{{old('color')}}" placeholder="Màu sản phẩm" />
                                    <span class="error" ng-show="formProduct.color.$error.required && formProduct.color.$touched">Vui lòng nhập màu sản phẩm</span>
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
                            <label class="col-sm-2 control-label">Ảnh kèm theo</label>
                                <div class="col-sm-10">
                                    <input type="file" name="images" class="form-control upload_imgs" files-model="imgs" multiple>
                                    <div class="row show-imgs">
                                        <img ng-repeat="imgs in images" src="{{asset('/public/upload/img/img_products/hihi')}}/{%imgs.name%}" alt="" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ram</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.ram" ng-required="true" type="text" class="form-control" name="ram" placeholder="Dung lượng RAM (Nhập số)" />
                                    <span class="error" ng-show="formProduct.ram.$error.required && formProduct.ram.$touched">Vui lòng nhập dung lượng ram</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dung lượng RAM</label>
                                <div class="col-sm-10">
                                    <select name="" class="form-control" ng-model="pro.value_ram">
                                        <option value="">Chọn dung lượng RAM</option>
                                        <option value="2" ng-selected="pro.value_ram == 2">2GB</option>
                                        <option value="4" ng-selected="pro.value_ram == 4">4GB</option>
                                        <option value="8" ng-selected="pro.value_ram == 8">8GB</option>
                                        <option value="16" ng-selected="pro.value_ram == 16">16GB</option>
                                        <option value="32" ng-selected="pro.value_ram == 32">32GB</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ổ cứng</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.hard_drive" type="text" class="form-control" name="hard_drive" value="{{old('memory')}}" placeholder="Dung lượng bộ nhớ" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dung lượng ổng cứng</label>
                                <div class="col-sm-10">
                                    <select name="" class="form-control" ng-model="pro.value_hard_drive">
                                        <option value="">Chọn ổ cứng</option>
                                        <option value="120" ng-selected="pro.value_hard_drive == 120">120GB</option>
                                        <option value="250" ng-selected="pro.value_hard_drive == 250">250GB</option>
                                        <option value="500" ng-selected="pro.value_hard_drive == 500">500GB</option>
                                        <option value="1000" ng-selected="pro.value_hard_drive == 1000">1TB</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CPU</label>
                                <div class="col-sm-10">
                                    <input ng-model="pro.cpu" ng-required="true" type="text" class="form-control" name="cpu" value="{{old('cpu')}}" placeholder="Tên và tốc độ CPU" />
                                    <span class="error" ng-show="formProduct.cpu.$error.required && formProduct.cpu.$touched">Vui lòng nhập thông tin về cpu</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                               <label class="col-sm-2 control-label">CPU</label>
                               <div class="col-sm-10">
                                <select name="" class="form-control" ng-model="pro.value_cpu">
                                    <option value="">Chọn CPU</option>
                                    <option value="i3" ng-selected="pro.value_cpu == i3">CPU i3</option>
                                    <option value="i5" ng-selected="pro.value_cpu == i5">CPU i5</option>
                                    <option value="i7" ng-selected="pro.value_cpu == i7">CPU i7</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea ng-model="pro.content" class="form-control" rows="5" name="content"  placeholder="Nhập mô tả"></textarea>
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
                                <button type="button" class="btn btn-primary" ng-disabled="formProduct.$invalid" ng-click="save(state,id)">{%submit%}</button>
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
<script type="text/javascript" src="{{asset('/public/backend/js/angular/laptop.js')}}"></script>
@endsection

