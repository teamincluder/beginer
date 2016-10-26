<?php
	header('location: ../hexa_chat/hexa_chat.php');
	if(empty($_POST['tools_name'])||empty($_POST['url']))
	{
		exit();
	}
	session_start();
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project 	= 	new project_module();
	$html_members	=		$project	->	insert_other_tools($_POST['tools_name'],$_POST['url'],$_SESSION['project']);
?>
