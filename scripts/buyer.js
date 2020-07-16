var buyerVue = new Vue({
	el: '#buyer',
	data: {
		basket: {
			show: false,
			list: []
		},
		order: {
			show: false,
			name: '',
			shop: ''
		},
		history: {
			show: false
		}
	},
	methods: {
		basketControl(){
			this.basket.show = !this.basket.show;
		},
		orderControl(){
			this.order.show = !this.order.show;
		},
		historyControl(){
			this.history.show = !this.history.show;
		}
	}
});