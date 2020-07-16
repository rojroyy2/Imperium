<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');


		if (isset($_POST['id'])){

			// Обновление информации об уже сущесвующем товаре

			$goodsQuery = mysqli_query($link, 'UPDATE `goods` SET `bar_code` = "'.$_POST['bar'].'", `name` = "'.$_POST['name'].'", `category_id` = '.$_POST['category'].', `sport` = '.$_POST['sport'].', `manufacturer_id` = '.$_POST['manufacturer'].',  `description` = "'.$_POST['description'].'", `peculiar_properties` = "'.$_POST['peculiar'].'" WHERE `goods`.`id` = '.$_POST['id'].';');

			if ($goodsQuery == true){

				$id = $_POST['id'];

			}else{

				$result['status'] = 'dbError';
				echo json_encode($result);
				exit();

			}

			switch ($_POST['category']) {
				case 3:
					$optionQuery = mysqli_query($link, 'UPDATE `footwear_options` SET `footwear_category` = "'.$_POST['subCategory'].'", `age` = '.$_POST['age'].', `size` = '.$_POST['size'].', `color` = '.$_POST['color'].', `time_year` = '.$_POST['season'].', `floor` = '.$_POST['floor'].', `material` = '.$_POST['material'].' WHERE `footwear_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `clothes_options` WHERE `clothes_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `inventory_options` WHERE `inventory_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `sportpit_options` WHERE `sportpit_options`.`id` = '.$id.';');
				case 4:
					$optionQuery = mysqli_query($link, 'UPDATE `clothes_options` SET `category_clothes` = '.$_POST['subCategory'].', `age` = '.$_POST['age'].', `size` = '.$_POST['size'].', `color` = '.$_POST['color'].', `season` =  '.$_POST['season'].', `floor` = '.$_POST['floor'].', `material` = '.$_POST['material'].' WHERE `clothes_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `footwear_options` WHERE `footwear_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `inventory_options` WHERE `inventory_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `sportpit_options` WHERE `sportpit_options`.`id` = '.$id.';');
					break;
				case 5:
					$optionQuery = mysqli_query($link, 'UPDATE `inventory_options` SET `inventory_category` = '.$_POST['subCategory'].', `length` = "'.$_POST['length'].'", `width` = "'.$_POST['width'].'", `height` = "'.$_POST['height'].'", `weight` = "'.$_POST['mass'].'", `color` = '.$_POST['color'].', `age` = '.$_POST['age'].', `floor` = '.$_POST['floor'].', `material` = '.$_POST['material'].' WHERE `inventory_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `clothes_options` WHERE `clothes_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `footwear_options` WHERE `footwear_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `sportpit_options` WHERE `sportpit_options`.`id` = '.$id.';');
					break;
				case 6:
					$optionQuery = mysqli_query($link, 'UPDATE `sportpit_options` SET `taste` = '.$_POST['taste'].', `mass` = '.$_POST['mass'].', `number_servings` = '.$_POST['count'].', `instruction` = "'.$_POST['instruction'].'", `sportpit_category` = '.$_POST['subCategory'].' WHERE `sportpit_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `clothes_options` WHERE `clothes_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `footwear_options` WHERE `footwear_options`.`id` = '.$id.';');
					$optionDeleteQuery = mysqli_query($link, 'DELETE FROM `inventory_options` WHERE `inventory_options`.`id` = '.$id.';');
					break;
				default:
					# code...
					break;
			}

		}else{

			// Создание нового вида товара

			$goodsQuery = mysqli_query($link, 'INSERT INTO `goods` (`id`, `bar_code`, `name`, `category_id`, `sport`, `manufacturer_id`, `description`, `peculiar_properties`, `residue`, `price`) VALUES (NULL, "'.$_POST['bar'].'", "'.$_POST['name'].'", '.$_POST['category'].', '.$_POST['sport'].', '.$_POST['manufacturer'].', "'.$_POST['description'].'", "'.$_POST['peculiar'].'", 0, 0);');

			if ($goodsQuery == true){

				$id = mysqli_insert_id($link);

				if (is_dir($_SERVER['DOCUMENT_ROOT'] . '/image/goods/' . md5($_POST['name'])) == false){

					mkdir('../../../image/goods/' . md5($_POST['name']));

				}

			}else{

				$result['status'] = 'dbError';
				echo json_encode($result);
				exit();

			}

			switch ($_POST['category']) {
				case 3:
					$optionQuery = mysqli_query($link, 'INSERT INTO `footwear_options` (`id`, `footwear_category`, `age`, `size`, `color`, `time_year`, `floor`, `material`) VALUES ('.$id.', "'.$_POST['subCategory'].'", '.$_POST['age'].', '.$_POST['size'].','.$_POST['color'].', '.$_POST['season'].', '.$_POST['floor'].', '.$_POST['material'].');');
					break;
				case 4:
					$optionQuery = mysqli_query($link, 'INSERT INTO `clothes_options` (`id`, `category_clothes`, `age`, `size`, `color`, `season`, `floor`, `material`) VALUES ('.$id.', '.$_POST['subCategory'].', '.$_POST['age'].', '.$_POST['size'].', '.$_POST['color'].', '.$_POST['season'].', '.$_POST['floor'].', '.$_POST['material'].');');
					break;
				case 5:
					$optionQuery = mysqli_query($link, 'INSERT INTO `inventory_options` (`id`, `inventory_category`, `length`, `width`, `height`, `weight`, `color`, `age`, `floor`, `material`) VALUES ('.$id.', '.$_POST['subCategory'].', "'.$_POST['length'].'", "'.$_POST['width'].'", "'.$_POST['height'].'",  "'.$_POST['mass'].'", '.$_POST['color'].', '.$_POST['age'].', '.$_POST['floor'].', '.$_POST['material'].');');
					break;
				case 6:
					$optionQuery = mysqli_query($link, 'INSERT INTO `sportpit_options` (`id`, `taste`, `mass`, `number_servings`, `instruction`, `sportpit_category`) VALUES ('.$id.', '.$_POST['taste'].', '.$_POST['mass'].', '.$_POST['count'].', '.$_POST['instruction'].'", '.$_POST['subCategory'].');');
					break;
				default:
					# code...
					break;
			}

		}

	}

	if (($goodsQuery == true) && ($optionQuery == true)){

		$result['id'] = $id;
		$result['status'] = 'good';

	}else{

		$result['status'] = 'dbError';

	}

	echo json_encode($result);

?>