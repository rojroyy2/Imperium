<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$listQuery = mysqli_query($link, 'SELECT `orders`.`shop_id` as `shop`, `goods`.`id` as `local`, `goods`.`bar_code` as `bar`, `accounting`.`id` as `part`, `manufacturer`.`name` as `manufacturer`, `orders`.`id` as `order`, `sales`.`number` as `count`, `goods`.`name` as `name` FROM `orders` LEFT JOIN `sales` ON `sales`.`id` = `orders`.`sales` LEFT JOIN `accounting` ON `accounting`.`id` = `sales`.`accouting_id` LEFT JOIN `goods` ON `goods`.`id` = `accounting`.`goods_id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` WHERE ((`accounting`.`warehouse_id` = '.$shop['id'].') && (`orders`.`status` = 0))');

		while ($listElem = mysqli_fetch_assoc($listQuery)){

			$result['list'][] = $listElem;

		}

		if (count($result['list']) == 0){

			$result['status'] = 'none';

		}else{

			$result['status'] = 'result';

		}

	}

	echo json_encode($result);

?>