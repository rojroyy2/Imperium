<?php

	require('../../sessionChange.php');

	if (sessionChange(3) == false){

		$result['status'] = 'exit';

	}else{

		$_POST = json_decode(file_get_contents('php://input'), true);

		require('../../db_connect.php');

		$salespeopleId = $_SESSION['id'];

		$shop = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `shop_id` as `id` FROM `salespeople` WHERE `id` = '.$salespeopleId.';'));

		$query= mysqli_fetch_assoc(mysqli_query($link, 'SELECT `goods`.`id` as `local`, `orders`.`id` as `order`, `goods`.`name` as `name`, `goods`.`bar_code` as `bar`, `sales`.`number` as `count`, `sales`.`date_of_sale` as `date`, `orders`.`status`, `orders`.`payment` as `payStatus`, `orders`.`price` as `price`, CONCAT(`buyers`.`surname`, " ", `buyers`.`name`, " ", `buyers`.`patronymic`) as `buyersName` FROM `orders` LEFT JOIN `sales` ON `sales`.`id` = `orders`.`sales` LEFT JOIN `accounting` ON `accounting`.`id` = `sales`.`accouting_id` LEFT JOIN `goods` ON `goods`.`id` = `accounting`.`goods_id` LEFT JOIN `buyers` ON `buyers`.`id` = `sales`.`buyer_id` WHERE ((`orders`.`id` = '.$_POST['search'].')&&(`orders`.`shop_id` = '.$shop['id'].'));'));

	if (!isset($query['local'])){

		$result['status'] = 'none';
		echo json_encode($result);	
		exit();
	
	}

		$result['info']['orderStatus']['status'] = $query['status'];
		$result['info']['payStatus']['status'] = $query['payStatus'];

		if ($result['info']['orderStatus']['status'] == 1){

			$result['info']['orderStatus']['name'] = 'Доставлен!';

		}else{

			$result['info']['orderStatus']['name'] = 'В пути!';

		}

		if ($result['info']['payStatus']['status'] == 1){

			$result['info']['payStatus']['name'] = 'Оплачено!';

		}else{

			$result['info']['payStatus']['name'] = 'Ждёт оплаты!';

		}

		$result['info']['local'] = $query['local'];
		$result['info']['name'] = $query['name'];
		$result['info']['bar'] = $query['bar'];
		$result['info']['count'] = $query['count'];
		$result['info']['order'] = $query['order'];
		$result['info']['date'] = $query['date'];
		$result['info']['price'] = $query['price'];
		$result['info']['buyer'] = $query['buyersName'];
		$result['info']['date'] = $query['date'];

		$result['status'] = 'result';
		
	}

	echo json_encode($result);

?>