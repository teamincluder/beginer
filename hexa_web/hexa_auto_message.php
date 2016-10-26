<?php
	$message	=		"";
	require_once( 	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_bot_api.php');
	$bot_api	= 	new hexa_bot_api();
	$bot_api	->	send_message("general","bot_system",$message);
?>