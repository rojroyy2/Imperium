<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$order = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `payment`, `price`, `sales` FROM `orders` WHERE `id` = '.(int) $_POST['id'].';'));

		if ($order['payment'] == 1){
			$result['pay'] = $order['price'];
		}else{
			$result['pay'] = null;
		}

		$sales = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `accounting`.`goods_id`, `accounting`.`supplier_id`, `sales`.`number`, `accounting`.`production_date` FROM `accounting` LEFT JOIN `sales` ON `accounting`.`id` = `sales`.`accouting_id` WHERE `sales`.`id` = '.$order['sales'].';'));

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$accountingNew = mysqli_query($link, 'INSERT INTO `accounting` (`id`, `goods_id`, `supplier_id`, `delivery_date`, `production_date`, `number`, `warehouse_id`, `purchase_price`, `residue`) VALUES (NULL, '.$sales['goods_id'].', '.$sales['supplier_id'].', CURRENT_TIMESTAMP, "'.$sales['production_date'].'", '.$sales['number'].', '.$shop['id'].', NULL, '.$sales['number'].');');

		if ($accountingNew == false){

			$result['status'] = 'dbError';
			echo json_encode($result);
			exit();

		}

		$orderDelete = mysqli_query($link, 'DELETE FROM `orders` WHERE `id` = '.(int) $_POST['id'].';');

		if ($orderDelete == false){

			$result['status'] = 'dbError';
			echo json_encode($result);
			exit();

		}

		$salesDelete = mysqli_query($link, 'DELETE FROM `sales` WHERE `sales`.`id` = '.$order['sales'].';');

		if ($salesDelete == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	echo json_encode($result);

?>