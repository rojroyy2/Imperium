window.onload = function(){

		headerSize();
		sliderVue.count = document.getElementsByClassName('slide').length;
		sliderSize();	

	}

	window.onresize = function(){

		headerSize();
		sliderSize();

}

var sliderSize = function(){

	let width = document.getElementById('slider').offsetWidth;
	sliderVue.slideWidth = width;
	sliderVue.styleWidthStyle = {'width': width + 'px'};

}

var sliderTimer = setInterval(function(){

	sliderVue.whiteShow = true;

	setTimeout(function(){
		sliderVue.opacityWriteAnimation = {'opacity': 1.0};
	},5);

	setTimeout(function(){

		let slide = document.getElementById('sliderConteinerReletive').lastChild;
		document.getElementById('sliderConteinerReletive').insertBefore(slide, document.getElementById('sliderConteinerReletive').firstChild);
		
		sliderVue.opacityWriteAnimation = {'opacity': 0.0};

		setTimeout(function(){
			sliderVue.whiteShow = false;
		},100);

	}, 200);

}, 3000);

var sliderVue = new Vue({
	el: '#sliderConteiner',
	data: {
		slideWidth: 0,
		styleWidthStyle: {},
		opacityWriteAnimation: {'opacity': 0.0},
		whiteShow: false
	},
	methods: {
		sliderLeft: function(){

			sliderVue.whiteShow = true;

			setTimeout(function(){
				sliderVue.opacityWriteAnimation = {'opacity': 1.0};
			},5);
			

			setTimeout(function(){

				let slide = document.getElementById('sliderConteinerReletive').firstChild;
				document.getElementById('sliderConteinerReletive').appendChild(slide);

				sliderVue.opacityWriteAnimation = {'opacity': 0.0};
				setTimeout(function(){
					sliderVue.whiteShow = false;
				},100);

			}, 200);

			clearInterval(sliderTimer);

		},
		sliderRight: function(){

			sliderVue.whiteShow = true;

			setTimeout(function(){
				sliderVue.opacityWriteAnimation = {'opacity': 1.0};
			},5);
			
			setTimeout(function(){

				let slide = document.getElementById('sliderConteinerReletive').lastChild;
				document.getElementById('sliderConteinerReletive').insertBefore(slide, document.getElementById('sliderConteinerReletive').firstChild);

				sliderVue.opacityWriteAnimation = {'opacity': 0.0};
				setTimeout(function(){
					sliderVue.whiteShow = false;
				},100);
				
			}, 200);

			clearInterval(sliderTimer);

		}
	}
});