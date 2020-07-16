<?php

	require('../../sessionChange.php');

	if (sessionChange(3) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$salespeopleId = $_SESSION['id'];

		$order = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `price`,`sales` FROM `orders` WHERE `id` = '. (int) $_POST['id'] .';'));

		$salesUpdate = mysqli_query($link, 'UPDATE `sales` SET `sale_price` = '.$order['price'].', `salespeoplees_id` = '.$salespeopleId.', `date_of_sale` = CURRENT_TIMESTAMP WHERE `id` = '. $order['sales'] .';');

		if ($salesUpdate == false){

			$result['status'] = 'dbError';
			echo json_encode($result);
			exit();

		}

		$ordersDelete = mysqli_query($link, 'DELETE FROM `orders` WHERE `id` = '. (int) $_POST['id'] .';');

		if ($orders == false){

			$result['status'] = 'dbError';
			echo json_encode($result);
			exit();

		}

		$result['status'] = 'good';

	}

	echo json_encode($result);

?>