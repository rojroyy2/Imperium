<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		if (gettype($_POST['id']) == 'NULL'){

			$materialQuery = mysqli_query($link, 'INSERT INTO `material` (`id`, `name`) VALUES (NULL, "'.$_POST['name'].'");');

		}else{

			$materialQuery = mysqli_query($link, 'UPDATE `material` SET `name` = "'.$_POST['name'].'" WHERE `material`.`id` = '.$_POST['id'].';');

		}

	}

	if ($materialQuery == true){

		$result['status'] = 'good';

	}else{

		$result['status'] = 'dbError';

	}

	echo json_encode($result);

?>