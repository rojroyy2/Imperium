window.onload = function(){

	headerSize();
	var width = screen.width;
	imageTovarCount(width);

}

window.onresize = function(){

	headerSize();
	var width = screen.width;
	imageTovarCount(width);

}

function imageTovarCount(width){

	if ((width >= 640) && (width <= 720)){

		tovar.imageListMainCount = 2;

	}else{

		if (width <= 640){

			tovar.imageListMainCount = 1;

		}else{

			tovar.imageListMainCount = 3;

		}

	}

	let array = tovar.imageListMain.concat(tovar.imageAll);

	mainImages(array);
	allImages(array);

}

async function mainImages(array){

	tovar.imageListMain = [];
	for (let i = 0; i < tovar.imageListMainCount; i++){

		tovar.imageListMain.push(array[i]);

	}

}

async function allImages(array){

	tovar.imageAll = [];
	for (let i = tovar.imageListMainCount; i < array.length; i++){

		tovar.imageAll.push(array[i]);

	}

}

var tovar = new Vue({
	el: '#tovarConteiner',
	data: {
		tovarId: 0,
		imageListMain: [],
		imageListMainCount: 3,
		imageAll: []
	},
	methods: {
		images(){

			axios({
				method: 'POST',
				headers: { "X-Requested-With": "XMLHttpRequest" },
				url: '../modules/tovar/tovarImages.php',
				data: {
					tovarId: tovar.tovarId
				}
			})
			.then(function(response){
console.log(response['data']);
				mainImages(response['data']['imageList']);
				allImages(response['data']['imageList']);

		})
			.catch(function(error){
				console.log(error);
				alert('Извините произошла ошибка!');
				// location.href = 'http://imperium/index.php';
			});

		}
	}
});