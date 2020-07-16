<?php
	
	function loginChange($login, $id){

		require('../../db_connect.php');

		if ($id == 0){

			$accessSQL = 'SELECT `id` FROM `access` WHERE `login` = "'.md5(md5($login)).'";';

		}else{

			$accessSQL = 'SELECT `id` FROM `access` WHERE ((`login` = "'.md5(md5($login)).'") && (`id` != '.$id.'));';

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