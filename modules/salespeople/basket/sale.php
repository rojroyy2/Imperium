<?php

	require('../../sessionChange.php');

	if (sessionChange(3) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require ('../../db_connect.php');

		$salespeopleId = $_SESSION['id'];

		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `shop_id` as `id` FROM `salespeople` WHERE `id` = '.$salespeopleId.';'));

		forEach($_POST['basket'] as $tovar){

			$price = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `goods`.`price` as `price` FROM `goods` WHERE `goods`.`id` = '. (int) $tovar['local'] .';'));
			$discount = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `discount`.`discount` FROM `discount` WHERE `discount`.`tovarId` = '. (int) $tovar['local'] .';'));

			if (isset($discount['discount'])){

				$price['price'] = round($price['price'] - ($price['price'] / 100 * $discount['discount']));

			}

			if (($price['price'] * $tovar['count']) != $tovar['price']){

				$result['status'] = 'saleError';
				echo json_encode($result);
				exit();

			}

		}

		forEach($_POST['basket'] as $tovar){

			$parti = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id`  FROM `accounting` WHERE ((`residue` >= '. (int) $tovar['count'] .')&&(`warehouse_id` = '.(int) $shop['id'].')&&(`accounting`.`goods_id` = '. (int) $tovar['local'] .'));'));


			if (isset($parti['id'])){

				$saleQuery = mysqli_query($link, 'INSERT INTO `sales` (`id`, `accouting_id`, `number`, `sale_price`, `salespeoplees_id`, `date_of_sale`, `buyer_id`) VALUES (NULL, '. $parti['id'] .', "'. (int) $tovar['count'] .'", '. $tovar['price'] .', '. $salespeopleId.', CURRENT_TIMESTAMP, NULL);');

			}else{

				$residue = (int) $tovar['count'];
				residue($residue, $tovar, $link);

			}

		}

		$result['status'] = 'good';
		echo json_encode($result);
		exit();

	}

	$partiArray = [];

	function residue($residue, $tovar, $link){

		$p = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id`, `residue` FROM `accounting` WHERE ((`warehouse_id` = '.(int) $shop['id'].')&&(`residue` != 0)&&(`goods_id` = '. (int) $tovar['local'] .')) ORDER BY `id` LIMIT 1;'));

		if ($residue > $p['residue']){

			$saleQuery = mysqli_query($link, 'INSERT INTO `sales` (`id`, `accouting_id`, `number`, `sale_price`, `salespeoplees_id`, `date_of_sale`, `buyer_id`) VALUES (NULL, '. $p['id'] .', "'. $p['residue'] .'", '. $tovar['price'] .', '. $salespeopleId.', CURRENT_TIMESTAMP, NULL);');

			$residue = $residue - $p['residue'];

			residue($residue, $tovar, $link);

		}else{

			$saleQuery = mysqli_query($link, 'INSERT INTO `sales` (`id`, `accouting_id`, `number`, `sale_price`, `salespeoplees_id`, `date_of_sale`, `buyer_id`) VALUES (NULL, '. $p['id'] .', "'. $residue .'", '. $tovar['price'] .', '. $salespeopleId.', CURRENT_TIMESTAMP, NULL);');

			return true;

		}

	}

?>