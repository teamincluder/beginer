<?php
	ini_set("display_errors", Off);
	error_reporting(E_ALL);
	session_start();
	if(!isset($_SESSION['user_id'])){
		$_SESSION["reqest"] = 0;
		header('location: login.php');
	}
	$member_id = $_SESSION['user_id'];
	require_once "./sql/mysql.php";
	if(isset($_POST['send'])){
		$pdo->query("UPDATE `hexa_member_master` SET `membar_category` =" . $_POST['parmission'] . " WHERE `member_id` = '". $_POST['user'] ."'");
		header('location: admin.php');
	} 

?>
<!DOCTYPE html>
<html>
<!-- loginするページ -->
	<head>

	</head>
	<body>
		<?php while($row = $list -> fetch(PDO::FETCH_ASSOC)) {
			$user = $row["member_id"];
			switch ($row["membar_category"]) {
				case 5:
					$upar="管理者";
					break;
				case 1:
					$upar="Hexaのみ";
					break;
				case 2:
					$upar="includerのみ";
					break;
				case 3:
					$upar="両プロジェクト";
					break;
				
			} ?>
			<form action="admin.php" method="post">
				<p><?php echo $user; ?>のパーミッション変更</p>
				<input type="hidden" name="user" value="<?php echo $user; ?>">
				<select name="parmission">
					<option value=""><?php echo $upar; ?></option>
					<option value="5">管理者</option>
					<option value="1">Hexaのみ</option>
					<option value="2">includerのみ</option>
					<option value="3">両プロジェクト</option>
				</select>
				<input type="submit" name="send" value="change">
			</form>
			<?php } ?>
			<a href="./logout.php"><input type="button" name="logout" value="logout"></a>
			<a href="./menu.php"><input type="button" name="return" value="return"></a>
	</body>
</html>
<!-- 
	user parmision
	shun 1
	nobu 1
	doberan 5
	fumiya 5
	hourin 2
	ushi 3

	5 管理者
	1 HEXAのみ
	2 includerのみ
	3 両プロジェクト

 -->