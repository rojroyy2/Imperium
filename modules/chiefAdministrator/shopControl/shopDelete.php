<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$shopQuery = mysqli_query($link, 'UPDATE `shopping_opportunities` SET `status` = "0" WHERE `shopping_opportunities`.`id` = '.$_POST['id'].';');

		if ($shopQuery == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'error';

		}

	}

	echo json_encode($result);

?>