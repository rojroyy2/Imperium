<?php

	$_POST = json_decode(file_get_contents('php://input'), true);

	require('../../db_connect.php');

	$materialQuery = mysqli_query($link, 'SELECT * FROM `material` WHERE ((`name` LIKE "%'.$_POST['search'].'%") || (`id` = "%'.$_POST['search'].'%"));');

	while ($material = mysqli_fetch_assoc($materialQuery)){

		$result['list'][] = $material;

	}

	if (count($result['list']) == 0){

		$result['status'] = "null";

	}else{

		$result['status'] = 'result';

	}

	echo json_encode($result);

?>