<?php
	
	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		if ($_POST['search'] == null){

			$sql = "SELECT `shopping_opportunities`.`id`, `shopping_opportunities`.`address`, `shopping_opportunities`.`phone`, `administrators`.`id` as `administratorId`, CONCAT(`administrators`.`surname`, ' ', `administrators`.`name`, ' ', `administrators`.`patronymic`) as `administratorName` FROM `shopping_opportunities` LEFT JOIN `administrators` ON `administrators`.`id_shop` = `shopping_opportunities`.`id` WHERE `shopping_opportunities`.`status` = '1';";

		}else{

			$sql = "SELECT `shopping_opportunities`.`id`, `shopping_opportunities`.`address`, `shopping_opportunities`.`phone`, `administrators`.`id` as `administratorId`, CONCAT(`administrators`.`surname`, ' ', `administrators`.`name`, ' ', `administrators`.`patronymic`) as `administratorName` FROM `shopping_opportunities` LEFT JOIN `administrators` ON `administrators`.`id_shop` = `shopping_opportunities`.`id` WHERE ((`shopping_opportunities`.`status` = '1') && ((`shopping_opportunities`.`id` = '".trim($_POST['search'])."') || (`shopping_opportunities`.`address` LIKE '%".trim($_POST['search'])."%')));";

		}

		require('../../db_connect.php');

		$shopListQuery = mysqli_query($link, $sql);
		$result['stasus'] = 'result';

		while ($shopListElem = mysqli_fetch_assoc($shopListQuery)){

			$result['list'][] = $shopListElem;

		}

		if (count($result['list']) == 0){
			$result['list'] == null;
		}

	}

	echo json_encode($result);

?>