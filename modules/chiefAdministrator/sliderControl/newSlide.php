<?php
	
	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$file = $_FILES[img][tmp_name];
		$type = $_FILES[img][type];
		$size = $_FILES[img][size];

		if(($type == 'image/jpeg')&&($size < 15728640)){
		
			$freedom_size = disk_free_space("/");

			if($size < $freedom_size){

				$tempName = $_SERVER['DOCUMENT_ROOT'] . '/slider_image/temp.temp';
				move_uploaded_file($file, $tempName);
				$md5Name = md5_file('../../../slider_image/temp.temp');

				rename('../../../slider_image/temp.temp', '../../../slider_image/' . $md5Name . '.jpg');

	        	$result['status'] = 'good';

			}else{

				$result['status'] = 'error1';

			}

		}else{

			$result['status'] = 'error0';

		}

	}

	echo json_encode($result);

?>