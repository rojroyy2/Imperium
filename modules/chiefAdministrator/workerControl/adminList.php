<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$search = trim($_POST['search']);

		$sql = 'SELECT `administrators`.`id`, CONCAT(`administrators`.`surname`, " ",`administrators`.`name`, " ",`administrators`.`patronymic`) as `fio`, `access`.`phone`, `administrators`.`residential_address`, `administrators`.`base_salary`, `administrators`.`id_shop` FROM `administrators` LEFT JOIN `access` ON `access`.`id` = `administrators`.`access` WHERE ((`access`.`phone` = "'.$search.'") || (`administrators`.`id` = "'.$search.'") || (`administrators`.`residential_address` LIKE "%'.$search.'%") || (`administrators`.`surname` LIKE "%'.$search.'%") || (`administrators`.`name` LIKE "%'.$search.'%") || (`administrators`.`patronymic` LIKE "%'.$search.'%"))';

		if ($_POST['shop'] == 'freedom'){

			$sql = $sql . ' && (`administrators`.`id_shop` IS NULL);';

		}else{

			$sql = $sql . ';';

		}

		$adminQuery = mysqli_query($link, $sql);

		while ($admin = mysqli_fetch_assoc($adminQuery)){

			$result['list'][] = $admin;

		}

		$result['status'] = 'good';

		if (count($result['list']) == 0){

			$result['status'] = null;

		}

	}

	echo json_encode($result);

?>