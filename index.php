<?php
	require './setup/core.inc.php';
	require './setup/connect.inc.php';
	
	if(loggedin()) {
		header('Location: ./main_test/deathprobability.php');
	}
	else {
		include './login_stuff/login.php';
	}
?>

