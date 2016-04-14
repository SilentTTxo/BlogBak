<?php
/*
$data = "mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=app_silenttt";
$db = new PDO($data,SAE_MYSQL_USER,SAE_MYSQL_PASS);
*/
$data = "mysql:host=".SAE_MYSQL_HOST_M.";port=".SAE_MYSQL_PORT.";dbname=app_silenttt";
$db = new PDO($data,SAE_MYSQL_USER,SAE_MYSQL_PASS);
if(isset($_GET['type'])){
	if($_GET['type']=="index"){
		$count = $db->query("SELECT * FROM `Blogs` ORDER BY time DESC");
		echo json_encode($count->fetchAll());
	}
	if($_GET['type']=="Del"){
		$count = $db->query("DELETE from `Blogs` where names = '{$_GET['name']}'");
		echo "ok";
	}
}
//upload data
$params = json_decode(file_get_contents('php://input'),true);
if(isset($params['name'])){
	$params['content']=strtr($params['content'],"'","\'");
	$count = $db->query("INSERT INTO `Blogs` (names,time,type,Content) values ('{$params['name']}',now(),'{$params['type']}','{$params['content']}')");
	echo "INSERT INTO `Blogs` (names,time,type,Content) values ('{$params['name']}',now(),'{$params['type']}','{$params['content']}')";
}
if(isset($_GET['cmd'])){
	if($_GET['cmd']=="Blog"){
		if(isset($_GET['type'])){
			$count = $db->query("SELECT `names`,`time` FROM `Blogs` WHERE type = '{$_GET['type']}' ORDER BY time DESC");
			echo json_encode($count->fetchAll());
		}
		if(isset($_GET['name'])){
			$count = $db->query("SELECT * FROM `Blogs` WHERE names = '{$_GET['name']}'");
			echo json_encode($count->fetchAll());
		}
	}
}
?>