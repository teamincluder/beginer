<?php

	
	session_start();

	if($_POST['user_id'] == NULL || $_POST['pass'] == NULL){
		$_SESSION["reqest"] = 0;
		$url = "location: login.php";
	}
	$member_id	= $_POST['user_id'];
	$pass		= $_POST['pass'];
	require_once "./sql/mysql.php";
	$row = $private -> fetch(PDO::FETCH_ASSOC);
	$member_id_saccess		= $row['member_id'];
	$member_pass_saccess	= $row['member_pass'];
	if($member_id_saccess == $member_id && $member_pass_saccess == $pass && $member_id != NULL && $pass != NULL){
		$_SESSION['user_id'] = $member_id;
		$url = "menu.php";
	}else if($member_id_saccess	== NULL ){
		$_SESSION["reqest"] = 1;
		$url = "login.php";
	}else if($member_pass_saccess != $pass ){
		$_SESSION["reqest"] = 2;
		$url = "login.php";
	}

	header('location: '. $url);
	exit;
?>
