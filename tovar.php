<?php 
	
	session_start();

	if (!isset($_GET['id'])){

		header('Location: index.php');

	}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<link rel="stylesheet" type="text/css" href="styles/tovar.css">
	<link rel="stylesheet" type="text/css" href="styles/class.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Imperium</title>
</head>
<body>
	
	<?php

		require('modules/header.php');

		require('modules/db_connect.php');

		$goodsQuery = mysqli_query($link, 'SELECT `goods`.`id`, `goods`.`name` as `name`, `goods`.`bar_code`, `category`.`id` as `categoryId`, `views_sport`.`id` as `sportId`, `goods`.`description`, `goods`.`peculiar_properties`, `manufacturer`.`id` as `manufacturerId`, `views_sport`.`name` as `sportName`, `manufacturer`.`name` as `manufacturerName`, `category`.`name` as `categoryName` FROM `goods` LEFT JOIN `category` ON `category`.`id` = `goods`.`category_id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` LEFT JOIN `views_sport` ON `views_sport`.`id` = `goods`.`sport` WHERE `goods`.`id` = '.$_GET['id'].';');
		$goods = mysqli_fetch_assoc($goodsQuery);

	?>

	<div id="tovarConteiner">
		<h1 class="tovarH1"><?php echo $goods['name']; ?></h1>
		<div id="tovarPhotoConteiner">
			<div id="tovarPreview">
				<div v-for="img in imageListMain" class="tovarPreviewImgConteiner df aic jc">
					<img :src="img">
				</div>
			</div>
			<div id="allPhotoConteiner" class="df jc aic fw">
				<img v-for="img in imageAll" :src="img">
			</div>
		</div>
		<div class="tovarButtonConteiner mt10">
			<div class="butR">В корзину</div>
			<div class="butR">Купить</div>
		</div>
		<div class="conteiner mt10">
			<div class="tovarH1 mb10">Особенности:</div>
			<ul id="peculiar_properties" class="mt10"><?php echo $goods['peculiar_properties']; ?></ul>
		</div>
		<div class="conteiner mt10">
			<div class="tovarH1">Описание:</div>
			<p class="tovarText"><?php echo $goods['description'] ?></p>
		</div>
		<div class="conteiner mt10">
			<div class="tovarH1 mb10">Характеристики:</div>
			<div class="tovarParamConteiner">
				<p data-id="<?php echo $goods['categoryId']; ?>" class="tovarParam">Категория: <span class="spanSearch"><?php echo $goods['categoryName']; ?></span></p>
				<p data-id="<?php echo $goods['manufacturerId']; ?>" class="tovarParam">Производитель: <span class="spanSearch"><?php echo $goods['manufacturerName']; ?></span></p>
				<p data-id="<?php echo $goods['sportId']; ?>" class="tovarParam">Вид спорта: <span class="spanSearch"><?php echo $goods['sportName']; ?></span></p>
			<?php

				switch ($goods['categoryId']) {
					case 3:
						$infoQuery = mysqli_query($link, 'SELECT `footwear_category`.`name` as `subCategoryName`, `age`.`value` as `age`, `size`.`value` as `sizeName`, `color`.`name` as `colorName`, `color`.`hex` as `colorHex`, `time_year`.`name` as `seasonName`, `floor`.`name` as `floorName`, `material`.`name` as `materialName`, `footwear_category`.`id` as `footwear_categoryId`, `age`.`id` as `ageId`, `size`.`id` as `sizeId`, `color`.`id` as `colorId`, `time_year`.`id` as `seasonId`, `floor`.`id` as `floorId`, `material`.`id` as `materialId` FROM `footwear_options` LEFT JOIN `footwear_category` ON `footwear_category`.`id` = `footwear_options`.`footwear_category` LEFT JOIN `age` ON `age`.`id` = `footwear_options`.`age` LEFT JOIN `size` ON `size`.`id` = `footwear_options`.`size` LEFT JOIN `color` ON `color`.`id` = `footwear_options`.`color` LEFT JOIN `time_year` ON `time_year`.`id` = `footwear_options`.`time_year` LEFT JOIN `floor` ON `floor`.`id` = `footwear_options`.`floor` LEFT JOIN `material` ON `material`.`id` = `footwear_options`.`material` WHERE `footwear_options`.`id` = '.$_GET['id'].';');
						$info = mysqli_fetch_assoc($infoQuery);
			?>

				<p data-id="<?php echo $info['subCategoryId']; ?>" class="tovarParam">Подкатегория: <span class="spanSearch"><?php echo $info['subCategoryName']; ?></span></p>
				<p data-id="<?php echo $info['ageId']; ?>" class="tovarParam">Возрастная категория: <span class="spanSearch"><?php echo $info['age']; ?></span> лет</p>
				<p data-id="<?php echo $info['sizeId']; ?>" class="tovarParam">Размер: <span class="spanSearch"><?php echo $info['sizeName'] ?></span></p>
				<p data-id="<?php echo $info['materialId']; ?>" class="tovarParam">Материал: <span class="spanSearch"><?php echo $info['materialName'] ?></span></p>
				<p data-id="<?php echo $info['seasonId']; ?>" class="tovarParam">Сезон: <span class="spanSearch"><?php echo $info['seasonName'] ?></span></p>
				<p data-id="<?php echo $info['floorId']; ?>" class="tovarParam">Пол: <span class="spanSearch"><?php echo $info['floorName'] ?></span></p>
				<p data-id="<?php echo $info['colorId']; ?>" class="tovarParam">Цвет: <span class="spanSearch"><?php echo $info['colorName'] ?> <span style="background-color: #<?php echo $info['colorHex']; ?>;" class="colorBlock"></span></span></p>
			<?php
						break;
					case 4:
						
						break;
					case 5:
						
						break;
					case 6:
						
						break;
					default:
						# code...
						break;
				}

			?>
		</div>
			<div id="tovarSearchButConteiner">
				<div class="tovarSearchBut">Отчистить</div>
				<div class="tovarSearchBut">Применить</div>
			</div>
		</div>
	</div>

	<?php 

		include('modules/footer.php');

	?>
</body>
	<!-- VueJs -->
<script src="scripts/vue.js"></script>
	<!-- Axios -->
<script src="scripts/axios.min.js"></script>
	<!-- Авторизация -->
<script type="text/javascript" src="scripts/header.js"></script>
	<!-- js -->
<script type="text/javascript" src="scripts/tovar.js"></script>
<?php 

	echo '<script type="text/javascript" id="autorisationWindowScript">';
		if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)){

			$_SESSION[id] = 0;
			$_SESSION[root] = 0;
			$_SESSION[userName] = 0;

			session_destroy();

		}
		echo 'autorisationWindow('.$_SESSION[id].', '.$_SESSION[root].', "'.$_SESSION[userName].'");';
		echo 'tovar.tovarId = '. $_GET['id'] .';';
		echo 'tovar.images();';
	echo '</script>';

?>
	<!-- LiveReload -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>