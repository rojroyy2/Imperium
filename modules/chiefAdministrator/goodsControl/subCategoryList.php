<?php

	require('../../db_connect.php');

	$_POST = json_decode(file_get_contents('php://input'), true);

	switch ($_POST['id']) {
		case 4:
			$table = 'clothes_category';
			break;
		case 3:
			$table = 'footwear_category';
			break;
		case 5:
			$table = 'inventory_category';
			break;
		case 6:
			$table = 'sportpit_category';
			break;
		default:
			# code...
			break;
	}
	$subCategoryQuery = mysqli_query($link, 'SELECT * FROM `'.$table.'`;');
	while ($subCategory = mysqli_fetch_assoc($subCategoryQuery)){
		$result['subCategory'][] = $subCategory;
	}

	echo json_encode($result);

?>