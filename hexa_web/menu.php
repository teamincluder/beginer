<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		$_SESSION["reqest"] = 0;
		header('location: login.php');
	}
	$member_id = $_SESSION['user_id'];
	require_once "./sql/mysql.php";
	$row = $private -> fetch(PDO::FETCH_ASSOC);
	$num = $row['membar_category'];
	
?>
<!DOCTYPE html>
<html>
<!-- loginするページ -->
	<head>

	</head>
	<body>
		 	<?php if($num == 1 || $num == 3 || $num == 5){ ?>	
				<a href="./message.php"><h2>Hexaの日報を書く</h2></a>
			<?php } ?>
		 	<?php if($num == 2 || $num == 3 || $num == 5){ ?>	
				<a href="./hexa_project/hexa_menu.php"><h2>hexa_chat</h2></a>
			<?php } ?>
		 	<?php if($num == 5){ ?>
				<a href="./admin.php"><h2>管理</h2></a>
			<?php } ?>
			<a href="./logout.php"><input type="button" name="logout" value="logout"></a>
			<a href="./change.php"><input type="button" name="pass_change" value="passChange"></a>
			<a href="./git.php"><input type="button" name="git" value="git操作"></a>
	</body>
</html>
