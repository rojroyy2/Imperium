<?php
	
	$_POST = json_decode(file_get_contents('php://input'), true);
	$_POST = $_POST['register'];

	$error = 0;
	$errorStr = '';

	// Проверка номера телефона

	require('../phoneChange.php');

	$phoneGoodFormat = trim(preg_replace('/[^0-9]/', '', $_POST['phone']));

	if (phoneChange($phoneGoodFormat, 0, 0) == false){

		$errorStr = "Номер телефона занят!";
		$error++;

	}

	// Проверка почты

	require('../emailChange.php');

	if (emailChange(trim($_POST['email']), 0) == false){

		$errorStr = "E-mail занят!";
		$error++;

	}

	// Проверка Логина

	require('../loginChange.php');

	if (loginChange(trim($_POST['login']), 0) == false){

		$errorStr = "Логин занят!";
		$error++;

	}

	if ($error == 0){{

		require('addAccess.php');

		$accessResalt = addAccess($_POST['login'], $_POST['password'], $phoneGoodFormat, $_POST['email'], 4);

		if ($accessResalt == false){

			$errorStr = 'Ошибка в базе данных!';

		}else{

			require('../../db_connect.php');

			$buyersQuery = mysqli_query($link, 'INSERT INTO `buyers` (`id`, `access`, `name`, `surname`, `patronymic`) VALUES (NULL, "'.$accessResalt.'", "'.trim($_POST['name']).'", "'.trim($_POST['surname']).'", "'.trim($_POST['patronymic']).'");');
			$userId = mysqli_insert_id($link);

			if ($buyersQuery == false){

				$errorStr = 'Ошибка в базе данных!';

			}else{

				// Открытие сессии

				session_start();
				$_SESSION['userName'] = $_POST['surname'] .' '. $_POST['name'];
				$_SESSION['id'] = $userId;
				$_SESSION['root'] = 4;

				$errorStr = 'Успешно!';

			}

		}

	}}

	$result['status'] = $errorStr;
	echo json_encode($result);

?>