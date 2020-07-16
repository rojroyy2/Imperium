<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$search = trim($_POST['search']);

		$sql = 'SELECT `salespeople`.`id`, CONCAT(`salespeople`.`surname`, " ",`salespeople`.`name`, " ",`salespeople`.`patronymic`) as `fio`, `access`.`phone`, `salespeople`.`residential_address`, `salespeople`.`base_salary`, `salespeople`.`shop_id` FROM `salespeople` LEFT JOIN `access` ON `access`.`id` = `salespeople`.`access` WHERE ((`access`.`phone` = "'.$search.'") || (`salespeople`.`id` = "'.$search.'") || (`salespeople`.`residential_address` LIKE "%'.$search.'%") || (`salespeople`.`surname` LIKE "%'.$search.'%") || (`salespeople`.`name` LIKE "%'.$search.'%") || (`salespeople`.`patronymic` LIKE "%'.$search.'%"))';

		if ($_POST['shop'] == 'freedom'){

			$sql = $sql . ' && (`salespeople`.`shop_id` IS NULL);';

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