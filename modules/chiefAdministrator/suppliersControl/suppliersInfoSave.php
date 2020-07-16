<?php

	require('../../sessionChange.php');

	if (sessionChange() == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		require('../../user/phoneChange.php');

		if (gettype($_POST['id']) == 'NULL'){

			if (phoneChange($_POST['phone'], 0, 0) == false){

				$result['status'] = 'phoneError';
				echo json_encode($result);
				exit();

			}

			$suppliersQuery = mysqli_query($link, 'INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `information`) VALUES (NULL, "'.$_POST['name'].'", "'.$_POST['address'].'", "'.$_POST['phone'].'", "'.$_POST['information'].'");');

		}else{

			if (phoneChange($_POST['phone'], 'suppliers', $_POST['id']) == false){

				$result['status'] = 'phoneError';
				echo json_encode($result);
				exit();

			}

			$suppliersQuery = mysqli_query($link, 'UPDATE `suppliers` SET `information` = "'.$_POST['information'].'", `name` = "'.$_POST['name'].'", `address` = "'.$_POST['address'].'", `phone` = "'.$_POST['phone'].'" WHERE `suppliers`.`id` = '.$_POST['id'].';');

		}

	}

	if ($suppliersQuery == true){

		$result['status'] = 'good';

	}else{

		$result['status'] = 'dbError';

	}

	echo json_encode($result);

?>