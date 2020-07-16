<?php

	require('../../db_connect.php');

	$_POST = json_decode(file_get_contents('php://input'), true);

	switch ($_POST['id']) {
		case 4:
			$table = 'clothes_category';
			$query = mysqli_query($link, 'SELECT `id`, `value` as `name` FROM `size` WHERE `id` > 34;');
			while ($size = mysqli_fetch_assoc($query)){
				$result['size'][] = $size;
			}
			$query = mysqli_query($link, 'SELECT * FROM `time_year`;');
			while ($season = mysqli_fetch_assoc($query)){
				$result['season'][] = $season;
			}
			$query = mysqli_query($link, 'SELECT `id`, `value` as `name` FROM `age`;');
			while ($age = mysqli_fetch_assoc($query)){
				$result['age'][] = $age;
			}
			$query = mysqli_query($link, 'SELECT * FROM `color`;');
			while ($color = mysqli_fetch_assoc($query)){
				$result['color'][] = $color;
			}
			$query = mysqli_query($link, 'SELECT * FROM `material`;');
			while ($material = mysqli_fetch_assoc($query)){
				$result['material'][] = $material;
			}
			$query = mysqli_query($link, 'SELECT * FROM `floor`;');
			while ($floor = mysqli_fetch_assoc($query)){
				$result['floor'][] = $floor;
			}
			break;
		case 3:
			$table = 'footwear_category';
			$query = mysqli_query($link, 'SELECT `id`, `value` as `name` FROM `size` WHERE `id` < 35;');
			while ($size = mysqli_fetch_assoc($query)){
				$result['size'][] = $size;
			}
			$query = mysqli_query($link, 'SELECT * FROM `time_year`;');
			while ($season = mysqli_fetch_assoc($query)){
				$result['season'][] = $season;
			}
			$query = mysqli_query($link, 'SELECT `id`, `value` as `name` FROM `age`;');
			while ($age = mysqli_fetch_assoc($query)){
				$result['age'][] = $age;
			}
			$query = mysqli_query($link, 'SELECT * FROM `color`;');
			while ($color = mysqli_fetch_assoc($query)){
				$result['color'][] = $color;
			}
			$query = mysqli_query($link, 'SELECT * FROM `material`;');
			while ($material = mysqli_fetch_assoc($query)){
				$result['material'][] = $material;
			}
			$query = mysqli_query($link, 'SELECT * FROM `floor`;');
			while ($floor = mysqli_fetch_assoc($query)){
				$result['floor'][] = $floor;
			}
			break;
		case 5:
			$table = 'inventory_category';
			$query = mysqli_query($link, 'SELECT `id`, `value` as `name` FROM `age`;');
			while ($age = mysqli_fetch_assoc($query)){
				$result['age'][] = $age;
			}
			$query = mysqli_query($link, 'SELECT * FROM `color`;');
			while ($color = mysqli_fetch_assoc($query)){
				$result['color'][] = $color;
			}
			$query = mysqli_query($link, 'SELECT * FROM `material`;');
			while ($material = mysqli_fetch_assoc($query)){
				$result['material'][] = $material;
			}
			$query = mysqli_query($link, 'SELECT * FROM `floor`;');
			while ($floor = mysqli_fetch_assoc($query)){
				$result['floor'][] = $floor;
			}
			break;
		case 6:
			$table = 'sportpit_category';
			$query = mysqli_query($link, 'SELECT * FROM `taste`;');
			while ($taste = mysqli_fetch_assoc($query)){
				$result['taste'][] = $taste;
			}
			break;
		default:
			# code...
			break;
	}

	$query = mysqli_query($link, 'SELECT * FROM `'.$table.'`;');
	while ($subCategory = mysqli_fetch_assoc($query)){

		$result['subCategory'][] = $subCategory;

	}

	echo json_encode($result);

?>