<?php

	$_POST = json_decode(file_get_contents('php://input'), true);

	require('../../db_connect.php');

	$suppliersQuery = mysqli_query($link, 'SELECT `id`, `name`, `address`, `phone` FROM `suppliers` WHERE ((`name` LIKE "%'.$_POST['search'].'%") || (`address` LIKE "%'.$_POST['search'].'%") || (`phone` = "%'.$_POST['search'].'%") || (`id` = "%'.$_POST['search'].'%"));');

	while ($suppliers = mysqli_fetch_assoc($suppliersQuery)){

		$result['list'][] = $suppliers;

	}

	if (count($result['list']) == 0){

		$result['status'] = "null";

	}else{

		$result['status'] = 'result';

	}

	echo json_encode($result);

?>