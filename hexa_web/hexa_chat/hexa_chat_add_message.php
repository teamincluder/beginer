<?php
	session_start();
	
	if(!isset($_SESSION['user_id']))
	{	
		header('location: ../login.php');
		exit();
	}	
	$url	=	"hexa_chat.php?channel="	.	$_POST['channel_name'];
	header('location: '.$url);
	if(empty($_POST['message']))
	{
		exit();
	}
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project 	= 	new project_module();
	$project_id	=		$project	->	get_project_id($_SESSION['project']);
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 		= new chat_module();
	$chat->set_new_message($_POST['channel_name'],$_SESSION['user_id'],$_POST['message'],$project_id);

?>