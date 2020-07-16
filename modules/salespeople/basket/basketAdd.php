<?php

	require('../../sessionChange.php');

	if (sessionChange(3) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require ('../../db_connect.php');

		$salespeopleId = $_SESSION['id'];

		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `shop_id` as `id` FROM `salespeople` WHERE `id` = '.$salespeopleId.';'));

		$tovarQuery = mysqli_query($link, 'SELECT `goods`.`id` as `local`, `goods`.`bar_code` as `barCode`, `goods`.`name` as `name`, `manufacturer`.`name` as `manufacturer`, `goods`.`price` as `price`, SUM(`accounting`.`residue`) as `maxCount` FROM `accounting` LEFT JOIN `goods` ON `goods`.`id` = `accounting`.`goods_id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` WHERE ((`goods`.`id` = '. (int) $_POST['code'] .')&&(`accounting`.`warehouse_id` = '. (int) $shop['id'] .'));');

		$tovar = mysqli_fetch_assoc($tovarQuery);
		$discountQuery = mysqli_query($link, 'SELECT `discount`.`discount` FROM `discount` WHERE `discount`.`tovarId` = '. (int) $_POST['code'] .';');
		$discount = mysqli_fetch_assoc($discountQuery);

		if (isset($discount['discount'])){

			$tovar['price'] = round($tovar['price'] - ($tovar['price'] / 100 * $discount['discount']));

		}

		if ($tovar['maxCount'] == 0){

			$result['status'] = 'tovarNot';
			echo json_encode($result);
			exit();

		}

		$result['tovar'] = $tovar;

		if ($tovar['maxCount'] < $_POST['count']){

			$result['status'] = 'countError';
			
		}else{

			$result['status'] = 'good';

		}

		echo json_encode($result);

	}

?>