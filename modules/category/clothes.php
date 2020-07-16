<?php
	
	$sizeQuery = mysqli_query($link, 'SELECT * FROM `size` WHERE (`id` > 34);');
	$subCategoryQuery = mysqli_query($link, 'SELECT * FROM `clothes_category`;');
	$materialQuery = mysqli_query($link, 'SELECT * FROM `material`;');
	$colorQuery = mysqli_query($link, 'SELECT `id`, `hex` FROM `color` ORDER BY `hex`;');
	$sportQuery = mysqli_query($link, 'SELECT * FROM `views_sport`;');
	$seasonQuery = mysqli_query($link, 'SELECT * FROM `time_year`;');
	$ageQuery = mysqli_query($link, 'SELECT * FROM `age`;');

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

		<div class="categorySelectElem df aic" data-id="<?php echo $material['id']; ?>" @click="categorySelectElem('material')"><?php echo $material['name']; ?></div>

	<?php

		}

	?>
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="size" :class="{ categoryMenuButtonClick: categoryMenu.size.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Размер:</div>
	<div class="categoryMenu df fw" v-if="categoryMenu.size.show" :class="{ categoryMenuOpen: categoryMenu.size.opacity }">
	<?php

		while ($size = mysqli_fetch_assoc($sizeQuery)){

	?>
	
		<div class="categorySelectElem df js aic" data-id="<?php echo $size['id'] ?>" @click="categorySelectElem('size')"><?php echo $size['value'] ?></div>
	
	<?php

		}

	?>
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="subCategory" :class="{ categoryMenuButtonClick: categoryMenu.subCategory.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Вид одежды:</div>
	<div class="categoryMenu" v-if="categoryMenu.subCategory.show" :class="{ categoryMenuOpen: categoryMenu.subCategory.opacity }">
		<?php

			while ($subCategory = mysqli_fetch_assoc($subCategoryQuery)){

		?>
			
			<div @click="categorySelectElem('subCategory')" class="categorySelectElem df aic" data-id="<?php echo $subCategory['id']; ?>"><?php echo $subCategory['name']; ?></div>

		<?php

			}

		?>
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="time_year" :class="{ categoryMenuButtonClick: categoryMenu.time_year.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Сезон:</div>
	<div class="categoryMenu df js fw" v-if="categoryMenu.time_year.show" :class="{ categoryMenuOpen: categoryMenu.time_year.opacity }">
		<?php

			while ($season = mysqli_fetch_assoc($seasonQuery)){

		?>
			
			<div @click="categorySelectElem('time_year')" class="categorySelectElem df aic" data-id="<?php echo $season['id']; ?>"><?php echo $season['name']; ?></div>

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
			
			<div @click="categorySelectElem('age')" class="categorySelectElem df aic" data-id="<?php echo $age['id']; ?>"><?php echo $age['value']; ?></div>

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
			
			<div @click="categorySelectElem('views_sport')" class="categorySelectElem df aic" data-id="<?php echo $sport['id']; ?>"><?php echo $sport['name']; ?></div>

		<?php

			}

		?>
	</div>
</div>