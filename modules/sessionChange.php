<?php

	function sessionChange($root){

		session_start();

		if ((isset($_SESSION[id]) == false)||(isset($_SESSION[root]) == false)||(isset($_SESSION[userName]) == false)||($_SESSION[root] != $root)){

			$_SESSION[id] = 0;
			$_SESSION[root] = 0;
			$_SESSION[userName] = 0;

			session_destroy();

			return false;

		}else{

			return true;

		}

	}

?>