<?php 
	
	session_start();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<link rel="stylesheet" type="text/css" href="styles/category.css">
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

	?>
	
	<div class="w100 df jc">
		<div class="df jc" id="categoryConteiner">
			<div id="categoryMenuConteiner">
				<div class="categoryMenuConteiner">
					<div data-show="price" class="categoryMenuButton" :class="{ categoryMenuButtonClick: categoryMenu.price.show }" v-on:click="categoryMenuOpen">Цена:</div>
					<div class="categoryMenu" v-if="categoryMenu.price.show" :class="{ categoryMenuOpen: categoryMenu.price.opacity }">
						<div class="conteiner w100 df jc mt10">
							<h1 class="ma">Мин:</h1>
							<input v-model="categoryMenu.price.min" type="number">
						</div>
						<div class="conteiner w100 df jc mt10 mb10">
							<h1 class="ma">Макс:</h1>
							<input v-model="categoryMenu.price.max" type="number">
						</div>
					</div>
				</div>
				<div class="categoryMenuConteiner">
					<div data-show="manufacturer" :class="{ categoryMenuButtonClick: categoryMenu.manufacturer.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Производитель:</div>
					<div class="categoryMenu" v-if="categoryMenu.manufacturer.show" :class="{ categoryMenuOpen: categoryMenu.manufacturer.opacity }">
						<?php

							$manufacturerQuery = mysqli_query($link, 'SELECT `id`, `name` FROM `manufacturer`;');

							while ($manufacturer = mysqli_fetch_assoc($manufacturerQuery)){

						?>

							<div class="categorySelectElem df aic" data-id="<?php echo $manufacturer['id']; ?>" @click="categorySelectElem('manufacturer')">
								<?php echo $manufacturer['name']; ?>
							</div>

						<?php

							}

						?>
					</div>
				</div>
				<?php

					switch ($_GET['id']) {
						case 3:
							require('modules/category/footwear.php');
							break;
						case 4:
							require('modules/category/clothes.php');
							break;
						case 5:
							require('modules/category/inventory.php');
							break;
						case 6:
							require('modules/category/sportpit.php');
							break;
						default:
							# code...
							break;
					}

				?>
				<div id="categorySearchButton" class="df fw jc">
					<div @click="categorySearchButtonClear">Отчистить</div>
					<div @click="categoryTovarShowAll(10)">Показать</div>
				</div>
			</div>
			<div id="categorySearchResult" class="df">
				<div id="tovarArrayNull" class="df jc aic" v-if="categoryResult.tovarArray.length == 0">
					<div>
						{{ categoryResult.responseStr }}
					</div>
				</div>
				<div id="orderConteiner" class="df jc aic w100" v-if="categoryResult.tovarArray.length != 0">
					Сортировать по:
					<div class="orderButton">Цена (по возрастанию)</div>
					<div class="orderButton">Рейтинг (по убыванию)</div>
					<div class="orderButton" @click="categoryResult.view = !categoryResult.view">
						Показывать:
						<img v-if="categoryResult.view == false" src="styles/icon/categoryResultShowCollumn.svg">
						<img v-else src="styles/icon/categoryResultShowRows.svg">
					</div>
				</div>
				<div :class="{ tovarConteinerCol: categoryResult.view }" class="tovarGrid">
					<div class="categoryResultTovarConteiner" class="df js ais fw mt10" v-if="categoryResult.tovarArray.length != 0" v-for="tovar in categoryResult.tovarArray">
						<div class="tovarConteiner">
							<div class="tovarImg df jc aic">
								<img :src="tovar.jp">
							</div>		
							<div class="tovarInfoConteiner">
								<a v-bind:href="tovar.url" class="tovarName">{{ tovar.name }}</a>
								<div class="tovarRating w100 df aic">
									Рейтинг: <span>{{ tovar.rating }}</span>
								</div>
								<p class="tovarInfo" v-if="!categoryResult.view">
									{{ tovar.info }}
								</p>
								<div :class="{ tovarPriceCol: categoryResult.view }">
									<div class="price">
										<div class="df jc aic" :class="{ priceLineThrough: tovar.discount != null }">
											{{ tovar.price }} ₽
										</div>
										<div class="df jc aic" v-if="tovar.discount != null">
											Скидка: {{ tovar.discount }} % = {{ Math.round(tovar.price - (tovar.price / 100 * tovar.discount)) }} ₽ до {{ tovar.discountUntil }}
										</div>
									</div>
									<div class="tovarButtonConteiner">
										<a :href="tovar.url" class="tovarButton"><img src="styles/icon/eye-solid.svg"></a>
										<div :data-tovarId="tovar.id" class="tovarButton"><img src="styles/icon/shopping-basket-solid.svg" @click="basketAdd"></div>
										<div :data-tovarId="tovar.id" class="tovarButton">Купить</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="paginatorPlus" class="w100 df jc aic mt10" v-if="((categoryResult.tovarArray.length != 0)&&(max > paginator))" @click="paginatorClick">Ещё..</div>
			</div>
			<div v-if="alertShow" id="alert">
				{{ alertContent }}
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
	<!-- Категории -->
<script type="text/javascript" src="scripts/category.js"></script>
	
<script type="text/javascript" id="autorisationWindowScript">

<?php

	if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)){

		$_SESSION[id] = 0;
		$_SESSION[root] = 0;
		$_SESSION[userName] = 0;

		session_destroy();

	}

	echo 'autorisationWindow('.$_SESSION[id].', '.$_SESSION[root].', "'.$_SESSION[userName].'");';

?>
	categoryVue.categoryGet = <?php echo $_GET['id']; ?>;
	categoryVue.root = <?php echo $_SESSION['root']; ?>;
	categoryVue.buyer = <?php echo $_SESSION['id']; ?>;

</script>
	<!-- LiveReload -->
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>