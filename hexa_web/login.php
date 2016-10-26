<?php
	session_start();
	if(!strpos($_SERVER['DOCUMENT_ROOT'],'hexa_web') ){
		$message	=	"システムが正常に動かない恐れがあります！<br>".
								"http://team.doberan.net/login.php からログインしてください！<br>";
		echo	$message;
	}
	if(!isset($_POST['send'])){
		switch($_SESSION['reqest']){
			case 0:
				echo "値が入力されていません";
				break;
			case 1:
				echo "ユーザ名かパスワードが違います";
				break;
			case 2:
				echo "パスワードが違います";
				break;
			default :
				echo "入力してください。";
		}
	}	
?>
<!DOCTYPE html>
<html>
<!-- loginするページ -->	
	<head>
		<style>
			.login_form{
				position:relative;
			}
			.signup_btn{
				position:absolute;
				left:0;
				bottom:-30px;
			}
			.btn{
				position:absolute;
				bottom:-30px;
				left:80px;	
			}
			
		</style>
	</head>
	<body>
		<form class="login_form" action="index.php" method="post">
			<p>ID</p>
			<input type="text"name="user_id" placeholder="user_id">
			<p>PASS</p>
			<input type="password" name="pass" placeholder="password">
			<a class="signup_btn" href="signup.php"><input type="button" name="signup" value="新規登録"></a>
			<input class="btn" type="submit" name="send" value="login">
		</form>
	</body>
</html>
