<?php
	session_start();




?>
<!DOCTYPE html>
<html>
	<head>
		<style>
		</style>
	</head>
	<body>
		<form action="signup_reg.php" method="post">
			<p>ユーザネームを入力してください</p>
			<input type="text" name="user_id" placefolder="ユーザネーム">
			<p>パスワードを入力してください</p>
			<input type="password" name="pass" placefolder="パスワード">
			<p>同じパスワードをもう一度入力してください</p>
			<input type="password" name="passConf" placefolder="パスワード">
			<input type="submit" name="send" value="完了">
		</form>
	</body>
</html>
