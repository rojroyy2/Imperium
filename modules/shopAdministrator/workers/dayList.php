<?php

	require('../../sessionChange.php');

	if (sessionChange(2) == false){

		$result['status'] = 'exit';

	}else{

		require('../../db_connect.php');

		$_POST = json_decode(file_get_contents('php://input'), true);

		$administratorId = $_SESSION['id'];
		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `id_shop` as `id` FROM `administrators` WHERE `id` = '.$administratorId.';'));

		if (($_POST['start'] == null)&&($_POST['end'] == null)){

			$sql = 'SELECT DATE_FORMAT(`workerDay`.`date`, "%d.%m.%Y") as `date`, WEEKDAY(`workerDay`.`date`) as `week`, `workerDay`.`begin`, `workerDay`.`end`, TIMEDIFF(`workerDay`.`end`, `workerDay`.`begin`) as `countHours` FROM `workerDay` WHERE ((`workerDay`.`worker` = '.(int) $_POST['id'].')&&(`workerDay`.`root` = '.(int) $_POST['root'].')) ORDER BY `workerDay`.`date`;';

		}

		if (($_POST['start'] != null)&&($_POST['end'] == null)){

			$sql = 'SELECT DATE_FORMAT(`workerDay`.`date`, "%d.%m.%Y") as `date`, WEEKDAY(`workerDay`.`date`) as `week`, `workerDay`.`begin`, `workerDay`.`end`, TIMEDIFF(`workerDay`.`end`, `workerDay`.`begin`) as `countHours` FROM `workerDay` WHERE (((`workerDay`.`worker` = '.(int) $_POST['id'].')&&(`workerDay`.`root` = '.(int) $_POST['root'].'))&&(`workerDay`.`date` >= "'.$_POST['start'].'")) ORDER BY `workerDay`.`date`;';

		}

		if (($_POST['start'] == null)&&($_POST['end'] != null)){

			$sql = 'SELECT DATE_FORMAT(`workerDay`.`date`, "%d.%m.%Y") as `date`, WEEKDAY(`workerDay`.`date`) as `week`, `workerDay`.`begin`, `workerDay`.`end`, TIMEDIFF(`workerDay`.`end`, `workerDay`.`begin`) as `countHours` FROM `workerDay` WHERE (((`workerDay`.`worker` = '.(int) $_POST['id'].')&&(`workerDay`.`root` = '.(int) $_POST['root'].'))&&(`workerDay`.`date` <= "'.$_POST['end'].'")) ORDER BY `workerDay`.`date`;';

		}

		if (($_POST['start'] != null)&&($_POST['end'] != null)){

			$sql = 'SELECT DATE_FORMAT(`workerDay`.`date`, "%d.%m.%Y") as `date`, WEEKDAY(`workerDay`.`date`) as `week`, `workerDay`.`begin`, `workerDay`.`end`, TIMEDIFF(`workerDay`.`end`, `workerDay`.`begin`) as `countHours` FROM `workerDay` WHERE (((`workerDay`.`worker` = '.(int) $_POST['id'].')&&(`workerDay`.`root` = '.(int) $_POST['root'].'))&&((`workerDay`.`date` <= "'.$_POST['end'].'")&&(`workerDay`.`date` >= "'.$_POST['start'].'"))) ORDER BY `workerDay`.`date`;';

		}

		$dayQuery = mysqli_query($link, $sql);

		while ($day = mysqli_fetch_assoc($dayQuery)){

			switch ($day['week']) {
				case '0':
					$day['week'] = 'Понедельник';
					break;
				case '1':
					$day['week'] = 'Вторник'; 
					break;
				case '2':
					$day['week'] = 'Среда'; 
					break;
				case '3':
					$day['week'] = 'Четверг'; 
					break;
				case '4':
					$day['week'] = 'Пятница'; 
					break;
				case '5':
					$day['week'] = 'Суббота'; 
					break;
				case '6':
					$day['week'] = 'Воскресенье'; 
					break;
				default:
					# code...
					break;
			}

			// $day['countHours'] = (int) substr($day['countHours'], 0, 1) . '.' . substr($day['countHours'], 1, 2);

			$result['list'][] = $day;

		}

		if (count($result['list']) == 0){

			$result['status'] = 'none';

		}else{

			$result['status'] = 'result';

		}

	}

	echo json_encode($result);

?>