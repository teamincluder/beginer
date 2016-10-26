<?php
	header('location: hexa_chat.php');
	if(!isset($_POST['channel_name']))
	{	
		exit();
	}
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 		= 	new chat_module();
	$check		=		$chat	->	get_channel_id($_POST['channel_name']);
	if(empty($check))	exit();
	$chat			->	delete_channel($_POST['channel_name']);
?>