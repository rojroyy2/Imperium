<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$status = mysqli_query($link, 'UPDATE `orders` SET `status` = 1 WHERE `id` = '.(int) $_POST['id'].';');

		if ($status == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	$result['pay'] = null;
	
	echo json_encode($result);

?>