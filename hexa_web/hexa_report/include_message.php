<?php
	session_start();
	if($_SESSION['send_flag'] == 1){
		$_SESSION['send_flag'] = NULL;
		header('location: menu.php');
	}
	if(!isset($_SESSION['user_id'])){
		$_SESSION["reqest"] = 0;
		header('location: login.php');
	}
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 						= new chat_module();
	$channel_list 		= $chat	->	set_channel_select();
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="hexa_send_report.php" method="post">
			<p><input type="text" name="user_name" value="<?php echo $_SESSION['user_id']; ?>"></p>
			<?php echo $channel_list	;?>
			<p><textarea name="task" cols="100" rows="10" placeholder = "本日やったこと"></textarea></p>
			<p><textarea name="nowTask" cols="100" rows="10" placeholder = "これからやること"></textarea></p>
			<p><input type="submit" name="send" value="SEND"></p>
		</form>
			<a href="./menu.php"><input type="button" value="CANCEL"></a>
	</body>
</html>
