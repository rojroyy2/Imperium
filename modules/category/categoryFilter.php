<?php

	$_POST = json_decode(file_get_contents('php://input'), true);

	switch ($_POST['category']) {
		case 3:
			$sql = 'SELECT `goods`.`id`, `goods`.`name`, `ratingGoods`.`assessment`, `goods`.`description`, `goods`.`price` FROM `goods` LEFT JOIN `accounting`  ON `goods`.`id` = `accounting`.`goods_id` LEFT JOIN `footwear_options` ON `accounting`.`options` = `footwear_options`.`key` LEFT JOIN `ratingGoods` ON `ratingGoods`.`goodsId` = `goods`.`id` LEFT JOIN `sales` ON `sales`.`accouting_id` = `accounting`.`id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` LEFT JOIN `footwear_category` ON `footwear_category`.`id` = `footwear_options`.`footwear_category` LEFT JOIN `color` ON `color`.`id` = `footwear_options`.`color` LEFT JOIN `material` ON `material`.`id` = `footwear_options`.`material` LEFT JOIN `size` ON `size`.`id` = `footwear_options`.`size` LEFT JOIN `floor` ON `floor`.`id` = `footwear_options`.`floor` LEFT JOIN `views_sport` ON `views_sport`.`id` = `goods`.`sport` LEFT JOIN `time_year` ON `time_year`.`id` = `footwear_options`.`time_year` LEFT JOIN `age` ON `age`.`id` = `footwear_options`.`age` WHERE (((`accounting`.`residue` > 0)&&(`goods`.`category_id` = '.$_POST['category'].')';
			break;
		case 4:
			$sql = 'SELECT `goods`.`id`, `goods`.`name`, `ratingGoods`.`assessment`, `goods`.`description`, `goods`.`price` FROM `goods` LEFT JOIN `accounting`  ON `goods`.`id` = `accounting`.`goods_id` LEFT JOIN `clothes_options` ON `accounting`.`options` = `clothes_options`.`key` LEFT JOIN `ratingGoods` ON `ratingGoods`.`goodsId` = `goods`.`id` LEFT JOIN `sales` ON `sales`.`accouting_id` = `accounting`.`id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` LEFT JOIN `clothes_category` ON `clothes_category`.`id` = `clothes_options`.`category_clothes` LEFT JOIN `color` ON `color`.`id` = `clothes_options`.`color` LEFT JOIN `material` ON `material`.`id` = `clothes_options`.`material` LEFT JOIN `size` ON `size`.`id` = `clothes_options`.`size` LEFT JOIN `floor` ON `floor`.`id` = `clothes_options`.`floor` LEFT JOIN `views_sport` ON `views_sport`.`id` = `goods`.`sport` LEFT JOIN `time_year` ON `time_year`.`id` = `clothes_options`.`season` LEFT JOIN `age` ON `age`.`id` = `clothes_options`.`age` WHERE (((`accounting`.`residue` > 0)&&(`goods`.`category_id` = '.$_POST['category'].')';
			break;
		case 5:
			$sql = 'SELECT `goods`.`id`, `goods`.`name`, `ratingGoods`.`assessment`, `goods`.`description`, `goods`.`price` FROM `goods` LEFT JOIN `accounting` ON `accounting`.`goods_id` = `goods`.`id` LEFT JOIN `sales` ON `sales`.`accouting_id` = `accounting`.`id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` LEFT JOIN `inventory_options` ON `inventory_options`.`id` = `goods`.`id` LEFT JOIN `inventory_category` ON `inventory_category`.`id` = `inventory_options`.`inventory_category` LEFT JOIN `color` ON `color`.`id` = `inventory_options`.`color` LEFT JOIN `material` ON `material`.`id` = `inventory_options`.`material` LEFT JOIN `floor` ON `floor`.`id` = `inventory_options`.`floor` LEFT JOIN `views_sport` ON `views_sport`.`id` = `goods`.`sport` LEFT JOIN `age` ON `age`.`id` = `inventory_options`.`age` LEFT JOIN `ratingGoods` ON `ratingGoods`.`goodsId` = `goods`.`id` WHERE (((`accounting`.`residue` > 0)&&(`goods`.`category_id` = '.$_POST['category'].')';
			break;
		case 6: 
			$sql = 'SELECT `goods`.`id`, `goods`.`name`, `ratingGoods`.`assessment`, `goods`.`description`, `goods`.`price` FROM `goods` LEFT JOIN `accounting` ON `accounting`.`goods_id` = `goods`.`id` LEFT JOIN `sales` ON `sales`.`accouting_id` = `accounting`.`id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` LEFT JOIN `sportpit_options` ON `sportpit_options`.`id` = `goods`.`id` LEFT JOIN `sportpit_category` ON `sportpit_category`.`id` = `sportpit_options`.`sportpit_category` LEFT JOIN `taste` ON `taste`.`id` = `sportpit_options`.`taste` LEFT JOIN `ratingGoods` ON `ratingGoods`.`goodsId` = `goods`.`id` WHERE (((`accounting`.`residue` > 0)&&(`goods`.`category_id` = '.$_POST['category'].')';
			break;
		default:
			# code...
			break;
	}

	$sqlPrice = "";
	$sqlParam = "";
	$sqlCountPortion = "";
	$sqlValue = "";
	$sqlL = "";
	$sqlW = "";
	$sqlH = "";

	// Цена

	if (($_POST['params']['price']['min'] != NULL) && ($_POST['params']['price']['max'] != NULL)){

		$sqlPrice = ' && ((`goods`.`price` >= '.$_POST['params']['price']['min'].') && (`goods`.`price` <= '.$_POST['params']['price']['max'].'))';

	}else{

		if ($_POST['params']['price']['min'] != NULL){

			$sqlPrice = ' && (`goods`.`price` >= '.$_POST['params']['price']['min'].')';

		}

		if ($_POST['params']['price']['max'] != NULL){

			$sqlPrice = ' && (`goods`.`price` <= '.$_POST['params']['price']['max'].')';

		}

	}

	$sql = $sql . $sqlPrice;

	// Перебор $_POST параметров поиска

	forEach($_POST['params'] as $key => $params){

		if (($key == 'subCategory') && (count($params['elem']) != 0)){

			switch ($_POST['category']) {
				case 3:
					$table = "footwear_options";
					break;
				case 4:
					$table = "clothes_options";
					break;
				case 5:
					$table = "inventory_options";
					break;
				case 6:
					$table = "sportpit_options";
					break;
				default:

					break;
			}

			$sqlParam = "";

			if (count($params['elem']) != 1){

				forEach($params['elem'] as $elem){

					$sqlParam = $sqlParam . "(`".$table."`.`id` = ".$elem.") || ";

				}

				$sqlParam = substr($sqlParam, 0, -3);				

			}else{

				$sqlParam = "`".$table."`.`id` = ".$params['elem'][0]."";

			}

			$sql = $sql . " && (". $sqlParam . ")";

		}else{

			if (count($params['elem']) != 0){

				$sqlParam = "";

				if (count($params['elem']) != 1){

					forEach($params['elem'] as $elem){

						$sqlParam = $sqlParam . "(`".$key."`.`id` = ".$elem.") || ";

					}

					$sqlParam = substr($sqlParam, 0, -3);				

				}else{

					$sqlParam = "`".$key."`.`id` = ".$params['elem'][0]."";

				}

				$sql = $sql . " && (". $sqlParam . ")";

			}

		}

	}

	// Количество порций

	if ($_POST['params']['countPortion']['value'] != NULL){

		$sqlCountPortion = " && (`sportpit_options`.`number_servings` = ".$_POST['params']['countPortion']['value'].")";

		$sql = $sql . $sqlCountPortion;

	}

	// Объём

	if ($_POST['params']['valume']['value'] != NULL){

		$sqlValue = " && (`sportpit_options`.`mass` = ".$_POST['params']['valume']['value'].")";

		$sql = $sql . $sqlValue;

	}

	// Длина

	if ($_POST['params']['size']['length'] != NULL){

		$sqlL = " && (`inventory_options`.`length` = ".$_POST['params']['size']['length'].")";

		$sql = $sql . $sqlL;

	}

	// Ширина

	if ($_POST['params']['size']['width'] != NULL){

		$sqlL = " && (`inventory_options`.`width` = ".$_POST['params']['size']['width'].")";

		$sql = $sql . $sqlL;

	}

	// Высота

	if ($_POST['params']['size']['height'] != NULL){

		$sqlL = " && (`inventory_options`.`height` = ".$_POST['params']['size']['height'].")";

		$sql = $sql . $sqlL;

	}

	// Окночание формирования sql строки запроса

	$sqlCount = $sql . ")) GROUP BY `goods`.`id` ORDER BY SUM(`sales`.`number`) DESC;";
	$sqlCount = str_replace("SELECT `footwear_options`.`key`, `goods`.`id`, `goods`.`name`, `ratingGoods`.`assessment`, `goods`.`description`, `goods`.`price` FROM", "SELECT COUNT(`goods`.`id`) as `count` FROM", $sqlCount);

	$sql = $sql . ")) GROUP BY `goods`.`id` ORDER BY SUM(`sales`.`number`) DESC LIMIT ".$_POST['limit'].";";

	require("../db_connect.php");

	$discountDelete = mysqli_query($link, 'DELETE FROM `discount` WHERE `until` < CURRENT_TIMESTAMP;');
	
	$popularTovarCategoryQuery = mysqli_query($link, $sql);
	$maxCountTovar = 0;

	$CountTovar = mysqli_query($link, $sqlCount);
	while($el = mysqli_fetch_assoc($CountTovar)){
		$maxCountTovar++;
	}


	$result = [];

	while ($tovar = mysqli_fetch_assoc($popularTovarCategoryQuery)){

		$rating = mysqli_fetch_assoc(mysqli_query($link, 'SELECT AVG(`ratingGoods`.`assessment`) as `assessment` FROM `ratingGoods` WHERE `goodsId` = '.$tovar['id'].' GROUP BY `goodsId` = '.$tovar['id'].';'));

		$discount = mysqli_fetch_assoc(mysqli_query($link, 'SELECT * FROM `discount` WHERE `discount`.`tovarId` = '.$tovar['id'].';'));

		if ($rating['assessment'] == null){

			$rating['assessment'] = 0;

		}

		$tovar['assessment'] = $rating['assessment'];
		$tovar['discount'] = $discount['discount'];
		$tovar['discountUntil'] = substr($discount['until'], 8, 2);

		switch (substr($discount['until'], 5, 2)) {
			case '01':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' января';
				break;
			case '02':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' февраля';
				break;
			case '03':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' марта';
				break;
			case '04':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' апреля';
				break;
			case '05':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' мая';
				break;
			case '06':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' июня';
				break;
			case '07':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' июля';
				break;
			case '08':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' августа';
				break;
			case '09':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' сентября';
				break;
			case '10':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' октября';
				break;
			case '11':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' ноября';
				break;
			case '12':
				$tovar['discountUntil'] = $tovar['discountUntil'] . ' декабря';
				break;
			default:
				# code...
				break;
		}

		$result_temp[] = $tovar;

	}

	$count = count($result_temp);

	if ($count == 0){

		$result = [];
		echo json_encode($result);

	}else{

		for ($i = (int) $_POST['limit'] - 10; $i < $count; $i++){

			$result_temp[$i]['jpeg'] = md5($result_temp[$i]['name']);
			$result['list'][] = $result_temp[$i];

		}

		$result['maxCountTovar'] = $maxCountTovar;

		echo json_encode($result);

	}

?>