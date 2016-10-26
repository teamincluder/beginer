<?php
	ini_set("display_errors", On);
	error_reporting(E_ALL);
	define('DB_DATABASE', 'LAA0562135-hexacustom' );	//database_name
	define('DB_ADRESS','mysql111.phy.lolipop.lan');	//database_adress
	define('DB_USER','LAA0562135');			//database_user_name
	define('DB_PASS','h0ugy0kugyuu');			//database_password
/*
	$connect = mysql_connect(DB_ADRESS,DB_USER,DB_PASS);
	if (!$connect) die();
	mysql_select_db(DB_DATABASE) or die();

		$selectquery = "SELECT * FROM hexa_member_master WHERE member_id='" . $member_id . "'";
		$result = mysql_query($selectquery);
		$my_row = mysql_fetch_assoc($result);

		$sql = "DESCRIBE hexa_member_master;";
		$result2 = mysql_query($sql);
		$row = mysql_fetch_assoc($result2);
*/

		try {
			$pdo = new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE , DB_USER, DB_PASS,
			array(PDO::ATTR_EMULATE_PREPARES => false));
			$private= $pdo->query("SELECT * FROM hexa_member_master WHERE member_id='" . $member_id . "'");
			$list 	= $pdo->query("SELECT * FROM hexa_member_master");
		} catch (PDOException $e) {
			exit('データベース接続失敗。'.$e->getMessage());
		}

?>