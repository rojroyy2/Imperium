<?php
	
	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		// Запрос для получения адреса магазина
		$shopQuery = mysqli_query($link, 'SELECT `address` FROM `shopping_opportunities` WHERE `id` = '.$_POST['id'].';');
		
		while ($shop = mysqli_fetch_assoc($shopQuery)){

			$result['shop'] = $shop['address'];

		}

		// Запрос для получения списка администраторов

		$adminQuery = mysqli_query($link, 'SELECT `administrators`.`id`, CONCAT(`administrators`.`surname`, " ",`administrators`.`name`, " ",`administrators`.`patronymic`) as `fio`, `access`.`phone`, `administrators`.`residential_address`, `administrators`.`base_salary`, `administrators`.`id_shop` FROM `administrators` LEFT JOIN `access` ON `access`.`id` = `administrators`.`access` WHERE `administrators`.`id_shop` = '.$_POST['id'].';');
		
		while ($admin = mysqli_fetch_assoc($adminQuery)){

			$result['adminList'][] = $admin;

		}

		// Запрос для получения списка продавцов

		$salesQuery = mysqli_query($link, 'SELECT `salespeople`.`id`, CONCAT(`salespeople`.`surname`, " ",`salespeople`.`name`, " ",`salespeople`.`patronymic`) as `fio`, `access`.`phone`, `salespeople`.`residential_address`, `salespeople`.`base_salary`, `salespeople`.`shop_id` FROM `salespeople` LEFT JOIN `access` ON `access`.`id` = `salespeople`.`access` WHERE `salespeople`.`shop_id` = '.$_POST['id'].';');
		
		while ($sales = mysqli_fetch_assoc($salesQuery)){

			$result['salesList'][] = $sales;

		}

		$result['status'] = 'good';

	}

	echo json_encode($result);

?>