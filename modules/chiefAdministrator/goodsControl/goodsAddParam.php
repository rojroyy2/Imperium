<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$category = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `category_id` FROM `goods` WHERE `id` = '.(int) $_POST['id'].';'));

		switch ($category['category_id']) {
			case 3:
				$option = mysqli_query($link, 'INSERT INTO `footwear_options` (`id`, `footwear_category`, `age`, `size`, `color`, `time_year`, `floor`, `material`) VALUES ('.(int) $_POST['id'].', '.(int) $_POST['subCategory'].', '.(int) $_POST['age'].', '.(int) $_POST['size'].', '.(int) $_POST['color'].', '.(int) $_POST['season'].', '.(int) $_POST['floor'].', '.(int) $_POST['material'].');');
				break;
			case 4:
				$option = mysqli_query($link, 'INSERT INTO `clothes_options` (`id`, `category_clothes`, `size`, `color`, `floor`, `season`, `material`, `age`) VALUES ('.(int) $_POST['id'].', '.(int) $_POST['subCategory'].', '.(int) $_POST['size'].', '.(int) $_POST['color'].', '.(int) $_POST['floor'].', '.(int) $_POST['season'].', '.(int) $_POST['material'].', '.(int) $_POST['age'].');');
				break;
			case 5:
				$option = mysqli_query($link, 'INSERT INTO `inventory_options` (`id`, `inventory_category`, `length`, `width`, `height`, `weight`, `color`, `material`, `age`, `floor`) VALUES ('.(int) $_POST['id'].', '.(int) $_POST['subCategory'].', '.(int) $_POST['length'].', '.(int) $_POST['width'].', '.(int) $_POST['height'].', '.(int) $_POST['mass'].', '.(int) $_POST['color'].', '.(int) $_POST['material'].', '.(int) $_POST['age'].', '.(int) $_POST['floor'].');');
				break;
			case 6:
				$option = mysqli_query($link, 'INSERT INTO `sportpit_options` (`id`, `taste`, `mass`, `number_servings`, `instruction`, `sportpit_category`) VALUES ('.(int) $_POST['id'].', '.(int) $_POST['taste'].', '.(int) $_POST['mass'].', '.(int) $_POST['count'].', '.(int) $_POST['instruction'].', '.(int) $_POST['subCategory'].');');
				break;
			default:
				# code...
				break;
		}

		if ($option == true){

			$result['status'] = 'good';

		}else{

			$result['status'] = 'dbError';
			
		}

	}

	echo json_encode($result);

?>