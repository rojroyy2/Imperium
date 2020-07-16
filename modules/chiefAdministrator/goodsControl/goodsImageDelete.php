<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require ('../../db_connect.php');
		$folder = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `name` FROM `goods` WHERE `id` = '.(int) $_POST['id'].';'));

		$nameBegin = strrpos($_POST['imageName'], '/');
		$name = substr($_POST['imageName'], $nameBegin + 1, strlen($_POST['imageName']) - $nameBegin);
		$result['name'] = $name;
		if ((strlen($name) != 36)&&(strlen($name) != 8)){

			$result['status'] = 'error';
			echo json_encode($result);
			exit();

		}

		if (unlink('../../../image/goods/'.md5($folder['name']).'/'.$name) == true){
			
			// Поиск изображений

			require('goodsImageSelect.php');

			$images = imageSelect($_POST['id']);
			$result['images']['main'] = $images['main'];
			$result['images']['list'] = $images['list'];
			$result['status'] = 'good';
		}
		

	}

	echo json_encode($result);

?>