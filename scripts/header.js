function headerSize(){
	
	let per = document.getElementById('headerFile').children;
	let h = 0;

	for (let i = 0; i < per.length; i++){

		h = h + per[i].offsetHeight;

	}

	header.sportTop = h;
	document.getElementsByTagName('body')[0].style.paddingTop = h + 'px';

}

// Авторизация

// Для выхода пользователя отправить 0,0,0
function autorisationWindow(id, root, userName){

	if ((id == 0)||(root == 0)||(userName == 0)){

		header.login = '';
		header.password = '';

		axios({
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			url: '../modules/user/userExit.php',
		})
		.then(function(response){
			header.autorisationForm = true;
			header.userShow = false;
			header.rootName = null; //Название должности
			header.userName = null; //Имя пользователя
			header.userUrl = null; //Ссылка на страницу пользователя
			header.userFunctionName = null; //Название должностных функций
			header.userFunctionUrl = null; //Ссылка на страницу должностных функций
			header.autorisationStatus = null;
			header.autorisationDataError = false;

			switch (location.href){
				case 'http://imperium/admin.php':
					location.href = 'http://imperium/index.php';
					break;
				case 'http://imperium/shopAdministrator.php':
					location.href = 'http://imperium/index.php';
					break;
				case 'http://imperium/salespeople.php':
					location.href = 'http://imperium/index.php';
					break;
			}
		})
		.catch(function(error){
			console.log(error);
		});

	}else{

		// Вывод имени
		header.userName = userName;

		switch(root){
			case 1:
				header.rootName = 'Главный администратор:';
				header.nameRootShow = true;
				header.autorisationForm = false;
				header.userShow = true;
				header.userUrl = '#';
				header.userFunctionName = 'Админка сайта';
				header.userFunctionUrl = 'admin.php';
				break;
			case 2:
				header.rootName = 'Администратор магазина:';
				header.nameRootShow = true;
				header.autorisationForm = false;
				header.userShow = true;
				header.userUrl = '#';
				header.userFunctionName = 'Магазин:';
				header.userFunctionUrl = 'shopAdministrator.php';
				break;
			case 3:
				header.rootName = 'Продавец магазина:';
				header.nameRootShow = true;
				header.autorisationForm = false;
				header.userShow = true;
				header.userUrl = '#';
				header.userFunctionName = 'Продажа:';
				header.userFunctionUrl = 'salespeople.php';
				break;
			case 4:
				header.rootName = '';
				header.nameRootShow = false;
				header.autorisationForm = false;
				header.userShow = true;
				header.userUrl = '#';
				header.userFunctionName = 'Личный кабинет';
				header.userFunctionUrl = 'buyer.php';
				break;
		}

		header.autorisationForm = false;
		header.userShow = true;

	}

}

	// Поля ввода данных для регистрации

function registerInputGood(){

	header.register.errorInput.login = header.register.inputGood;
	header.register.errorInput.password = header.register.inputGood;
	header.register.errorInput.passwordChange = header.register.inputGood;
	header.register.errorInput.email = header.register.inputGood;
	header.register.errorInput.surname = header.register.inputGood;
	header.register.errorInput.name = header.register.inputGood;
	header.register.errorInput.patronymic = header.register.inputGood;
	header.register.errorInput.phone = header.register.inputGood;

}

var header = new Vue({
	el: '#headerFile',
	data: {
		login: '',
		password: '',
		autorisationForm: true,
		userShow: false,
		rootName: '', //Название должности
		userName: null, //Имя пользователя
		userUrl: null, //Ссылка на страницу пользователя
		userFunctionName: null, //Название должностных функций
		nameRootShow: false,
		userFunctionUrl: null, //Ссылка на страницу должностных функций
		autorisationStatus: null,
		autorisationDataError: false,
		sportViewsShow: false, //Все виды спорта
		sportTop: 0,
		register: {
			windowOpacity: {'opacity': '0'},
			registerStatus: '',
			show: false,
			data: {
				login: '',
				password: '',
				passwordChange: '',
				email: '',
				surname: '',
				name: '',
				patronymic: '',
				phone: ''
			},
			inputGood: {
				'border': '2px solid #7FB3D0',
				'color': '#7FB3D0'
			},
			inputError: {
				'border': '2px solid #BF3030',
				'color': '#BF3030'
			},
			errorInput: {
				login: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
				password: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
				passwordChange: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
				email: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
				surname: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
				name: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
				patronymic: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
				phone: {
					'border': '2px solid #7FB3D0',
					'color': '#7FB3D0'
				},
			},
			registerStatusColor: 'black'
		}
	},
	methods: {

		// Авторизация

		passwordFocus: function(){

			document.getElementById('password').focus();

		},

		input: function(){

			if ((this.login.length !=  0) && (this.password.length != 0)){

				this.autorisationStatus = null;
				this.autorisationDataError = false;
				
				axios({
					method: 'POST',
				  	headers: { 'Content-Type': 'application/json' },
				  	url: '../modules/user/autorisation.php',
				  	data: {
				    	login: this.login.trim(),
					    password: this.password.trim()
				  	}
				})
				.then(function(response){

					if (response['data']['status'] == true){

						header.autorisationStatus = 'Успешно!';
						header.statusColor = true;

						setTimeout(function() {

							autorisationWindow(parseInt(response['data']['info']['id']), parseInt(response['data']['info']['root']), response['data']['info']['userName']);
						
						}, 500);
						
					}else{

						header.statusColor = false;
						header.autorisationStatus = 'Неверный логин или пароль!';

					}

				})
				.catch(function(error){
					console.log(error);
				});

			}else{

				this.autorisationStatus = 'Введите логин и пароль!';
				this.autorisationDataError = true;

			}

		},

		// Выход

		exit:function(){

			autorisationWindow(0, 0, 0);

		},

		// Открытие списка видов спорта

		viewsSportOpen: function(){		

			if (this.sportViewsShow == true){

				let h = document.getElementById('sportViews').offsetHeight;
				header.sportTop = h;

				setTimeout(function(){
					header.sportViewsShow = false;
				},500);

			}else{

				this.sportViewsShow = true;

				setTimeout(function(){
					header.sportTop = 0;
					setTimeout(function(){
						document.getElementById('sportViews').scrollIntoView(false);
					}, 500);
				},10);
				

			}
		},

		// Регистрация

		registerNewUser(){

			var  error = 0;
			registerInputGood();

			// Проверка логина

			if (this.register.data.login.length == 0){

				this.register.errorInput.login = this.register.inputError;
				this.register.registerStatus = 'Введите логин!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}

			// Проверка пароля

			if (this.register.data.password.length < 6){

				this.register.errorInput.password = this.register.inputError;
				this.register.registerStatus = 'Пароль должен быть больше 6 символов!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}

			// Проверка повторно введённого пароля

			if (this.register.data.passwordChange.length == 0){

				this.register.errorInput.passwordChange = this.register.inputError;
				this.register.registerStatus = 'Введите пароль ещё раз!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}

			// Проверка E-mail

			if (this.register.data.email.length != 0){

				let reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

   				if(reg.test(this.register.data.email) == false) {

      				this.register.errorInput.email = this.register.inputError;
					this.register.registerStatus = 'Введён не корректный E-mail !';
					this.register.registerStatusColor = '#BF3030';
					error++

   				}

			}else{

				this.register.errorInput.email = this.register.inputError;
				this.register.registerStatus = 'Введите E-mail!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}

			// Проверка фамилии

			if ((this.register.data.surname.length == 0)||(this.register.data.surname.length > 20)){

				this.register.errorInput.surname = this.register.inputError;
				this.register.registerStatus = 'Введите фамилию!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}

			// Проверка именя

			if ((this.register.data.name.length == 0)||(this.register.data.name.length > 20)){

				this.register.errorInput.name = this.register.inputError;
				this.register.registerStatus = 'Введите имя!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}

			// Проверка отчества

			if ((this.register.data.patronymic.length == 0)||(this.register.data.patronymic.length > 20)){

				this.register.errorInput.patronymic = this.register.inputError;
				this.register.registerStatus = 'Введите отчество!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}

			// Проверка номера телефона

			let reg = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;

			if (reg.test(this.register.data.phone) == false){

				this.register.errorInput.phone = this.register.inputError;
				this.register.registerStatus = 'Номер телефона должен состоять из 11 цифр!';
				this.register.registerStatusColor = '#BF3030';
				error++;

			}else{

				let phone = this.register.data.phone.replace(/\D+/g, '');

				if (phone.length != 11){

					this.register.errorInput.phone = this.register.inputError;
					this.register.registerStatus = 'Номер телефона должен состоять из 11 цифр!';
					this.register.registerStatusColor = '#BF3030';
					error++;

				}

			}

			// Проверка на наличие ошибок

			if (error != 0){

				if (error > 1){

					this.register.registerStatus = 'Ошибки в выделенных полях!';
					this.register.registerStatusColor = '#BF3030';

				}

			}else{

				// Проверка совпадают ли введённые пароли

				if (this.register.data.password != this.register.data.passwordChange){

					this.register.errorInput.password = this.register.inputError;
					this.register.errorInput.passwordChange = this.register.inputError;
					this.register.registerStatus = 'Введённые пароли не совпадают!';
					this.register.registerStatusColor = '#BF3030';
					error++;

				}else{

					registerInputGood();
					this.register.registerStatus = 'Регистрация';
					this.register.registerStatusColor = 'green';

					axios({
						method: 'POST',
					  	headers: { 'Content-Type': 'application/json' },
					  	url: '../modules/user/registerUser/addBuyers.php',
					  	data: {
					    	register: header.register.data
					  	}
					})
					.then(function(response){

						header.register.registerStatus = response['data']['status'];

						switch(response['data']['status']) {
							case 'Номер телефона занят!':

								header.register.errorInput.phone = header.register.inputError;
								header.register.registerStatusColor = '#BF3030';

						    break;
						    case 'Логин занят!':

								header.register.errorInput.login = header.register.inputError;
								header.register.registerStatusColor = '#BF3030';

						    break;
						    case 'E-mail занят!':

								header.register.errorInput.email = header.register.inputError;
								header.register.registerStatusColor = '#BF3030';

						    break;
						default:

							header.rootName = '';
							header.nameRootShow = false;
							header.autorisationForm = false;
							header.userShow = true;
							header.userUrl = '#';
							header.userFunctionName = '';
							header.userFunctionUrl = '#';
							header.userName = header.register.data.surname + ' ' + header.register.data.name;
						    header.register.registerStatusColor = 'green';

						    setTimeout(function(){

						    	location.reload();

						    }, 1000);

						    break;
						}

					})
					.catch(function(error){
						console.log(error);
					});

				}

			}

		},

		// Открытие окна регистрации

		registerWindowOpen(){

			header.register.show = true;
			setTimeout(function(){
				header.register.windowOpacity = {'opacity': '1'};
			},100);

		},

		// Закрытие окна регистрации

		resisterWindowClose(){

			header.register.windowOpacity = {'opacity': '0'};
			registerInputGood();
			header.register.data.login = '';
			header.register.data.password = '';
			header.register.data.passwordChange = '';
			header.register.data.email = '';
			header.register.data.surname = '';
			header.register.data.name = '';
			header.register.data.patronymic = '';
			header.register.data.phone = '';
			header.register.registerStatus = '';
			header.register.registerStatusColor = 'black';
			setTimeout(function(){
				header.register.show = false;
			}, 500);

		}

	}

});