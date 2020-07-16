<?php

	require('../../db_connect.php');

	$shopListQuery = mysqli_query($link, 'SELECT `id`, CONCAT(`id`, " | ", `address`) as `name` FROM `shopping_opportunities` WHERE (`status` = 1);');

	While ($shop = mysqli_fetch_assoc($shopListQuery)){

		$result['list'][] = $shop;

	}

	echo json_encode($result);

?>