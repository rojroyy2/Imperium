window.onload = function(){

	headerSize();
	
	let lastButtom = document.getElementById('adminFunction').lastChild;
	lastButtom.style.borderBottom = '0px';

}

window.onresize = function(){

	headerSize();

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

function workerInfoClear(){

	admin.adminFunction.workerControl.shopId = null;
	admin.adminFunction.workerControl.searchStatus = '';
	workerInfoInputClear();
	admin.adminFunction.workerControl.administratorListShow = false;
	admin.adminFunction.workerControl.salespeopleListShow = false;
	admin.adminFunction.workerControl.administratorList = [];
	admin.adminFunction.workerControl.salespeopleList = [];
	admin.adminFunction.workerControl.inputAdminSearch = '';
	admin.adminFunction.workerControl.inputSalesSearch = '';
	admin.adminFunction.workerControl.workerInfo.shopList = [];

}

function workerInfoInputClear(){

	admin.adminFunction.workerControl.workerInfo.show = false;
	admin.adminFunction.workerControl.workerInfo.status = '';
	admin.adminFunction.workerControl.workerInfo.surname = '';
	admin.adminFunction.workerControl.workerInfo.name = '';
	admin.adminFunction.workerControl.workerInfo.patronymic = '';
	admin.adminFunction.workerControl.workerInfo.address = '';
	admin.adminFunction.workerControl.workerInfo.workbook = '';
	admin.adminFunction.workerControl.workerInfo.salary = '';
	admin.adminFunction.workerControl.workerInfo.date = null;
	admin.adminFunction.workerControl.workerInfo.shop = null;
	admin.adminFunction.workerControl.workerInfo.login = '';
	admin.adminFunction.workerControl.workerInfo.passwordChange = '';
	admin.adminFunction.workerControl.workerInfo.password = '';
	admin.adminFunction.workerControl.workerInfo.email = '';
	admin.adminFunction.workerControl.workerInfo.phone = '';
	admin.adminFunction.workerControl.workerInfo.shopList = [];
	admin.adminFunction.workerControl.workerInfo.status = '';

}

	// Запрос списка

function goodsSelectQuery(table, category){

	var list = [];

	axios({
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		url: '../modules/chiefAdministrator/goodsControl/selectList.php',
		data: {
			table: table,
			category: category
		}
	})
	.then(function(response){

		response['data']['list'].forEach(function(elem){
			list.push(elem);
		});

	})
	.catch(function(error){
		console.log(error);
	});

	return list;

}

var admin = new Vue({
	el: '#adminFunction',
	data: {
		adminFunction: {
			siteControl: {
				show: false,
				status: '',
				slider: {
					list: [],
					status: {
						show: true
					},
					newSlideStatus: "",
					preview: "",
					img: null
				}
			},
			shopControl: {
				show: false,
				shopList: {
					show: false,
					status: '',
					shopListShow: false,
					list: [],
					search: null
				},
				shopInfo: {
					add: false,
					show: false,
					shopId: null,
					status: '',
					address: '',
					phone: ''
				}
			},
			workerControl: {
				show: false,
				administratorShow: false,
				salespeopleShow: false,
				administratorListShow: false,
				salespeopleListShow: false,
				administratorList: [],
				salespeopleList: [],
				shopId: '',
				searchStatus: '',
				inputAdminSearch: '',
				inputSalesSearch: '',
				workerInfo: {
					id: null,
					show: false,
					status: '',
					surname: '',
					name: '',
					patronymic: '',
					address: '',
					workbook: '',
					salary: '',
					date: null,
					shop: null,
					login: '',
					password: '',
					passwordChange: '',
					email: '',
					phone: '',
					root: null,
					shopId: null,
					passwordChangeShow: false,
					shopList: []
				}
			},
			goodsControl: {
				addParam: false,
				show: false,
				status: '',
				search: '',
				infoShow: false,
				infoStatus: '',
				errorShow: false,
				info: {
					id: null,
					name: '',
					bar: '',
					sport: {
						id: null,
						list: []
					},
					manufacturer: {
						id: null,
						list: []
					},
					category: {
						id: null,
						list: []
					},
					subCategory: {
						id: null,
						list: []
					},
					age: {
						id: null,
						list: []
					},
					size: {
						id: null,
						list: []
					},
					color: {
						id: null,
						hex: '',
						list: []
					},
					season: {
						id: null,
						list: []
					},
					material: {
						id: null,
						list: []
					},
					floor: {
						id: null,
						list: []
					},
					taste: {
						id: null,
						list: []
					},
					mass: 0,
					count: 0,
					length: 0,
					width: 0,
					height: 0,
					instruction: '',
					peculiarProperties: '',
					description: '',
					rating: ''
				},
				priceStatus: '',
				price: {
					price: '',
					discountPrice: '',
					discount: '',
					until: null
				},
				images: {
					main: '',
					list: []
				},
				newImage: null,
				imageStatus: '',
				tovarImagesMainStatus: false
			},
			manufacturerControl: {
				show: false,
				list: [],
				search: '',
				searchStatus: '',
				info: {
					id: null,
					show: false,
					name: '',
					info: '',
					img: null,
					status: '',
					newImg: null,
					newImgFile: null
				}
			},
			sportControl: {
				show: false,
				list: [],
				search: '',
				status: '',
				info: {
					id: null,
					name: '',
					show: false,
					status: ''
				}
			},
			suppliersControl: {
				show: false,
				list: [],
				search: '',
				status: '',
				info: {
					id: null,
					name: '',
					show: false,
					status: '',
					info: '',
					address: '',
					phone: ''
				}
			},
			materialControl: {
				show: false,
				list: [],
				search: '',
				status: '',
				info: {
					id: null,
					name: '',
					show: false,
					status: ''
				}
			}
		}
	},
	methods: {

		// Преведение номера телефона к удобному виду

		phoneView(phone){

			return phone['0'] + '(' + phone.substr(1,3) + ')' + phone.substr(4,3) + '-' + phone.substr(7,2) + '-' + phone.substr(9,2);

		},

		siteControl(){

			this.adminFunction.siteControl.show = !this.adminFunction.siteControl.show;

			if (this.adminFunction.siteControl.show == true){

				this.adminFunction.siteControl.status = "Загрузка, пожалуйста подождите...";
				this.slideListLoading();

			}else{

				

			}

		},
		shopControl(){

			this.adminFunction.shopControl.show = !this.adminFunction.shopControl.show;

			if (this.adminFunction.shopControl.show == true){

				this.shopList();

			}else{

				this.adminFunction.shopControl.shopList.show = false;
				this.adminFunction.shopControl.shopList.status = '';
				this.adminFunction.shopControl.shopList.shopListShow = false;
				this.adminFunction.shopControl.shopList.list = [];
				this.adminFunction.shopControl.shopList.search = null;
				this.adminFunction.shopControl.shopInfo.add = false;
				this.adminFunction.shopControl.shopInfo.show = false;
				this.adminFunction.shopControl.shopInfo.shopId = null;
				this.adminFunction.shopControl.shopInfo.status = '';
				this.adminFunction.shopControl.shopInfo.address = '';
				this.adminFunction.shopControl.shopInfo.phone = '';

			}
			
		},
		workerControl(){

			this.adminFunction.workerControl.show = !this.adminFunction.workerControl.show;

			if (this.adminFunction.workerControl.show == false){

				this.adminFunction.workerControl.administratorShow = false;
				this.adminFunction.workerControl.salespeopleShow = false;
				workerInfoClear();

			}

		},
		goodsControl(){
			this.adminFunction.goodsControl.show = !this.adminFunction.goodsControl.show;

			if (this.adminFunction.goodsControl.show == false){

				this.adminFunction.goodsControl.infoShow = false;
				this.goodsInfoClear();

			}
		},
		manufacturerControl(){

			this.adminFunction.manufacturerControl.show = !this.adminFunction.manufacturerControl.show;

			if (this.adminFunction.manufacturerControl.show == true){

				this.manufacturerList();

			}
	
		},
		sportControl(){
			
			this.adminFunction.sportControl.show = !this.adminFunction.sportControl.show;

			if(this.adminFunction.sportControl.show == true){

				this.adminFunction.sportControl.search = '';
				this.sportSearch();

			}

		},
		suppliersControl(){

			this.adminFunction.suppliersControl.show = !this.adminFunction.suppliersControl.show;

			if (this.adminFunction.suppliersControl.show == true){

				this.adminFunction.suppliersControl.search = '';
				this.suppliersSearch();

			}

		},
		materialControl(){

			this.adminFunction.materialControl.show = !this.adminFunction.materialControl.show;

			if (this.adminFunction.materialControl.show == true){

				this.adminFunction.materialControl.search = '';
				this.materialSearch();

			}

		},

		// Усправление сайтом
			// Управление слайдером
				// Добаление нового слайда

		newSlide(event){

			let img = document.getElementById('newSlideInput').files[0];

			if (img.type != 'image/jpeg'){

				this.adminFunction.siteControl.slider.newSlideStatus = 'Тип файла должен быть "*.jpeg"';

			}else{

				if (img.size > 15728640){

					this.adminFunction.siteControl.slider.newSlideStatus = "Размер файла должен быть не более 15Мб!"

				}else{

					let preview = new Image();

					let fileReader = new FileReader();
					fileReader.readAsDataURL(img);

					fileReader.onload = function(event){

						admin.adminFunction.siteControl.slider.preview = event.target.result;
						admin.adminFunction.siteControl.slider.img = img;

					}

				}

			}

		},
		newSlideAdd(){

			if (admin.adminFunction.siteControl.slider.img == null){

				this.adminFunction.siteControl.slider.newSlideStatus = 'Выберите файл!';

			}else{

				var formData = new FormData();
				formData.append('img', admin.adminFunction.siteControl.slider.img);

				axios({
					method: 'POST',
					headers: { "X-Requested-With": "XMLHttpRequest" },
					url: '../modules/chiefAdministrator/sliderControl/newSlide.php',
					data: formData
				})
				.then(function(response){

					switch(response['data']['status']) {
						case 'error0':
							admin.adminFunction.siteControl.slider.newSlideStatus = 'Файл либо больше 15Мб, либо не является "*.jpg"!';
							break;
						case 'error1':
							admin.adminFunction.siteControl.slider.newSlideStatus = 'Нехватка свободного места!';
							break;
						default:
							admin.adminFunction.siteControl.slider.newSlideStatus = 'Успешно!';
							setTimeout(admin.slideListLoading(), 1000);
					    	break;
					}
					
				})
				.catch(function(error){
					console.log(error);
				});

			}

		},

				// Загрузка слайдов

		slideListLoading(){

			admin.adminFunction.siteControl.slider.list = [];
			admin.adminFunction.siteControl.slider.img = null;
			admin.adminFunction.siteControl.slider.newSlideStatus = '';

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/sliderControl/slideList.php'
			})
			.then(function(response){

				if (response['data']['status'] == 'exit'){

					autorisationWindow(0, 0, 0);

				}else{

					admin.adminFunction.siteControl.slider.status.show = false;

					response['data']['list'].forEach(function(elem){

						let img = {
							url: "slider_image/" + elem,
							delete: elem
						}
						admin.adminFunction.siteControl.slider.list.push(img);

					});

				}

			})
			.catch(function(error){
				admin.adminFunction.siteControl.slider.status.show = true;
				admin.adminFunction.siteControl.status = "Извините, произошла ошибка при загрузке данных!";
				console.log(error);
			});

		},

				// Удаление слайда

		deleteSlide(event){

			let src = event.target.getAttribute('data-img');

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/sliderControl/deleteSlide.php',
				data: {
					image_name: src
				}
			})
			.then(function(response){

				switch(response['data']['status']) {
					case 'error':
						admin.adminFunction.siteControl.slider.newSlideStatus = 'Серверная ошибка!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						admin.slideListLoading();
						admin.adminFunction.siteControl.slider.newSlideStatus = 'Успешно!';
						break;
				}

			})
			.catch(function(error){
				console.log(error);
			});

		},

		// Управление магазинами

			// Список магазинов

		shopList(){

			this.adminFunction.shopControl.shopList.show = false;
			this.adminFunction.shopControl.shopList.list = [];
			this.adminFunction.shopControl.status = "Загрузка, пожалуйста подождите...";

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/shopControl/shopList.php',
				data: {
					search: admin.adminFunction.shopControl.shopList.search
				}
			})
			.then(function(response){

				if (response['data']['status'] == 'exit'){

					autorisationWindow(0, 0, 0);

				}else{

					if (response['data']['list'] != null){

						admin.adminFunction.shopControl.shopList.list = response['data']['list'];
						admin.adminFunction.shopControl.shopList.status = "Результат:";
						admin.adminFunction.shopControl.shopList.show = true;

					}else{

						admin.adminFunction.shopControl.shopList.status = "Поиск не дал результатов!";
						admin.adminFunction.shopControl.shopList.show = false;

					}

				}

			})
			.catch(function(error){
				admin.adminFunction.shopControl.shopList.status = "Извините, произошла ошибка при загрузке данных!";
				console.log(error);
			});

		},

		shopTableClick(){

			tableClickRender(event);

			let tr = event.target.parentNode;

			admin.adminFunction.shopControl.shopInfo.administratorId = null;
			admin.adminFunction.shopControl.shopInfo.administratorName = '';
			admin.adminFunction.shopControl.shopInfo.adminList = [];
			admin.adminFunction.shopControl.shopInfo.shopId = tr.getAttribute('data-id');
			admin.adminFunction.shopControl.shopInfo.address = tr.getAttribute('data-address');
			admin.adminFunction.shopControl.shopInfo.phone = tr.getAttribute('data-phone');
			admin.adminFunction.shopControl.shopInfo.administratorId = tr.getAttribute('data-adminId');
			admin.adminFunction.shopControl.shopInfo.administratorName = tr.getAttribute('data-administratorName');

		},

		shopTableClickDblclick(){

			tableClickRender(event);
			this.shopInfo();

		},

		shopInfo(){

			if (this.adminFunction.shopControl.shopInfo.shopId != null){

				if (this.adminFunction.shopControl.shopInfo.administratorId == null){

					this.freedomShopAdministratorList();

				}else{

					let obj = {
						id: this.adminFunction.shopControl.shopInfo.administratorId,
						name: this.adminFunction.shopControl.shopInfo.administratorName
					}

					this.adminFunction.shopControl.shopInfo.adminList = [];
					this.adminFunction.shopControl.shopInfo.adminList.push(obj);

				}

				this.adminFunction.shopControl.shopInfo.show = true;

			}else{

				this.adminFunction.shopControl.shopList.status = "Сначала выберите магазин!";

			}

		},

		freedomShopAdministratorList(){

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/shopControl/freedomAdministratorList.php'
			})
			.then(function(response){

				if (response['data']['status'] == 'exit'){

					autorisationWindow(0, 0, 0);

				}else{

					admin.adminFunction.shopControl.shopInfo.adminList = response['data']['list'];
					admin.adminFunction.shopControl.shopInfo.adminList.unshift(false);

				}

			})
			.catch(function(error){
				console.log(error);
			});

		},

			// Не изменять информацию

		shopInfoCancel(){

			admin.adminFunction.shopControl.shopInfo.shopId = null;
			admin.adminFunction.shopControl.shopInfo.address = '';
			admin.adminFunction.shopControl.shopInfo.phone = '';
			admin.adminFunction.shopControl.shopInfo.add = false;
			admin.adminFunction.shopControl.shopInfo.show = false;
			admin.adminFunction.shopControl.shopInfo.status = '';

			tableRenderClear('shopListTable');

		},

			// Новый магазин

		newShow(){

			admin.adminFunction.shopControl.shopInfo.shopId = null;
			admin.adminFunction.shopControl.shopInfo.address = '';
			admin.adminFunction.shopControl.shopInfo.phone = '';
			admin.adminFunction.shopControl.shopInfo.add = true;
			admin.adminFunction.shopControl.shopInfo.show = true;
			admin.adminFunction.shopControl.shopInfo.status = '';

		},

			// Сохранение информации о магазине

		shopInfoSave(){

			if (this.adminFunction.shopControl.shopInfo.address.length != 0){

				let reg = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;

				if (reg.test(this.adminFunction.shopControl.shopInfo.phone) == false){

					this.adminFunction.shopControl.shopInfo.status = 'Номер телефона должен состоять из 11 цифр!';

				}else{

					let phone = this.adminFunction.shopControl.shopInfo.phone.replace(/\D+/g, '');

					if (phone.length != 11){

						this.adminFunction.shopControl.shopInfo.status = 'Номер телефона должен состоять из 11 цифр!';

					}else{

						admin.adminFunction.shopControl.shopInfo.status = 'Отправка данных на сервер...';

						axios({
							method: 'POST',
							headers: { 'Content-Type': 'application/json' },
							url: '../modules/chiefAdministrator/shopControl/shopInfoUpdate.php',
							data: {
								id: admin.adminFunction.shopControl.shopInfo.shopId,
								address: admin.adminFunction.shopControl.shopInfo.address,
								phone: admin.adminFunction.shopControl.shopInfo.phone
							}
						})
						.then(function(response){

							switch (response['data']['status']){
								case 'exit':

									autorisationWindow(0, 0, 0);

									break;
								case 'phoneError':

									admin.adminFunction.shopControl.shopInfo.status = 'Введённый номер телефона занят!';

									break;
								case 'good':

									if (admin.adminFunction.shopControl.shopInfo.add == true){

										admin.adminFunction.shopControl.shopInfo.status = 'Новый магазин успешно добавлен!';

									}else{

										admin.adminFunction.shopControl.shopInfo.status = 'Информация успешно обновлена!';

									}

									setTimeout(function(){

										admin.shopInfoCancel();
										admin.shopList();

									}, 1000);

									break;
								default:

									break;
							}

						})
						.catch(function(error){
							console.log(error);
						});

					}

				}

			}else{

				this.adminFunction.shopControl.shopInfo.status = "Введите адрес (не больше 255 символов)!"

			}

		},

			// Закрыть магазин

		shopDelete(){

			if (true == confirm('Вы дествительно хотите закрыть магазин №'+ admin.adminFunction.shopControl.shopInfo.shopId +', находящийся по адресу: '+ admin.adminFunction.shopControl.shopInfo.address +'!?')){

				admin.adminFunction.shopControl.shopInfo.status = 'Отправка данных на сервер...';

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/chiefAdministrator/shopControl/shopDelete.php',
					data: {
						id: admin.adminFunction.shopControl.shopInfo.shopId
					}
				})
				.then(function(response){

				switch (response['data']['status']){
					case 'exit':

						autorisationWindow(0, 0, 0);

					break;
					case 'good':

						admin.adminFunction.shopControl.shopInfo.status = 'Магазин закрыт!';

						setTimeout(function(){

							admin.shopInfoCancel();
							admin.shopList();

						}, 1000);

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

			// Открыть персонал

		shopWorker(){

			this.adminFunction.workerControl.shopId = this.adminFunction.shopControl.shopInfo.shopId;
			this.adminFunction.workerControl.show = true;
			this.shopWorkerList();

		},

		// Пресонал магазина
			// Загрузка списков работников

		shopWorkerList(){

			if (this.adminFunction.workerControl.shopId != ''){

				this.adminFunction.workerControl.workerInfo.root = null;
				this.adminFunction.workerControl.searchStatus = "Выполняется поиск...";

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/chiefAdministrator/workerControl/shopWorkerList.php',
					data: {
						id: admin.adminFunction.workerControl.shopId
					}
				})
				.then(function(response){

				switch (response['data']['status']){
					case 'exit':

						autorisationWindow(0, 0, 0);

					break;
					case 'good':

						admin.adminFunction.workerControl.searchStatus = 'Магазин № '+ admin.adminFunction.workerControl.shopId +', '+ response['data']['shop'] + ':';
						admin.adminFunction.workerControl.administratorList = response['data']['adminList'];
						admin.adminFunction.workerControl.salespeopleList = response['data']['salesList'];
						admin.adminFunction.workerControl.administratorShow = true;
						admin.adminFunction.workerControl.salespeopleShow = true;
						admin.adminFunction.workerControl.administratorListShow = true;
						admin.adminFunction.workerControl.salespeopleListShow = true;

						break;
					default:

						break;
						
					}
				})
					.catch(function(error){
						console.log(error);
				});

			}else{

				this.adminFunction.workerControl.searchStatus = "Введите номер магазина!";

			}

		},

			// Открыть меню администраторов
		
		adminOpen(){

			if (this.adminFunction.workerControl.salespeopleShow == true){

				this.adminFunction.workerControl.salespeopleShow = false;

			}

			workerInfoClear();
			this.adminFunction.workerControl.workerInfo.root = 2;
			this.adminFunction.workerControl.administratorShow = true;

		},

			// Открыть меню продавцов

		salesOpen(){

			if (this.adminFunction.workerControl.administratorShow == true){

				this.adminFunction.workerControl.administratorShow = false;

			}

			workerInfoClear();
			this.adminFunction.workerControl.workerInfo.root = 3;
			this.adminFunction.workerControl.salespeopleShow = true;

		},

			// Список работников

		allWorkerList(){

			this.workerList('all');

		},

			// Свободные работники

		freedomWorker(){

			this.workerList('freedom');

		},

		workerList(status){

			workerInfoClear();

			let search = '';
			let url = ''

			if (this.adminFunction.workerControl.workerInfo.root == 2){

				search = this.adminFunction.workerControl.inputAdminSearch;
				url = 'adminList.php';

			}else{

				search = this.adminFunction.workerControl.inputSalesSearch;
				url = 'salesList.php';

			}

			this.adminFunction.workerControl.searchStatus = "Выполняется поиск...";

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/workerControl/'+ url,
				data: {
					search: search,
					shop: status
				}
			})
				.then(function(response){

				admin.adminFunction.workerControl.administratorList = [];
				admin.adminFunction.workerControl.salespeopleList = [];

				switch (response['data']['status']){
					case 'exit':

						autorisationWindow(0, 0, 0);

					break;
					case 'good':

						admin.adminFunction.workerControl.searchStatus = "Результат:";

						if (admin.adminFunction.workerControl.workerInfo.root == 2){

							admin.adminFunction.workerControl.inputAdminSearch = search;
							admin.adminFunction.workerControl.administratorList = response['data']['list'];
							admin.adminFunction.workerControl.administratorListShow = true;

						}else{

							admin.adminFunction.workerControl.inputSalesSearch = search;
							admin.adminFunction.workerControl.salespeopleList = response['data']['list'];
							admin.adminFunction.workerControl.salespeopleListShow = true;

						}

						break;
					case null:
						admin.adminFunction.workerControl.searchStatus = "Ничего не найдено!";
						break;
					default:
						break;
						
				}

			})
			.catch(function(error){
				admin.adminFunction.workerControl.searchStatus = "Извините, при загрузке данных произошла ошибка!";
				console.log(error);
			});

		}, 

			// Клик по таблице работников

		workerTableClick(event){

			this.adminFunction.workerControl.workerInfo.root = event.target.parentNode.getAttribute('data-root');
			this.adminFunction.workerControl.workerInfo.id = event.target.parentNode.getAttribute('data-id');

			if (this.adminFunction.workerControl.workerInfo.root == 2){

				tableRenderClear('salesTable');

			}else{

				tableRenderClear('adminTable');

			}

			tableClickRender(event);

		},

			// Двойной клик по таблице работников

		dblworkerTableClick(event){
			
			this.adminFunction.workerControl.workerInfo.root = event.target.parentNode.getAttribute('data-root');
			this.adminFunction.workerControl.workerInfo.id = event.target.parentNode.getAttribute('data-id');

			if (this.adminFunction.workerControl.workerInfo.root == 2){

				tableRenderClear('salesTable');

			}else{

				tableRenderClear('adminTable');

			}

			tableClickRender(event);
			this.workerInfoOpen();

		},

			// Загрузка информации о работнике

		workerInfoOpen(){

			if ((this.adminFunction.workerControl.workerInfo.root == null) || (this.adminFunction.workerControl.workerInfo.id == null)){

				this.adminFunction.workerControl.searchStatus = "Сначала выберите работника!";

			}else{

				workerInfoInputClear();

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/chiefAdministrator/workerControl/workerInfo.php',
					data: {
						id: admin.adminFunction.workerControl.workerInfo.id,
						root: admin.adminFunction.workerControl.workerInfo.root
					}
				})
					.then(function(response){

					switch (response['data']['status']){
						case 'exit':

							autorisationWindow(0, 0, 0);

						break;
						case 'good':

							let info = response['data']['info'];
							admin.adminFunction.workerControl.workerInfo.show = true;
							admin.adminFunction.workerControl.workerInfo.status = '';
							admin.adminFunction.workerControl.workerInfo.surname = info.surname;
							admin.adminFunction.workerControl.workerInfo.name = info.name;
							admin.adminFunction.workerControl.workerInfo.patronymic = info.patronymic;
							admin.adminFunction.workerControl.workerInfo.address = info.residential_address;
							admin.adminFunction.workerControl.workerInfo.workbook = info.work_book_number;
							admin.adminFunction.workerControl.workerInfo.salary = info.base_salary;
							admin.adminFunction.workerControl.workerInfo.date = info.start_date;
							admin.adminFunction.workerControl.workerInfo.shop = info.shop;
							admin.adminFunction.workerControl.workerInfo.login = '';
							admin.adminFunction.workerControl.workerInfo.password = ''
							admin.adminFunction.workerControl.workerInfo.passwordChange = '';
							admin.adminFunction.workerControl.workerInfo.email = info.email;
							admin.adminFunction.workerControl.workerInfo.phone = info.phone;
							admin.adminFunction.workerControl.workerInfo.shopId = info.shopId;
							admin.adminFunction.workerControl.workerInfo.passwordChange = '';
							admin.adminFunction.workerControl.workerInfo.shopList = response['data']['shopList'];
							admin.adminFunction.workerControl.workerInfo.show = true;

							break;
						case null:
							admin.adminFunction.workerControl.searchStatus = "Ошибка в Базе данных!";
							break;
						default:
							break;
							
					}

				})
				.catch(function(error){
					admin.adminFunction.workerControl.searchStatus = "Извините, при загрузке данных произошла ошибка!";
					console.log(error);
				});

			}

		},

			// Отмена изменения информации о сотруднике

		workerInfoCansel(){

			workerInfoClear();

		},

			// Открыть окно добавления нового сотрудника

		newWorker(){

			this.adminFunction.workerControl.workerInfo.id = null;
			workerInfoInputClear();
			this.adminFunction.workerControl.workerInfo.show = true;

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/workerControl/shopList.php'
			})
			.then(function(response){

				admin.adminFunction.workerControl.workerInfo.shopId = null;
				admin.adminFunction.workerControl.workerInfo.shop = '';
				admin.adminFunction.workerControl.workerInfo.shopList = response['data']['list'];
				

			})
			.catch(function(error){
				admin.adminFunction.workerControl.workerInfo.status = "Извините, при списка магазинов произошла ошибка!";
				console.log(error);
			});

		},

			// Сохранение информации о сотруднике

		workerInfoSave(){

			if (this.adminFunction.workerControl.workerInfo.phone.length != 0){

				let phone = this.adminFunction.workerControl.workerInfo.phone;
				let reg = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;

				if (reg.test(phone) == false){

					this.adminFunction.workerControl.workerInfo.status = 'Номер телефона должен состоять из 11 цифр!';
					return false;

				}else{

					phone = phone.replace(/\D+/g, '');

					if (phone.length != 11){

						this.adminFunction.workerControl.workerInfo.status = 'Номер телефона должен состоять из 11 цифр!';
						return false;

					}

				} 

			}else{

				this.adminFunction.workerControl.workerInfo.status = 'Введите номер телефона!';
				return false;

			}

			if (this.adminFunction.workerControl.workerInfo.email.trim().length != 0){

				let email = this.adminFunction.workerControl.workerInfo.email;
				let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

   				if(reg.test(email) == false) {

      				this.adminFunction.workerControl.workerInfo.status = 'Неверный формат E-mail!';
      				return false;

   				}

			}

			if (this.adminFunction.workerControl.workerInfo.surname.trim().length == 0){

				this.adminFunction.workerControl.workerInfo.status = 'Введите фамилию!';
      			return false;

			}

			if (this.adminFunction.workerControl.workerInfo.name.trim().length == 0){

				this.adminFunction.workerControl.workerInfo.status = 'Введите имя!';
      			return false;

			}

			if (this.adminFunction.workerControl.workerInfo.patronymic.trim().length == 0){

				this.adminFunction.workerControl.workerInfo.status = 'Введите отчество!';
      			return false;

			}

			if ((this.adminFunction.workerControl.workerInfo.workbook.trim().length == 0) || ((this.adminFunction.workerControl.workerInfo.workbook.trim().length > 13))){

				this.adminFunction.workerControl.workerInfo.status = 'Трудовая книжка должна быть не более 13 символов!';
      			return false;

			}

			if (admin.adminFunction.workerControl.workerInfo.date == null){

				this.adminFunction.workerControl.workerInfo.status = 'Выберите дату начала работы!';
      			return false;

			}

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/workerControl/workerInfoSave.php',
				data: {
					id: admin.adminFunction.workerControl.workerInfo.id,
					root: admin.adminFunction.workerControl.workerInfo.root,
					surname: admin.adminFunction.workerControl.workerInfo.surname.trim(),
					name: admin.adminFunction.workerControl.workerInfo.name.trim(),
					patronymic: admin.adminFunction.workerControl.workerInfo.patronymic.trim(),
					address: admin.adminFunction.workerControl.workerInfo.address.trim(),
					salary: admin.adminFunction.workerControl.workerInfo.salary.replace(/\D+/g, ''),
					date: admin.adminFunction.workerControl.workerInfo.date,
					shop: admin.adminFunction.workerControl.workerInfo.shopId,
					login: admin.adminFunction.workerControl.workerInfo.login.trim(),
					password: admin.adminFunction.workerControl.workerInfo.password.trim(),
					email: admin.adminFunction.workerControl.workerInfo.email.trim(),
					phone: admin.adminFunction.workerControl.workerInfo.phone.replace(/\D+/g, ''),
					workBook: admin.adminFunction.workerControl.workerInfo.workbook.trim()
				}
			})
			.then(function(response){

				console.log(response['data']);

				switch (response['data']['status']){
					case 'phoneError':
						admin.adminFunction.workerControl.workerInfo.status = 'Введённый номер телефона занят!';
						break;
					case 'loginError':
						admin.adminFunction.workerControl.workerInfo.status = 'Введённый логин занят!';
						break;
					case 'emailError':
						admin.adminFunction.workerControl.workerInfo.status = 'Введённый E-mail занят!';
						break;
					case 'dbError':
						admin.adminFunction.workerControl.workerInfo.status = 'Извините, в базе данных произошла ошибка!';
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'good':

						admin.adminFunction.workerControl.workerInfo.status = 'Успешно!';

						if (admin.adminFunction.workerControl.workerInfo.id != null){

							setTimeout(function(){
								admin.adminFunction.workerControl.workerInfo.status = 'Обновление информации...';
								setTimeout(function(){
									admin.workerInfoOpen();	
								},50);
							},1000);

						}else{

							setTimeout(function(){
								admin.adminFunction.workerControl.workerInfo.status = 'Обновление информации...';	
								admin.adminFunction.workerControl.workerInfo.id = response['data']['id'];
								setTimeout(function(){
									admin.workerInfoOpen();	
								},50);
							},1000);

						}

						break;
					default:
						admin.adminFunction.workerControl.workerInfo.status = 'Извините, произошла серверная ошибка!';
						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.workerControl.workerInfo.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Изменение значения в списке магазинов в информации о работнике

		workerInfoShopList(){

			this.adminFunction.workerControl.workerInfo.shopList.forEach(function(elem){

				if (elem['id'] == admin.adminFunction.workerControl.workerInfo.shopId){

					admin.adminFunction.workerControl.workerInfo.shop = elem['name'];

				}

			});

		},

		// Управление производителями

			// Поиск производителями

		manufacturerList(){

			this.adminFunction.manufacturerControl.list = [];

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/manufacturerControl/search.php',
				data: {
					search: admin.adminFunction.manufacturerControl.search
				}
			})
			.then(function(response){

				if (response['data']['status'] != false){

					admin.adminFunction.manufacturerControl.list = response['data']['list'];
					admin.adminFunction.manufacturerControl.searchStatus = 'Результат:';

				}else{

					admin.adminFunction.manufacturerControl.searchStatus = 'Ничего не найдено!';

				}

			})
			.catch(function(error){
				admin.adminFunction.manufacturerControl.searchStatus = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Клик по таблице производителей

		manufacturerTableClick(){

			this.adminFunction.manufacturerControl.info.id = event.target.parentNode.getAttribute('data-id');
			tableClickRender(event);

		},

			// Двойной клик по таблице производителей

		manufacturerTableDblClick(){

			this.adminFunction.manufacturerControl.info.id = event.target.parentNode.getAttribute('data-id');
			tableClickRender(event);
			this.manufacturerInfo();

		},

			// Открытие информации о производителей

		manufacturerInfo(){

			if (this.adminFunction.manufacturerControl.info.id == null){

				this.adminFunction.manufacturerControl.searchStatus = "Сначала выберите производителя!";
				return false;

			}

			admin.adminFunction.manufacturerControl.info.newImg = null;
			admin.adminFunction.manufacturerControl.info.newImgFile = null;
			admin.adminFunction.manufacturerControl.info.img = null;

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/manufacturerControl/manufacturerInfo.php',
				data: {
					id: admin.adminFunction.manufacturerControl.info.id
				}
			})
			.then(function(response){

				admin.adminFunction.manufacturerControl.info.img = response['data']['img'];
				admin.adminFunction.manufacturerControl.info.name = response['data']['result']['name'];
				admin.adminFunction.manufacturerControl.info.info = response['data']['result']['information'];

				admin.adminFunction.manufacturerControl.info.show = true;

			})
			.catch(function(error){
				admin.adminFunction.manufacturerControl.searchStatus = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Отмета изменения информации о производителей

		manufacturerInfoClear(){

			admin.adminFunction.manufacturerControl.info.img = null;
			admin.adminFunction.manufacturerControl.info.newImg = null;
			admin.adminFunction.manufacturerControl.info.newImgFile = null;
			admin.adminFunction.manufacturerControl.info.name = '';
			admin.adminFunction.manufacturerControl.info.info = '';
			admin.adminFunction.manufacturerControl.info.show = false;
			admin.adminFunction.manufacturerControl.info.id = null;
			admin.adminFunction.manufacturerControl.info.status = '';
			tableRenderClear('manufactorerTable');

		},

			// Сохранение инфомрации о производителей

		manufacturerInfoSave(){

			if ((this.adminFunction.manufacturerControl.info.name == '') || (this.adminFunction.manufacturerControl.info.name.length > 20)){

				this.adminFunction.manufacturerControl.info.status = 'Введите название! Не более 20 символов!';
				return false;

			}

			if (this.adminFunction.manufacturerControl.info.info == ''){

				this.adminFunction.manufacturerControl.info.status = 'Введите инфомрацию о производителе!';
				return false;

			}

			if (this.adminFunction.manufacturerControl.info.img == null){

				if (this.adminFunction.manufacturerControl.info.newImgFile == null){

					this.adminFunction.manufacturerControl.info.status = 'Прикрепите логотип! Тип файла должен быть "*.png. Размер, не более 15Мб."';
					return false;

				}

			}

			var formDataManufacturer = new FormData();
			formDataManufacturer.append('name', admin.adminFunction.manufacturerControl.info.name);
			formDataManufacturer.append('id', admin.adminFunction.manufacturerControl.info.id);
			formDataManufacturer.append('information', admin.adminFunction.manufacturerControl.info.info);
			formDataManufacturer.append('img', admin.adminFunction.manufacturerControl.info.newImgFile);

			axios({
				method: 'POST',
				headers: { "X-Requested-With": "XMLHttpRequest" },
				url: '../modules/chiefAdministrator/manufacturerControl/manufacturerInfoSave.php',
				data: formDataManufacturer
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'dbError':
						admin.adminFunction.manufacturerControl.info.status = 'Извините, в базе данных произошла ошибка!';
						break;
					case 'fileError':
						admin.adminFunction.manufacturerControl.info.status = 'Извините, при загрузке логотипа произошла ошибка!';
						break;
					case 'fileTypeError':
						admin.adminFunction.manufacturerControl.info.status = 'Неверный формат изображения!';
						break;
					case 'fileSizeError':
						admin.adminFunction.manufacturerControl.info.status = 'Размер логотипа должен быть не более 15Мб!';
						break;
					case 'freedomSizeError':
						admin.adminFunction.manufacturerControl.info.status = 'Извините, на сервере недостаточно свободного пространства!';
						break;
					case 'good':
						admin.adminFunction.manufacturerControl.info.status = 'Успешно';

						setTimeout(function(){
							admin.adminFunction.manufacturerControl.search = admin.adminFunction.manufacturerControl.info.name;
							admin.manufacturerInfoClear();
							admin.manufacturerList();
						},1500);
						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.manufacturerControl.info.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Новый производитель

		newManufacturer(){

			admin.adminFunction.manufacturerControl.info.img = null;
			admin.adminFunction.manufacturerControl.info.newImg = null;
			admin.adminFunction.manufacturerControl.info.newImgFile = null;
			admin.adminFunction.manufacturerControl.info.name = '';
			admin.adminFunction.manufacturerControl.info.info = '';
			admin.adminFunction.manufacturerControl.info.show = false;
			admin.adminFunction.manufacturerControl.info.id = null;
			admin.adminFunction.manufacturerControl.info.status = '';
			this.adminFunction.manufacturerControl.info.show = true;

		},

			// Превью перед загрузкой логотипа производителя

		newManufacturerImg(){

			let img = document.getElementById('manufacturerNewImage').files[0];

			if (img.type != 'image/png'){

				this.adminFunction.manufacturerControl.info.status = 'Тип файла должен быть "*.png"';

			}else{

				if (img.size > 15728640){

					this.adminFunction.manufacturerControl.info.status = "Размер логотипа должен быть не более 15Мб!"

				}else{

					let preview = new Image();

					let fileReader = new FileReader();
					fileReader.readAsDataURL(img);

					fileReader.onload = function(event){

						admin.adminFunction.manufacturerControl.info.newImg = event.target.result;
						admin.adminFunction.manufacturerControl.info.newImgFile = img;

					}

				}

			}

		},

		// Виды спорта
			// Поиск вида спорта

		sportSearch(){

			this.adminFunction.sportControl.list = [];

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/sportControl/sportSearch.php',
				data: {
					search: admin.adminFunction.sportControl.search
				}
			})
			.then(function(response){

				if (response['data']['status'] != 'result'){

					admin.adminFunction.sportControl.status = "Ничего не найдено!";

				}else{

					admin.adminFunction.sportControl.list = response['data']['list'];
					admin.adminFunction.sportControl.status = "Результат:";

				}

			})
			.catch(function(error){
				admin.adminFunction.sportControl.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Клик по таблице видов спорта

		sportTableClick(){

			tableClickRender(event);
			this.adminFunction.sportControl.info.id = event.target.parentNode.getAttribute('data-id');
			this.adminFunction.sportControl.info.name = event.target.parentNode.getAttribute('data-name');

		},

			// Двойной клик по таблице видов спорта

		sportTableDblClick(){

			this.adminFunction.sportControl.info.id = event.target.parentNode.getAttribute('data-id');
			this.adminFunction.sportControl.info.name = event.target.parentNode.getAttribute('data-name');
			tableClickRender(event);
			this.sportInfo();

		},

			// Добаление нового вида спорта

		newSport(){

			this.adminFunction.sportControl.info.show = true;
			this.adminFunction.sportControl.info.id = null;
			this.adminFunction.sportControl.info.name = '';
			this.adminFunction.sportControl.info.status = '';
			tableRenderClear('sportTable');

		},

			// Информация о виде спорта

		sportInfo(){

			if ((this.adminFunction.sportControl.info.id == null) || (this.adminFunction.sportControl.info.name == '')){

				this.adminFunction.sportControl.status = "Сначала выберите вид спорта";

			}else{

				this.adminFunction.sportControl.info.show = true;

			}

		},

			// Сохранить информацию о виде спорта

		sportInfoSave(){

			if ((this.adminFunction.sportControl.info.name.length == 0) || (this.adminFunction.sportControl.info.name.length > 30)){

				this.adminFunction.sportControl.info.status = "Введите название спорта! Не более 30 символов!";
				return false;

			}

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/sportControl/sportInfoSave.php',
				data: {
					id: admin.adminFunction.sportControl.info.id,
					name: admin.adminFunction.sportControl.info.name
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'dbError':
						admin.adminFunction.sportControl.info.status = "Извините, в базе данных произошла ошибка!";
						break;
					case 'good':
						admin.adminFunction.sportControl.info.status = "Успешно!";
						setTimeout(function(){
							admin.sportSearch();
							admin.sportInfoCansel();
						},1500);
						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.sportControl.info.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Отмена изменения информации

		sportInfoCansel(){

			tableRenderClear('sportTable');
			this.adminFunction.sportControl.info.show = false;
			this.adminFunction.sportControl.info.id = null;
			this.adminFunction.sportControl.info.name = '';
			this.adminFunction.sportControl.info.status = '';

		},

		// Управление поставщиками
			// Поиск поставщиками

		suppliersSearch(){

			this.adminFunction.suppliersControl.list = [];

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/suppliersControl/suppliersSearch.php',
				data: {
					search: admin.adminFunction.suppliersControl.search
				}
			})
			.then(function(response){

				if (response['data']['status'] != 'result'){

					admin.adminFunction.suppliersControl.status = "Ничего не найдено!";

				}else{

					admin.adminFunction.suppliersControl.list = response['data']['list'];
					admin.adminFunction.suppliersControl.status = "Результат:";

				}

			})
			.catch(function(error){
				admin.adminFunction.suppliersControl.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Клик по таблице поставщиков

		suppliersTableClick(){

			this.adminFunction.suppliersControl.info.id = event.target.parentNode.getAttribute('data-id');
			tableClickRender(event);

		},

			// Двойной клик по таблице поставщиков

		suppliersTableDblClick(){

			this.adminFunction.suppliersControl.info.id = event.target.parentNode.getAttribute('data-id');
			tableClickRender(event);
			this.suppliersInfo();

		},

			// Просмотр информации о поставщике

		suppliersInfo(){

			this.adminFunction.suppliersControl.info.status = '';

			if (this.adminFunction.suppliersControl.info.id == null){

				this.adminFunction.suppliersControl.status = 'Сначала выберите поставщика в теблице!';
			
			}else{

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/chiefAdministrator/suppliersControl/suppliersInfo.php',
					data: {
						id: admin.adminFunction.suppliersControl.info.id
					}
				})
				.then(function(response){

					if (response['data']['status'] == 'exit'){

						autorisationWindow(0, 0, 0);

					}else{

						admin.adminFunction.suppliersControl.info.name = response['data']['info']['name'];
						admin.adminFunction.suppliersControl.info.info = response['data']['info']['information'];
						admin.adminFunction.suppliersControl.info.address = response['data']['info']['address'];
						admin.adminFunction.suppliersControl.info.phone = admin.phoneView(response['data']['info']['phone']);
						admin.adminFunction.suppliersControl.info.show = true;

					}

				})
				.catch(function(error){
					admin.adminFunction.suppliersControl.status = "Извините, произошла серверная ошибка!";
					console.log(error);
				});

			}

		},

			// Добавление нового поставщика

		newSuppliers(){

			tableRenderClear('suppliersTable');
			this.adminFunction.suppliersControl.info.show = true;
			this.adminFunction.suppliersControl.info.name = '';
			this.adminFunction.suppliersControl.info.info = '';
			this.adminFunction.suppliersControl.info.address = '';
			this.adminFunction.suppliersControl.info.phone = '';
			this.adminFunction.suppliersControl.info.id = null;
			this.adminFunction.suppliersControl.info.status = '';

		},

			// Сохранение информации о поставщике

		suppliersInfoSave(){

			if ((this.adminFunction.suppliersControl.info.name.length == 0)||(this.adminFunction.suppliersControl.info.name.length > 35)){

				this.adminFunction.suppliersControl.info.status = "Введите имя! Не более 35 символов!"
				return false;

			}

			if ((this.adminFunction.suppliersControl.info.address.length == 0)||(this.adminFunction.suppliersControl.info.address.length > 35)){

				this.adminFunction.suppliersControl.info.status = "Введите адрес! Не более 255 символов!"
				return false;

			}

			if (this.adminFunction.suppliersControl.info.phone.length != 0){

				let phone = this.adminFunction.suppliersControl.info.phone;
				let reg = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;

				if (reg.test(phone) == false){

					this.adminFunction.suppliersControl.info.status = 'Номер телефона должен состоять из 11 цифр!';
					return false;

				}else{

					phone = phone.replace(/\D+/g, '');

					if (phone.length != 11){

						this.adminFunction.suppliersControl.info.status = 'Номер телефона должен состоять из 11 цифр!';
						return false;

					}else{

						this.adminFunction.suppliersControl.info.phone = phone;

					}

				} 

			}else{

				this.adminFunction.suppliersControl.info.status = 'Введите номер телефона!';
				return false;

			}


			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/suppliersControl/suppliersInfoSave.php',
				data: {
					id: admin.adminFunction.suppliersControl.info.id,
					name: admin.adminFunction.suppliersControl.info.name,
					address: admin.adminFunction.suppliersControl.info.address,
					information: admin.adminFunction.suppliersControl.info.info,
					phone: admin.adminFunction.suppliersControl.info.phone
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'dbError':
						admin.adminFunction.suppliersControl.info.status = "Извините, в базе данных произошла ошибка!";
						break;
					case 'phoneError':
						admin.adminFunction.suppliersControl.info.status = "Номер телефона занят!";
						break;
					case 'good':
						admin.adminFunction.suppliersControl.info.status = "Успешно!";
						setTimeout(function(){
							admin.suppliersInfoCansel();
							admin.suppliersSearch();
						},1500);
						break;
					default:

						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.suppliersControl.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Отмена изменения информации о поставщике

		suppliersInfoCansel(){

			tableRenderClear('suppliersTable');
			this.adminFunction.suppliersControl.info.show = false;
			this.adminFunction.suppliersControl.info.name = '';
			this.adminFunction.suppliersControl.info.info = '';
			this.adminFunction.suppliersControl.info.address = '';
			this.adminFunction.suppliersControl.info.phone = '';
			this.adminFunction.suppliersControl.info.id = null;
			this.adminFunction.suppliersControl.info.status = '';

		},

		// Матариалы

			// Поиск материала

		materialSearch(){

			this.adminFunction.materialControl.list = [];

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/materialControl/materialSearch.php',
				data: {
					search: admin.adminFunction.materialControl.search
				}
			})
			.then(function(response){

				if (response['data']['status'] != 'result'){

					admin.adminFunction.materialControl.status = "Ничего не найдено!";

				}else{

					admin.adminFunction.materialControl.list = response['data']['list'];
					admin.adminFunction.materialControl.status = "Результат:";

				}

			})
			.catch(function(error){
				admin.adminFunction.materialControl.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Новый материала

		newMaterial(){

			tableRenderClear('materialTable');
			this.adminFunction.materialControl.info.show = true;
			this.adminFunction.materialControl.info.id = null;
			this.adminFunction.materialControl.info.name = '';
			this.adminFunction.materialControl.info.status = '';

		},

			// Клик по таблице материалов

		materialTableClick(){

			this.adminFunction.materialControl.info.id = event.target.parentNode.getAttribute('data-id');
			this.adminFunction.materialControl.info.name = event.target.parentNode.getAttribute('data-name');
			tableClickRender(event);

		},

			// Дваойной клик по таблице материалов

		materialTableDblClick(){

			this.adminFunction.materialControl.info.id = event.target.parentNode.getAttribute('data-id');
			this.adminFunction.materialControl.info.name = event.target.parentNode.getAttribute('data-name');
			tableClickRender(event);
			this.materialInfo();

		},

			// Редактирвование материала

		materialInfo(){

			if (this.adminFunction.materialControl.info.id == null){

				this.adminFunction.materialControl.status = "Сначала выберите материал из таблицы!";
				return false;

			}

			this.adminFunction.materialControl.info.show = true;

		},

			// Отмена сохранения информации о материала

		materialInfoCansel(){

			tableRenderClear('materialTable');
			this.adminFunction.materialControl.info.show = false;
			this.adminFunction.materialControl.info.id = '';
			this.adminFunction.materialControl.info.name = '';

		},

			// Сохранение информации о материале

		materialInfoSave(){

			if ((this.adminFunction.materialControl.info.name.length == 0)||(this.adminFunction.materialControl.info.name.length  > 15)){

				this.adminFunction.materialControl.info.status = "Введите название материала! Не более 15 символов!";
				return false;

			}

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/materialControl/materialInfoSave.php',
				data: {
					id: admin.adminFunction.materialControl.info.id,
					name: admin.adminFunction.materialControl.info.name
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'dbError':
						admin.adminFunction.materialControl.info.status = "Извините, в базе данных произошла ошибка!";
						break;
					case 'good':
						admin.adminFunction.materialControl.info.status = "Успешно!";
						setTimeout(function(){
							admin.materialInfoCansel();
							admin.materialSearch();
						},1500);
						break;
					default:

						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.suppliersControl.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

		// Управление информацией о товарах
			// Поиск товара

		tovarSearch(){

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/goodsControl/goodsSearch.php',
				data: {
					search: admin.adminFunction.goodsControl.search
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'null':
						admin.goodsInfoClear();
						admin.adminFunction.goodsControl.infoShow = false;
						admin.adminFunction.goodsControl.status = "Ничего не найдено!";
						break;
					case 'result':

						if (admin.adminFunction.goodsControl.addParam == true){
							admin.goodsInfoClear();
							admin.adminFunction.goodsControl.addParam = true;
						}else{
							admin.goodsInfoClear();
						}
						
						admin.adminFunction.goodsControl.status = "Результат!";
						admin.adminFunction.goodsControl.info = response['data']['info'];

						if (response['data']['images']['list'] == null){

							admin.adminFunction.goodsControl.imageStatus = "Загрузите изображения данного товара!";

						}else{

							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}

						if (response['data']['images']['main'] == null){

							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;

						}else{

							admin.adminFunction.goodsControl.images.main = response['data']['images']['main'];

						}

						if ((response['data']['images']['main'] == null)&&(response['data']['images']['list'] != null)){

							admin.adminFunction.goodsControl.imageStatus = '';
							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;
							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}

						admin.adminFunction.goodsControl.price = response['data']['price'];
						admin.adminFunction.goodsControl.saveClick = false;
						admin.adminFunction.goodsControl.infoError = 0;
						admin.adminFunction.goodsControl.infoShow = true;
						break;
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					default:
						admin.goodsInfoClear();
						admin.adminFunction.goodsControl.infoShow = false;
						break;
				}

			})
			.catch(function(error){
				admin.goodsInfoClear();
				admin.adminFunction.goodsControl.infoShow = false;
				admin.adminFunction.goodsControl.status = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Сохранить цену

		priceInfoSave(){

			if (this.adminFunction.goodsControl.info.id == null){

				this.adminFunction.goodsControl.priceStatus = "Сначала сохраните информацию о новом товаре!";
				return false;

			}

			if ((this.adminFunction.goodsControl.price.discount.length != 0)&&(this.adminFunction.goodsControl.price.until == null)){

				this.adminFunction.goodsControl.priceStatus = "Выберите дату окончания скидки!";
				return false;

			}

			if ((this.adminFunction.goodsControl.price.price.length == 0)||(parseFloat(this.adminFunction.goodsControl.price.price) <= 0)){

				return false;

			}

			this.adminFunction.goodsControl.priceStatus = "Отправка ...";

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/goodsControl/goodsPriceInfoSave.php',
				data: {
					id: admin.adminFunction.goodsControl.info.id,
					price: parseInt(admin.adminFunction.goodsControl.price.price),
					discount: parseInt(admin.adminFunction.goodsControl.price.discount),
					until: admin.adminFunction.goodsControl.price.until
				}
			})
			.then(function(response){
				console.log(response['data']);

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'dbError':
						admin.adminFunction.goodsControl.priceStatus = "Ошибка в базе данных!";
						break;
					case 'good':
						admin.adminFunction.goodsControl.priceStatus = "Успешно!";
						setTimeout(function(){
							admin.adminFunction.goodsControl.priceStatus = "";
						},1500);
						break;
					default:

						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.goodsControl.priceStatus = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Отмена изменения информации о товаре

		goodsInfoCansel(){

			this.goodsInfoClear();
			this.adminFunction.goodsControl.infoShow = false;

		},

			// Добавление нового товара

		newGoods(){

			this.goodsInfoClear();
			this.adminFunction.goodsControl.info.manufacturer.list = goodsSelectQuery('manufacturer', 0);
			this.adminFunction.goodsControl.info.sport.list = goodsSelectQuery('views_sport', 0);
			this.adminFunction.goodsControl.info.category.list = goodsSelectQuery('category', 0);
			this.adminFunction.goodsControl.infoShow = true;
			admin.adminFunction.goodsControl.addParam = false;

		},

			// Выбор категории товаров

		categoryTovarChange(){

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/goodsControl/selectParamLists.php',
				data: {
					id: admin.adminFunction.goodsControl.info.category.id
				}
			})
			.then(function(response){

				admin.adminFunction.goodsControl.info.subCategory.list = response['data']['subCategory'];

				switch (admin.adminFunction.goodsControl.info.category.id){
					case '3':
						admin.adminFunction.goodsControl.info.size.list = response['data']['size'];
						admin.adminFunction.goodsControl.info.season.list = response['data']['season'];
						admin.adminFunction.goodsControl.info.age.list = response['data']['age'];
						admin.adminFunction.goodsControl.info.color.list = response['data']['color'];
						admin.adminFunction.goodsControl.info.material.list = response['data']['material'];
						admin.adminFunction.goodsControl.info.floor.list = response['data']['floor'];
						break;
					case '4':
						admin.adminFunction.goodsControl.info.size.list = response['data']['size'];
						admin.adminFunction.goodsControl.info.season.list = response['data']['season'];
						admin.adminFunction.goodsControl.info.age.list = response['data']['age'];
						admin.adminFunction.goodsControl.info.color.list = response['data']['color'];
						admin.adminFunction.goodsControl.info.material.list = response['data']['material'];
						admin.adminFunction.goodsControl.info.floor.list = response['data']['floor'];
						break;
					case '5':
						admin.adminFunction.goodsControl.info.age.list = response['data']['age'];
						admin.adminFunction.goodsControl.info.color.list = response['data']['color'];
						admin.adminFunction.goodsControl.info.material.list = response['data']['material'];
						admin.adminFunction.goodsControl.info.floor.list = response['data']['floor'];
						break;
					case '6':
						admin.adminFunction.goodsControl.info.taste.list = response['data']['taste'];
						break;
					default:
						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.goodsControl.priceStatus = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

			// Отчистка полей с информацией о товарах

		goodsInfoClear(){

			this.adminFunction.goodsControl.tovarImagesMainStatus = false;
			this.adminFunction.goodsControl.imageStatus = '';
			this.adminFunction.goodsControl.search = '';
			this.adminFunction.goodsControl.errorShow = false;
			admin.adminFunction.goodsControl.addParam = false;
			let info = {
					id: null,
					name: '',
					bar: '',
					sport: {
						id: null,
						list: []
					},
					manufacturer: {
						id: null,
						list: []
					},
					category: {
						id: null,
						list: []
					},
					subCategory: {
						id: null,
						list: []
					},
					age: {
						id: null,
						list: []
					},
					size: {
						id: null,
						list: []
					},
					color: {
						id: null,
						hex: '',
						list: []
					},
					season: {
						id: null,
						list: []
					},
					material: {
						id: null,
						list: []
					},
					floor: {
						id: null,
						list: []
					},
					taste: {
						id: null,
						list: []
					},
					mass: 0,
					count: 0,
					length: 0,
					width: 0,
					height: 0,
					instruction: '',
					peculiarProperties: '',
					description: '',
					imageList: [],
					rating: '',
					saleStatus: null
				}

			this.adminFunction.goodsControl.price.price = '';
			this.adminFunction.goodsControl.price.discount = '';
			this.adminFunction.goodsControl.price.discountPrice = '';
			this.adminFunction.goodsControl.price.until = null;
			this.adminFunction.goodsControl.info = info;
			this.adminFunction.goodsControl.images.main = '';
			this.adminFunction.goodsControl.images.list = [];
			this.adminFunction.goodsControl.status = '';
			this.adminFunction.goodsControl.search = '';
			this.adminFunction.goodsControl.infoStatus = '';
			this.adminFunction.goodsControl.priceStatus = '';
			this.adminFunction.goodsControl.newImage = null;

		},

			// Клик по изображния товара

		tovarImageClick(){

			admin.adminFunction.goodsControl.images.main = event.target.getAttribute('src');

		},

			// Сохранить информаицю о товаре

		tovarInfoSave(){

			this.adminFunction.goodsControl.errorShow = true;

			if ((this.tovarNameError != false)||(this.tovarBarCodeError != false)||(this.tovarSportError != false)||(this.tovarCategoryError != false)||(this.tovarManufacturerError != false)||(this.tovarDiscriptionError != false)||(this.tovarSubCategoryError != false)||(this.tovarAgeError != false)||(this.tovarSizeError != false)||(this.tovarColorError != false)||(this.tovarSeasonError != false)||(this.tovarMaterialError != false)||(this.tovarFloorError != false)||(this.tovarWidthError != false)||(this.tovarHeightError != false)||(this.tovarLengthError != false)||(this.tovarTasteError != false)||(this.tovarMassError != false)||(this.tovarCountError != false)){

				return false;

			}

			if (admin.adminFunction.goodsControl.addParam == true){

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/chiefAdministrator/goodsControl/goodsAddParam.php',
					data: {
						id: admin.adminFunction.goodsControl.info.id,
						subCategory: admin.adminFunction.goodsControl.info.subCategory.id,
						age: admin.adminFunction.goodsControl.info.age.id,
						size: admin.adminFunction.goodsControl.info.size.id,
						color: admin.adminFunction.goodsControl.info.color.id,
						floor: admin.adminFunction.goodsControl.info.floor.id,
						material: admin.adminFunction.goodsControl.info.material.id,
						season: admin.adminFunction.goodsControl.info.season.id,
						length: admin.adminFunction.goodsControl.info.length,
						width: admin.adminFunction.goodsControl.info.width,
						height: admin.adminFunction.goodsControl.info.height,
						mass: admin.adminFunction.goodsControl.info.mass,
						count: admin.adminFunction.goodsControl.info.count,
						instruction: admin.adminFunction.goodsControl.info.instruction,
						taste: admin.adminFunction.goodsControl.info.taste.id
					}
				})
				.then(function(response){

					switch (response['data']['status']){
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						case 'dbError':
							admin.adminFunction.goodsControl.infoStatus = "Извините, в базе данных произошла ошибка!";
							break;
						case 'good':
							admin.adminFunction.goodsControl.infoStatus = "Добавлено!";
							setTimeout(function(){
								admin.adminFunction.goodsControl.infoStatus = "";
							},1000);
							break;
						default:
							break;
					}

				})
				.catch(function(error){
					admin.adminFunction.goodsControl.infoStatus = "Извините, произошла серверная ошибка!";
					console.log(error);
				});

			}else{

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/chiefAdministrator/goodsControl/goodsInfoSave.php',
					data: {
						id: admin.adminFunction.goodsControl.info.id,
						bar: admin.adminFunction.goodsControl.info.bar,
						name: admin.adminFunction.goodsControl.info.name,
						sport: admin.adminFunction.goodsControl.info.sport.id,
						category: admin.adminFunction.goodsControl.info.category.id,
						manufacturer: admin.adminFunction.goodsControl.info.manufacturer.id,
						description: admin.adminFunction.goodsControl.info.description,
						peculiar: admin.adminFunction.goodsControl.info.peculiarProperties,
						subCategory: admin.adminFunction.goodsControl.info.subCategory.id,
						age: admin.adminFunction.goodsControl.info.age.id,
						size: admin.adminFunction.goodsControl.info.size.id,
						color: admin.adminFunction.goodsControl.info.color.id,
						floor: admin.adminFunction.goodsControl.info.floor.id,
						material: admin.adminFunction.goodsControl.info.material.id,
						season: admin.adminFunction.goodsControl.info.season.id,
						length: admin.adminFunction.goodsControl.info.length,
						width: admin.adminFunction.goodsControl.info.width,
						height: admin.adminFunction.goodsControl.info.height,
						mass: admin.adminFunction.goodsControl.info.mass,
						count: admin.adminFunction.goodsControl.info.count,
						instruction: admin.adminFunction.goodsControl.info.instruction,
						taste: admin.adminFunction.goodsControl.info.taste.id
					}
				})
				.then(function(response){
					console.log("response", response['data']);

					switch (response['data']['status']){
						case 'exit':
							autorisationWindow(0, 0, 0);
							break;
						case 'dbError':
							admin.adminFunction.goodsControl.infoStatus = "Извините, в базе данных произошла ошибка!";
							break;
						case 'good':
							if (admin.adminFunction.goodsControl.info.id == null){
								admin.adminFunction.goodsControl.info.id = response['data']['id'];
								admin.adminFunction.goodsControl.infoStatus = "Новый товар успешно добавлен. Локальный код товара: " + admin.adminFunction.goodsControl.info.id; + '.'
							}else{
								admin.adminFunction.goodsControl.infoStatus = "Информация о товаре успешно изменена!";
							}
							break;
						default:
							break;
					}

				})
				.catch(function(error){
					admin.adminFunction.goodsControl.infoStatus = "Извините, произошла серверная ошибка!";
					console.log(error);
				});

			}

		},

			// Обработка фото товара
				// Сделать главным изображением

		tovarImageMain(){

			this.adminFunction.goodsControl.infoStatus = "";
			if (this.adminFunction.goodsControl.images.main.substr(-8) == 'main.jpg'){

				this.adminFunction.goodsControl.imageStatus = "Данной изображение уже является главным!";
				return false;

			}

			let src = this.adminFunction.goodsControl.images.main;
			src = src.substring(1, src.indexOf('?'));

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/goodsControl/goodsImageMain.php',
				data: {
					id: admin.adminFunction.goodsControl.info.id,
					imageName: src
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'good':
						if (response['data']['images']['list'] == null){

							admin.adminFunction.goodsControl.imageStatus = "Загрузите изображения данного товара!";

						}else{

							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}

						if (response['data']['images']['main'] == null){

							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;

						}else{

							admin.adminFunction.goodsControl.images.main = response['data']['images']['main'];

						}

						if ((response['data']['images']['main'] == null)&&(response['data']['images']['list'] != null)){

							admin.adminFunction.goodsControl.imageStatus = '';
							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;
							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}
						admin.adminFunction.goodsControl.imageStatus = "Изображение успешно сделано главным!";
						setTimeout(function(){
							admin.adminFunction.goodsControl.imageStatus = "";
						},3000);
						break;
					default:
						admin.adminFunction.goodsControl.imageStatus = "Извините, произошла серверная ошибка!";
						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.goodsControl.imageStatus = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

				// Выбор файла

		tovarImageChange(){

			let img = event.target.files[0];

			if (img.size > 15728640){

				this.adminFunction.goodsControl.imageStatus = "Загружаемый файл должен быть не больше 15 Мб!";
				return false;

			}

			if (img.type != 'image/jpeg'){

				this.adminFunction.goodsControl.imageStatus = "Загружаемый файл должен быть в формате: '*.jpeg'!";
				return false;

			}
			
			let fileReader = new FileReader();
			fileReader.readAsDataURL(img);

			fileReader.onload = function(event){

				admin.adminFunction.goodsControl.images.main = event.target.result;
				admin.adminFunction.goodsControl.newImage = img;

			}

		},

				// Добавление нового фото

		tovarImageNew(){

			if (this.adminFunction.goodsControl.newImage == null){

				this.adminFunction.goodsControl.imageStatus = "Сначала загрузите файл, '*.jpeg' размером не более 15 Мб!";
				return false;

			}

			var formData = new FormData();
			formData.append('img', admin.adminFunction.goodsControl.newImage);
			formData.append('id', admin.adminFunction.goodsControl.info.id);

			axios({
				method: 'POST',
				headers: { "X-Requested-With": "XMLHttpRequest" },
				url: '../modules/chiefAdministrator/goodsControl/goodsImageAdd.php',
				data: formData
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'good':
						if (response['data']['images']['list'] == null){

							admin.adminFunction.goodsControl.imageStatus = "Загрузите изображения данного товара!";

						}else{

							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}

						if (response['data']['images']['main'] == null){

							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;

						}else{

							admin.adminFunction.goodsControl.images.main = response['data']['images']['main'];

						}

						if ((response['data']['images']['main'] == null)&&(response['data']['images']['list'] != null)){

							admin.adminFunction.goodsControl.imageStatus = '';
							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;
							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}
						admin.adminFunction.goodsControl.imageStatus = "Изображение успешно добавлено!";
						setTimeout(function(){
							admin.adminFunction.goodsControl.imageStatus = "";
						},3000);
						break;
					case 'typeError':
						admin.adminFunction.goodsControl.imageStatus = "Загружаемый файл должен быть в формате: '*.jpeg'!";
						break;
					case 'sizeError':
						admin.adminFunction.goodsControl.imageStatus = "Загружаемый файл должен быть не больше 15 Мб!";
						break;
					case 'loadingError':
						admin.adminFunction.goodsControl.imageStatus = "При загрузке изображения произошла ошибка!";
						break;
					case 'freedomError':
						admin.adminFunction.goodsControl.imageStatus = "На сервере недостаточно дискового пространства!";
						break;
					default:
						admin.adminFunction.goodsControl.imageStatus = "Извините, произошла серверная ошибка!";
						break;

				}
			})
			.catch(function(error){
				admin.adminFunction.goodsControl.imageStatus = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		},

				// Добавить параметры

		addParamTovar(){

			this.tovarSearch();
			admin.adminFunction.goodsControl.addParam = true;

		},

				// Удалить изображение товара

		tovarImageDelete(){

			let src = this.adminFunction.goodsControl.images.main;
			src = src.substring(1, src.indexOf('?'));

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/chiefAdministrator/goodsControl/goodsImageDelete.php',
				data: {
					id: admin.adminFunction.goodsControl.info.id,
					imageName: src
				}
			})
			.then(function(response){

				switch (response['data']['status']){
					case 'exit':
						autorisationWindow(0, 0, 0);
						break;
					case 'good':
						
						if (response['data']['images']['list'] == null){

							admin.adminFunction.goodsControl.imageStatus = "Загрузите изображения данного товара!";

						}else{

							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}

						if (response['data']['images']['main'] == null){

							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;

						}else{

							admin.adminFunction.goodsControl.images.main = response['data']['images']['main'];

						}

						if ((response['data']['images']['main'] == null)&&(response['data']['images']['list'] != null)){

							admin.adminFunction.goodsControl.imageStatus = '';
							admin.adminFunction.goodsControl.tovarImagesMainStatus = true;
							admin.adminFunction.goodsControl.images.list = response['data']['images']['list'];

						}
						admin.adminFunction.goodsControl.imageStatus = "Изображение успешно удалено!";
						setTimeout(function(){
							admin.adminFunction.goodsControl.imageStatus = "";
						},3000);
						break;
					default:
						admin.adminFunction.goodsControl.imageStatus = "Извините, произошла серверная ошибка!";
						break;
				}

			})
			.catch(function(error){
				admin.adminFunction.goodsControl.imageStatus = "Извините, произошла серверная ошибка!";
				console.log(error);
			});

		}

	},
	computed: {
		endPrice(){
			return Math.round(this.adminFunction.goodsControl.price.price - (this.adminFunction.goodsControl.price.price / 100 * this.adminFunction.goodsControl.price.discount)) + '₽';
		},
		priceStatus(){
			if ((this.adminFunction.goodsControl.price.price <= 0)||(this.adminFunction.goodsControl.price.price.length == 0)){
				return "Введите цену!";
			}else{
				return false;
			}
		},

		// Поиск ошибок в информации о товаре

		tovarNameError(){
			if ((this.adminFunction.goodsControl.info.name.length == 0)||(this.adminFunction.goodsControl.info.name.length > 255)){
				return "Введите название товара! Не более 255 символов";
			}else{
				return false;
			}
		},
		tovarBarCodeError(){

			if ((this.adminFunction.goodsControl.info.bar.length == 0)||(this.adminFunction.goodsControl.info.bar.length > 14)){
				return "Введите bar код товара! Не более 14 цифр!";
			}else{
				return false;
			}
		},
		tovarSportError(){
			if ((this.adminFunction.goodsControl.info.sport.id == null)){
				return "Выберите вид спорта!!";
			}else{
				return false;
			}
		},
		tovarCategoryError(){
			if ((this.adminFunction.goodsControl.info.category.id == null)){
				return "Выберите категорию товара!";
			}else{
				return false;
			}
		},
		tovarManufacturerError(){
			if ((this.adminFunction.goodsControl.info.manufacturer.id == null)){
				return "Выберите производителя товара!";
			}else{
				return false;
			}
		},
		tovarDiscriptionError(){
			if ((this.adminFunction.goodsControl.info.description.length == 0)){
				return "Введите описание товара!";
			}else{
				return false;
			}
		},
		tovarSubCategoryError(){
			if ((this.adminFunction.goodsControl.info.subCategory.id == null)){
				return "Выберите подкатегорию товара!";
			}else{
				return false;
			}
		},
		tovarAgeError(){
			if ((this.adminFunction.goodsControl.info.age.id == null)&&(this.adminFunction.goodsControl.info.category.id != 6)){
				return "Выберите возрастную категорию товара!";
			}else{
				return false;
			}
		},
		tovarSizeError(){
			if ((this.adminFunction.goodsControl.info.size.id == null)&&(this.adminFunction.goodsControl.info.category.id == 3)&&(this.adminFunction.goodsControl.info.category.id == 4)){
				return "Выберите размер товара!";
			}else{
				return false;
			}
		},
		tovarColorError(){
			if ((this.adminFunction.goodsControl.info.color.id == null)&&(this.adminFunction.goodsControl.info.category.id != 6)){
				return "Выберите цвет товара!";
			}else{
				return false;
			}
		},
		tovarSeasonError(){
			if ((this.adminFunction.goodsControl.info.season.id == null)&&(this.adminFunction.goodsControl.info.category.id != 6)&&(this.adminFunction.goodsControl.info.category.id != 5)){
				return "Выберите сезонность товара!";
			}else{
				return false;
			}
		},
		tovarMaterialError(){
			if ((this.adminFunction.goodsControl.info.material.id == null)&&(this.adminFunction.goodsControl.info.category.id != 6)){
				return "Выберите материал из которого изоготовлен товар!";
			}else{
				return false;
			}
		},
		tovarFloorError(){
			if ((this.adminFunction.goodsControl.info.floor.id == null)&&(this.adminFunction.goodsControl.info.category.id != 6)){
				return "Выберите пол!";
			}else{
				return false;
			}
		},
		tovarWidthError(){
			if (((parseInt(this.adminFunction.goodsControl.info.width) == false)||(this.adminFunction.goodsControl.info.width == 0)||(this.adminFunction.goodsControl.info.width > 9999))&&(this.adminFunction.goodsControl.info.category.id == 5)){
				return "Введите ширину товара! Не более 9999 мм";
			}else{
				return false;
			}
		},
		tovarHeightError(){
			if (((parseInt(this.adminFunction.goodsControl.info.height) == false)||(this.adminFunction.goodsControl.info.height == 0)||(this.adminFunction.goodsControl.info.height > 9999))&&(this.adminFunction.goodsControl.info.category.id == 5)){
				return "Введите высоту товара! Не более 9999 мм";
			}else{
				return false;
			}
		},
		tovarLengthError(){
			if (((parseInt(this.adminFunction.goodsControl.info.length) == false)||(this.adminFunction.goodsControl.info.length == 0)||(this.adminFunction.goodsControl.info.length > 9999))&&(this.adminFunction.goodsControl.info.category.id == 5)){
				return "Введите длину товара! Не более 9999 мм";
			}else{
				return false;
			}
		},
		tovarTasteError(){
			if ((this.adminFunction.goodsControl.info.taste.id == null)&&(this.adminFunction.goodsControl.info.category.id == 6)){
				return "Выберите вкус спортивного питания!";
			}else{
				return false;
			}
		},
		tovarMassError(){
			if (((parseInt(this.adminFunction.goodsControl.info.mass) == false)||(this.adminFunction.goodsControl.info.mass == 0)||(this.adminFunction.goodsControl.info.mass > 9999))&&((this.adminFunction.goodsControl.info.category.id == 6)||(this.adminFunction.goodsControl.info.category.id == 5))){
				return "Введите вес товара! Не более 9999 грамм";
			}else{
				return false;
			}
		},
		tovarCountError(){
			if (((parseInt(this.adminFunction.goodsControl.info.count) == false)||(this.adminFunction.goodsControl.info.count == 0)||(this.adminFunction.goodsControl.info.count > 9999))&&(this.adminFunction.goodsControl.info.category.id == 6)){
				return "Введите количество порций товара! Не более 9999 порций";
			}else{
				return false;
			}
		}
	}
});