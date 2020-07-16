<?php

	require('../../db_connect.php');

	$result['status'] = false;
	
	$_POST = json_decode(file_get_contents('php://input'), true);

	$manufacturerQuery = mysqli_query($link, "SELECT `id`, `name`, SUBSTRING(`information`, 1, 110) as `information` FROM `manufacturer` WHERE ((`manufacturer`.`id` LIKE '%".$_POST['search']."%')||(`manufacturer`.`name` LIKE '%".$_POST['search']."%'));");

	while ($manufacturer = mysqli_fetch_assoc($manufacturerQuery)){

		$result['list'][] = $manufacturer;

	}

	if(count($result['list']) != 0){

		$result['status'] = true;

	}

	echo json_encode($result);

?>