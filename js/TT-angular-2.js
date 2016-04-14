var type="Code";
var routeApp = angular.module('BlogIndex',[]);
routeApp.controller('BlogController',function($scope, $http,$rootScope,$sce){
	$rootScope.load=true;
	$http.get("data.php?cmd=Blog&&type="+type).success(function(response) {
		$scope.Blogs = response;
		$rootScope.load=false;
	});
	$scope.QH=function(xtype){
		$rootScope.load=true;
		$http.get("data.php?cmd=Blog&&type="+xtype).success(function(response) {
			$scope.Blogs = response;
			$rootScope.load=false;
		});
		delete $scope.x;
	}
	$scope.WB=function(obj){
		delete $scope.Blogs;
		$rootScope.load=true;
		$http.get("data.php?cmd=Blog&&name="+obj.names).success(function(response) {
			$scope.x = response[0];
			$scope.x.content=$sce.trustAsHtml($scope.x.content);
			$rootScope.load=false;
		});
	}
});