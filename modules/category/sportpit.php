<?php

	$sportpitSubcategoryQuery = mysqli_query($link, 'SELECT * FROM `sportpit_category`;');
	$tasteQuery = mysqli_query($link, 'SELECT * FROM `taste`;');

?>
<div class="categoryMenuConteiner">
	<div data-show="taste" :class="{ categoryMenuButtonClick: categoryMenu.taste.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Вкус:</div>
	<div class="categoryMenu" v-if="categoryMenu.taste.show" :class="{ categoryMenuOpen: categoryMenu.taste.opacity }">
		<?php

			while ($taste = mysqli_fetch_assoc($tasteQuery)){

		?>
			
			<div @click="categorySelectElem('taste')" class="categorySelectElem df aic" data-id="<?php echo $taste['id']; ?>"><?php echo $taste['name']; ?></div>

		<?php

			}

		?>
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="valume" :class="{ categoryMenuButtonClick: categoryMenu.valume.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Объём:</div>
	<div class="categoryMenu df jc" v-if="categoryMenu.valume.show" :class="{ categoryMenuOpen: categoryMenu.valume.opacity }">
		<input type="number" placeholder="(грамм:)" class="ml10 mr10 mb10 mt10" v-model="categoryMenu.valume.value">
	</div>
</div>
<div class="categoryMenuConteiner">
	<div data-show="countPortion" :class="{ categoryMenuButtonClick: categoryMenu.countPortion.show }" class="categoryMenuButton" v-on:click="categoryMenuOpen">Количество порций:</div>
	<div class="categoryMenu df jc" v-if="categoryMenu.countPortion.show" :class="{ categoryMenuOpen: categoryMenu.countPortion.opacity }">
		<input type="number" class="ml10 mr10 mb10 mt10" v-model="categoryMenu.countPortion.value">
	</div>
</div>