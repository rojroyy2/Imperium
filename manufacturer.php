<?php 

	require('modules/db_connect.php');

	$manufacturer = mysqli_fetch_assoc(mysqli_query($link, 'SELECT * FROM `manufacturer` WHERE `id` = '.(int) $_GET['id'].';'));

	if (!isset($manufacturer['id'])){

		header("Location: http://imperium/index.php");

	}

	session_start();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles/class.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<link rel="stylesheet" type="text/css" href="styles/manufacturer.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Imperium</title>
</head>
<body>
	
	<?php

		require('modules/header.php');

	?>
	
	<div class="w100 df jc">
		<div id="manufacturerConteiner" class="df jc aic fw">
			<h1><?php echo $manufacturer['name']; ?></h1>
			<img src="image/manufacturer/<?php echo $manufacturer['name']; ?>/logo.png">
			<p><?php echo $manufacturer['information']; ?></p>
		</div>
	</div>

	<?php 

		require('modules/footer.php');

	?>
</body>
	<!-- VueJs -->
<script src="scripts/vue.js"></script>
	<!-- Axios -->
<script src="scripts/axios.min.js"></script>
	<!-- Авторизация -->
<script type="text/javascript" src="scripts/header.js"></script>
<script type="text/javascript" src="scripts/salespeople.js"></script>
<?php

	echo '<script type="text/javascript" id="autorisationWindowScript">';
		if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)){

			$_SESSION[id] = 0;
			$_SESSION[root] = 0;
			$_SESSION[userName] = 0;

			session_destroy();

		}
		echo 'autorisationWindow('.$_SESSION[id].', '.$_SESSION[root].', "'.$_SESSION[userName].'");';
	echo '</script>';

?>
</script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</html>