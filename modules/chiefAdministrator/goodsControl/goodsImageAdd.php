<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		if ($_FILES['img']['error'] != 0){

			$result['status'] = 'loadingError';
			echo json_encode($result);
			exit();

		}

		if ($_FILES['img']['size'] > 15728640){

			$result['status'] = 'sizeError';
			echo json_encode($result);
			exit();

		}

		if ($_FILES['img']['type'] > 'image/jpeg'){

			$result['status'] = 'typeError';
			echo json_encode($result);
			exit();

		}

		$freedom_size = disk_free_space("/");

		if ($freedom_size <= $_FILES['img']['size']){
			
			$result['status'] = 'freedomError';
			echo json_encode($result);
			exit();

		}

		$file = $_FILES['img']['tmp_name'];

		require('../../db_connect.php');

		$folder = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `name` FROM `goods` WHERE `id` = '.(int) $_POST['id'].';'));

		$tempName = $_SERVER['DOCUMENT_ROOT'] . '/image/goods/'.md5($folder['name']).'/temp.temp';

		move_uploaded_file($file, $tempName);

		$md5Name = md5_file('../../../image/goods/'.md5($folder['name']).'/temp.temp');

		rename('../../../image/goods/'.md5($folder['name']).'/temp.temp', '../../../image/goods/'.md5($folder['name']).'/' . $md5Name . '.jpg');

	    $result['status'] = 'good';

		// Поиск изображений

		require('goodsImageSelect.php');

		$images = imageSelect($_POST['id']);
		$result['images']['main'] = $images['main'];
		$result['images']['list'] = $images['list'];
		$result['status'] = 'good';

	}

	echo json_encode($result);

?>