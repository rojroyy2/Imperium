<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../user/phoneChange.php');

		if ($_POST['id'] == null){

			// Регистрация нового магазина
			
			if (phoneChange($_POST['phone'], null, null) == true){

				$sql = 'INSERT INTO `shopping_opportunities` (`id`, `address`, `phone`, `status`) VALUES (NULL, "'.trim($_POST['address']).'", "'.trim($_POST['phone']).'", "1")';

				require('../../db_connect.php');

				$shopQuery = mysqli_query($link, $sql);

				if ($shopQuery == true){

					$result['status'] = 'good';

				}else{

					$result['status'] = 'error';

				}

			}else{

				$result['status'] = 'phoneError';

			}

		}else{
			
			// Обновление информации об уже сущевствующем магазине

			if (phoneChange($_POST['phone'], 'shopping_opportunities', $_POST['id']) == true){

				$sql = 'UPDATE `shopping_opportunities` SET `phone` = "'.trim($_POST['phone']).'", `address` = "'.trim($_POST['address']).'" WHERE `shopping_opportunities`.`id` = '.$_POST['id'].';';

				require('../../db_connect.php');

				$shopQuery = mysqli_query($link, $sql);

				if ($shopQuery == true){

					$result['status'] = 'good';

				}else{

					$result['status'] = 'error';

				}

			}else{

				$result['status'] = 'phoneError';

			}

		}

	}

	echo json_encode($result);

?>