<?php
	header('location: hexa_chat.php?channel='.$_POST['channel_name']);
	if(!isset($_POST['chat_id']))
	{	
		exit();
	}
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 		= 	new chat_module();
	$chat	->	delete_message($_POST['chat_id']);
?>