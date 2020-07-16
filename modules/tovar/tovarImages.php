<?php
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	require ('../db_connect.php');
	$folder = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `name` FROM `goods` WHERE `id` = '.(int) $_POST['tovarId'].';'));

	$tovar_url = scandir("../../image/goods/". md5($folder['name']) .'/');

	for ($i = 2; $i < count($tovar_url); $i++){

		$result['imageList'][] = 'image/goods/'. md5($folder['name']) .'/'. $tovar_url[$i];

	}

	echo json_encode($result);

?>