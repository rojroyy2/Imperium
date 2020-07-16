<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$search = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `orders`.`status` as `status`, `goods`.`id` as `local`, `goods`.`bar_code` as `bar`, `goods`.`name` as `name`, `sales`.`number` as `count` FROM `orders` LEFT JOIN `sales` ON `orders`.`sales` = `sales`.`id` LEFT JOIN `accounting` ON `accounting`.`id` = `sales`.`accouting_id` LEFT JOIN `goods` ON `goods`.`id` = `accounting`.`goods_id` WHERE ((`orders`.`id` = '.(int) trim($_POST['search']).')&&(`orders`.`shop_id` = '.$shop['id'].'));'));

		if (isset($search['local'])){

			$result['status'] = 'result';
			$result['info'] = $search;
			$result['info']['orderId'] = (int) trim($_POST['search']);

		}else{

			$result['status'] = 'none';

		}

	}

	echo json_encode($result);

?>