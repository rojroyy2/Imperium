<div id="headerFile">
	<?php
	
		require('db_connect.php');

	?>
	<div id="header">
		<div class="conteiner"></div>
		<div class="df mb10">
			<a class="conteiner" href="http://imperium/index.php" id="logo"></a>
		</div>
		<div id="userWindow">
			<div v-if="autorisationForm" id="autorisationForm">
				
				<!-- Форма авторизации -->

				<div class="conteiner df jc ais">Авторизация:</div>
				<div class="conteiner df jc ais">
					<input :class="{ inputError: autorisationDataError }" v-model="login" type="text" placeholder="Телефон или логин:" @keyup.enter="passwordFocus">
				</div>
				<div class="conteiner df jc ais">
					<input :class="{ inputError: autorisationDataError }" v-model="password" id="password" type="password" placeholder="Пароль:" @keyup.enter="input">
				</div>
				<div class="conteiner df jc ais">
					<div @click="registerWindowOpen" class="butR ma">Регистрация</div>
					<div class="butR ma" @click="input">Вход</div>
					<div class="butR ma">?</div>
				</div>
				<div id="autorisationStatus">{{ autorisationStatus }}</div>
			</div>
			<div v-if="userShow" id="userShow" class="df aic jc">
				
				<!-- Главный администратор  -->

				<div class="conteiner df jc ma" v-if="nameRootShow">
					{{ rootName }}
				</div>
				<div class="conteiner df jc ma">
					<a :href="userUrl">{{ userName }}</a>
				</div>
				<div class="conteiner df jc ma">
					<a :href="userFunctionUrl">{{ userFunctionName }}</a>
				</div>
				<div class="conteiner w100 df je">
					<div class="butR mr10 mb10" @click="exit">Выход</div>
				</div>
			</div>
		</div>
		<div class="conteiner"></div>
	</div>
	<div id="menu">
		<ul class="df je">
			<li @click="viewsSportOpen">Виды спорта</li>
			<li>Распродажа</li>
			<li>
				<a href="category.php?id=3">Обувь</a>
			</li>
			<li>
				<a href="category.php?id=4">Одежда</a>
			</li>
			<li>
				<a href="category.php?id=5">Инвентарь</a>
			</li>
			<li>
				<a href="category.php?id=6">СпортПит</a>
			</li>
		</ul>
		<div id="search">
			<input type="text" placeholder="Поиск:">
			<div id="searchBut" class="ml10"></div>
		</div>
	</div>
	<div id="sportViews" class="df jc" v-show="sportViewsShow" :style="{ marginTop: '-' + sportTop + 'px'}">
		<div>
			<?php

				$sportQuery = mysqli_query($link, 'SELECT * FROM `views_sport`;');

				while($sport = mysqli_fetch_assoc($sportQuery)){

			?>
					
					<a href="../category?sport=<?php echo $sport['id']; ?>"><?php echo $sport['name']; ?></a>

			<?php

				}

			?>
		</div>
	</div>
	<div id="registerConteiner" class="df aic jc" v-if="register.show" :style="register.windowOpacity">
		<div id="registerform" class="df jc fw">
			<div id="registerClose" @click="resisterWindowClose"></div>
			<h1 class="df jc aic df">
				Регистрация:
			</h1>
			<div class="df jc fw registerDataFormConteiner">
				<h1>Данные аккаунта:</h1>
				<input v-bind:style="register.errorInput.login" type="text" class="registerDataInput" placeholder="Введите логин:" v-model="register.data.login">
 				<input v-bind:style="register.errorInput.password" type="password" class="registerDataInput" placeholder="Введите пароль:" v-model="register.data.password">
				<input v-bind:style="register.errorInput.passwordChange" type="password" class="registerDataInput" placeholder="Повторите пароль:" v-model="register.data.passwordChange">
				<input v-bind:style="register.errorInput.email" type="text" class="registerDataInput" placeholder="Введите E-mail: (до 50 символов)" v-model="register.data.email">
			</div>
			<div class="df jc fw registerDataFormConteiner">
				<h1>Данные пользователя:</h1>
				<input v-bind:style="register.errorInput.surname" type="text" class="registerDataInput" placeholder="Введите фамилию: (до 20 символов)" v-model="register.data.surname">
				<input v-bind:style="register.errorInput.name" type="text" class="registerDataInput" placeholder="Введите имя: (до 20 символов)" v-model="register.data.name">
				<input v-bind:style="register.errorInput.patronymic" type="text" class="registerDataInput" placeholder="Введите отчество: (до 20 символов)" v-model="register.data.patronymic">
				<input v-bind:style="register.errorInput.phone" type="text" class="registerDataInput" placeholder="Введите номер телефона: 8(999)999-99-99" v-model="register.data.phone">
			</div>
			<div id="registerStatus" :style="{ color: register.registerStatusColor }">
				{{ register.registerStatus }}
			</div>
			<div id="registerButton" class="df jc aic" @click="registerNewUser">
				Зарегестрироваться
			</div>
		</div>
	</div>
</div>