var routeApp = angular.module('Write',['ngRoute']);  
routeApp.config(['$routeProvider',function ($routeProvider) {  
    $routeProvider  
    .when('/', {  
        templateUrl: 'html/W.html',  
        controller: 'ctr'  
    })  
    .when('/ip', {  
        templateUrl: 'html/IP.html',  
        controller: 'ip'  
    }) 
    .when('/del', {  
        templateUrl: 'html/Del.html',  
        controller: 'Del'  
    })   
    .otherwise({  
        redirectTo: '/'  
    });  
}]);
routeApp.controller('ctr',function($scope,$http,$rootScope){
    $rootScope.editor = new Simditor({
      textarea: $('#content')
  });
    $scope.x={};
    $scope.updata=function(){
        $scope.x.content=$rootScope.editor.getValue();
      console.log($scope.x);
      $http.post('data.php',$scope.x).success(function(data) {
         console.log(data);
     });
  }
})
routeApp.controller('ip',function($scope,$http,$rootScope){
    $rootScope.load=true;
    $http.get("data.php?type=ip")
    .success(function(response) {
        $scope.IPs = response;
        $rootScope.load=false;
    });
})
routeApp.controller('Del',function($scope,$http,$rootScope) {
	$scope.Delect=function(x){
        $rootScope.load=true;
        $http.get("data.php?type=Del&name="+x)
        .success(function(response) {
           alert(response)});
        $http.get("data.php?type=index")
        .success(function(response) {
            $scope.Dels = response;
            $rootScope.load=false;
        });
    }
    $rootScope.load=true;
    $http.get("data.php?type=index")
    .success(function(response) {
        $scope.Dels = response;
        $rootScope.load=false;
    });
})