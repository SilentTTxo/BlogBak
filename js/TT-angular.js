var routeApp = angular.module('BlogIndex',['ngRoute']);  
routeApp.config(['$routeProvider',function ($routeProvider) {  
	$routeProvider  
	.when('/Code', {  
		templateUrl: 'html/Blog.html',  
		controller: 'Code'  
	}) 
	.when('/Music', {  
		templateUrl: 'html/Blog.html',  
		controller: 'Music'  
	})
	.when('/Game', {  
		templateUrl: 'html/Blog.html',  
		controller: 'Game'  
	}) 
	.otherwise({  
		redirectTo: '/'  
	});  
}]);
routeApp.controller('Code',function($scope,$http){
	$http.get("data.php?cmd=Blog&&type=Code").success(function(response) {
		$scope.Blogs = response;
	});
})
routeApp.controller('Music',function($scope,$http){
	$http.get("data.php?cmd=Blog&&type=Music").success(function(response) {
		$scope.Blogs = response;
	});
})
routeApp.controller('Game',function($scope,$http){
	$http.get("data.php?cmd=Blog&&type=Game").success(function(response) {
		$scope.Blogs = response;
	});
})
