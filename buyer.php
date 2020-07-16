<?php 
	
	session_start();

	if ($_SESSION['root'] != 4){

		header("Location: http://imperium/index.php");
		exit();

	}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<link rel="stylesheet" type="text/css" href="styles/class.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
	<link rel="stylesheet" type="text/css" href="styles/buyer.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Imperium</title>
</head>
<body>
	
	<?php

		require('modules/header.php');

	?>
	
	<div class="w100 df jc fw" id="buyer">
		<div id="adminFunction">		
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="basketControl">
				<div class="functionArrow"></div>
				Корзина</div>
				<div class="adminFunctionWindow w100 df jc fw" v-if="basket.show">
					<div class="tovarConteiner df fw jc">
						<div class="text tovarName w100">
							<a href="tovar.php">Товар</a>
							<div class="tovarBasketDelete"></div>
						</div>
						<div class="img">
							<img src="image/goods/51d39844e872cadb0ec5ebd0d904b479/main.jpg">
						</div>
						<div class="text df jc w100 aic">Количество: 
							<input class="basketTovarCount" type="number" value="2">
						</div>
						<div class="butR w120 mb10">Купить</div>
					</div>
				</div>
			</div>	
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="orderControl">
				<div class="functionArrow"></div>
				Оформление заказа</div>
				<div class="adminFunctionWindow w100" v-if="order.show">
					<div class="orderInfoConteiner">
						<div class="tovarConteiner df fw jc">
							<div class="text tovarName w100">
								<a href="tovar.php">Товар</a>
							</div>
							<div class="img">
								<img src="image/goods/51d39844e872cadb0ec5ebd0d904b479/main.jpg">
							</div>
							<div class="text df jc w100 aic">Количество: 
								<input class="basketTovarCount" type="number" value="2">
							</div>
						</div>
						<div id="orders">
							<div class="text df jc aic" id="shop">
								Магазин получения:яж 
							</div>
							<div class="df w100 jc mt10">
								<div class="butR w120 mr10">Отмена</div>
								<div>Оплата:</div>
								<div class="butR w120 ml10 mr10">В магазине</div>
								<div class="butR w120 ml10">Онлайн</div>
							</div>			
						</div>
					</div>
				</div>
			</div>		
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="historyControl">
				<div class="functionArrow"></div>
				История покупок</div>
				<div class="adminFunctionWindow w100 df jc" v-if="history.show">
					<div class="tovarConteiner df fw jc">
						<div class="text tovarName w100">
							<a href="tovar.php">Товар</a>
						</div>
						<div class="img">
							<img src="image/goods/535156254fcd9c83697bffd119ab8cee/main.jpg">
						</div>
						<div class="text df jc w100 aic">Количество: 2 шт.</div>
						<div class="text df jc w100 aic">Статус: получен</div>
						<div class="text df jc w100 aic">Цена 4990 ₽</div>
						<div class="text df jc w100 aic">Дата покупки: 15_05_2019</div>
					</div>
				</div>
			</div>
	</div>
</body>
	<!-- VueJs -->
<script src="scripts/vue.js"></script>
	<!-- Axios -->
<script src="scripts/axios.min.js"></script>
	<!-- Авторизация -->
<script type="text/javascript" src="scripts/header.js"></script>

<?php 

	echo '<script type="text/javascript" id="autorisationWindowScript">';
		if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)||(isset($_SESSION[root]) != 1)){

			$_SESSION[id] = 0;
			$_SESSION[root] = 0;
			$_SESSION[userName] = 0;

			session_destroy();
 			exit;

		}
		echo 'autorisationWindow('.$_SESSION[id].', '.$_SESSION[root].', "'.$_SESSION[userName].'");';
	echo '</script>';

?>
<script type="text/javascript" src="scripts/buyer.js"></script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>