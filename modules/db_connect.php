<?php
	$link = mysqli_connect('127.0.0.1','root','','sports shop');
	if ($link == false){
		echo 'Ошибка подключения к базе данных!';
		echo mysqli_connect_error($link);
		exit();
	}
?>