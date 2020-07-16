<?php

	require('../sessionChange.php');

	if (sessionChange(4) == false){

		$result['status'] = 'autorisationError';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require ('../db_connect.php');

		$id = $_SESSION['id'];

		$change = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id` FROM `basket` WHERE ((`buyers_id` = '.$id.')&&(`goods_id` = '.(int) $_POST['goods'].'))'));

		if (!isset($change['id'])){

			$basket = mysqli_query($link, 'INSERT INTO `basket` (`id`, `buyers_id`, `goods_id`, `count`) VALUES (NULL, '.$id.', '.(int) $_POST['goods'].', NULL);');

		}else{

			$basket = true;

		}

		if ($basket == true){
			
			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	echo json_encode($result);

?>