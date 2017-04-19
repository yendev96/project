
var app = angular.module('myApp', [
	'angular-flash.service',
	'angular-flash.flash-alert-directive',
	'ui.bootstrap',
	'angular-loading-bar',
	'checklist-model'
	]).constant('API','http://localhost:8888/project/backend/');

app.config(function($interpolateProvider,cfpLoadingBarProvider){
	$interpolateProvider.startSymbol('{%').endSymbol('%}');
	cfpLoadingBarProvider.includeSpinner = true;
	
});


app.directive('fileModel', ['$parse', function ($parse) {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			var model = $parse(attrs.fileModel);
			var modelSetter = model.assign;

			element.bind('change', function(){
				scope.$apply(function(){
					modelSetter(scope, element[0].files[0]);
				});
			});
		}
	};
}]);


app.directive('filesModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.filesModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files);
                });
            });
        }
    };
}]);


app.filter('pagination', function(){
   return function(data, start){
      return data.slice(start);
  }
});

app.controller('myController',function($scope,$http,API){

})


app.controller('asideController', function($scope,$http,API){




})