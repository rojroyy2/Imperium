<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		if (!isset($_POST['root'])){

			$result['status'] = null;

		}else{

			switch ($_POST['root']) {
				case 2:
					$sql = 'SELECT `administrators`.`id` as `id`, `administrators`.`work_book_number`, `administrators`.`surname`, `administrators`.`name`, `administrators`.`patronymic`, `administrators`.`start_date`, `administrators`.`residential_address`, `administrators`.`base_salary`, `access`.`phone`, `access`.`email`, `shopping_opportunities`.`id` as `shopId`, `shopping_opportunities`.`address` as `shop` FROM `administrators` LEFT JOIN `access` ON `access`.`id` = `administrators`.`access` LEFT JOIN `shopping_opportunities` ON `shopping_opportunities`.`id` = `administrators`.`id_shop` WHERE `administrators`.`id` = '.$_POST['id'].';';
					break;
				case 3:
					$sql = 'SELECT `salespeople`.`id` as `id`, `salespeople`.`work_book_number`, `salespeople`.`surname`, `salespeople`.`name`, `salespeople`.`patronymic`, `salespeople`.`start_date`, `salespeople`.`residential_address`, `salespeople`.`base_salary`, `access`.`phone`, `access`.`email`, `shopping_opportunities`.`id` as `shopId`, `shopping_opportunities`.`address` as `shop` FROM `salespeople` LEFT JOIN `access` ON `access`.`id` = `salespeople`.`access` LEFT JOIN `shopping_opportunities` ON `shopping_opportunities`.`id` = `salespeople`.`shop_id` WHERE `salespeople`.`id` = '.$_POST['id'].';';
					break;
				default:
					$result['status'] = null;
					echo json_encode($result);
					exit();
					break;
			}

			$workerQuery = mysqli_query($link, $sql);
			$worker = mysqli_fetch_assoc($workerQuery);

			if (gettype($worker['shopId']) != 'NULL'){

				$shopId = $worker['shopId'];
				$sqlShop = 'SELECT `id`, CONCAT(`id`, " | ", `address`) as `name` FROM `shopping_opportunities` WHERE ((`status` = 1) && (`id` != '.$shopId.'));';

			}else{

				$sqlShop = 'SELECT `id`, CONCAT(`id`, " | ", `address`) as `name` FROM `shopping_opportunities` WHERE (`status` = 1);';

			}

			$shopListQuery = mysqli_query($link, $sqlShop);

			while ($shopList = mysqli_fetch_assoc($shopListQuery)){

				$result['shopList'][] = $shopList;

			}

			$result['info'] = $worker;
			$result['status'] = 'good';

		}

	}

	echo json_encode($result);

?>