<?php 
	
	session_start();
	if ($_SESSION['root'] != 3){

		header("Location: http://imperium/index.php");
		exit();

	}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<?php
		$time = getdate();

		require ('modules/config.php');

		if (($time['hours'] >= $timeMax)||($time['hours'] <= $timeMin - 1)){

			echo "Не рабочее время!";
			?>
				<script type="text/javascript">
					setTimeout(function(){
						location.href = "http://imperium/index.php";
					}, 5000);
				</script>
			<?php
			exit();

		}
	?>
	<link rel="stylesheet" type="text/css" href="styles/class.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
	<link rel="stylesheet" type="text/css" href="styles/salespeople.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Imperium</title>
</head>
<body>
	
	<?php

		

		require('modules/header.php');

	?>
	
	<div class="w100 df jc">
		<div id="adminFunction">		
			<div class="adminFunctionConteiner">
				<div class="adminFunctionWindow w100 df jc aic fw">
					<h1 class="adminFunctionH1">{{ shop.statusWrite }}</h1>
				</div>
				<div class="adminFunctionButton w100 df js aic" @click="basketOpen">
					<div class="functionArrow"></div>
					Оформление покупки
				</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="basket.show">
					<div class="mt10 df jc w100 mb10">
						<div class="infoText">Код товара:</div>
						<input @keyup.enter="addBasket" class="w120 mr10 ml10" type="number" v-model="basket.code">
						<div class="infoText">Количество:</div>
						<input @keyup.enter="addBasket" class="w90 mr10 ml10" type="number" min='1' value="1" v-model="basket.tovarCount">
						<div class="butR w120 ml10" @click="addBasket">Добавить</div>
					</div>
					<h1 class="adminFunctionH1" v-if="basket.searchStatus.length != 0">{{ basket.searchStatus }}</h1>
					<div class="conteiner w100 jc fw" v-if="basket.list.length != 0">
						<h1 class="adminFunctionH1">Формирование покупки:</h1>
						<table id="basket">
							<tr>
								<th>Лок. код</th>
								<th>Bar-Code</th>
								<th>Название</th>
								<th>Производитель</th>
								<th>Количество</th>
								<th>Цена</th>
								<th>Сумма</th>
							</tr>
							<tr @click="basketEditClick" v-for="elem in basket.list" :data-maxCount="elem.maxCount" :data-count="elem.count" :data-local="elem.local">
								<td>{{ elem.local }}</td>
								<td>{{ elem.barCode }}</td>
								<td>{{ elem.name }}</td>
								<td>{{ elem.manufacturer }}</td>
								<td>{{ elem.count }} шт.</td>
								<td>{{ elem.price }} ₽</td>
								<td>{{ elem.price * elem.count }} ₽</td>
							</tr>
						</table>
						<div class="conteiner w100 df je aic mt10">
							<div class="infoText">Сумма: {{ tovarPriceSum }}</div>
						</div>
						<div class="conteiner">
							<div class="w100 df jc fw mb10">
								<input @keyup.enter="tovarCountEdit" type="text" class="w120" v-model="basket.newCount" placeholder="Количество:">
								<div class="butR ml10 w120" @click="tovarCountEdit">Изменить количество</div>
								<div class="butR ml10 w120" @click="tovarCansel">Отмена</div>
								<div class="butR ml10 w120" @click="tovarClear">Отменить всё</div>
								<div class="butR ml10 w120" @click="basketCash">Наличные</div>
								<div class="butR ml10 w120" @click="basketNonCash">Без. нал.</div>
							</div>
						</div>
						<h1 class="adminFunctionH1" v-if="basket.basketStatus.length != 0">{{ basket.basketStatus }}</h1>
					</div>
				</div>
				<div class="adminFunctionButton w100 df js aic" @click="ordersOpen">
					<div class="functionArrow"></div>
					Выдача заказов
				</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="orders.show">
					<div class="mt10 df jc w100 mb10">
						<div class="infoText">Номер заказа:</div>
						<input class="w120 mr10 ml10" type="text" v-model="orders.search" @keyup.enter="ordersSearch">
						<div class="butR w120" @click="ordersSearch">Поиск:</div>
					</div>
					<h1 class="adminFunctionH1" v-if="orders.status.length != 0">{{ orders.status }}</h1>
					<h1 class="adminFunctionH1" v-if="orders.infoShow">Информация о заказе: {{ orders.info.order }}</h1>
					<div id="ordersConteiner" v-if="orders.infoShow">
						<img :src="orders.info.img">
						<div class="conteiner" id="ordersInfoConteiner">
							<div class="infoText">Локальный код: {{ orders.info.local }}</div>
							<div class="infoText">Название: {{ orders.info.name }}</div>
							<div class="infoText">BarCode: {{ orders.info.bar }}</div>
							<div class="infoText">Количество: {{ orders.info.count }}</div>
							<div class="infoText">Дата заказа: {{ orders.info.date }}</div>
							<div class="infoText">Статус доставки: {{ orders.info.orderStatus.name }}</div>
							<div class="infoText">Статус оплаты: {{ orders.info.payStatus.name }}</div>
							<div class="infoText">Цена: {{ orders.info.price }}</div>
							<div class="infoText">Получатель: {{ orders.info.buyer }}</div>
						</div>
					</div>
					<h1 class="adminFunctionStatus" v-if="orders.statusInfo.length != 0">{{ orders.statusInfo }}</h1>
					<div class="conteiner" v-if="orders.infoShow">
						<div class="w100 df jc fw mt10 mb10">
							<div class="butR ml10 w120" @click="orderCash" v-if="orders.info.payStatus.status == 0">Наличные</div>
							<div class="butR ml10 w120" @click="orderNoCash" v-if="orders.info.payStatus.status == 0">Без нал.</div>
							<div class="butR ml10 w120" @click="orderWrite" v-if="((orders.info.payStatus.status == 1)&&(orders.info.orderStatus.status == 1))">Выдать</div>
						</div>
					</div>
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
<script type="text/javascript" src="scripts/salespeople.js"></script>
<?php

	echo '<script type="text/javascript" id="autorisationWindowScript">';
		if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)||(isset($_SESSION[root]) != 3)){

			$_SESSION[id] = 0;
			$_SESSION[root] = 0;
			$_SESSION[userName] = 0;

			session_destroy();

		}
		echo 'autorisationWindow('.$_SESSION[id].', '.$_SESSION[root].', "'.$_SESSION[userName].'");';
		echo 'salespeople.salespeopleId = ' . $_SESSION['id'];

		$shopQuery = mysqli_query($link, 'SELECT `salespeople`.`shop_id` as `id_shop`, `shopping_opportunities`.`address` FROM `salespeople` LEFT JOIN `shopping_opportunities` ON `shopping_opportunities`.`id` = `salespeople`.`shop_id` WHERE `salespeople`.`id` = '.$_SESSION['id'].';');
		$shop = mysqli_fetch_assoc($shopQuery);

		if (isset($shop['id_shop'])){
			?>	

				salespeople.shop.address = '<?php echo $shop['address']; ?>';
				salespeople.shop.statusWrite = 'Магазин: <?php echo $shop['address']; ?>';
			<?php
		}else{
			?>
			salespeople.shop.address = '';
			salespeople.shop.statusWrite = 'Вы не являетесь администратором ни какого магазина. Обратитесь к администратору сайта!';
			<?php
		}

?>
</script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>