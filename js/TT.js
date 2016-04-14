$(document).ready(function(){
  $("img#tx").mouseover(function(){
    $(this).animate({
      width:"100"
    })
  })
})
$(document).ready(function(){
  $("img#tx").mouseout(function(){
    $(this).animate({
      width:"50"
    })
  })
})
function BlogController($scope,$http) {
	url="data.php?type="+Lb;
	$http.get(url).success(function(response) {
		$scope.Blog = response;
	});
}
$(document).ready(function(){
  $("h2.DX").mouseover(function(){
    $(this).animate({
      fontSize:'40px'
    },"fast")
  })
})
$(document).ready(function(){
  $("h2.DX").mouseout(function(){
    $(this).animate({
      fontSize:'30px'
    },"fast")
  })
})

