<?php

	$_POST = json_decode(file_get_contents('php://input'), true);

	require('../../db_connect.php');

	$sportQuery = mysqli_query($link, 'SELECT * FROM `views_sport` WHERE `name` LIKE "%'.$_POST['search'].'%";');

	while ($sport = mysqli_fetch_assoc($sportQuery)){

		$result['list'][] = $sport;

	}

	if (count($result['list']) == 0){

		$result['status'] = "null";

	}else{

		$result['status'] = 'result';

	}

	echo json_encode($result);

?>