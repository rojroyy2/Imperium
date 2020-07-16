<?php

	require('../../sessionChange.php');

	if (sessionChange(1) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$discountDelete = mysqli_query($link, 'DELETE FROM `discount` WHERE `until` < CURRENT_TIMESTAMP;');

		$goodsQuery = mysqli_query($link, 'SELECT `goods`.`id` as `id`, `goods`.`bar_code` as `bar`, `goods`.`price`, `goods`.`name` as `name`, `goods`.`description`, `goods`.`peculiar_properties`, `category`.`id` as `categoryId`, `manufacturer`.`id` as `manufacturerId`, `views_sport`.`id` as `sportId` FROM `goods` LEFT JOIN `category` ON `category`.`id` = `goods`.`category_id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` LEFT JOIN `views_sport` ON `views_sport`.`id` = `goods`.`sport` WHERE ((`goods`.`id` = "'.$_POST['search'].'") || (`goods`.`bar_code` = "'.$_POST['search'].'"));');

		$goods = mysqli_fetch_assoc($goodsQuery);


		if (!isset($goods['id'])){

			$result['status'] = 'null';
			echo json_encode($result);
			exit();

		}else{

			$result['status'] = 'result';
			$result['info']['name'] = $goods['name'];
			$result['info']['bar'] = $goods['bar'];
			$result['info']['id'] = $goods['id'];
			$result['info']['category']['id'] = $goods['categoryId'];
			$result['info']['manufacturer']['id'] = $goods['manufacturerId'];
			$result['info']['sport']['id'] = $goods['sportId'];
			$result['info']['description'] = $goods['description'];
			$result['info']['peculiarProperties'] = $goods['peculiar_properties'];
			$result['price']['price'] = $goods['price'];

			// Получение списка категорий товаров

			$categoryQuery = mysqli_query($link, 'SELECT * FROM `category` WHERE ((`id` != 1)&&(`id` != 2));');

			while ($category = mysqli_fetch_assoc($categoryQuery)) {

				$result['info']['category']['list'][] = $category;

			}
			
			// Получение списка производителей

			$manufacturerQuery = mysqli_query($link, 'SELECT `id`, `name` FROM `manufacturer`;');

			while ($manufacturer = mysqli_fetch_assoc($manufacturerQuery)){

				$result['info']['manufacturer']['list'][] = $manufacturer;

			}
			
			// Получение списка видов спорта

			$sportQuery = mysqli_query($link, 'SELECT * FROM `views_sport`;');

			while ($sport = mysqli_fetch_assoc($sportQuery)){

				$result['info']['sport']['list'][] = $sport;

			}

		}

		switch ($goods['categoryId']) {
			case 3:
				$subSql = 'SELECT `footwear_category`.`id` as `subCategoryId`, `age`.`id` as `ageId`, `age`.`value` as `age`, `size`.`id` as `sizeId`, `color`.`id` as `colorId`, `color`.`hex` as `colorHex`, `time_year`.`id` as `seasonId`, `floor`.`id` as `floorId`, `material`.`id` as `materialId` FROM `footwear_options` LEFT JOIN `footwear_category` ON `footwear_category`.`id` = `footwear_options`.`footwear_category` LEFT JOIN `age` ON `age`.`id` = `footwear_options`.`age` LEFT JOIN `size` ON `size`.`id` = `footwear_options`.`size` LEFT JOIN `color` ON `color`.`id` = `footwear_options`.`color` LEFT JOIN `time_year` ON `time_year`.`id` = `footwear_options`.`time_year` LEFT JOIN `floor` ON `floor`.`id` = `footwear_options`.`floor` LEFT JOIN `material` ON `material`.`id` = `footwear_options`.`material` WHERE `footwear_options`.`id` = '.$goods['id'].';';
				$subCatSql = 'SELECT * FROM `footwear_category`;';
				$ageSql = 'SELECT `id`, `value` as `name` FROM `age`;';
				$sizeSql = 'SELECT `id`, `value` as `name` FROM `size` WHERE `id` < 35;';
				$colorSql = 'SELECT * FROM `color`;';
				$seasonSql = 'SELECT * FROM `time_year`;';
				$materialSql = 'SELECT * FROM `material`;';
				$floorSql = 'SELECT * FROM `floor`;';
				$tasteSql = '';
				break;
			case 4:
				$subSql = 'SELECT `clothes_category`.`id` as `subCategoryId`, `age`.`id` as `ageId`, `age`.`value` as `age`, `size`.`id` as `sizeId`, `color`.`id` as `colorId`, `color`.`hex` as `colorHex`, `time_year`.`id` as `seasonId`, `floor`.`id` as `floorId`, `material`.`id` as `materialId` FROM `clothes_options` LEFT JOIN `clothes_category` ON `clothes_category`.`id` = `clothes_options`.`category_clothes` LEFT JOIN `age` ON `age`.`id` = `clothes_options`.`age` LEFT JOIN `size` ON `size`.`id` = `clothes_options`.`size` LEFT JOIN `color` ON `color`.`id` = `clothes_options`.`color` LEFT JOIN `time_year` ON `time_year`.`id` = `clothes_options`.`season` LEFT JOIN `floor` ON `floor`.`id` = `clothes_options`.`floor` LEFT JOIN `material` ON `material`.`id` = `clothes_options`.`material` WHERE `clothes_options`.`id` = '.$goods['id'].';';
				$subCatSql = 'SELECT * FROM `clothes_category`;';
				$ageSql = 'SELECT `id`, `value` as `name` FROM `age`;';
				$sizeSql = 'SELECT `id`, `value` as `name` FROM `size` WHERE `id` >= 35;';
				$colorSql = 'SELECT * FROM `color`;';
				$seasonSql = 'SELECT * FROM `time_year`;';
				$floorSql = 'SELECT * FROM `floor`;';
				$materialSql = 'SELECT * FROM `material`;';
				$tasteSql = '';
				break;
			case 5:
				$subSql = 'SELECT `inventory_category`.`id` as `subCategoryId`, `age`.`id` as `ageId`, `age`.`value` as `age`, `color`.`id` as `colorId`, `color`.`hex` as `colorHex`, `floor`.`id` as `floorId`, `material`.`id` as `materialId`, `inventory_options`.`length`, `inventory_options`.`width`, `inventory_options`.`weight` as `mass`, `inventory_options`.`height` as `height` FROM `inventory_options` LEFT JOIN `inventory_category` ON `inventory_category`.`id` = `inventory_options`.`inventory_category` LEFT JOIN `age` ON `age`.`id` = `inventory_options`.`age` LEFT JOIN `color` ON `color`.`id` = `inventory_options`.`color` LEFT JOIN `floor` ON `floor`.`id` = `inventory_options`.`floor` LEFT JOIN `material` ON `material`.`id` = `inventory_options`.`material` WHERE `inventory_options`.`id` = '.$goods['id'].';';
				$subCatSql = 'SELECT * FROM `inventory_category`;';
				$ageSql = 'SELECT `id`, `value` as `name` FROM `age`;';
				$sizeSql = '';
				$colorSql = 'SELECT * FROM `color`;';
				$floorSql = 'SELECT * FROM `floor`;';
				$materialSql = 'SELECT * FROM `material`;';
				$seasonSql = '';
				$tasteSql = '';
				break;
			case 6:
				$subSql = 'SELECT `sportpit_category`.`id` as `subCategoryId`, `taste`.`id` as `tasteId`, `sportpit_options`.`mass`, `sportpit_options`.`number_servings`, `sportpit_options`.`instruction` FROM `sportpit_options` LEFT JOIN `sportpit_category` ON `sportpit_category`.`id` = `sportpit_options`.`sportpit_category` LEFT JOIN `taste` ON `taste`.`id` = `sportpit_options`.`taste` WHERE `sportpit_options`.`id` = '.$goods['id'].';';
				$subCatSql = 'SELECT * FROM `sportpit_category`;';
				$floorSql = '';
				$ageSql = '';
				$sizeSql = '';
				$materialSql = '';
				$seasonSql = '';
				$colorSql = '';
				$tasteSql = 'SELECT * FROM `taste`;';
				break;
			default:
				# code...
				break;
		}

		// Проверка на скидку

		$discount = mysqli_fetch_assoc(mysqli_query($link, 'SELECT * FROM `discount` WHERE `tovarId` = '.$goods['id'].';'));
		if (isset($discount['discount'])){

			$result['price']['discount'] = $discount['discount'];
			$result['price']['until'] = $discount['until'];

		}else{

			$result['price']['discount'] = '';
			$result['price']['until'] = null;

		}

		// Подкатигория

		$subCategoryListQuery = mysqli_query($link, $subCatSql);

		while($subCategoryList = mysqli_fetch_assoc($subCategoryListQuery)){

			$result['info']['subCategory']['list'][] = $subCategoryList;

		}

		$subCategoryInfoQuery = mysqli_query($link, $subSql);
		$subCategoryInfo = mysqli_fetch_assoc($subCategoryInfoQuery);

		$result['info']['subCategory']['id'] = $subCategoryInfo['subCategoryId'];

		// Возрастная категория

		if ($ageSql != ''){

			$result['info']['age']['id'] = $subCategoryInfo['ageId'];
			$ageQuery = mysqli_query($link, $ageSql);

			while ($ageElem = mysqli_fetch_assoc($ageQuery)){

				$result['info']['age']['list'][] = $ageElem;

			}

		}else{

			$result['info']['age']['id'] = null;
			$result['info']['age']['list'] = [];

		}
		
		// Размер

		if ($sizeSql != ''){

			$result['info']['size']['id'] = $subCategoryInfo['sizeId'];
			$sizeQuery = mysqli_query($link, $sizeSql);

			while ($sizeElem = mysqli_fetch_assoc($sizeQuery)){

				$result['info']['size']['list'][] = $sizeElem;

			}

		}else{

			$result['info']['size']['id'] = null;
			$result['info']['size']['list'] = [];

		}

		// Цвет

		if ($colorSql != ''){

			$result['info']['color']['id'] = $subCategoryInfo['colorId'];
			$result['info']['color']['hex'] = $subCategoryInfo['colorHex'];
			$colorQuery = mysqli_query($link, $colorSql);

			while ($colorElem = mysqli_fetch_assoc($colorQuery)){

				$result['info']['color']['list'][] = $colorElem;

			}

		}else{

			$result['info']['color']['id'] = null;
			$result['info']['color']['hex'] = '';
			$result['info']['color']['list'] = [];

		}

		// Сезон

		if ($seasonSql != ''){

			$result['info']['season']['id'] = $subCategoryInfo['seasonId'];
			$seasonQuery = mysqli_query($link, $seasonSql);

			while ($seasonElem = mysqli_fetch_assoc($seasonQuery)){

				$result['info']['season']['list'][] = $seasonElem;

			}

		}else{

			$result['info']['season']['id'] = null;
			$result['info']['season']['list'] = [];

		}

		// Пол

		if ($floorSql != ''){

			$result['info']['floor']['id'] = $subCategoryInfo['floorId'];
			$floorQuery = mysqli_query($link, $floorSql);

			while ($floorElem = mysqli_fetch_assoc($floorQuery)){

				$result['info']['floor']['list'][] = $floorElem;

			}

		}else{

			$result['info']['floor']['id'] = null;
			$result['info']['floor']['list'] = [];

		}

		// Материал

		if ($materialSql != ''){

			$result['info']['material']['id'] = $subCategoryInfo['materialId'];
			$materialQuery = mysqli_query($link, $materialSql);

			while ($materialElem = mysqli_fetch_assoc($materialQuery)){

				$result['info']['material']['list'][] = $materialElem;

			}

		}else{

			$result['info']['material']['id'] = null;
			$result['info']['material']['list'] = [];

		}

		// Габариты

		if (isset($subCategoryInfo['width'])){

			$result['info']['width'] = $subCategoryInfo['width'];

		}else{

			$result['info']['width'] = '';

		}

		if (isset($subCategoryInfo['height'])){

			$result['info']['height'] = $subCategoryInfo['height'];

		}else{

			$result['info']['height'] = '';

		}

		if (isset($subCategoryInfo['length'])){

			$result['info']['length'] = $subCategoryInfo['length'];

		}else{

			$result['info']['length'] = '';

		}

		// Количество порций

		if (isset($subCategoryInfo['number_servings'])){

			$result['info']['count'] = $subCategoryInfo['number_servings'];

		}else{

			$result['info']['count'] = '';

		}
		
		// Инструкция

		if (isset($subCategoryInfo['instruction'])){

			$result['info']['instruction'] = $subCategoryInfo['instruction'];

		}else{

			$result['info']['instruction'] = '';

		}

		// Масса

		if (isset($subCategoryInfo['mass'])){

			$result['info']['mass'] = $subCategoryInfo['mass'];

		}else{

			$result['info']['mass'] = '';

		}

		// Список вкусов

		if ($tasteSql != ''){
			
			$result['info']['taste']['id'] = $subCategoryInfo['tasteId'];
			$tasteQuery = mysqli_query($link, $tasteSql);

			while ($tasteElem = mysqli_fetch_assoc($tasteQuery)){

				$result['info']['tastetaste']['list'][] = $tasteElem;

			}

		}else{

			$result['info']['taste']['id'] = null;
			$result['info']['taste']['list'] = [];

		}

		// Поиск изображений

		require('goodsImageSelect.php');

		$images = imageSelect($goods['id']);
		$result['images']['main'] = $images['main'];
		$result['images']['list'] = $images['list'];

	}

	echo json_encode($result);

?>