<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');
		require('../../user/phoneChange.php');
		require('../../user/emailChange.php');
		require('../../user/loginChange.php');

		if (gettype($_POST['id']) != 'NULL'){

			// Изменение информации об уже существующем сотруднике

			switch ($_POST['root']) {
				case 2:
					$accessId = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `access` FROM `administrators` WHERE `id` = '.$_POST['id'].';'));

					$sql = 'UPDATE `administrators` SET `work_book_number` = "'.$_POST['workBook'].'", `name` = "'.$_POST['name'].'", `surname` = "'.$_POST['surname'].'", `patronymic` = "'.$_POST['patronymic'].'", `start_date` = "'.$_POST['date'].'", `residential_address` = "'.$_POST['address'].'", `base_salary` = "'.$_POST['salary'].'", `shop_id` = NULL WHERE `id` = '.$_POST['id'].';';

					if (gettype($_POST['shop']) != 'NULL'){

						$sql = 'UPDATE `administrators` SET `work_book_number` = "'.$_POST['workBook'].'", `name` = "'.$_POST['name'].'", `surname` = "'.$_POST['surname'].'", `patronymic` = "'.$_POST['patronymic'].'", `start_date` = "'.$_POST['date'].'", `residential_address` = "'.$_POST['address'].'", `base_salary` = "'.$_POST['salary'].'", `id_shop` = '.$_POST['shop'].' WHERE `id` = '.$_POST['id'].';';

					}
					break;
				case 3:
					$accessId = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `access` FROM `salespeople` WHERE `id` = '.$_POST['id'].';'));

					$sql = 'UPDATE `salespeople` SET `work_book_number` = "'.$_POST['workBook'].'", `name` = "'.$_POST['name'].'", `surname` = "'.$_POST['surname'].'", `patronymic` = "'.$_POST['patronymic'].'", `start_date` = "'.$_POST['date'].'", `residential_address` = "'.$_POST['address'].'", `base_salary` = "'.$_POST['salary'].'", `shop_id` = NULL WHERE `id` = '.$_POST['id'].';';

					if (gettype($_POST['shop']) != 'NULL'){

						$sql = 'UPDATE `salespeople` SET `work_book_number` = "'.$_POST['workBook'].'", `name` = "'.$_POST['name'].'", `surname` = "'.$_POST['surname'].'", `patronymic` = "'.$_POST['patronymic'].'", `start_date` = "'.$_POST['date'].'", `residential_address` = "'.$_POST['address'].'", `base_salary` = "'.$_POST['salary'].'", `shop_id` = '.$_POST['shop'].' WHERE `id` = '.$_POST['id'].';';

					}
					break;
				default:
					# code...
					break;
			}

			if (phoneChange($_POST['phone'], 'access', $accessId['access']) == true){

				if (loginChange($_POST['login'], $accessId['access']) == true){

					if (emailChange($_POST['email'], $accessId['access']) == true){

						$tableQuery = mysqli_query($link, $sql);

						$accessQuery = mysqli_query($link, 'UPDATE `access` SET `email` = "'.$_POST['email'].'", `phone` = "'.$_POST['phone'].'" WHERE `id` = '.$accessId['access'].';');

						if ($_POST['login'] != null){

							$accessQuery = mysqli_query($link, 'UPDATE `access` SET `login` = "'.md5(md5($_POST['login'])).'" WHERE `id` = '.$accessId['access'].';');

						}

						if ($_POST['password'] != null){

							$accessQuery = mysqli_query($link, 'UPDATE `access` SET `password` = "'.md5(md5($_POST['password'])).'" WHERE `id` = '.$accessId['access'].';');

						}

						if (($accessQuery == true) && ($tableQuery == true)){

							$result['status'] = "good";

						}else{

							$result['status'] = "dbError";

						}

					}else{

						$result['status'] = "emailError";

					}

				}else{

					$result['status'] = "loginError";

				}

			}else{

				$result['status'] = "phoneError";

			}


		}else{

			// Добавление нового сотрудника

			if (phoneChange($_POST['phone'], 0, 0) == true){

				if (loginChange($_POST['login'], 0) == true){

					if (emailChange($_POST['email'], 0) == true){

						switch ($_POST['root']) {
							case 2:

								$accessQuery = mysqli_query($link, 'INSERT INTO `access` (`id`, `login`, `phone`, `email`, `password`, `rights`) VALUES (NULL, "'.md5(md5($_POST['login'])).'", "'.$_POST['phone'].'", "'.$_POST['email'].'", "'.md5(md5($_POST['password'])).'", 2);');
								
								$idAccess = mysqli_insert_id($link);

								if (gettype($_POST['shop']) == 'NULL'){
									$sqlTable = 'INSERT INTO `administrators` (`id`, `access`, `work_book_number`, `name`, `surname`, `patronymic`, `start_date`, `residential_address`, `base_salary`, `id_shop`) VALUES (NULL, '.$idAccess.', "'.$_POST['workBook'].'", "'.$_POST['name'].'", "'.$_POST['surname'].'", "'.$_POST['patronymic'].'", "'.$_POST['date'].'", "'.$_POST['address'].'", "'.$_POST['salary'].'", NULL);';
								}else{
									$sqlTable = 'INSERT INTO `administrators` (`id`, `access`, `work_book_number`, `name`, `surname`, `patronymic`, `start_date`, `residential_address`, `base_salary`, `id_shop`) VALUES (NULL, '.$idAccess.', "'.$_POST['workBook'].'", "'.$_POST['name'].'", "'.$_POST['surname'].'", "'.$_POST['patronymic'].'", "'.$_POST['date'].'", "'.$_POST['address'].'", "'.$_POST['salary'].'", '.$_POST['shop'].');';
								}

								$tableQuery = mysqli_query($link, $sqlTable);

								$idTable = mysqli_insert_id($link);

								break;
							case 3:

								$accessQuery = mysqli_query($link, 'INSERT INTO `access` (`id`, `login`, `phone`, `email`, `password`, `rights`) VALUES (NULL, "'.md5(md5($_POST['login'])).'", "'.md5(md5($_POST['phone'])).'", "'.$_POST['email'].'", "'.$_POST['password'].'", 3);');
								
								$idAccess = mysqli_insert_id($link);

								if (gettype($_POST['shop']) == 'NULL'){
									$sqlTable = 'INSERT INTO `salespeople` (`id`, `access`, `work_book_number`, `name`, `surname`, `patronymic`, `start_date`, `residential_address`, `base_salary`, `shop_id`) VALUES (NULL, '.$idAccess.', "'.$_POST['workBook'].'", "'.$_POST['name'].'", "'.$_POST['surname'].'", "'.$_POST['patronymic'].'", "'.$_POST['date'].'", "'.$_POST['address'].'", "'.$_POST['salary'].'", NULL);';
								}else{
									$sqlTable = 'INSERT INTO `salespeople` (`id`, `access`, `work_book_number`, `name`, `surname`, `patronymic`, `start_date`, `residential_address`, `base_salary`, `shop_id`) VALUES (NULL, '.$idAccess.', "'.$_POST['workBook'].'", "'.$_POST['name'].'", "'.$_POST['surname'].'", "'.$_POST['patronymic'].'", "'.$_POST['date'].'", "'.$_POST['address'].'", "'.$_POST['salary'].'", '.$_POST['shop'].');';
								}
	
								$tableQuery = mysqli_query($link, $sqlTable);

								$idTable = mysqli_insert_id($link);

								break;
							default:
								# code...
								break;
						}

						if (($accessQuery == true) && ($tableQuery == true)){

							$result['id'] = $idTable;
							$result['status'] = "good";

						}else{

							mysqli_query($link, 'DELETE FROM `access` WHERE `access`.`id` = '.$idAccess.';');

							switch ($_POST['root']) {
								case 2:
									mysqli_query($link, 'DELETE FROM `administrators` WHERE `administrators`.`id` = '.$idTable.';');
									break;
								case 3:
									mysqli_query($link, 'DELETE FROM `salespeople` WHERE `salespeople`.`id` = '.$idTable.';');
									break;
								default:
									# code...
									break;
							}

							$result['status'] = "dbError";

						}

					}else{

						$result['status'] = "emailError";

					}

				}else{

					$result['status'] = "loginError";

				}

			}else{

				$result['status'] = "phoneError";

			}

		}

	}

	$result['post'] = $_POST;
	echo json_encode($result);

?>