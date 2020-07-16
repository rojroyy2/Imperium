<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		$tovar = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `goods`.`id` as `local`, `goods`.`bar_code` as `bar`, `goods`.`name` as `name`, `manufacturer`.`name` as `manufacturer` FROM `goods` LEFT JOIN `manufacturer` ON `goods`.`manufacturer_id` = `manufacturer`.`id` WHERE `goods`.`'.$_POST['type'].'` = '.trim($_POST['search']).';'));

		$category = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `goods`.`category_id` as `category` FROM `goods` WHERE `goods`.`id` = '.$tovar['local'].';'));

		switch ($category['category']) {
			case 3:
				$optinsListQuery = mysqli_query($link, "SELECT CONCAT('Размер: ', `size`.`value`, ' | Цвет: ', `color`.`name`) as `options`, `footwear_options`.`key` as `key` FROM `footwear_options` LEFT JOIN `color` ON `color`.`id` = `footwear_options`.`color` LEFT JOIN `size` ON `size`.`id` = `footwear_options`.`size` WHERE `footwear_options`.`id` = ".$tovar["local"].";");
				break;
			case 4:
				$optinsListQuery = mysqli_query($link, "SELECT CONCAT('Размер: ', `size`.`value`, ' | Цвет: ', `color`.`name`) as `options`, `clothes_options`.`key` as `key` FROM `clothes_options` LEFT JOIN `color` ON `color`.`id` = `clothes_options`.`color` LEFT JOIN `size` ON `size`.`id` = `clothes_options`.`size` WHERE `clothes_options`.`id` = ".$tovar["local"].";");
				break;
			case 5:
				$optinsListQuery = mysqli_query($link, "SELECT CONCAT('Вкус: ', `taste`.`name`, ' | Вес: ', `sportpit_options`.`mass`, ' | Порций: ', `sportpit_options`.`number_servings`) as `options`, `sportpit_options`.`key` as `key` FROM `sportpit_options` LEFT JOIN `taste` ON `taste`.`id` = `sportpit_options`.`taste` WHERE `sportpit_options`.`id` = ".$tovar["local"].";");
				break;
			case 6:
				$optinsListQuery = mysqli_query($link, "SELECT CONCAT('Д: ', `inventory_options`.`length`, ' | Ш: ', `inventory_options`.`width`, ' | В: ', `inventory_options`.`height`, ' | Вес: ', `inventory_options`.`weight`,  ' | Цвет: ', `color`.`name`) as `options`, `inventory_options`.`key` as `key` FROM `inventory_options` LEFT JOIN `color` ON `color`.`id` = `inventory_options`.`color` LEFT JOIN `material` ON `material`.`id` = `inventory_options`.`material` WHERE `inventory_options`.`id` = ".$tovar["local"].";");
				break;
			default:
				# code...
				break;
		}

		while ($options = mysqli_fetch_assoc($optinsListQuery)){

			$result['options'][] = $options;

		}

		if (count($tovar) == 0){

			$result['status'] = 'none';

		}else{

			$result['status'] = 'result';
			$result['local'] = $tovar['local'];
			$result['bar'] = $tovar['bar'];
			$result['name'] = $tovar['name'];
			$result['manufacturer'] = $tovar['manufacturer'];

		}

	}

	echo json_encode($result);

?>