<?php

	$colorQuery = mysqli_query($link, 'SELECT `id`, `hex` FROM `color` ORDER BY `hex`;');
	$materialQuery = mysqli_query($link, 'SELECT * FROM `material`;');
	$sportQuery = mysqli_query($link, 'SELECT * FROM `views_sport`;');
	$ageQuery = mysqli_query($link, 'SELECT * FROM `age`;');
	$inventorySubCategoryQuery = mysqli_query($link,'SELECT * FROM `inventory_category`;');

?>
<div class="categoryMenuConteiner">
	<div data-show="color" :class="{ categoryMenuButtonClick: categoryMenu.color.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Цвет:</div>
	<div class="categoryMenu df jc" v-if="categoryMenu.color.show" :class="{ categoryMenuOpen: categoryMenu.color.opacity }">
		<div class="colorConteiner">
		<?php

			while ($color = mysqli_fetch_assoc($colorQuery)) {

		?>

			<div class="colorButton" @click="categorySelectColor" data-id="<?php echo $color['id'] ?>" style="background-color: #<?php echo $color['hex'] ?>"></div>

		<?php

			}

		?>
		</div>
	</div>
</div>	
<div class="categoryMenuConteiner">
	<div data-show="floor" :class="{ categoryMenuButtonClick: categoryMenu.floor.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Пол:</div>
	<div class="categoryMenu" v-if="categoryMenu.floor.show" :class="{ categoryMenuOpen: categoryMenu.floor.opacity }">
		<div class="categorySelectElem df aic" data-id="1" @click="categorySelectElem('floor')">Мужской</div>
		<div class="categorySelectElem df aic" data-id="2" @click="categorySelectElem('floor')">Женский</div>
		<div class="categorySelectElem df aic" data-id="3" @click="categorySelectElem('floor')">Универсальный</div>
	</div>
</div>		
<div class="categoryMenuConteiner">
	<div data-show="material" :class="{ categoryMenuButtonClick: categoryMenu.material.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Материал:</div>
	<div class="categoryMenu" v-if="categoryMenu.material.show" :class="{ categoryMenuOpen: categoryMenu.material.opacity }">
	<?php

		while ($material = mysqli_fetch_assoc($materialQuery)){
							
	?>

		<div class="categorySelectElem df aic" @click="categorySelectElem('material')" data-id="<?php echo $material['id']; ?>"><?php echo $material['name']; ?></div>

	<?php

		}

	?>
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="age" :class="{ categoryMenuButtonClick: categoryMenu.age.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Возрастная категория:</div>
	<div class="categoryMenu df js fw" v-if="categoryMenu.age.show" :class="{ categoryMenuOpen: categoryMenu.age.opacity }">
		<?php

			while ($age = mysqli_fetch_assoc($ageQuery)){

		?>
			
			<div class="categorySelectElem df aic" @click="categorySelectElem('age')" data-id="<?php echo $age['id']; ?>"><?php echo $age['value']; ?></div>

		<?php

			}

		?>
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="views_sport" :class="{ categoryMenuButtonClick: categoryMenu.views_sport.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Вид спорта:</div>
	<div class="categoryMenu" v-if="categoryMenu.views_sport.show" :class="{ categoryMenuOpen: categoryMenu.views_sport.opacity }">
		<?php

			while ($sport = mysqli_fetch_assoc($sportQuery)){

		?>
			
			<div class="categorySelectElem df aic" @click="categorySelectElem('views_sport')" data-id="<?php echo $sport['id']; ?>"><?php echo $sport['name']; ?></div>

		<?php

			}

		?>
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="size" :class="{ categoryMenuButtonClick: categoryMenu.size.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Размер:</div>
	<div class="categoryMenu df jc mt10" v-if="categoryMenu.size.show" :class="{ categoryMenuOpen: categoryMenu.size.opacity }">
		<input placeholder="Д:" type="number" class="ml10 mb10" v-model="categoryMenu.size.length">
		<input placeholder="Ш:" type="number" class="ml10 mb10" v-model="categoryMenu.size.width">
		<input placeholder="В:" type="number" class="ml10 mr10 mb10" v-model="categoryMenu.size.height">
	</div>
</div>