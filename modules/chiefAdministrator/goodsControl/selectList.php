<?php

	require('../../db_connect.php');

	$_POST = json_decode(file_get_contents('php://input'), true);

	if ($_POST['table'] == 'category'){

		$selectQuery = mysqli_query($link, 'SELECT * FROM `'.$_POST['table'].'` WHERE ((`id` != 1)&&(`id` != 2));');

	}else{

		$selectQuery = mysqli_query($link, 'SELECT * FROM `'.$_POST['table'].'`;');

	}

	

	while ($select = mysqli_fetch_assoc($selectQuery)){

		$result['list'][] = $select;

	}

	echo json_encode($result);

?>