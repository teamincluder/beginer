<?php
	/*
		DB構造まとめ

		hexa_chat_tool
			chat_id	
			member_id
			message
			img_path
			channel_id
			timestamp
	
		hexa_channel_master
			channel_id
			channel_name
			purpose
		
	*/
	ini_set("display_errors", On);
	error_reporting(E_ALL);
	mb_internal_encoding("UTF-8");
	define('DB_DATABASE', 'LAA0562135-hexacustom' );
	define('DB_ADRESS','mysql111.phy.lolipop.lan');
	define('DB_USER','LAA0562135');
	define('DB_PASS','h0ugy0kugyuu');
	
	
class mysql_class
{
	public static function select_func($table_name,$column_name,$param)
	{
		$private			=	null;
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$private	= $pdo->query("SELECT * FROM ".$table_name." WHERE ".$column_name."='" . $param . "'");
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
		return $private;
	}	
	public static function select_double_func($table_name,$column_name1,$column_name2,$param1,$param2)
	{
		$private			=	null;
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$private	= $pdo->query("SELECT * FROM ".$table_name." WHERE ".$column_name1."='" . $param1 . "' AND ".$column_name2."='".$param2 . "'");
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
		return $private;
	}
	public static function select_all_func($table_name)
	{
		$list					=	null;
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$list 		= $pdo->query("SELECT * FROM ".$table_name);
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
		return $list;
	}
	public static function insert_channel_func($name,$purpose,$project_id)
	{
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$column 	= 	"channel_name,purpose,project_id";
				$insert		= 	"Insert into "."hexa_channel_master"." (".$column.") values (:name,:purpose,:project_id);";
				$stmt 		= 	$pdo -> prepare($insert);
				$stmt			->	bindValue(':name'			, $name			, PDO::PARAM_STR);
				$stmt			->	bindValue(':purpose'	, $purpose	, PDO::PARAM_STR);
				$stmt			->	bindValue(':project_id'	, $project_id	, PDO::PARAM_STR);
				$stmt			->	execute();
				var_dump($stmt);
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
	}
	public static function insert_message_func($channel_id,$member_id,$message,$project_id)
	{
		try{
				$timestamp	=		date('Y-m-d H:i:s', time());
				echo $channel_id;
				$column 	= 	"channel_id,member_id,message,timestamp,project_id";
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$insert 	= 	"Insert into "."hexa_chat_tool"." (".$column.") values (:channel_id,:member_id,:message,:timestamp,:project_id);";
				$stmt 		= 	$pdo -> prepare($insert);
				$stmt			->	bindValue(':channel_id'	, $channel_id	,	PDO::PARAM_STR);
				$stmt			->	bindValue(':member_id'	, $member_id	,	PDO::PARAM_STR);
				$stmt			->	bindValue(':message'		, $message		,	PDO::PARAM_STR);
				$stmt			->	bindValue(':timestamp'	, $timestamp		,	PDO::PARAM_STR);
				$stmt			->	bindValue(':project_id'	, $project_id		,	PDO::PARAM_STR);
				$stmt			->	execute();
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
	}
	public static function delete_func($table_name,$column,$value)
	{
		try
		{
			$pdo 		=	new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
								array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$sql 		= 	"DELETE FROM " .$table_name." where ".$column." = :value";
			$stmt 		= 	$pdo->prepare($sql);
			$params 	= 	array(':value'=>$value);
 			$stmt 		->  execute($params);
		} 
		catch (PDOException $e)
		{
			exit('データベース接続失敗。'.$e->getMessage());
		}
	}
	public static function insert_project_member_func($project_id,$member_id,$member_category)
	{
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$column 	= 	"project_id,member_id,member_category";
				$insert		= 	"Insert into "."hexa_project_subscription"." (".$column.") values (:project_id,:member_id,:member_category);";
				$stmt 		= 	$pdo -> prepare($insert);
				$stmt			->	bindValue(':project_id'			, $project_id			, PDO::PARAM_STR);
				$stmt			->	bindValue(':member_id'			, $member_id			, PDO::PARAM_STR);
				$stmt			->	bindValue(':member_category', $member_category, PDO::PARAM_STR);
				$stmt			->	execute();
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
	}
	public static function insert_project_func($project_name,$description)
	{
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$column 	= 	"project_name,description";
				$insert		= 	"Insert into "."hexa_project_master"." (".$column.") values (:project_name,:description);";
				$stmt 		= 	$pdo -> prepare($insert);
				$stmt			->	bindValue(':project_name'			, $project_name			, PDO::PARAM_STR);
				$stmt			->	bindValue(':description'			, $description			, PDO::PARAM_STR);
				$stmt			->	execute();
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
	}
	
	public static function update_project_member_func($project_id,$member_id,$member_category)
	{
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$update		= 	"Update hexa_project_subscription	set member_category	=	:member_category	Where member_id=	:member_id AND project_id = :project_id";
				$stmt 		= 	$pdo -> prepare($update);
				$stmt			->	bindValue(':project_id'			, $project_id			, PDO::PARAM_STR);
				$stmt			->	bindValue(':member_id'			, $member_id			, PDO::PARAM_STR);
				$stmt			->	bindValue(':member_category', $member_category, PDO::PARAM_STR);
				$stmt			->	execute();
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
	}
	
	public static function insert_project_tools_func($tools_name,$url,$project_id)
	{
		try{
				$pdo 			= new PDO('mysql:host=' . DB_ADRESS . ';dbname='. DB_DATABASE, DB_USER, DB_PASS,
										array(PDO::ATTR_EMULATE_PREPARES => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$column 	= 	"tools_name,url,project_id";
				$insert		= 	"Insert into "."hexa_project_other_tools"." (".$column.") values (:tools_name,:url,:project_id);";
				$stmt 		= 	$pdo -> prepare($insert);
				$stmt			->	bindValue(':tools_name',$tools_name, PDO::PARAM_STR);
				$stmt			->	bindValue(':url',$url, PDO::PARAM_STR);
				$stmt			->	bindValue(':project_id'			, $project_id			, PDO::PARAM_STR);
				$stmt			->	execute();
			} catch (PDOException $e) {
				exit('データベース接続失敗。'.$e->getMessage());
			}
	}
}
?>