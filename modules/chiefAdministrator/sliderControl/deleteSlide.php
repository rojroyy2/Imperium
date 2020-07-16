<?php
	
	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		$file_name = '../../../slider_image/' . $_POST['image_name'];

		if(unlink($file_name)){
			
			$result['status'] = 'good';

		}else{

			$result['status'] = 'error';

		}

	}

	echo json_encode($result);

?>