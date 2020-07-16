<?php 
	
	session_start();
	if ($_SESSION['root'] != 2){

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

		// if (($time['hours'] >= $timeMax)||($time['hours'] <= $timeMin - 1)){

		// 	?>
		// 		<script type="text/javascript">
					// alert('Не рабочее время!');
		// 			setTimeout(function(){
		// 				location.href = "http://imperium/index.php";
		// 			}, 5000);
		// 		</script>
		// 	<?php
		// 	exit();

		// }
	?>
	<link rel="stylesheet" type="text/css" href="styles/class.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<link rel="stylesheet" type="text/css" href="styles/admin.css">
	<link rel="stylesheet" type="text/css" href="styles/shopAdministrator.css">
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
				<div class="adminFunctionButton w100 df js aic" @click="tovarOpen">
					<div class="functionArrow"></div>
					Товары
				</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="tovar.show">
					<div class="adminFunctionH1">Поиск партии:</div>
					<div class="tovarSearchConteiner">
						<input type="text" v-model="tovar.search" @keyup.enter="tovarSearch(`id`)">
						<div class="butR" @click="tovarSearch(`id`)">Локальный</div>
						<div class="butR" @click="tovarSearch(`name`)">Название</div>
						<div class="butR" @click="tovarSearch(`bar_code`)">BarCode</div>
					</div>
					<h1 class="adminFunctionStatus" v-if="tovar.searchStatus.length != 0">{{ tovar.searchStatus }}</h1>
					<table id="tovarList" v-if="tovar.table.length != 0">
						<tr>
							<th>Партия</th>
							<th>Локальный</th>
							<th>BarCode</th>
							<th>Название</th>
							<th>Поступил</th>
							<th>Произведён</th>
							<th>Осталось</th>
						</tr>
						<tr :data-reside="tr.reside" :data-id="tr.part" v-for="tr in tovar.table" @click="tovarTableClick">
							<td>{{ tr.part }}</td>
							<td>{{ tr.local }}</td>
							<td>{{ tr.bar }}</td>
							<td>{{ tr.name }}</td>
							<td>{{ tr.delivery }}</td>
							<td>{{ tr.production }}</td>
							<td>{{ tr.residue }}</td>
						</tr>
					</table>
					<h1 class="adminFunctionStatus" v-if="tovar.tovarStatus.length != 0">{{ tovar.tovarStatus }}</h1>
					<div id="tovarOffsConteiner" v-if="tovar.tableId != null">
						<div class="infoText">Комментарий:</div>
						<input type="text" v-model="tovar.comment">
						<div class="infoText">Кол-во:</div>
						<input type="number" min="1" :max="tovar.max" v-model="tovar.count">
						<div class="butR" @click="tovarCansel">Отмена</div>
						<div class="butR" @click="tovarOffs">Списать</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="partOpen">
					<div class="functionArrow"></div>
					Новая партия
				</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="part.show">
					<h1 class="adminFunctionH1">Поиск:</h1>
					<div class="newTovarSearchConteiner">
						<input type="number" v-model="part.search">
						<div class="butR" @click="partSearch(`id`)">Локальный</div>
						<div class="butR" @click="partSearch(`bar_code`)">BarCode</div>
					</div>
					<h1 class="adminFunctionStatus mb10" v-if="part.searchStatus.length != 0">{{ part.searchStatus }}</h1>
					<h1 class="adminFunctionH1 mt10" v-if="part.infoShow">Введите информацию о добавляемой партии:</h1>
					<div class="newPartiTovarInfo" v-if="part.infoShow">
						<div class="adminFunctionStatus">Локальный код: {{ part.local }}</div>
						<div class="adminFunctionStatus">BarCode: {{ part.bar }}</div>
						<div class="adminFunctionStatus">Название: {{ part.name }}</div>
						<div class="adminFunctionStatus">Производитель: {{ part.manufacturer }}</div>
					</div>
					<div id="newPartiInfoConteiner" v-if="part.infoShow">
						<div class="conteiner">
							<div>Дата производства:</div>
							<input type="date" v-model="part.dateProd">
						</div>
						<div class="conteiner">
							<div>Количество:</div>
							<input type="number" min="1" v-model="part.count">
						</div>
						<div class="conteiner">
							<div>Цена партии:</div>
							<input type="number" min="1" v-model="part.pricePart">
						</div>
						<div class="conteiner">
							<div>Код поставщика:</div>
							<input type="number" v-model="part.sup" @keyup="partSupChange" @change="partSupChange">
						</div>
						<div>{{ part.supName }}</div>
						<select v-model="part.optionsKey">
							<option v-for="el in part.options" :value="el.key">{{ el.options }}</option>
						</select>
					</div>
					<h1 class="adminFunctionStatus" v-if="((part.infoShow)&&(part.infoStatus.length != 0))">{{ part.infoStatus }}</h1>
					<div class="df jc mt10">
						<div class="butR mr10 w120" v-if="part.infoShow" @click="newPartCansel">Отмена</div>
						<div class="butR ml10 w120" v-if="part.infoShow" @click="newPartSave">Добавить</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="ordersOpen">
					<div class="functionArrow"></div>
					Заказы
				</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="orders.show">
					<h1 class="adminFunctionH1">Управление заказами:</h1>
					<div id="ordersConteiner" class="mb10">
						<input type="text" v-model="orders.search" @keyup.enter="orderSearch">
						<div class="butR" @click="orderSearch">Поиск</div>
					</div>
					<h1 class="adminFunctionStatus" v-if="orders.orderSearchStatus.length != 0">{{ orders.orderSearchStatus }}</h1>
					<div class="newPartiTovarInfo" v-if="orders.orderTakeShow">
						<div class="adminFunctionStatus">Локальный код: {{ orders.orderTakeInfo.local }}</div>
						<div class="adminFunctionStatus">BarCode: {{ orders.orderTakeInfo.bar }}</div>
						<div class="adminFunctionStatus">Название: {{ orders.orderTakeInfo.name }}</div>
						<div class="adminFunctionStatus">Количество: {{ orders.orderTakeInfo.count }}</div>
					</div>
					<h1 class="adminFunctionStatus" v-if="((orders.orderTakeShow == true)&&(orders.orderTakeStatus.length != 0))">{{ orders.orderTakeStatus }}</h1>
					<div class="df jc mt10 mb10" v-if="orders.orderTakeShow">
						<div class="butR w120 mr10" @click="orderTake('orderCansel.php')" v-if="orders.orderTakeInfo.status == 1">Отменить</div>
						<div class="butR w120 ml10" @click="orderTake('ordersStatusCome.php')" v-if="orders.orderTakeInfo.status == 0">Принят</div>
					</div>
					<h1 class="adminFunctionH1 mt10" v-if="orders.thisShopOrdersSend.length != 0">Необходимо отправить:</h1>
					<table id="orderSendList" v-if="orders.thisShopOrdersSend.length != 0">
						<tr>
							<th>Заказ</th>
							<th>Партия</th>
							<th>Локальный</th>
							<th>BarCode</th>
							<th>Название</th>
							<th>Производитель</th>
							<th>Количество</th>
							<th>Адресат</th>
						</tr>
						<tr @click="ordersSendClick" :data-id="tr.order" v-for="tr in orders.thisShopOrdersSend">
							<td>{{ tr.order }}</td>
							<td>{{ tr.part }}</td>
							<td>{{ tr.local }}</td>
							<td>{{ tr.bar }}</td>
							<td>{{ tr.name }}</td>
							<td>{{ tr.manufacturer }}</td>
							<td>{{ tr.count }}</td>
							<td>{{ tr.shop }}</td>
						</tr>
					</table>
					<h1 class="adminFunctionStatus" v-if="orders.sendStatus.length != 0">{{ orders.sendStatus }}</h1>
					<div class="df jc mt10 mb10" v-if="orders.orderSendId != null">
						<div class="butR w120" @click="orderSend">Отправлено</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="workersOpen">
					<div class="functionArrow"></div>
					Сотрудники
				</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="workers.show">
					<div id="workerConteiner" class="mb10">
						<input type="text" v-model="workers.search" @keyup.enter="workersSearch">
						<div class="butR" @click="workersSearch">Поиск</div>
					</div>
					<h1 class="adminFunctionStatus" v-if="workers.searchStatus.length != 0">{{ workers.searchStatus }}</h1>
					<table id="workersListTable" v-if="workers.workersList.length != 0">
						<tr>
							<th>ФИО</th>
							<th>Телефон</th>
							<th>Адрес</th>
							<th>Трудовая книжка</th>
							<th>Должность</th>
						</tr>
						<tr :data-root="tr.root" :data-id="tr.id" v-for="tr in workers.workersList" @click="workersTableClick" @dblclick="workersTableDblClick">
							<td>{{ tr.fio }}</td>
							<td>{{ tr.phone }}</td>
							<td>{{ tr.address }}</td>
							<td>{{ tr.workbook }}</td>
							<td>{{ tr.works }}</td>
						</tr>
					</table>
					<h1 class="adminFunctionStatus mt10" v-if="workers.workersList.length != 0">Интервал:</h1>
					<div class="df jc w100" id="workerDateInterval" v-if="workers.workersList.length != 0">
						<div class="conteiner">
							<div>
								Начальная дата:
							</div>
							<input type="date" v-model="workers.startDate">
						</div>
						<div class="conteiner">
							<div>
								Конечная дата:
							</div>
							<input type="date" v-model="workers.endDate">
						</div>
					</div>
					<h1 class="adminFunctionStatus" v-if="workers.workersListStatus.length != 0">{{ workers.workersListStatus }}</h1>
					<div class="df jc mt10 mb10 w100" v-if="((workers.workerId != null)&&(workers.workerRoot != null))">
						<div class="butR w120 mt10 mr10" @click="dayInfoList">Информация</div>
						<div class="butR w120 mt10 ml10" @click="workerAddDay">Засчитать смену</div>
					</div>
					<table v-if="workers.dayTable.length != 0">
						<tr>
							<th>Дата</th>
							<th>Начал</th>
							<th>Закончил</th>
							<th>День недели</th>
							<th>Количество времени</th>
						</tr>
						<tr v-for="tr in workers.dayTable">
							<td>{{ tr.date }}</td>
							<td>{{ tr.begin }}</td>
							<td>{{ tr.end }}</td>
							<td>{{ tr.week }}</td>
							<td>{{ tr.countHours }}</td>
						</tr>
					</table>
					<div id="newDayConteiner" v-if="((workers.workerId != null)&&(workers.workerRoot != null)&&(workers.dayPlusShow == true))">
						<div>Дата: {{ thisDate }}</div>
						<div>Начал:</div>
						<input type="time" v-model="workers.dayStart">
						<div>Закончил:</div>
						<input type="time" v-model="workers.dayEnd">
					</div>
					<h1 class="adminFunctionStatus" v-if="workers.dayStatus.length != 0">{{ workers.dayStatus }}</h1>
					<div class="df jc w100 mt10 pt10" style="border-top: 2px solid #BF3030;" v-if="((workers.workerId != null)&&(workers.workerRoot != null)&&(workers.dayPlusShow == true))">
						<div class="butR w120 mr10" @click="addWorkDayCansel">Отменить</div>
						<div class="butR w120 ml10" @click="workerAddDayPlus">Засчитать</div>
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
<script type="text/javascript" src="scripts/shopAdministrator.js"></script>
<?php 

	echo '<script type="text/javascript" id="autorisationWindowScript">';
		if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)||(isset($_SESSION[root]) != 2)){

			$_SESSION[id] = 0;
			$_SESSION[root] = 0;
			$_SESSION[userName] = 0;

			session_destroy();

		}
		echo 'autorisationWindow('.$_SESSION[id].', '.$_SESSION[root].', "'.$_SESSION[userName].'");';

		$shopQuery = mysqli_query($link, 'SELECT `administrators`.`id_shop` as `id_shop`, `shopping_opportunities`.`address` FROM `administrators` LEFT JOIN `shopping_opportunities` ON `shopping_opportunities`.`id` = `administrators`.`id_shop` WHERE `administrators`.`id` = '.$_SESSION['id'].';');
		$shop = mysqli_fetch_assoc($shopQuery);

		if (isset($shop['id_shop'])){
			?>
				shopAdmin.shop.address = '<?php echo $shop['address']; ?>';
				shopAdmin.shop.statusWrite = 'Магазин: <?php echo $shop['address']; ?>';
			<?php
		}else{
			?>
			shopAdmin.shop.address = '';
			shopAdmin.shop.statusWrite = 'Вы не являетесь администратором ни какого магазина. Обратитесь к администратору сайта!';
			<?php
		}
?>
</script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>