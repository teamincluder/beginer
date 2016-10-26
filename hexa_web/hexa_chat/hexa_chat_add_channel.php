<?php
	session_start();
	header('location: hexa_chat.php');
	if(!isset($_POST['channel_name']))
	{	
		exit();
	}
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project 	= 	new project_module();
	$project_id	=		$project	->	get_project_id($_SESSION['project']);
	
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 		= 	new chat_module();
	$chat			->	set_new_channel($_POST['channel_name'],$_POST['purpose'],$project_id);
?>