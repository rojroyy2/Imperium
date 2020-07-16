<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require ('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		if (strlen($_POST['comment']) == 0){

			$result['status'] = 'commentError';
			echo json_encode($result);
			exit();

		}

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$accounting = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `residue` FROM `accounting` WHERE ((`id` = '.(int) $_POST['part'] .')&&(`warehouse_id` = '.$shop['id'].'));'));

		if(!isset($accounting['residue'])){

			$result['status'] = 'dbError';
			echo json_encode($result);
			exit();

		}

		if ($accounting['residue'] < ((int) $_POST['count'])||(strlen($_POST['count']) == 0)){

			$result['status'] = 'countError';
			echo json_encode($result);
			exit();

		}

		$offsTovarQuery = mysqli_query($link, 'INSERT INTO `offsTovar` (`id`, `accounting_id`, `administratorId`, `count`, `date`, `comments`) VALUES (NULL, '.(int) $_POST['part'] .', '.$administratorId.', '.(int) $_POST['count'].', CURRENT_TIMESTAMP, "'.$_POST['comment'].'");');

		if ($offsTovarQuery == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	echo json_encode($result);

?>