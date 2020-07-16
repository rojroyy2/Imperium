<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$sendChange = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `orders`.`id` as `order` FROM `orders` LEFT JOIN `sales` ON `sales`.`id` = `orders`.`sales` LEFT JOIN `accounting` ON `accounting`.`id` = `sales`.`accouting_id` LEFT JOIN `goods` ON `goods`.`id` = `accounting`.`goods_id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` WHERE ((`accounting`.`warehouse_id` = '.$shop['id'].') && (`orders`.`status` = 0) && (`orders`.`id` = '.(int) $_POST['order'].'))'));

		if (!isset($sendChange['order'])){

			$result['status'] = 'dbError';
			echo json_encode($result);
			exit();

		}

		$send = mysqli_query($link, 'UPDATE `orders` SET `status` = 1 WHERE `id` = '.$sendChange['order'].';');

		if ($send == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	echo json_encode($result);

?>