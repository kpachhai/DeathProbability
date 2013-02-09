<?php
	require '../setup/connect.inc.php';
	require '../setup/core.inc.php';

	if(!loggedin()) header('Location: ../index.php');	
	
	$username = getuserfield('Username');		 
	$firstname = getuserfield('FirstName');
	$lastname = getuserfield('LastName');
	
	if($firstname == "deleteme" && $lastname == "deleteme") {
		$query = "DELETE FROM Login WHERE Username='$username' AND FirstName='$firstname'";
		$query2 = "DELETE FROM Info WHERE Username='$username'";
		if($query_run = mysql_query($query)) {
			if($query_run2 = mysql_query($query2)) {
				session_destroy();
				header('Location: index.php');
			}
			else {
				session_destroy();
				header('Location: ../index.php');			
			}
		}
		else {
			echo 'We couldn\'t delete your account at this time. Please try again later.';
		}	
	}
	else {
		session_destroy();
		header('Location: ../index.php');
	}
?>