<?php 

	function addAccess($login, $password, $phone, $email, $rights){

		require('../../db_connect.php');

		$accessQuery = mysqli_query($link,'INSERT INTO `access` (`id`, `login`, `phone`, `email`, `password`, `rights`) VALUES (NULL, "'.md5(md5($login)).'", "'.$phone.'", "'.trim($email).'", "'.md5(md5($password)).'", '.$rights.');');
		$id = mysqli_insert_id($link);

		if ($accessQuery == true){

			return $id;

		}else{

			return false;

		}

	}

?>