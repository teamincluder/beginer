<?php
	session_start();
	header( "Location: include_message.php" ) ;
	if($_SESSION['user_id']==null||$_POST['task']==null||$_POST['nowTask']==null)
	{
		exit();
	}
	require_once( 	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_bot_api.php');
	$bot_api	= 	new hexa_bot_api();
	$message 	= 	$bot_api	->	make_report_message($_POST['task'],$_POST['nowTask']);
	$bot_api	->	send_message($_POST['channel_name'],$_SESSION['user_id'],$message);
	
?>