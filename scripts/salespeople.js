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

var salespeople = new Vue({
	el: '#adminFunction',
	data: {
		shop: {
			statusWrite: 'Вы не являетесь администратором ни какого магазина. Обратитесь к администратору сайта!'
		},
		salespeopleId: null,
		basket: {
			show: false,
			searchStatus: '',
			code: '',
			tovarCount: 1,
			list: [],
			newCount: null,
			tableId: null,
			basketStatus: ''
		},
		orders: {
			show: false,
			search: '',
			infoShow: false,
			status: '',
			statusInfo: '',
			info: {
				order: null,
				bar: '',
				local: '',
				name: '',
				count: '',
				date: null,
				img: '',
				orderStatus: {
					status: null,
					name: ''
				},
				payStatus: {
					status: null,
					name: ''
				},
				price: null,
				buyer: ''
			}
		}
	},
	methods: {

			// Товары
			// Открыть меню для продажи товаров

		basketOpen(){

			if (this.shop.id == 0){

				this.basket.show = false;
				return false;

			}

			this.basket.show = !this.basket.show;

			if (this.basket.show == false){

				this.tovarClear();

			}

		},

			// Добавить товар для продажи

		addBasket(){

			this.basket.searchStatus = "";
			this.basket.tableId = 0;
			this.basket.basketStatus = '';

			if (this.basket.code.length == 0){

				this.basket.searchStatus = "Введите код товара!";
				return false;

			}

			if ((this.basket.tovarCount.length == 0)||(this.basket.tovarCount <= 0)){

				this.basket.searchStatus = "Введите количество товаров!";
				return false;

			}

			var s = false;

			this.basket.list.forEach(function(elem, i){

				if (elem.local == salespeople.basket.code){

					if (elem.maxCount < (elem.count + parseInt(salespeople.basket.tovarCount))){

						if(confirm('Максимально доступное количество:' + elem.maxCount + 'шт! Сохранить?') == true){

							elem.count = elem.maxCount;

						}else{

							salespeople.basket.list.splice(i, 1);

						}

					}else{

						elem.count = parseInt(elem.count) + parseInt(salespeople.basket.tovarCount);

					}

					s = true;

				}

			});

			if (s == true){

				this.basket.searchStatus = "Товар добавлен!";
				return false;

			}else{

				this.basket.searchStatus = "Загрузка ...";

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					data: {
						code: salespeople.basket.code,
						count: salespeople.basket.tovarCount
					},
					url: '../modules/salespeople/basket/basketAdd.php'
				})
				.then(function(response){

					switch (response['data']['status']){
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						case 'tovarNot':
							salespeople.basket.searchStatus = "Возможно товар был забронирован! В базе данных этого магазина данного товара нет, обратитесь к администратору магазина!";
							break;
						case 'countError':
							if (confirm('Максимально доступное количество:' + response['data']['tovar']['maxCount'] + 'шт! Сохранить?') == true){

								let tovar = response['data']['tovar'];
								tovar['count'] = tovar['maxCount'];

								salespeople.basket.list.push(tovar);

								salespeople.basket.searchStatus = "";

							}else{

								this.basket.searchStatus = "Отменено!";
								setTimeout(function(){
									salespeople.basket.searchStatus = "";
								}, 1500);
								return false;

							}
							break;
						case 'good':

							let tovar = response['data']['tovar'];
							tovar['count'] = salespeople.basket.tovarCount;

							salespeople.basket.list.push(tovar);

							salespeople.basket.searchStatus = "Товар добавлен!";

							setTimeout(function(){
								salespeople.basket.searchStatus = "";
							}, 1500);

							break;
						default:
							break;
					}

					salespeople.basket.code = '';
					salespeople.basket.tovarCount = 1;

				})
				.catch(function(error){
					console.log(error);
				});

			}

		},

			// Клик по таблице

		basketEditClick(){

			tableClickRender(event);

			this.basket.tableId = event.target.parentNode.getAttribute('data-local');
			this.basket.newCount = event.target.parentNode.getAttribute('data-count');

		},

			// Изменение количества товаров в корзине

		tovarCountEdit(){

			if (this.basket.tableId == null){

				this.basket.basketStatus = "Сначала выберите товар!";
				return false;

			}

			this.basket.list.forEach(function(elem){

				if (elem.local == salespeople.basket.tableId){

					if (parseInt(salespeople.basket.newCount) > parseInt(elem.maxCount)){

						salespeople.basket.basketStatus = "Превышен лимит! Выброно максимально доступное значение!";
						elem.maxCount = parseInt(elem.maxCount);
						salespeople.basket.newCount = parseInt(elem.maxCount);

					}else{

						elem.count = salespeople.basket.newCount;

					}

				}

			});

		},

			// Отмена покупки товара

		tovarCansel(){

			if (this.basket.tableId == null){

				this.basket.basketStatus = "Сначала выберите товар!";
				return false;

			}

			this.basket.list.forEach(function(elem, i){

				if (elem.local == salespeople.basket.tableId){

					salespeople.basket.list.splice(i, 1);

				}

			});

			this.basket.basketStatus = "Успешно удалено!";

		},

			// Отмена покупки всех товаров

		tovarClear(){

			let basketClear = {
				show: false,
				searchStatus: '',
				code: '',
				tovarCount: 1,
				list: [],
				newCount: null,
				tableId: null,
				basketStatus: ''
			}

			this.basket = basketClear;

		},

			// Оплата наличными

		basketCash(){

			if (this.priceChange() == true){

				this.basketInfoSend();
				
			}

		},

			// Оплата без наличными

		basketNonCash(){

			if (this.priceChange() == true){

				this.basketInfoSend();

			}

		},

			// Оплата

		priceChange(){

			return true;

		},

			// Отправка информации о продаже товара

		basketInfoSend(){

			let basket = [];

			this.basket.list.forEach(function(elem){
				let b = {
					local: elem.local,
					count: elem.count,
					price: parseInt(elem.price) * parseInt(elem.count)
				}
				basket.push(b);
			});

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				data: {
					basket: basket
				},
				url: '../modules/salespeople/basket/sale.php'
			})
			.then(function(response){

					switch (response['data']['status']){
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						case 'dbError':
							salespeople.basket.searchStatus = "В базе данных произошла ошибка!";
							break;
						case 'saleError':
							salespeople.basket.basketStatus = "Ошибка с суммой, срочно обратитесь к администратору!";
							break;
						case 'good':

							salespeople.basket.basketStatus = "Успешно!";

							setTimeout(function(){
								salespeople.tovarClear();
							}, 1500);

							break;
						default:
							break;
					}

			})
			.catch(function(error){
				console.log(error);
			});		

		},

			// Заказы
			// Открыть меню для работы с заказами

		ordersOpen(){

			if (this.shop.id == 0){

				this.orders.show = false;
				return false;

			}

			this.orders.show = !this.orders.show;

		},

			// Поиск заказа

		ordersSearch(){

			if (this.orders.search.length == 0){

				this.orders.status = "Введите номер заказа!";
				return false;

			}

			this.orders.status = "Поиск ...";
			this.orders.statusInfo = "";
			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				data: {
					search: salespeople.orders.search,
				},
				url: '../modules/salespeople/orders/ordersSearch.php'
			})
			.then(function(response){

					switch (response['data']['status']){
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						case 'none':
							salespeople.orders.status = "Ничего не найдено!";
							break;
						case 'result':

							salespeople.orders.info = response['data']['info'];
							salespeople.orders.info.img = '../image/goods/'+ salespeople.orders.info['local'] +'/main.jpg';
							salespeople.orders.status = "Результат:";
							salespeople.orders.infoShow = true;

							setTimeout(function(){
								salespeople.tovarClear();
							}, 1500);

							break;
						default:
							break;
					}

			})
			.catch(function(error){
				console.log(error);
			});

		},

			// Наличная оплата

		orderCash(){

			this.orders.info.payStatus.status = 1;
			this.orders.statusInfo = "Успешно!";

		},

			// Без нал.

		orderNoCash(){

			this.orders.info.payStatus.status = 1;
			this.orders.statusInfo = "Успешно!";

		},

			// Выдача заказа

		orderWrite(){

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				data: {
					id: salespeople.orders.info.order
				},
				url: '../modules/salespeople/orders/orderWrite.php'
			})
			.then(function(response){

					switch (response['data']['status']){
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						case 'dbError':
							salespeople.orders.statusInfo = "В базе данных произошла ошибка, обратитесь к администратору!";
							break;
						case 'good':

							salespeople.orders.statusInfo = "Успешно!";
							setTimeout(function(){
								salespeople.orders.statusInfo = "";
								salespeople.orders.infoShow = false;
							}, 1500);

							break;
						default:
							break;
					}

			})
			.catch(function(error){
				console.log(error);
			});

		}

	},
	computed: {
		
		// Подсчёт суммы товаров

		tovarPriceSum(){

			let sum = 0;

			salespeople.basket.list.forEach(function(elem){

				sum = sum + (elem.price * elem.count);

			});

			return sum + ' ₽';

		}
	}
});