<?php

	function phoneChange($phone, $table, $id){

		require('../../db_connect.php');	

		// Проверка в таблице пользователей
				
		$accessSQL = 'SELECT `id` FROM `access` WHERE `phone` = "'.$phone.'";';

		// Проврка в таблице магазинов

		$shopping_opportunitesSQL = 'SELECT `id` FROM `shopping_opportunities` WHERE `phone` = "'.$phone.'";';

		// Проверка в таблице поставщиков

		$suppliersSQL = 'SELECT `id` FROM `suppliers` WHERE `phone` = "'.$phone.'";';

		switch ($table) {
			case 'access':

				$accessSQL = 'SELECT `id` FROM `access` WHERE ((`phone` = "'.$phone.'") && (`id` != '.$id.'));';

				break;
			case 'shopping_opportunities':

				$shopping_opportunitesSQL = 'SELECT `id` FROM `shopping_opportunities` WHERE ((`phone` = "'.$phone.'") && (`id` != '.$id.'));';

				break;
			case 'suppliers':

				$suppliersSQL = 'SELECT `id` FROM `suppliers` WHERE ((`phone` = "'.$phone.'") && (`id` != '.$id.'));';

				break;
			default:

				break;
		}

		$accessQuery = mysqli_query($link, $accessSQL);
		$shopping_opportunitesQuery = mysqli_query($link, $shopping_opportunitesSQL);
		$suppliersQuery = mysqli_query($link, $suppliersSQL);

		$access = mysqli_fetch_assoc($accessQuery);
		$shopping_opportunites = mysqli_fetch_assoc($shopping_opportunitesQuery);
		$suppliers = mysqli_fetch_assoc($suppliersQuery);

		if (!isset($access['id']) && !isset($shopping_opportunites['id']) && !isset($suppliers['id'])){

			return true;

		}else{

			return false;

		}

	}

?>