<!DOCTYPE html>
<html ng-app="loginApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap-reset.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="{{asset('public/backend/js/validate.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('public/backend/css/login.css')}}">
    
</head>
<body class="wrapper-login" ng-controller="loginController">
    <?php //echo $pass = Hash::make('supper'); ?>
    <div class="container">
        <div class="row text-center title-login">
            <h2><i class="fa fa-lock" style="padding-right: 6px"></i>LOGIN CONTROLLER</h2>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 content-login">
                <div class="row">
                    @if(count($errors) > 0)
                    <div class="thongbaoloi text-center">
                        @foreach($errors->all() as $err)
                            <div class="alert alert-danger">
                                {{$err}}<br>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <form id="myform" name="formLogin" action="{{url('login')}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="email" name="email" value="{{old('email')}}" class="email form-control" id="email" ng-model="login.email" ng-required="true">
                        <span class="loginError" ng-show="formLogin.email.$error.required && formLogin.email.$touched">Email không để trống</span>
                        <span class="loginError" ng-show="formLogin.email.$error.email && formLogin.email.$touched">Vui lòng nhập đúng địa chỉ email</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" value="{{old('password')}}" class="password form-control" id="password" ng-model="login.password" required>
                        <span class="loginError" ng-show="formLogin.password.$error.required && formLogin.password.$touched">Vui lòng nhập password</span>
                    </div>
                    <div class="form-group remember-login">
                        <label><input type="checkbox"> Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary my-btn" ng-disabled="formLogin.$invalid" ng-click="login()">Đăng nhập vào hệ thống</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    var app = angular.module('loginApp', []);
    app.config(function($interpolateProvider){
        $interpolateProvider.startSymbol('{%').endSymbol('%}');
    
    });

    app.controller('loginController', function($scope, $http){
        
    })
    </script>
</body>
</html>