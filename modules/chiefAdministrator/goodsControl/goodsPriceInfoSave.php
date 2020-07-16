<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		if (!isset($_POST['id'])){
			
			$result['status'] = 'dbError';
			echo json_encode($result);
			exit();

		}

		require('../../db_connect.php');

		$priceQuery = mysqli_query($link, 'UPDATE `goods` SET `price` = "'.$_POST['price'].'" WHERE `id` = '.$_POST['id'].';');

		if (($_POST['discount'] == 0)||(!isset($_POST['discount']))||(gettype($_POST['discount']) != 'integer')||(gettype($_POST['discount']) == 'NULL')){

			$discountQuery = mysqli_query($link, 'DELETE FROM `discount` WHERE `discount`.`tovarId` = '.$_POST['id'].';');

		}else{

			$discountChange = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `tovarId`FROM `discount` WHERE `tovarId` = '.$_POST['id'].';'));

			if (isset($discountChange['tovarId'])){

				$discountQuery = mysqli_query($link, 'UPDATE `discount` SET `discount` = '.$_POST['discount'].', `until` = "'.$_POST['until'].'" WHERE `discount`.`tovarId` = '.$_POST['id'].';');

			}else{

				$discountQuery = mysqli_query($link, 'INSERT INTO `discount` (`tovarId`, `discount`, `until`) VALUES ('.$_POST['id'].', '.$_POST['discount'].', "'.$_POST['until'].'");');

			}			

		}		

		if (($priceQuery == true)&&($discountQuery == true)){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';

		}

	}

	echo json_encode($result);

?>