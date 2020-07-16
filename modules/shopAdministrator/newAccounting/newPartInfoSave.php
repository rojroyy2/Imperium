<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		if (((int) $_POST['price']) <= 0){

			$result['status'] = 'priceError';
			echo json_encode($result);
			exit();

		}

		if (((int) $_POST['count']) <= 0){

			$result['status'] = 'countError';
			echo json_encode($result);
			exit();

		}

		if (!isset($_POST['sup'])){

			$result['status'] = 'supError';
			echo json_encode($result);
			exit();

		}

		if (!isset($_POST['goods'])){

			$result['status'] = 'goodsError';
			echo json_encode($result);
			exit();

		}

		if (!isset($_POST['date'])){

			$result['status'] = 'dateError';
			echo json_encode($result);
			exit();

		}

		if (!isset($_POST['sup'])){

			$result['status'] = 'supError';
			echo json_encode($result);
			exit();

		}else{

			$sup = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `name` FROM `suppliers` WHERE `id` = '.(int) trim($_POST['sup']).';'));

			if (!isset($sup['name'])){

				$result['status'] = 'supError';
				echo json_encode($result);
				exit();

			}

		}

		$accountingQuery = mysqli_query($link, 'INSERT INTO `accounting` (`id`, `goods_id`, `options`, `supplier_id`, `delivery_date`, `production_date`, `number`, `warehouse_id`, `purchase_price`, `residue`) VALUES (NULL, '.(int) $_POST['goods'].', '.(int) $_POST['optionsKey'].', '.(int) trim($_POST['sup']).', CURRENT_TIMESTAMP, "'.$_POST['date'].'", '.(int) $_POST['count'].', '.$shop['id'].', '.$_POST['price'].', '.(int) $_POST['count'].')');

		if ($accountingQuery == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	echo json_encode($result);

?>