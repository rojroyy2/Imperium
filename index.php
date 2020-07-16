<?php 
	
	session_start();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<link rel="stylesheet" type="text/css" href="styles/index.css">
	<link rel="stylesheet" type="text/css" href="styles/class.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Imperium</title>
</head>
<body>
	
	<?php

		require('modules/header.php');

	?>

	<div class="df jc" id="sliderConteiner">
		<div id="slider">
			<div @click="sliderLeft" class="sliderButton" style="margin-right: auto;">
				<img @click="sliderLeft" src="styles/icon/chevron-circle-left-solid.svg" alt="">
			</div>
			<div id="sliderConteinerWindow">
				<div id="white" v-if="whiteShow" v-bind:style="opacityWriteAnimation"></div>
				<div id="sliderConteinerReletive">
					<?php

						$slide_url = scandir("slider_image");

						for ($i = 2; $i < count($slide_url); $i++){

							echo '<div class="slide" v-bind:style="styleWidthStyle">';
								echo '<a href="#" v-bind:style="styleWidthStyle">';
									echo '<img src="slider_image/'.$slide_url[$i].'" v-bind:style="styleWidthStyle">';
								echo '</a>';
							echo '</div>';	

						}
					?>
				</div>
			</div>
			<div @click="sliderRight" class="sliderButton" style="margin-left: auto;">
				<img @click="sliderRight" src="styles/icon/chevron-circle-right-solid.svg" alt="">
			</div>
		</div>
	</div>
	<div class="df fw aic js population">
		<?php

			require('modules/db_connect.php');

			$tovar_query = mysqli_query($link, 'SELECT `goods`.`name` FROM `sales` LEFT JOIN `accounting` ON `accounting`.`id` = `sales`.`accouting_id` LEFT JOIN `goods` ON `goods`.`id` = `accounting`.`goods_id` GROUP BY `goods`.id ORDER BY SUM(`sales`.`number`) DESC LIMIT 10;');

			While($tovar_image = mysqli_fetch_assoc($tovar_query)){
			
		?>
			<a href="tovar.php?id=<?php echo $tovar_image['id']; ?>">
				<img class="image_manufacturer" src="image\goods\<?php echo md5($tovar_image['name']); ?>\main.jpg"/>
			</a>
		<?php		
			}
		?>
	</div>
	<div class="df fw aic js population">
		<?php 
			$manufactures_query = mysqli_query($link, 'SELECT `manufacturer`.`name`, `manufacturer`.`id` FROM `sales` LEFT JOIN `accounting` ON `accounting`.`id` = `sales`.`accouting_id` LEFT JOIN `goods` ON `goods`.`id` = `accounting`.`goods_id` LEFT JOIN `manufacturer` ON `manufacturer`.`id` = `goods`.`manufacturer_id` GROUP BY `manufacturer`.`name` LIMIT 10;');

			While($manufactures_image = mysqli_fetch_assoc($manufactures_query)){
		?>
			<a href="manufacturer.php?id=<?php echo $manufactures_image['id']; ?>">
				<img  src="image/manufacturer/<?php echo $manufactures_image['name']; ?>/logo.png"/>
			</a>
		<?php		
			}
		?>
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
<?php 

	echo '<script type="text/javascript" id="autorisationWindowScript">';
		if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)){

			$_SESSION[id] = 0;
			$_SESSION[root] = 0;
			$_SESSION[userName] = 0;

			session_destroy();

		}
		echo 'autorisationWindow('.$_SESSION[id].', '.$_SESSION[root].', "'.$_SESSION[userName].'");';
	echo '</script>';

?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="scripts/index.js"></script>
	<!-- LiveReload -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>