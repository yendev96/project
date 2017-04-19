@extends('backend.layouts.master')
@section('title','Danh mục đã xóa')
@section('content')
<div flash-alert="success" active-class="in alert-flash flash-angular" class="fade ">
 <button type="button" class="close" ng-click="hide()">&times;</button>
 <strong class="alert-heading">Thông báo!</strong>
 <span class="alert-message" ng-bind="flash.message"></span>
</div>

<div class="content" ng-controller="categoryTrashController">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading myheading">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <h4><i class="fa fa-trash"></i>DANH MỤC ĐÃ XÓA<span class="count"></span></h4>
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
                        <p>Có <span style="color:red;font-size:20px">{%countsearch%}</span> kết quả được tìm thấy</p>
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
                                <th ng-click="sortData('name')">Name</th>
                                <th ng-click="sortData('keywords')">Keyworks</th>
                                <th ng-click="sortData('description')">Description</th>
                                <th ng-click="sortData('show_nav')">Show</th>
                                <th ng-click="sortData('cat_order')">Thứ tự</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="" ng-repeat="x in trashCat | orderBy: '-id'">
                                <td><input id='checkbox' type="checkbox" value=""></td>
                                <td>{%x.name%}</td>
                                <td>{%x.keywords%}</td>
                                <td>{%x.description%}</td>
                                <td>
                                    <div ng-if="x.show_nav == 1">
                                        <span>Có</span>
                                    </div>
                                    <div ng-if="x.show_nav == 0">
                                        <span>Không</span>
                                    </div>
                                </td>
                                <td>{%x.cat_order%}</td>
                                <td class="td-action" class="td-action">
                                    <a data-toggle="tooltip" title="Khôi phục danh mục này" href="" ng-click="modalCategorys('recovery', x.id)"><i class="fa fa-refresh"></i></a>
                                    <a data-toggle="tooltip" title="Xóa vĩnh viễn" href="" ng-click="modalCategorys('delete', x.id)"><i class="fa fa-trash-o"></i></a>
                                    
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
        <!-- /panel-body -->


        <div class="modal fade" id="confirmRc" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">{%title_trash%}</h4>
                  </div>
                  <div class="modal-body">
                      <p>{%text_trash%}</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-success" ng-click="recovery(state,idrC)">Có</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>

              </div>
          </div>
      </div>

    <!-- /panel-default -->
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('/public/backend/js/angular/trash.js')}}"></script>
@endsection
