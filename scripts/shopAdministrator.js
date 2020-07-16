window.onload = function(){

	let Data = new Date();

	let d = Data.getDate();
	let m = Data.getMonth();
	let y = Data.getFullYear();
	shopAdmin.thisDate = d + '.' + m + '.' + y;

}

function tableClickRender(event){

	let tr = event.target.parentNode;
	let tableName = tr.parentNode;
	let table = tr.parentNode;
	let td = table.getElementsByTagName('td');
	let clickTd = tr.getElementsByTagName('td');

	tableRenderClear(tableName.parentNode.getAttribute('id'));
	
	for (let j = 0; j < clickTd.length; j++){

		clickTd[j].style.color = '#FFFFFF';
		clickTd[j].style.backgroundColor = '#BF3030';
		clickTd[j].style.borderRight = '1px solid #FFFFFF';
		clickTd[j].style.borderTop = '1px solid #FFFFFF';

	}

}

function tableRenderClear(id){

	let table = document.getElementById(id);
	let td = table.getElementsByTagName('td');

	for (let i = 0; i < td.length; i++){

		td[i].style.color = '#BF3030';
		td[i].style.backgroundColor = '#FFFFFF';
		td[i].style.borderRight = '1px solid #BF3030';

	}

}

var shopAdmin = new Vue({
	el: '#adminFunction',
	data: {
		shop: {
			statusWrite: 'Вы не являетесь администратором ни какого магазина. Обратитесь к администратору сайта!',
		},
		thisDate: null,
		tovar: {
			show: false,
			searchStatus: '',
			search: '',
			table: [],
			tovarStatus: '',
			tableId: null,
			max: null,
			comment: '',
			count: null
		},
		part: {
			show: false,
			search: '',
			searchStatus: '',
			infoShow: false,
			local: '',
			bar: '',
			name: '',
			options: [],
			optionsKey: null,
			manufacturer: '',
			dateProd: null,
			count: null,
			pricePart: null,
			sup: null,
			supName: '',
			infoStatus: ''
		},
		orders: {
			show: false,
			search: '',
			orderSearchStatus: '',
			orderTakeShow: false,
			orderTakeInfo: {
				local: '',
				bar: '',
				name: '',
				count: null,
				status: null,
				orderId: null
			},
			orderTakeStatus: '',
			thisShopOrdersSend: [],
			sendStatus: '',
			orderSendId: null
		},
		workers: {
			show: false,
			search: '',
			searchStatus: '',
			workersList: [],
			startDate: null,
			endDate: null,
			workersListStatus: '',
			dayTable: [],
			dayStart: null,
			dayEnd: null,
			dayStatus: '',
			workerId: null,
			workerRoot: null,
			dayListShow: false,
			dayPlusShow: false
		}
	},
	methods: {
		tovarOpen(){
			this.tovar.show = !this.tovar.show;

			if (this.tovar.show == false){

				let tovar = {
					show: false,
					searchStatus: '',
					search: '',
					table: [],
					max: null,
					tovarStatus: '',
					tableId: null,
					count: null
				};

				this.tovar = tovar;

			}
		},
		partOpen(){
			this.part.show = !this.part.show;

			if (this.tovar.show == false){

				this.newPartCansel();
				this.part.search = '';
				this.part.searchStatus = '';

			}
		},
		ordersOpen(){
			this.orders.show = !this.orders.show;

			if (this.orders.show == true){

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/shopAdministrator/orders/ordersSendList.php'
				})
				.then(function(response){

					switch (response['data']['status']){
						case 'none':
							shopAdmin.orders.thisShopOrdersSend = [];
							break;
						case 'result':
							shopAdmin.orders.thisShopOrdersSend = response['data']['list'];
							break;
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						default:
							break;
					}

				})
				.catch(function(error){
					console.log(error);
				});

			}else{

				let orderTakeInfo = {
					local: '',
					bar: '',
					name: '',
					count: null,
					status: null,
					orderId: null
				}
				shopAdmin.orders.orderTakeInfo = orderTakeInfo;
				shopAdmin.orders.orderTakeShow = false,
				shopAdmin.orders.orderSendId = null;
				shopAdmin.orders.orderSearchStatus = '';
				shopAdmin.orders.orderTakeStatus = "";

			}
		},
		workersOpen(){
			this.workers.show = !this.workers.show;

			if (this.workers.show == false){

				let workers = {
					show: false,
					search: '',
					searchStatus: '',
					workersList: [],
					startDate: null,
					endDate: null,
					workersListStatus: '',
					dayTable: [],
					dayStart: null,
					dayEnd: null,
					dayStatus: '',
					workerId: null,
					workerRoot: null,
					dayListShow: false,
					dayPlusShow: false
				};

				this.workers = workers;

			}
		},

		// Поиск партии товаров

		tovarSearch(col){

			if (this.tovar.search.length == 0){
				this.tovar.searchStatus = "Заполните строку поиска!";
				return false;
			}

			shopAdmin.tovar.table = [];
			shopAdmin.tovar.searchStatus = "Поиск ...";

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/tovar/tovarPartSearch.php',
				data: {
					search: shopAdmin.tovar.search,
					type: col
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'none':
						shopAdmin.tovar.searchStatus = "Ничего не найдено!";
						setTimeout(function(){
							shopAdmin.tovar.searchStatus = "";
						}, 2000);
						break;
					case 'result':
						shopAdmin.tovar.searchStatus = "Результат:";
						shopAdmin.tovar.table = response['data']['list'];
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
			});

		},

		// Клик по таблице партий товаров

		tovarTableClick(){

			tableClickRender(event);
			this.tovar.tableId = event.target.parentNode.getAttribute('data-id');
			this.tovar.max = event.target.parentNode.getAttribute('data-reside');
			
		},

		// Отмена

		tovarCansel(){

			this.tovar.tableId = null;
			this.tovar.max = null;
			this.tovar.comment = '';

			tableRenderClear('tovarList');

		},

		// Списание товара

		tovarOffs(){

			if (this.tovar.comment.length == 0){

				this.tovar.tovarStatus = "Введите комментарий!";
				return false;
			
			}

			if ((parseInt(this.tovar.max) < this.tovar.count)||(this.tovar.count <= 0)){

				this.tovar.tovarStatus = "Введите количество! Не более: "+ this.tovar.max + " штук!";
				return false;

			}

			this.tovar.tovarStatus = "Отправка ...";

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/tovar/tovarOffs.php',
				data: {
					part: shopAdmin.tovar.tableId,
					count: shopAdmin.tovar.count,
					comment: shopAdmin.tovar.comment
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'dbError':
						shopAdmin.tovar.tovarStatus = "Ошибка в базе данных!";
						break;
					case 'good':
						shopAdmin.tovar.tovarStatus = "Успешно!";
						shopAdmin.tovar.table.forEach(function(elem){
							if (elem['reside'] == shopAdmin.tovar.max){
								elem['reside'] = shopAdmin.tovar.max - shopAdmin.tovar.count;
							}
						});
						shopAdmin.tovar.max = shopAdmin.tovar.max - shopAdmin.tovar.count;
						shopAdmin.tovar.comment = '';
						shopAdmin.tovar.count = 1;
						setTimeout(function(){
							shopAdmin.tovar.tovarStatus = "";
						}, 2000);
						break;
					case 'countError':
						shopAdmin.tovar.tovarStatus = "Ошибка с количеством!";
						break;
					case 'commentError':
						shopAdmin.tovar.tovarStatus = "Ошибка связанная с комментарием!";
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
			});

		},

		// Добавление новой партии

		partSearch(col){

			shopAdmin.part.searchStatus = "";
			shopAdmin.part.local = '';
			shopAdmin.part.bar = '';
			shopAdmin.part.name = '';
			shopAdmin.part.manufacturer = '';

			if (this.part.search.length == 0){

				this.part.searchStatus = "Введите код товара!";
				return false;

			}

			this.part.searchStatus = "";

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/newAccounting/tovarSearch.php',
				data: {
					search: shopAdmin.part.search,
					type: col
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'result':
						shopAdmin.part.searchStatus = "Результат:";
						shopAdmin.part.local = response['data']['local'];
						shopAdmin.part.bar = response['data']['bar'];
						shopAdmin.part.name = response['data']['name'];
						shopAdmin.part.options = response['data']['options'];
						shopAdmin.part.manufacturer = response['data']['manufacturer'];
						shopAdmin.part.infoShow = true;
						break;
					case 'none':
						shopAdmin.part.searchStatus = "К сожалению, ничего не найдено!";
						shopAdmin.part.infoShow = false;
						setTimeout(function(){
							shopAdmin.part.tovarStatus = "";
						}, 2000);
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
			});

		},

		// Отмена добавления новой партии

		newPartCansel(){

			this.part.searchStatus = "";
			this.part.local = "";
			this.part.bar = "";
			this.part.name = "";
			this.part.manufacturer = null;
			this.part.infoShow = false;
			this.part.dateProd = null;
			this.part.pricePart = null;
			this.part.count = null;
			this.part.sup = null;
			this.part.supName = '';
			this.part.infoStatus = '';
			this.part.optionsKey = null;

		},

		// Отправка информации о новой партии

		newPartSave(){

			if (this.part.dateProd == null){

				this.part.infoStatus = "Выберите дату производства!";
				return false;

			}

			if ((this.part.count == null)||(this.part.count <= 0)){

				this.part.infoStatus = "Введите количество!";
				return false;

			}

			if ((this.part.pricePart == null)||(this.part.pricePart <= 0)){

				this.part.infoStatus = "Введите цену партии!";
				return false;

			}

			if (this.part.sup == null){

				this.part.infoStatus = "Введите код поставщика!";
				return false;

			}

			if (this.part.optionsKey == null){

				this.part.infoStatus = "Введите дополнительные параметры товара!";
				return false;

			}

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/newAccounting/newPartInfoSave.php',
				data: {
					goods: shopAdmin.part.local,
					sup: shopAdmin.part.sup,
					date: shopAdmin.part.dateProd,
					price: shopAdmin.part.pricePart,
					count: shopAdmin.part.count,
					optionsKey: shopAdmin.part.optionsKey
				}
			})
			.then(function(response){
				console.log("response", response['data']);

				switch (response['data']['status']){
					case 'good':
						shopAdmin.part.infoStatus = "Успешно!";
						setTimeout(function(){
							shopAdmin.newPartCansel();
						}, 2000);
						break;
					case 'priceError':
						shopAdmin.part.infoStatus = "Ошибка стоимости!";
						break;
					case 'countError':
						shopAdmin.part.infoStatus = "Ошибка количества!";
						break;
					case 'supError':
						shopAdmin.part.infoStatus = "Ошибка поставщиков!";
						break;
					case 'goodsError':
						shopAdmin.part.infoStatus = "Ошибка локального кода товара!";
						break;
					case 'dateError':
						shopAdmin.part.infoStatus = "Ошибка даты!";
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
			});


		},

		// Запрос названия поставщика

		partSupChange(){

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/newAccounting/suppliersSearch.php',
				data: {
					id: shopAdmin.part.sup
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'result':
						shopAdmin.part.supName = response['data']['name'];
						break;
					case 'none':
						shopAdmin.part.sup = null;
						shopAdmin.part.supName = 'Поставщик не найден!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
			});

		},

		// Управление заказами

			// Поиск заказа

		orderSearch(){

			if (this.orders.search.length == 0){

				this.orders.searchStatus = "Введите номер заказа!";
				return false;

			}

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/orders/orderSearch.php',
				data: {
					search: shopAdmin.orders.search
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'result':
						shopAdmin.orders.orderTakeInfo = response['data']['info'];
						shopAdmin.orders.orderTakeShow = true;
						shopAdmin.orders.orderSearchStatus = "Заказ №" + response['data']['info']['orderId'];
						break;
					case 'none':
						shopAdmin.orders.orderSearchStatus = 'Ничего не найдено!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
			});

		},

			// Заказ принят, либо отменён

		orderTake(file){

			if (this.orders.orderTakeInfo.orderId != null){

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/shopAdministrator/orders/' + file,
					data: {
						id: shopAdmin.orders.orderTakeInfo.orderId
					}
				})
				.then(function(response){

					switch (response['data']['status']){
						case 'good':
							setTimeout(function(){
								let orderTakeInfo = {
									local: '',
									bar: '',
									name: '',
									count: null,
									status: null,
									orderId: null
								}
								shopAdmin.orders.orderTakeInfo = orderTakeInfo;
								shopAdmin.orders.orderTakeShow = false,
								shopAdmin.orders.orderSendId = null;
								shopAdmin.orders.orderSearchStatus = '';
								shopAdmin.orders.orderTakeStatus = "";
							}, 10000);
							if (response['data']['pay'] != null){
								shopAdmin.orders.orderTakeStatus = "Верните покупателю " + response['data']['pay'] + ' ₽';
							}
							break;
						case 'dbError':
							shopAdmin.orders.orderTakeStatus = 'В базе данных произошла ошибка!';
							break;
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						default:
							break;
					}

				})
				.catch(function(error){
					console.log(error);
					shopAdmin.orders.orderTakeStatus = 'Извините произошла серверная ошибка!';
				});

			}else{

				this.order.orderTakeStatus = "Ошибка, не присвоен номер заказа!";
				return false;

			}

		},

			// Отправка заказа

				// Выбор заказа

		ordersSendClick(){

			tableClickRender(event);
			this.orders.orderSendId = event.target.parentNode.getAttribute('data-id');

		},

				// Заказ отправлен

		orderSend(){

			if (this.orders.orderSendId == null){

				this.orders.sendStatus = "Выберите заказ!"; 
				return false;

			}

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/orders/ordersStatusSend.php',
				data: {
					order: shopAdmin.orders.orderSendId
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'good':
						tableRenderClear('orderSendList');
						shopAdmin.orders.show = false;
						shopAdmin.orders.orderSendId = null;
						shopAdmin.ordersOpen();
						shopAdmin.orders.sendStatus = 'Успешно!';
						setTimeout(function(){
							shopAdmin.orders.sendStatus = '';
						}, 2000);
						break;
					case 'dbError':
						shopAdmin.orders.sendStatus = 'Извините в базе данных произошла ошибка!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
				shopAdmin.orders.sendStatus = 'Извините произошла серверная ошибка!';
			});

		},


		// Сотрудники

			// Поиск сотрудников

		workersSearch(){

			this.workers.workersList = [];
			shopAdmin.workers.searchStatus = '';

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/workers/workerList.php',
				data: {
					search: shopAdmin.workers.search
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'result':
						shopAdmin.workers.workersList = response['data']['list'];
						break;
					case 'none':
						shopAdmin.workers.searchStatus = 'Ничего не найдено!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
				shopAdmin.workers.searchStatus = 'Извините произошла серверная ошибка!';
			});

		},

			// Клик по таблице со списком сотрудников

		workersTableClick(){

			tableClickRender(event);
			let elem = event.target.parentNode;
			this.workers.workerRoot = elem.getAttribute('data-root');
			this.workers.workerId = elem.getAttribute('data-id');

		},

			// Двойной клик по таблице со списком сотрудников

		workersTableDblClick(){

			let elem = event.target.parentNode;
			this.workers.workerRoot = elem.getAttribute('data-root');
			this.workers.workerId = elem.getAttribute('data-id');
			shopAdmin.workerAddDay();
			shopAdmin.workers.dayTable = [];
			shopAdmin.workers.workersListStatus = '';

		},

			// Показать смены

		dayInfoList(){

			if ((this.workers.workerId == null)||(this.workers.workerRoot == null)){

				this.workers.dayStatus = "Сначала выберите работника!";
				return false;

			}

			shopAdmin.workers.dayTable = [];
			shopAdmin.workers.workersListStatus = '';
			shopAdmin.workers.dayStart = null;
			shopAdmin.workers.dayEnd = null;
			shopAdmin.workers.dayPlusShow = false;

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/workers/dayList.php',
				data: {
					id: shopAdmin.workers.workerId,
					root: shopAdmin.workers.workerRoot,
					start: shopAdmin.workers.startDate,
					end: shopAdmin.workers.endDate
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'result':
						shopAdmin.workers.dayTable = response['data']['list'];
						shopAdmin.workers.workersListStatus = '';
						break;
					case 'none':
						shopAdmin.workers.workersListStatus = 'Ничего не найдено!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
				shopAdmin.workers.searchStatus = 'Извините произошла серверная ошибка!';
			});

		},

			// Открыть окно добавления новой смены

		workerAddDay(){

			this.workers.dayPlusShow = true;

		},

			// Засчитать смену

		workerAddDayPlus(){

			if (this.workers.dayStart == null){

				this.workers.dayStatus = "Выберите время начала смены!";
				return false;

			}

			if (this.workers.dayEnd == null){

				this.workers.dayStatus = "Выберите время конца смены!";
				return false;

			}

			if ((this.workers.workerId == null)||(this.workers.workerRoot == null)){

				this.workers.dayStatus = "Не выбран работник!";
				return false;

			}

			this.workers.dayStatus = "";

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/shopAdministrator/workers/addDay.php',
				data: {
					id: shopAdmin.workers.workerId,
					root: shopAdmin.workers.workerRoot,
					begin: shopAdmin.workers.dayStart,
					end: shopAdmin.workers.dayEnd
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'good':
						shopAdmin.workers.dayTable = response['data']['list'];
						shopAdmin.workers.dayStatus = 'Успешно';
						shopAdmin.workers.dayStart = null;
						shopAdmin.workers.dayEnd = null;
						shopAdmin.dayInfoList();
						setTimeout(function(){
							shopAdmin.workers.dayStatus = '';
						}, 2000);
						break;
					case 'dbError':
						shopAdmin.workers.dayStatus = 'Ошибка в базе данных!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				console.log(error);
				shopAdmin.workers.dayStatus = 'Извините произошла серверная ошибка!';
			});

		},

			// Закрыть окно добавления смены

		addWorkDayCansel(){

			shopAdmin.workers.dayStart = null;
			shopAdmin.workers.dayEnd = null;
			shopAdmin.workers.dayPlusShow = false;

		}
	}
});