<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		$_SESSION["reqest"] = 0;
		header('location: login.php');
	}
    $member_id	= $_SESSION['user_id'];
    require "./sql/mysql.php";
    $row = $private -> fetch(PDO::FETCH_ASSOC);
    $pass	    = $row['member_pass'];
    if(isset($_POST['change'])){
        if($pass == $_POST['pass']){
            if($_POST['new_pass'] == $_POST['re_pass'] ){
				$pdo->query("UPDATE hexa_member_master SET member_pass = '" . $_POST['new_pass'] . "' WHERE  member_id='" . $member_id . "';");
                header('location: login.php');
            }else{
                echo "パスワードちゃんと入力して";
            }
        }else{
            echo "現在のパスワードが違うよー";
        }
    }

?>
<!DOCTYPE html>
<html>
<!-- loginするページ -->
	<head>

	</head>
	<body>
		<form action="change.php" method="post">
			<p>現在のパスワード</p>
			<input type="password" name="pass" placeholder="password">
			<p>新しいPASS</p>
			<input type="password" name="new_pass" placeholder="password">
			<p>もう一度入力して</p>
			<input type="password" name="re_pass" placeholder="password">
			<input type="submit" name="change" value="change">
		</form>
			<a href="./menu.php"><input type="button" name="cancel" value="cancel">
	</body>
</html>