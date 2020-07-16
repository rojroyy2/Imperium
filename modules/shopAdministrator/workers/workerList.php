<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$administratorsQuery = mysqli_query($link, 'SELECT `administrators`.`id` as `id`, CONCAT(`administrators`.`surname`, " ", `administrators`.`name`, " ", `administrators`.`patronymic`) as `fio`, `access`.`phone`, `administrators`.`residential_address` as `address`, `administrators`.`work_book_number` as `workbook` FROM `administrators` LEFT JOIN `access` ON `access`.`id` = `administrators`.`access` WHERE ((`id_shop` = '.$shop['id'].')&&((CONCAT(`surname`, " ", `name`, " ", `patronymic`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`surname`, " ", `patronymic`, " ", `name`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`name`, " ", `surname`, " ", `patronymic`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`name`, " ", `patronymic`, " ", `surname`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`patronymic`, " ", `name`, " ", `surname`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`patronymic`, " ", `surname`, " ", `name`) LIKE "%'.$_POST['search'].'%")));');

		while ($administrators = mysqli_fetch_assoc($administratorsQuery)){

			$administrators['root'] = 2;
			$administrators['works'] = 'Администратор';
			$result['list'][] = $administrators;

		}

		$salespeopleQuery = mysqli_query($link, 'SELECT `salespeople`.`id` as `id`, CONCAT(`salespeople`.`surname`, " ", `salespeople`.`name`, " ", `salespeople`.`patronymic`) as `fio`, `access`.`phone`, `salespeople`.`residential_address` as `address`, `salespeople`.`work_book_number` as `workbook` FROM `salespeople` LEFT JOIN `access` ON `access`.`id` = `salespeople`.`access` WHERE ((`shop_id` = '.$shop['id'].')&&((CONCAT(`surname`, " ", `name`, " ", `patronymic`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`surname`, " ", `patronymic`, " ", `name`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`name`, " ", `surname`, " ", `patronymic`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`name`, " ", `patronymic`, " ", `surname`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`patronymic`, " ", `name`, " ", `surname`) LIKE "%'.$_POST['search'].'%")||(CONCAT(`patronymic`, " ", `surname`, " ", `name`) LIKE "%'.$_POST['search'].'%")));');

		while ($salespeople = mysqli_fetch_assoc($salespeopleQuery)){

			$salespeople['root'] = 3;
			$salespeople['works'] = 'Продавец';
			$result['list'][] = $salespeople;

		}

		if (count($result['list']) == 0){

			$result['status'] = 'none';

		}else{

			$result['status'] = 'result';

		}

	}

	echo json_encode($result);

?>