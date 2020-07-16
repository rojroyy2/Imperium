<?php

	function imageSelect($id){

		require('../../db_connect.php');

		$folder = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `name` FROM `goods` WHERE `id` = '. $id.';'));

		$md = md5($folder['name']);

		$img = scandir("../../../image/goods/" .$md. '/');

		$result['images']['list'] = [];
		$result['images']['main'] = null;

		for ($i = 2; $i < count($img); $i++){

			$result['list'][] = 'image/goods/'. $md . '/' . $img[$i] .'?'. date("d_m_Y_H:i:s");

			if ($img[$i] == 'main.jpg'){

				$result['main'] = 'image/goods/'. $md . '/' . $img[$i] .'?'. date("d_m_Y_H:i:s");

			}

		}

		return $result; 

	}

?>