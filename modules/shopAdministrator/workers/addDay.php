<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$date = date("y-m-d");

		$workerDayQuery = mysqli_query($link, 'INSERT INTO `workerDay` (`id`, `worker`, `root`, `date`, `begin`, `end`) VALUES (NULL, '.(int) $_POST['id'].', '.(int) $_POST['root'].', "'.$date.'", "'.$_POST['begin'].'", "'.$_POST['end'].'");');

		if ($workerDayQuery == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	echo json_encode($result);

?>