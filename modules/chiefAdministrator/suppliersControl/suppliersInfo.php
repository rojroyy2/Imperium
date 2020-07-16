<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$result['info'] = mysqli_fetch_assoc(mysqli_query($link, 'SELECT * FROM `suppliers` WHERE `id` = '.$_POST['id'].';'));

		$result['status'] = 'result';
		
	}

	echo json_encode($result);

?>