<?php
	
	require('../../sessionChange.php');

	$result['status'] = "";

	if (sessionChange(1) == false){

		$result['status'] = "exit";

	}else{

		$slide_url = scandir("../../../slider_image/");

		for ($i = 2; $i < count($slide_url); $i++){

			$result['list'][] = $slide_url[$i];

		}

	}

	echo json_encode($result);

?>