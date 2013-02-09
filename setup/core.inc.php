<?php
	error_reporting(E_ALL^ E_WARNING); 
	ob_start();
	session_start();
	$current_file = $_SERVER['SCRIPT_NAME'];
	
	if(isset($_SERVER['HTTP_REFERER'])) {
		$http_referer = $_SERVER['HTTP_REFERER'];
	}
	
	function loggedin() {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
			return true;
		}
		else {
			return false;
		}
	}
	
	function getuserfield($field) {
		$query = "SELECT `$field` FROM Login WHERE Id='".$_SESSION['user_id']."'";
		if($query_run = mysql_query($query)) {
			if($query_result = mysql_result($query_run, 0, $field)) {
				return $query_result;
			}
		}
	}
	
	function getuserfieldfromInfo($field) {
		$query = "SELECT `$field` FROM Info WHERE Username = '".$_SESSION['user_name']."'";
		if($query_run = mysql_query($query)) {
			$num_rows = mysql_num_rows($query_run);
		}	
		return $num_rows;
	}
	
	function getipaddress() {
		if(isset($_SERVER['HTTP_CLIENT_IP'])) {
			$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {	//check if user is using a proxy
			$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		if(isset($_SERVER['REMOTE_ADDR'])) {
			$remote_addr = $_SERVER['REMOTE_ADDR'];
		}
			
		if(!empty($http_client_ip)) {
			$ip_address = $http_client_ip;
		}
		else if(!empty($http_x_forwarded_for)) {
			$ip_address = $http_x_forwarded_for;
		}
		else {
			$ip_address = $remote_addr;
		}
		return $ip_address;
	}
?>