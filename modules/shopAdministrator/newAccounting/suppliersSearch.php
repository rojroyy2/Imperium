<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$sup = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `name` FROM `suppliers` WHERE `id` = '.(int) trim($_POST['id']).';'));

		if (!isset($sup['name'])){

			$result['status'] = 'none';

		}else{

			$result['status'] = 'result';
			$result['name'] = $sup['name'];

		}

	}

	echo json_encode($result);

?>