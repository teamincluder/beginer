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
	if(!isset($_SESSION['project'])){
		header('location: ./hexa_project/hexa_menu.php');
		exit();
	}
	session_start();
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project 	= 	new project_module();
	$project_id	=		$project	->	get_project_id($_SESSION['project']);
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 		= 	new chat_module();
	$html_str	=		$chat	->	set_channel_select($project_id);
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1><?php echo $_SESSION['project']?></h1>
		<form action="hexa_send_report.php" method="post">
			<p><input type="text" name="user_name" value="<?php echo $_SESSION['user_id']; ?>"></p>
			<?php echo $html_str	;?>
			<p><textarea name="task" cols="100" rows="10" placeholder = "本日やったこと"></textarea></p>
			<p><textarea name="nowTask" cols="100" rows="10" placeholder = "これからやること"></textarea></p>
			<p><input type="submit" name="send" value="送信"></p>
		</form>
			<a href="./hexa_chat/hexa_chat.php"><input type="button" value="戻る"></a>
	</body>
</html>
