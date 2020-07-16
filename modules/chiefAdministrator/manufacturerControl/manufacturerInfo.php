<?php

	require('../../db_connect.php');

	$result['status'] = false;
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$manufacturerQuery = mysqli_query($link, 'SELECT `name`, `information` FROM `manufacturer` WHERE `id` = '. (int) $_POST['id'].';');

	$result['result'] = mysqli_fetch_assoc($manufacturerQuery);

	$fileName = '../../../image/manufacturer/'.$result['result']['name'].'/logo.png';

	if (file_exists($fileName)){

		$result['img'] = 'image/manufacturer/'.$result['result']['name'].'/logo.png';

	}else{

		$result['img'] = null;

	}

	echo json_encode($result);

?>