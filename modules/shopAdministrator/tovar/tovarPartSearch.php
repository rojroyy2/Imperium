<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require ('../../db_connect.php');

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$_POST = json_decode(file_get_contents('php://input'), true);

		$partQuery = mysqli_query($link, 'SELECT `accounting`.`id` as `part`, `accounting`.`residue` as `residue`, `goods`.`id` as `local`, `goods`.`bar_code` as `bar`, `goods`.`name` as `name`, `accounting`.`delivery_date` as `delivery`, `accounting`.`production_date` as `production` FROM `accounting` LEFT JOIN `goods` ON  `goods`.`id` = `accounting`.`goods_id` WHERE ((`goods`.`'.$_POST['type'].'` = '.trim($_POST['search']).')&&(`accounting`.`warehouse_id` = '.$shop['id'].')&&(`accounting`.`residue` > 0));');

		while ($part = mysqli_fetch_assoc($partQuery)){

			$result['list'][] = $part;

		}

		if (count($result['list']) == 0){

			$result['status'] = 'none';

		}else{

			$result['status'] = 'result';

		}

	}

	echo json_encode($result);

?>