<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		if (gettype($_POST['id']) == 'NULL'){

			$sportQuery = mysqli_query($link, 'INSERT INTO `views_sport` (`id`, `name`) VALUES (NULL, "'.$_POST['name'].'");');

		}else{

			$sportQuery = mysqli_query($link, 'UPDATE `views_sport` SET `name` = "'.$_POST['name'].'" WHERE `id` = '.$_POST['id'].';');

		}

	}

	if ($sportQuery == true){

		$result['status'] = 'good';

	}else{

		$result['status'] = 'dbError';

	}

	echo json_encode($result);

?>