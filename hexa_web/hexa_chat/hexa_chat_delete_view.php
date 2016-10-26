<?php
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 		= 	new chat_module();
	$html_str	=		$chat	->	set_channel_select();
?>
<!DOCTYPE html>
<html>
	<head></head>
	<body>
		<form class="sendBox" action="hexa_chat_add_channel.php" method="post">
			<input type="text" name="channel_name" placeholder="channel name">
			<input type="text" name="purpose" placeholder="purpose">
			<input type="submit" value="追加">
		</form>
		<form class="sendBox" action="hexa_chat_delete_channel.php" method="post">
			<?php echo $html_str; ?>
			<input type="submit" value="追加">
		</form>
		<input type="button" onclick="location.href='./hexa_chat.php'" value="チャットに戻る">
	</body>
</html>