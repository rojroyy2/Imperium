<?php 

	session_start();

	require('../db_connect.php');

	$response['status'] = null;

	$_POST = json_decode(file_get_contents('php://input'), true);

	if (($_POST['login'] == '') || ($_POST['password'] == '')){

		$response['status'] = false;
		echo json_encode($response);
		exit();

	}

	$login = $_POST['login'];
	$password = $_POST['password'];

	$accessQuery = mysqli_query($link, 'SELECT `id`, `rights` FROM `access` WHERE ((`password` = "'. md5(md5($password)) .'") && ((`login` = "'. md5(md5($login)) .'") || (`phone` = "'. $login .'")));');
		
	$access = mysqli_fetch_assoc($accessQuery);

	if (isset($access['id'])){

		switch ($access['rights']) {
			case 1:
				$tableName = 'admin_site';
				break;
			case 2:
				$tableName = 'administrators';
				break;
			case 3:
				$tableName = 'salespeople';
				break;
			case 4:
				$tableName = 'buyers';
				break;
			default:
				# code...
					break;
		}

		$userInfoQuery = mysqli_query($link, 'SELECT `id`, CONCAT(`surname`, " ", `name`) as `userName` FROM `'.$tableName.'` WHERE `access` = '.$access[id].';');
		$userInfo = mysqli_fetch_assoc($userInfoQuery);

		$userInfo['id'] = $userInfo['id'];
		$userInfo['userName'] = $userInfo['userName'];
		$userInfo['root'] = $access['rights'];
		$response['info'] = $userInfo;

		// Запись данных в сессию
		$_SESSION['userName'] = $userInfo['userName'];
		$_SESSION['id'] = $userInfo['id'];
		$_SESSION['root'] = $access['rights'];

		$response['status'] = true;
		$response['info']['id'] = $userInfo['id'];
		$response['info']['root'] = $access['rights'];
		$response['info']['userName'] = $userInfo['userName'];

	}else{

		// Сессия не открыта

		$_SESSION['id'] = null;
		$_SESSION['root'] = null;
		session_destroy();

		$response['status'] = false;

	}

	echo json_encode($response);

?>