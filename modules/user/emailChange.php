<?php 

	function emailChange($email, $id){

		require('../../db_connect.php');

		if ($id == 0){

			$accessSQL = 'SELECT `id` FROM `access` WHERE `email` = "'.$email.'";';

		}else{

			$accessSQL = 'SELECT `id` FROM `access` WHERE ((`email` = "'.$email.'") && (`id` != '.$id.'));';

		}

		$accessQuery = mysqli_query($link, $accessSQL);
		$access = mysqli_fetch_assoc($accessQuery);

		if (!isset($access['id'])){

			return true;

		}else{

			if ($login == ''){
				return true;
			}else{
				return false;
			}

		}

	}

?>