window.onload = function(){

	headerSize();
	categoryVue.categoryTovarShow(paginatorCount);

}

window.onresize = function(){

	headerSize();

}

var paginatorCount = 10;

var categoryVue = new Vue({
	el: '#categoryConteiner',
	data: {
		paginator: paginatorCount,
		max: 0,
		root: null,
		buyer: null,
		categoryGet: null,
		alertShow: false,
		alertContent: '',
		categoryMenu: {
			price: {
				show: false,
				opacity: false,
				min: null,
				max: null
			},
			manufacturer: {
				show: false,
				opacity: false,
				elem: []
			},
			floor: {
				show: false,
				opacity: false,
				elem: []
			},
			material: {
				show: false,
				opacity: false,
				elem: []
			},
			size: {
				show: false,
				opacity: false,
				elem: [],
				length: null,
				width: null,
				height: null
			},
			views_sport: {
				show: false,
				opacity: false,
				elem: []
			},
			time_year: {
				show: false,
				opacity: false,
				elem: []
			},
			taste: {
				show: false,
				opacity: false,
				elem: []
			},
			valume: {
				show: false,
				opacity: false,
				value: null
			},
			countPortion: {
				show: false,
				opacity: false,
				value: null
			},
			subCategory: {
				show: false,
				opacity: false,
				elem: []
			},
			color: {
				show: false,
				opacity: false,
				elem: []
			},
			age: {
				show: false,
				opacity: false,
				elem: []
			}
		},
		categoryResult: {
			view: false,
			responseStr: '',
			tovarArray: []
		}
	},
	methods: {

		// Меню в поиске по категориям
		categoryMenuOpen(event){

			let obj = event.target.getAttribute("data-show");

			this.categoryMenu[obj].show = !this.categoryMenu[obj].show;

			setTimeout(function(){
				categoryVue.categoryMenu[obj].opacity = !categoryVue.categoryMenu[obj].opacity;
			},10);

		},

		// Выбор в меню категории
		categorySelectElem(obj){

			let elem = event.target;
			let id = elem.getAttribute("data-id");
			let arrChange = this.categoryMenu[obj].elem.indexOf(id);

			if (arrChange == -1){

				this.categoryMenu[obj].elem.push(id);
				elem.style.color = '#BF3030';
				elem.style.backgroundColor = "#FFFFFF";

			}else{

				this.categoryMenu[obj].elem.splice(arrChange,1);
				elem.style.color = '#FFFFFF';
				elem.style.backgroundColor = "#BF3030";

			}

		},

		// Выбор цвета
		categorySelectColor(event){

			let elem = event.target;
			let id = elem.getAttribute("data-id");
			let arrChange = this.categoryMenu.color.elem.indexOf(id);

			if (arrChange == -1){

				this.categoryMenu.color.elem.push(id);
				elem.style.border = '1px solid #FFFFFF';
				elem.style.width = "18px";
				elem.style.height = "18px";

			}else{

				this.categoryMenu.color.elem.splice(arrChange,1);
				elem.style.border = '0px';
				elem.style.width = "20px";
				elem.style.height = "20px";

			}

		},

		// Отчистить фильтры
		async categorySearchButtonClear(){

			await categoryVue.categoryMenuElemClear();
			
			await categoryVue.categoryTovarShowAll(paginatorCount);
			this.paginator = paginatorCount;
			this.max = 0;

		},

		categoryMenuElemClear(){
			
			this.max = 0;
			for (elem in this.categoryMenu){

				this.categoryMenu[elem].show = false;
				this.categoryMenu[elem].opacity = false;

				switch (elem){
					case 'price':
						this.categoryMenu[elem].min = null;
						this.categoryMenu[elem].max = null;
						break;
					case 'size':
						this.categoryMenu[elem].elem = [];
						this.categoryMenu[elem].length = null;
						this.categoryMenu[elem].width = null;
						this.categoryMenu[elem].height = null;
						break;
					case 'valume':
						this.categoryMenu[elem].value = null;
						break;
					case 'countPortion':
						this.categoryMenu[elem].value = null;
						break;
					default:
						this.categoryMenu[elem].elem = [];
						break;
				}
				
			}

		},

		// Поиск по фильрам

		categoryTovarShowAll(lim){

			categoryVue.categoryResult.tovarArray = [];
			this.paginator = paginatorCount;
			this.max = 0;
			categoryVue.categoryTovarShow(lim);

		},

		categoryTovarShow(lim){
			
			this.categoryResult.responseStr = "Загрузка, пожалуйста подождите...";

				axios({
					method: 'POST',
					headers: { 'Content-Type': 'application/json' },
					url: '../modules/category/categoryFilter.php',
					data: {
						category: categoryVue.categoryGet,
						params: categoryVue.categoryMenu,
						limit: lim
					}
				})
				.then(function(response){

					if (response['data'].length == 0){

						categoryVue.categoryResult.responseStr = "К сожалению, ничего не найдено!";

					}else{

						response['data']['list'].forEach(function(obj){

							let tovar = {
								id: obj.id,
								name: obj.name,
								price: obj.price,
								rating: obj.assessment,
								info: obj.description,
								url: 'tovar.php?id=' + obj.id,
								jp: 'image/goods/'+ obj.jpeg +'/main.jpg?' + Date(),
								discount: obj.discount,
								discountUntil: obj.discountUntil,
							}

							categoryVue.categoryResult.tovarArray.push(tovar);
							categoryVue.max = response['data']['maxCountTovar'];

						});

					}

				})
				.catch(function(error){
					categoryVue.categoryResult.responseStr = "Извините, произошла ошибка при загрузке данных!";
					console.log(error);
				});

		},

			// Показать ещё

		paginatorClick(){

			this.paginator = this.paginator + paginatorCount;
			this.categoryTovarShow(this.paginator);

		},

			// Добавление в корзину

		basketAdd(){

			if ((this.buyer == null)||(this.root != 4)){

				alert('Сначала необходимо авторизоваться!');
				return false;

			}

			let goodsId = event.target.parentNode.getAttribute('data-tovarid');
			console.log("goodsId", goodsId);

			axios({
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				url: '../modules/buyer/addBasket.php',
				data: {
					goods: goodsId
				}
			})
			.then(function(response){

				if (response['data']['status'] == 'autorisationError'){

					alert('Сначала необходимо авторизоваться!');
					return false;

				}

				if (response['data']['status'] == 'good'){

					categoryVue.alertShow = true;
					categoryVue.alertContent = 'Содержимое добалено в корзину, просмотр доступен в личном кабинете!';
					setTimeout(function(){
						categoryVue.alertShow = false;
						categoryVue.alertContent = '';
					},6000);

				}else{

					categoryVue.alertShow = true;
					categoryVue.alertContent = 'Извините, произошла ошибка!';
					setTimeout(function(){
						categoryVue.alertShow = false;
						categoryVue.alertContent = '';
					},3000);

				}
				
			})
			.catch(function(error){
				alert('Извините, произошла серверная ошибка!');
				console.log(error);
			});

		}

	}
});