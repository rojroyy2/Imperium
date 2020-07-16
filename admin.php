<?php 
	
	session_start();
	if ($_SESSION['root'] != 1){

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
	<link rel="stylesheet" type="text/css" href="styles/chiefAdministrator.css">
	<meta charset="UTF-8">
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
				<div class="adminFunctionButton w100 df js aic" @click="siteControl">
				<div class="functionArrow"></div>
				Управление сайтом</div>
				<div class="adminFunctionWindow w100" v-if="adminFunction.siteControl.show">
					<h1 class="adminFunctionH1">Управление слайдером</h1>
					<div class="conteiner">
						<h1 v-if="adminFunction.siteControl.slider.status.show" class="adminFunctionStatus">{{ adminFunction.siteControl.status }}</h1>
						<div class="df jc fw w100">
							<div class="slideListElem df jc aic" v-for="url in adminFunction.siteControl.slider.list">
								<div class="slideDelete" @click="deleteSlide" :data-img="url.delete"></div>
								<img :src="url.url">
							</div>
						</div>	
						<div id="newSlideConteiner" class="df jc ais fw">
							<h1>Новый слайд:</h1>
							<img :src="adminFunction.siteControl.slider.preview" v-if="adminFunction.siteControl.slider.img != null">
							<input type="file" @change="newSlide" id="newSlideInput" multiple="false" accept="image/jpeg">
							<div class="butR" @click="newSlideAdd">Добавить</div>
							<h1 class="adminFunctionStatus">{{ adminFunction.siteControl.slider.newSlideStatus }}</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="shopControl">
					<div class="functionArrow"></div>
					Управление магазинами
				</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="adminFunction.shopControl.show">
					<h1 class="adminFunctionH1">Управление магазинами:</h1>
					<div class="functionSearch mt10">
						<input class="w120 mr10" type="text" v-model="adminFunction.shopControl.shopList.search">
						<div class="butR w120 ml10" @click="shopList">Поиск</div>
					</div>
					<div class="adminFunctionStatus">{{ adminFunction.shopControl.shopList.status }}</div>
					<table v-if="adminFunction.shopControl.shopList.show" id="shopListTable">
						<tr>
							<th>№</th>
							<th>Адрес</th>
							<th>Телефон</th>
						</tr>
						<tr @click="shopTableClick" @dblclick="shopTableClickDblclick" :data-id="shop.id" :data-address="shop.address" :data-phone="shop.phone" v-for="shop in adminFunction.shopControl.shopList.list">
							<td>{{ shop.id }}</td>
							<td>{{ shop.address }}</td>
							<td>{{ phoneView(shop.phone) }}</td>
						</tr>
					</table>
					<div class="w100 df jc aic" v-if="adminFunction.shopControl.shopList.show">
						<div class="butR w120 mt10 mr10" @click="shopInfo">Информация</div>
						<div class="butR w120 mt10 ml10" @click="newShow">Новый</div>
					</div>
					<div class="w100 mt10 df jc fw" v-if="adminFunction.shopControl.shopInfo.show == true">
						<h1 class="adminFunctionH1">Информация:</h1>
						<div class="w100 mt10 infoContiner">
							<div class="infoH1">Адрес:</div>
							<input type="text" v-model="adminFunction.shopControl.shopInfo.address">
							<div class="infoH1">Телефон:</div>
							<input type="text" v-model="adminFunction.shopControl.shopInfo.phone">
						</div>
						<div class="adminFunctionStatus">{{ adminFunction.shopControl.shopInfo.status }}</div>
						<div class="w100 df jc fw mt10">
							<div class="butR mr10 w120" @click="shopInfoCancel">Отменить</div>
							<div class="butR ml10 mr10 w120" @click="shopInfoSave">Сохранить</div>
							<div class="butR ml10 w120" v-if="adminFunction.shopControl.shopInfo.add == false" @click="shopWorker">Персонал</div>
							<div class="butR ml10 mr10 w120" @click="shopDelete" v-if="adminFunction.shopControl.shopInfo.shopId != null">Закрыть</div>
						</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="workerControl">
				<div class="functionArrow"></div>
				Управление персоналом</div>
				<div class="adminFunctionWindow w100 df jc fw" v-if="adminFunction.workerControl.show">
					<div class="workerMenuSearch mt10">
						Номер магазина:
						<input type="text" v-model="adminFunction.workerControl.shopId">
						<div class="butR" @click="shopWorkerList">Поиск</div>
						<div class="conteiner"></div>
						<div class="butR" @click="adminOpen">Администраторы</div>
						<div class="butR" @click="salesOpen">Продавцы</div>
					</div>
					<div class="adminFunctionStatus mb10">{{ adminFunction.workerControl.searchStatus }}</div>
					<div class="conteiner df jc mb10 w100 fw">
						<h1 class="adminFunctionH1" v-if="adminFunction.workerControl.administratorShow == true">Администраторы:</h1>
						<div class="workerMenu" v-if="adminFunction.workerControl.administratorShow == true">
							<input type="text" v-model="adminFunction.workerControl.inputAdminSearch" v-if="adminFunction.workerControl.shopId == null">
							<div class="butR" @click="allWorkerList" v-if="adminFunction.workerControl.shopId == null">Поиск</div>
							<div class="butR" @click="freedomWorker" v-if="adminFunction.workerControl.shopId == null">Свободные</div>
							<div class="butR" @click="newWorker" v-if="adminFunction.workerControl.shopId == null">Новый</div>
						</div>
						<table id="adminTable" v-show="adminFunction.workerControl.administratorListShow == true">
							<tr>
								<th>id</th>
								<th>ФИО</th>
								<th>Телефон</th>
								<th>Адрес</th>
								<th>Оклад</th>
								<th>Магазин</th>
							</tr>
							<tr @dblclick="dblworkerTableClick" @click="workerTableClick" :data-root="2" :data-id="elem.id" v-for="elem in adminFunction.workerControl.administratorList">
								<td>{{ elem.id }}</td>
								<td>{{ elem.fio }}</td>
								<td>{{ phoneView(elem.phone) }}</td>
								<td>{{ elem.residential_address }}</td>
								<td>{{ elem.base_salary }}</td>
								<td>{{ elem.id_shop }}</td>
							</tr>
						</table>
						<div class="conteiner mb10" v-if="adminFunction.workerControl.administratorListShow == true">
							<div class="w100 df js fw mt10">
								<div @click="workerInfoOpen" class="butR mr10 w120">Информация</div>
							</div>
						</div>
						<h1 class="adminFunctionH1 mt10" v-if="adminFunction.workerControl.salespeopleShow == true">Продавцы:</h1>
						<div class="workerMenu" v-if="adminFunction.workerControl.salespeopleShow == true">
							<input type="text" v-model="adminFunction.workerControl.inputSalesSearch"v-if="adminFunction.workerControl.shopId == null">
							<div class="butR" @click="allWorkerList" v-if="adminFunction.workerControl.shopId == null">Поиск</div>
							<div class="butR" @click="freedomWorker" v-if="adminFunction.workerControl.shopId == null">Свободные</div>
							<div class="butR" @click="newWorker" v-if="adminFunction.workerControl.shopId == null">Новый</div>
						</div>
						<table id="salesTable" v-show="adminFunction.workerControl.salespeopleListShow == true">
							<tr>
								<th>id</th>
								<th>ФИО</th>
								<th>Телефон</th>
								<th>Адрес</th>
								<th>Оклад</th>
								<th>Магазин</th>
							</tr>
							<tr @dblclick="dblworkerTableClick" @click="workerTableClick" :data-id="elem.id" :data-root="3" v-for="elem in adminFunction.workerControl.salespeopleList">
								<td>{{ elem.id }}</td>
								<td>{{ elem.fio }}</td>
								<td>{{ phoneView(elem.phone) }}</td>
								<td>{{ elem.residential_address }}</td>
								<td>{{ elem.base_salary }}</td>
								<td>{{ elem.shop_id }}</td>
							</tr>
						</table>
						<div class="conteiner" v-if="adminFunction.workerControl.salespeopleListShow == true">
							<div class="w100 df js fw mt10">
								<div @click="workerInfoOpen" class="butR mr10 w120">Информация</div>
							</div>
						</div>
					</div>
					<h1 class="adminFunctionH1 mt10" v-if="adminFunction.workerControl.workerInfo.show">Личная информация:</h1>
					<div class="infoContiner mt10 mb10" id="workerInfoConteiner" v-if="adminFunction.workerControl.workerInfo.show">
						<div class="infoH1">Фамилия:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.surname">
						<div class="infoH1">Трудовая книжка:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.workbook">
						<div class="infoH1">Имя:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.name">
						<div class="infoH1">Оклад:</div>
						<input type="number" v-model="adminFunction.workerControl.workerInfo.salary">
						<div class="infoH1">Отчество:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.patronymic">
						<div class="infoH1">Дата:</div>
						<input type="date" v-model="adminFunction.workerControl.workerInfo.date">
						<div class="infoH1">Адрес:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.address">
						<div class="infoH1">Номер магазина:</div>
						<select @change="workerInfoShopList" v-model="adminFunction.workerControl.workerInfo.shopId">
							<option :value="adminFunction.workerControl.workerInfo.shopId">{{ adminFunction.workerControl.workerInfo.shop }}</option>
							<option v-for="shop in adminFunction.workerControl.workerInfo.shopList" :value="shop.id">{{ shop.name }}</option>
						</select>
					</div>
					<h1 class="adminFunctionH1 mt10" v-if="adminFunction.workerControl.workerInfo.show">Информация для входа:</h1>
					<div class="infoContiner mt10" id="workerInfoConteiner" v-if="adminFunction.workerControl.workerInfo.show">
						<div class="infoH1">Логин:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.login">
						<div class="infoH1">Телефон:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.phone">						
						<div class="infoH1">Пароль:</div>
						<input type="password" v-model="adminFunction.workerControl.workerInfo.password">
						<div class="infoH1">E-mail:</div>
						<input type="text" v-model="adminFunction.workerControl.workerInfo.email">
						<div class="infoH1">Повторите пароль:</div>
						<input type="password" v-model="adminFunction.workerControl.workerInfo.passwordChange">
					</div>
					<div class="adminFunctionStatus" v-if="adminFunction.workerControl.workerInfo.show">{{ adminFunction.workerControl.workerInfo.status }}</div>
					<div class="conteiner" v-if="adminFunction.workerControl.workerInfo.show">
						<div class="w100 df js fw mt10">
							<div class="butR mr10 w120" @click="workerInfoCansel">Отмена</div>
							<div class="butR ml10 w120" @click="workerInfoSave">Сохранить</div>
						</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="goodsControl">
					<div class="functionArrow"></div>
					Виды товаров
				</div>
				<div class="adminFunctionWindow w100 df jc fw" v-if="adminFunction.goodsControl.show">
					<div class="goodsMenuSearch">
						Код товара:
						<input type="number" @keyup.enter="tovarSearch" v-model="adminFunction.goodsControl.search">
						<div class="butR" @click="tovarSearch">Поиск</div>
						<div class="butR" @click="newGoods">Новый</div>
						<div class="butR" @click="addParamTovar">Другие параметры</div>
					</div>
					<h1 class="adminFunctionH1 mb10" v-if="adminFunction.goodsControl.status.length != 0">{{ adminFunction.goodsControl.status }}</h1>
					<div class="conteiner df jc fw w100 mt10" v-if="adminFunction.goodsControl.infoShow == true">
						<div id="goodsPriceInfoConteiner">
							<div class="infoH1">Рейтинг: {{ adminFunction.goodsControl.info.rating }}</div>
							<div class="infoH1">Цена:</div>
							<input type="number" min="0" v-model="adminFunction.goodsControl.price.price">
							<div class="infoH1">Скидка (%):</div>
							<input type="number" max="100" v-model="adminFunction.goodsControl.price.discount">
							<div class="infoH1">До:</div>
							<input type="date" v-model="adminFunction.goodsControl.price.until">
							<div class="infoH1">Конечная цена: {{ endPrice }}</div>
							<div class="butR" @click="priceInfoSave">Сохранить</div>
						</div>
						<h1 class="adminFunctionH1" v-if="adminFunction.goodsControl.priceStatus.length != 0">{{ adminFunction.goodsControl.priceStatus }}</h1>
						<h1 class="adminFunctionH1" v-if="priceStatus != false">{{ priceStatus }}</h1>
						<div class="conteiner w100 mt10" id="tovarInfo">
							<div class="conteiner df jc fw w100">
								<div id="photoGoodsConteiner">
									<div class="conteiner">
										<div class="df jc aic" v-if="adminFunction.goodsControl.images.list.length != 0" @click="tovarImageDelete">Удалить</div>
										<div v-if="adminFunction.goodsControl.images.list.length == 0"></div>
										<div class="df jc aic" @click="tovarImageNew">Добавить</div>
										<div class="df jc aic" v-if="adminFunction.goodsControl.images.list.length != 0" @click="tovarImageMain">На главную</div>
									</div>
									<div id="imageTovarPreview">
										<img :src="adminFunction.goodsControl.images.main" v-if="adminFunction.goodsControl.images.main != ''">
										<img src="styles/image/icon/placeholder-featured-image.png" v-else>
										<div v-if="adminFunction.goodsControl.images.main.indexOf('main.jpg') > 0" class="mainImageTovarPrewiew">Главная</div>
									</div>
									<div class="w100 mt10 mb10 df jc">
										<input type="file" @change="tovarImageChange" class="w220">
									</div>
									<h1 class="adminFunctionH1" v-if="adminFunction.goodsControl.imageStatus.length != 0">{{ adminFunction.goodsControl.imageStatus }}</h1>
									<h1 class="adminFunctionH1" v-if="adminFunction.goodsControl.tovarImagesMainStatus == true">У товара не назначено главное изображение!</h1>
								</div>
								<div id="photoGoodsListConteiner" class="df js aic fw" v-if="adminFunction.goodsControl.images.list.length != 0">
									<div class="tovarImgConteiner" v-for="elem in adminFunction.goodsControl.images.list">
										<img @click="tovarImageClick" :src="elem">
										<div v-if="elem.indexOf('main.jpg') > 0" class="mainImageTovar">Главная</div>
									</div>
								</div>
							</div>
							<div class="conteiner mt10">
								<div class="goodsInfoConteiner">
									<div class="conteiner">
										<div class="infoH1">Название:</div>
										<input type="text" v-model="adminFunction.goodsControl.info.name">
									</div>
									<div class="conteiner">
										<div class="infoH1">Вид спорта:</div>
										<select v-model="adminFunction.goodsControl.info.sport.id">
											<option v-for="elem in adminFunction.goodsControl.info.sport.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner">
										<div class="infoH1">Bar-Code:</div>
										<input type="number" v-model="adminFunction.goodsControl.info.bar">
									</div>
									<div class="conteiner">
										<div class="infoH1">Производитель:</div>
										<select v-model="adminFunction.goodsControl.info.manufacturer.id">
											<option v-for="elem in adminFunction.goodsControl.info.manufacturer.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner">
										<div class="infoH1">Категория:</div>
										<select v-model="adminFunction.goodsControl.info.category.id" @change="categoryTovarChange">
											<option v-for="elem in adminFunction.goodsControl.info.category.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner" v-if="adminFunction.goodsControl.info.subCategory.list.length != 0">
										<div class="infoH1">Подкатегория:</div>
										<select v-model="adminFunction.goodsControl.info.subCategory.id">
											<option v-for="elem in adminFunction.goodsControl.info.subCategory.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
								</div>
								<div class="goodsInfoConteiner mt10 mb10">
									<div class="conteiner" v-if="(adminFunction.goodsControl.info.category.id == 3)||(adminFunction.goodsControl.info.category.id == 4)||(adminFunction.goodsControl.info.category.id == 5)">
										<div class="infoH1">Возраст:</div>
										<select v-model="adminFunction.goodsControl.info.age.id">
											<option v-for="elem in adminFunction.goodsControl.info.age.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner" v-if="(adminFunction.goodsControl.info.category.id == 3)||(adminFunction.goodsControl.info.category.id == 4)">
										<div class="infoH1">Размер:</div>
										<select v-model="adminFunction.goodsControl.info.size.id">
											<option v-for="elem in adminFunction.goodsControl.info.size.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner" v-if="(adminFunction.goodsControl.info.category.id == 3)||(adminFunction.goodsControl.info.category.id == 4)||(adminFunction.goodsControl.info.category.id == 5)">
										<div class="infoH1">Цвет:</div>
										<select v-model="adminFunction.goodsControl.info.color.id">
											<option v-bind:style="{ 'background-color': '#' + color.hex }" v-for="color in adminFunction.goodsControl.info.color.list" :value="color.id">
												{{ color.name }}
											</option>
										</select>
									</div>
									<div class="conteiner" v-if="(adminFunction.goodsControl.info.category.id == 3)||(adminFunction.goodsControl.info.category.id == 4)">
										<div class="infoH1">Сезон:</div>
										<select v-model="adminFunction.goodsControl.info.season.id">
											<option v-for="elem in adminFunction.goodsControl.info.season.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner" v-if="(adminFunction.goodsControl.info.category.id == 3)||(adminFunction.goodsControl.info.category.id == 4)||(adminFunction.goodsControl.info.category.id == 5)">
										<div class="infoH1">Материал:</div>
										<select v-model="adminFunction.goodsControl.info.material.id">
											<option v-for="elem in adminFunction.goodsControl.info.material.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner" v-if="(adminFunction.goodsControl.info.category.id == 3)||(adminFunction.goodsControl.info.category.id == 4)||(adminFunction.goodsControl.info.category.id == 5)">
										<div class="infoH1">Пол:</div>
										<select v-model="adminFunction.goodsControl.info.floor.id">
											<option v-for="elem in adminFunction.goodsControl.info.floor.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner" v-if="adminFunction.goodsControl.info.category.id == 6">
										<div class="infoH1">Вкус:</div>
										<select v-model="adminFunction.goodsControl.info.taste.id">
											<option v-for="elem in adminFunction.goodsControl.info.taste.list" :value="elem.id">{{ elem.name }}</option>
										</select>
									</div>
									<div class="conteiner" v-if="((adminFunction.goodsControl.info.category.id == 6)||(adminFunction.goodsControl.info.category.id == 5))">
										<div class="infoH1">Вес:</div>
										<input type="number" min="0" max="9999" v-model="adminFunction.goodsControl.info.mass">
									</div>
									<div class="conteiner" v-if="adminFunction.goodsControl.info.category.id == 6">
										<div class="infoH1">Кол. порций:</div>
										<input type="number" min="0" max="9999" v-model="adminFunction.goodsControl.info.count">
									</div>
									<div class="conteiner" v-if="adminFunction.goodsControl.info.category.id == 5">
										<div class="infoH1">Длина:</div>
										<input type="number" min="0" max="9999" v-model="adminFunction.goodsControl.info.length">
									</div>
									<div class="conteiner" v-if="adminFunction.goodsControl.info.category.id == 5">
										<div class="infoH1">Ширина:</div>
										<input type="number" min="0" max="9999" v-model="adminFunction.goodsControl.info.width">
									</div>
									<div class="conteiner" v-if="adminFunction.goodsControl.info.category.id == 5">
										<div class="infoH1">Высота:</div>
										<input type="number" min="0" max="9999" v-model="adminFunction.goodsControl.info.height">
									</div>
								</div>
								<div class="infoH1 df jc mt10" v-if="adminFunction.goodsControl.info.category.id == 6">Инструкция:</div>
								<textarea v-if="adminFunction.goodsControl.info.category.id == 6" name="" id="" cols="60" rows="10" class="tovarInfoTextArea" v-model="adminFunction.goodsControl.info.subCategory.id"></textarea>
								<div class="infoH1 df jc mt10">Особености:</div>
								<textarea name="" id="" cols="60" rows="10" v-model="adminFunction.goodsControl.info.peculiarProperties" class="tovarInfoTextArea"></textarea>
								<div class="infoH1 df jc mt10">Описание:</div>
								<textarea name="" id="" cols="60" rows="10" v-model="adminFunction.goodsControl.info.description" class="tovarInfoTextArea"></textarea>
								<h1 class="adminFunctionH1" v-if="adminFunction.goodsControl.infoStatus.length != 0">{{ adminFunction.goodsControl.infoStatus }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarNameError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarNameError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarBarCodeError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarBarCodeError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarSportError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarSportError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarCategoryError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarCategoryError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarManufacturerError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarManufacturerError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarDiscriptionError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarDiscriptionError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarSubCategoryError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarSubCategoryError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarAgeError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarAgeError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarSizeError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarSizeError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarColorError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarColorError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarSeasonError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarSeasonError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarMaterialError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarMaterialError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarFloorError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarFloorError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarWidthError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarWidthError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarHeightError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarHeightError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarLengthError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarLengthError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarTasteError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarTasteError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarMassError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarMassError }}</h1>
								<h1 class="adminFunctionH1" v-if="((tovarCountError != false)&&(adminFunction.goodsControl.errorShow == true))">{{ tovarCountError }}</h1>
								<div class="df jc mt10 mb10">
									<div class="butR mr10 w120" @click="goodsInfoCansel">Отмена</div>
									<div class="butR ml10 w120" @click="tovarInfoSave">Сохранить</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="manufacturerControl">
				<div class="functionArrow"></div>
				Управление производителями</div>
				<div class="adminFunctionWindow w100 df jc aic fw" v-if="adminFunction.manufacturerControl.show == true">
					<div class="manufacturerSearch mt10">
						<input class="w100 mr10" type="text" v-model="adminFunction.manufacturerControl.search" @keyup.enter="manufacturerList">
						<div class="butR w120 ml10" @click="manufacturerList">Поиск</div>
						<div class="butR mr10 w120" @click="newManufacturer">Новый</div>
					</div>
					<h1 class="adminFunctionStatus">{{ adminFunction.manufacturerControl.searchStatus }}</h1>
					<table id="manufactorerTable" v-show="adminFunction.manufacturerControl.list.length != 0">
						<tr>
							<th>№</th>
							<th>Название</th>
							<th>Информация</th>
						</tr>
						<tr @click="manufacturerTableClick" @dblclick="manufacturerTableDblClick" :data-id='tr.id' v-for="tr in adminFunction.manufacturerControl.list">
							<td>{{ tr.id }}</td>
							<td>{{ tr.name }}</td>
							<td>{{ tr.information }} ...</td>
						</tr>
					</table>
					<div class="conteiner" v-if="adminFunction.manufacturerControl.list.length != 0">
						<div class="w100 df js fw mt10 mb10">
							<div class="butR ml10 w120" @click="manufacturerInfo">Информация</div>
						</div>
					</div>
					<div class="adminFunctionH1 mt10" v-if="adminFunction.manufacturerControl.info.show == true">Информация:</div>
					<div class="mt10" v-if="adminFunction.manufacturerControl.info.show == true">
						<div id="manufacturerInfoConteiner" class="mt10">
							<div id="manufactorerLogoConteiner" class="df jc fw">
								<div id="logoManufacturer" class="df jc aic">
									<img style="width: 300px;" src="image/manufacturer/factoryNone.svg" v-show="((adminFunction.manufacturerControl.info.img == null) && (adminFunction.manufacturerControl.info.newImg == null) && (adminFunction.manufacturerControl.info.newImgFile == null))">
									<img v-if="((adminFunction.manufacturerControl.info.img != null) && (adminFunction.manufacturerControl.info.newImg == null) && (adminFunction.manufacturerControl.info.newImgFile == null))" :src="adminFunction.manufacturerControl.info.img">
									<img :src="adminFunction.manufacturerControl.info.newImg" v-if="((adminFunction.manufacturerControl.info.newImg != null) && (adminFunction.manufacturerControl.info.newImgFile != null))">
								</div>
								<div class="conteiner df js aic">
									<input type="file" id="manufacturerNewImage" class="w220 mr10">
									<div class="butR w120" @click="newManufacturerImg">Изменить</div>
								</div>
							</div>
							<div class="conteiner df js fw w100 ais" id="manufacturerTextInfoConteiner">
								<div id="manufactorerNameConteiner" class="df js aic mb10">
									<div class="infoH1 mr10">Название:</div>
									<input type="text" class="w220" v-model="adminFunction.manufacturerControl.info.name">
								</div>
								<div class="infoH1 w100">Информация:</div>
								<textarea class="w100" v-model="adminFunction.manufacturerControl.info.info"></textarea>
							</div>
						</div>
						<div class="adminFunctionStatus w100">{{ adminFunction.manufacturerControl.info.status }}</div>
						<div class="df jc mt10 mb10">
							<div class="butR mr10 w120" @click="manufacturerInfoClear">Отмена</div>
							<div class="butR ml10 w120" @click="manufacturerInfoSave">Сохранить</div>
						</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="sportControl">
				<div class="functionArrow"></div>
				Управление видами спорта</div>
				<div class="adminFunctionWindow w100" v-if="adminFunction.sportControl.show">
					<div class="df jc aic">
						<div class="manufacturerSearch mt10 mb10">
							<input class="w120 mr10" type="text" v-model="adminFunction.sportControl.search">
							<div class="butR w120 ml10" @click="sportSearch">Поиск</div>
							<div class="butR mr10 w120" @click="newSport">Новый</div>
						</div>
					</div>
					<h1 class="adminFunctionStatus">{{ adminFunction.sportControl.status }}</h1>
					<table id="sportTable" v-show="adminFunction.sportControl.list.length != 0">
						<tr>
							<th>№</th>
							<th>Название</th>
						</tr>
						<tr @click="sportTableClick" @dblclick="sportTableDblClick" :data-id="tr.id" :data-name="tr.name" v-for="tr in adminFunction.sportControl.list">
							<td>{{ tr.id }}</td>
							<td>{{ tr.name }}</td>
						</tr>
					</table>
					<div class="conteiner" v-if="adminFunction.sportControl.list.length != 0">
						<div class="df jc mt10 mb10">
							<div class="butR ml10 w120" @click="sportInfo">Редактировать</div>
						</div>
					</div>
					<h1 class="adminFunctionH1 mt10" v-if="adminFunction.sportControl.info.show == true">Инфомация:</h1>
					<div class="infoConteiner mt10" v-if="adminFunction.sportControl.info.show == true">
						<div class="df jc w100">
							<div class="infoH1 mr10">Название:</div>
							<input type="text" class="w120" v-model="adminFunction.sportControl.info.name">
						</div>
						<h1 class="adminFunctionStatus">{{ adminFunction.sportControl.info.status }}</h1>
						<div class="df jc mt10">
							<div class="butR mr10 w120" @click="sportInfoCansel">Отмена</div>
							<div class="butR ml10 w120" @click="sportInfoSave">Сохранить</div>
						</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner">
				<div class="adminFunctionButton w100 df js aic" @click="suppliersControl">
				<div class="functionArrow"></div>
				Управление поставщиками</div>
				<div class="adminFunctionWindow w100 df jc fw" v-if="adminFunction.suppliersControl.show">
					<div class="manufacturerSearch mt10 mb10">
						<input class="w120 mr10" type="text" v-model="adminFunction.sportControl.search">
						<div class="butR w120 ml10" @click="suppliersSearch">Поиск</div>
						<div class="butR mr10 w120" @click="newSuppliers">Новый</div>
					</div>
					<h1 class="adminFunctionStatus" v-if="adminFunction.suppliersControl.status.length != 0">{{ adminFunction.suppliersControl.status }}</h1>
					<table id="suppliersTable" v-show="adminFunction.suppliersControl.list.length != 0">
						<tr>
							<th>№</th>
							<th>Название</th>
							<th>Адрес</th>
							<th>Телефон</th>
						</tr>
						<tr :data-id="tr.id" @click="suppliersTableClick" @dblclick="suppliersTableDblClick" v-for="tr in adminFunction.suppliersControl.list">
							<td>{{ tr.id }}</td>
							<td>{{ tr.name }}</td>
							<td>{{ tr.address }}</td>
							<td>{{ phoneView(tr.phone) }}</td>
						</tr>
					</table>
					<div class="conteiner" v-if="adminFunction.suppliersControl.list.length != 0">
						<div class="w100 df js fw mt10 mb10">
							<div class="butR ml10 w120" @click="suppliersInfo">Информация</div>
						</div>
					</div>
					<div class="adminFunctionH1 mt10" v-if="adminFunction.suppliersControl.info.show">Информация:</div>
					<div class="infoConteiner mt10" v-if="adminFunction.suppliersControl.info.show">
						<div id="suppliersInfoConteiner">
							<div class="conteiner">
								<div class="infoH1 mr10">Название:</div>
								<input type="text" v-model="adminFunction.suppliersControl.info.name">
							</div>
							<div class="conteiner">
								<div class="infoH1 mr10">Адрес:</div>
								<input type="text" v-model="adminFunction.suppliersControl.info.address">
							</div>
							<div class="conteiner">
								<div class="infoH1 mr10">Телефон:</div>
								<input type="text" v-model="adminFunction.suppliersControl.info.phone">
							</div>
						</div>
						<div class="infoH1 mb10">Информация:</div>
						<textarea name="" id="" cols="100" rows="10" v-model="adminFunction.suppliersControl.info.info"></textarea>
						<h1 class="adminFunctionStatus">{{ adminFunction.suppliersControl.info.status }}</h1>
						<div class="df jc mt10 mb10">
							<div class="butR mr10 w120" @click="suppliersInfoCansel">Отмена</div>
							<div class="butR ml10 w120" @click="suppliersInfoSave">Сохранить</div>
						</div>
					</div>
				</div>
			</div>
			<div class="adminFunctionConteiner mb10">
				<div class="adminFunctionButton w100 df js aic" @click="materialControl">
				<div class="functionArrow"></div>
				Управление списком материалов</div>
				<div class="adminFunctionWindow w100" v-if="adminFunction.materialControl.show">
					<div class="df jc">
						<div class="manufacturerSearch mt10 mb10">
							<input class="w120 mr10" type="text" v-model="adminFunction.materialControl.search">
							<div class="butR w120 ml10" @click="materialSearch">Поиск</div>
							<div class="butR mr10 w120" @click="newMaterial">Новый</div>
						</div>
					</div>
					<h1 class="adminFunctionStatus">{{ adminFunction.materialControl.status }}</h1>
					<table id="materialTable" v-show="adminFunction.materialControl.list.length != 0">
						<tr>
							<th>№</th>
							<th>Название</th>
						</tr>
						<tr :data-id="tr.id" :data-name="tr.name" @click="materialTableClick" @dblclick="materialTableDblClick" v-for="tr in adminFunction.materialControl.list">
							<td>{{ tr.id }}</td>
							<td>{{ tr.name }}</td>
						</tr>
					</table>
					<div class="conteiner" v-show="adminFunction.materialControl.list.length != 0">
						<div class="df jc mt10 mb10">
							<div class="butR ml10 w120" @click="materialInfo">Редактировать</div>
						</div>
					</div>
					<h1 v-if="adminFunction.materialControl.info.show == true" class="adminFunctionH1 mt10">Инфомация:</h1>
					<div v-if="adminFunction.materialControl.info.show == true" class="infoConteiner mt10">
						<div class="df jc w100">
							<div class="infoH1 mr10">Название:</div>
							<input type="text" class="w120" v-model="adminFunction.materialControl.info.name">
						</div>
						<h1 class="adminFunctionStatus">{{ adminFunction.materialControl.info.status }}</h1>
						<div class="df jc mt10">
							<div class="butR mr10 w120" @click="materialInfoCansel">Отмена</div>
							<div class="butR ml10 w120" @click="materialInfoSave">Сохранить</div>
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
<script type="text/javascript" src="scripts/admin.js"></script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>