<?php
	
	require('../../sessionChange.php');

	$result = [];

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		if ($_FILES['error'] != 0){

			$result['status'] = 'fileError';
			echo json_encode($result);
			exit();

		}

		if (count($_FILES) != 0){

			$fileSize = $_FILES['img']['size'];
			$file = $_FILES['img']['tmp_name'];
			$fileType = $_FILES['img']['type'];

			if ($fileType != 'image/png'){

				response('fileTypeError');

			}

			if ($fileSize > 15728640){

				response('fileSizeError');

			}

			$freedom_size = disk_free_space("/");

			if($fileSize > $freedom_size){

				response('freedomSizeError');

			}

		}

		require('../../db_connect.php');

		if ($_POST['id'] == 'null'){

			$changeQuery = mysqli_query($link, 'SELECT * FROM `manufacturer` WHERE `name` = "'.strip_tags(trim($_POST['name'])).'";');
			$change = mysqli_fetch_assoc($changeQuery);

			if (isset($change['id'])){

				updateInfo($_POST['name'], $_POST['information'], $file, $_POST['id']);

			}else{

				$newQuery = mysqli_query($link, 'INSERT INTO `manufacturer` (`id`, `name`, `information`) VALUES (NULL, "'.strip_tags(trim($_POST['name'])).'", "'.strip_tags(trim($_POST['information'])).'");');
				$newId = mysql_insert_id($link);

				if ($newQuery == true){

					mkdir($_SERVER['DOCUMENT_ROOT'] . '/image/manufacturer/' . $_POST['name']);

					$fileName = $_SERVER['DOCUMENT_ROOT'] . '/image/manufacturer/' . $_POST['name'] . '/logo.png';

					if (move_uploaded_file($file, $fileName) == true){

						response('good');

					}

				}else{

					$result['status'] = 'dbError';

				}

			}

		}else{

			updateInfo($_POST['name'], $_POST['information'], $file, $_POST['id']);

		}
	}

	function updateInfo($name, $information, $file, $id){

		require('../../db_connect.php');

		$updateQuery = mysqli_query($link, 'UPDATE `manufacturer` SET `name` = "'.strip_tags(trim($name)).'", `information` = "'.strip_tags(trim($information)).'" WHERE `id` = '.$id.';');

		if ($updateQuery == true){

			if (count($_FILES) != 0){

				$fileName = $_SERVER['DOCUMENT_ROOT'] . '/image/manufacturer/' . $name . '/logo.png';

				if (file_exists($fileName) == true){

					unlink($fileName);

				}
					
				if (move_uploaded_file($file, $fileName) == true){

					response('good');

				}

			}else{

				response('good');

			}

		}else{

			response('dbError');

		}

	}

	function response($status){

		$result['status'] = $status;
		echo json_encode($result);
		exit();

	}

?>