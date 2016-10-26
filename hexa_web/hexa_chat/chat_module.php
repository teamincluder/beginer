<?php
	class chat_module
	{	
		
		/*
			channelのリストを取得する関数
			引数なし
			返り値：チャンネル選択ボタン
		*/
		public static function set_channel_list($project_id){
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance = new mysql_class();
			$result   = $instance->select_func("hexa_channel_master","project_id",$project_id);
			$html_str="";
			while($row = $result -> fetch(PDO::FETCH_ASSOC)) {
					$html_str =	$html_str	.
											'<li class="channelList">'	.
												'<a href="?channel='.$row['channel_name'].'">'.$row['channel_name'].'【'.$row['purpose'].'】</a>'	.
											'</li>'.PHP_EOL	;
			}
			return $html_str;
		}
		
		/*
			現在選択されているchannelを取得する関数
			引数	$value	=	channelの名前	example:"general"
			返り値：現在のチャンネル
		*/
		public static function set_now_channel($value){	
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance = new mysql_class();
			$result  	= $instance->select_func("hexa_channel_master","channel_name",$value);
			$row			=	$result->fetch(PDO::FETCH_ASSOC);
			$html_str	= '<h2 class="channelName">'.$row['channel_name'].'</h2><br>'	.
									'<p class="channelPurpose">'.$row['purpose'].'</p>';	
			return $html_str;				
		}
		
		/*
			channel_idを取得する関数
			引数	$channel_name =	channelの名前	example:"general"
			返り値：Channel_id
		*/
		public	static function get_channel_id($channel_name){
				require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$result  	= $instance->select_func("hexa_channel_master","channel_name",$channel_name);
				$row			=	$result->fetch(PDO::FETCH_ASSOC);
				return $row['channel_id'];
		}
		
		/*
			channelのメッセージを取得する関数
			引数	$channel_name =	channelの名前	example:"general"
			返り値：メッセージ詳細
		*/
		public static function set_channel_message($channel_name,$project_id){
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance = new mysql_class();
			$channel_id			=	chat_module::get_channel_id($channel_name);
			$result_message = $instance->select_double_func("hexa_chat_tool","channel_id","project_id",$channel_id,$project_id);
			$html_str				=	null;
			while($row = $result_message -> fetch(PDO::FETCH_ASSOC)) {
			
				$row['message'] = str_replace(array('\r\n','\r','\n'), '\n', $row['message']);
				$array = explode("\n", $row['message']);
				$message="";
				for($a=0;$a<count($array);$a++)
				{
					$message = $message.'	<p class="messageText">'.$array[$a].'</p>'.PHP_EOL;
				}
				$html_str	=	$html_str	.
										'<div class="messageBox">'																												.	PHP_EOL	.
										' <div class="messageInnerBox">'																									.	PHP_EOL	.
										'	 <h2 class="userName">'																													. $row['member_id'] .	'</h2>'		.
										'	 <time class="timeStamp">【'																											.	$row['timestamp']	.	'】</time>'	.	PHP_EOL	.
										$message																																					.
										' </div>'																																					.	PHP_EOL .
										' <form class="deleteform" action="hexa_chat_delete_message.php" method="post" onSubmit= "return disp()">'	.	PHP_EOL .
										'		<input type="hidden" name="chat_id"	value="'.$row['chat_id'].'">'							.	PHP_EOL .
										'		<input type="hidden" name="channel_name"	value="'.$channel_name.'">'					.	PHP_EOL .
										'		<input class="deletebutton" type="submit" value="削除" >'											.	PHP_EOL .
										'	</form>'																																				.	PHP_EOL .
										'</div>'																																					.	PHP_EOL ;
				}
			return $html_str;
		}
		
		/*
			channelを作る関数
			引数	$name 		=	channelの名前	example:"general"
						$purpose	= channelの目的	example:"雑談"
		*/
		public static function set_new_channel($name,$purpose,$project_id)
		{
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance = new mysql_class();
			$result   = $instance->insert_channel_func($name,$purpose,$project_id);
		}
			/*
			メッセージを保存する関数
			引数	$channel_name =	channelの名前	example:"general"
					$member_id	= メンバーの名前	example:"fumiya"
					$message		=メッセージ内容
		*/
		public static function set_new_message($channel_name,$member_id,$message,$project_id)
		{
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance = new mysql_class();
			$channel_id	=	chat_module::get_channel_id($channel_name);
			var_dump($channel_id);
			$result			=	$instance->insert_message_func($channel_id,$member_id,$message,$project_id);
		}
		/*
			channelのリストを表示する関数
		*/
		public static function set_channel_select($project_id)
		{
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance = new mysql_class();
			$result   = $instance->select_func("hexa_channel_master","project_id",$project_id);
			
			$html_str	='<select name="channel_name">'.	PHP_EOL;
			while($row=$result->fetch(PDO::FETCH_ASSOC))
			{
				$html_str=$html_str.'<option value='.$row['channel_name'].'>'.$row['channel_name'].'</option>'	.	PHP_EOL;
			}
			$html_str=$html_str.'</select>';
			return $html_str;
		}
		/*
			channelを消去する関数
		*/
		public static function delete_channel($channel_name)
		{
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance 	= 	new mysql_class();
			$instance 	-> 	delete_func("hexa_channel_master","channel_name",$channel_name);
			$channel_id	=	chat_module::get_channel_id($channel_name);
			$instance   -> 	delete_func("hexa_chat_tool","channel_id",$channel_id);
		}
		/*
			メッセージを消去する関数
		*/
		public static function delete_message($chat_id)
		{
			require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
			$instance 	= 	new mysql_class();
			$instance   -> 	delete_func("hexa_chat_tool","chat_id",$chat_id);
		}
		
		public static function get_setting($project_name){
			require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
			$project 	= 	new project_module();
			$project_id		=		$project	->	get_project_id($project_name);
			$html_members	=		$project	->	is_project_master($_SESSION['user_id'],$project_id);
			$html_str	=		chat_module::set_channel_select($project_id);
			
			$all_str	=	 $html_members			.	PHP_EOL	.
									'<h2>チャンネル</h2>'	.	PHP_EOL	.
									'<form class="sendBox" action="hexa_chat_add_channel.php" method="post">'.	PHP_EOL	.
									'<input type="text" name="channel_name" placeholder="channel name">'.	PHP_EOL	.
									'<input type="text" name="purpose" placeholder="purpose">'.	PHP_EOL	.
									'<input type="submit" value="追加">'.	PHP_EOL	.
									'</form>'	.	PHP_EOL	.
									'<form class="sendBox" action="hexa_chat_delete_channel.php" method="post">'.	PHP_EOL	.
									$html_str	.	PHP_EOL	.
									'<input type="submit" value="削除">'.	PHP_EOL	.
									'</form>'.	PHP_EOL	;	
			return $all_str;
		}
	}
?>