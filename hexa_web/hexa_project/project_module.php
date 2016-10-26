<?php
	class project_module
	{
			//プロジェクトネームを取得する
			public static function get_project_name($project_id)
			{
				require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$result  	= $instance->select_func("hexa_project_master","project_id",$project_id);
				$row			=	$result->fetch(PDO::FETCH_ASSOC);
				return $row['project_name'];
			}
			//プロジェクトIDを取得する
			public static function get_project_id($project_name)
			{
				require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$result  	= $instance->select_func("hexa_project_master","project_name",$project_name);
				$row			=	$result->fetch(PDO::FETCH_ASSOC);
				return $row['project_id'];
			}
			//購読しているプロジェクトを表示する
			public static function get_subscription_projects($member_id)
			{
				require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$result  	= $instance->select_func("hexa_project_subscription","member_id",$member_id);
				$html_str="";
				while($row = $result -> fetch(PDO::FETCH_ASSOC)) {
					$project_name =	project_module::get_project_name($row['project_id']);
					$html_str =	$html_str	.
													'	<form  action="./hexa_menu.php" method="post">'																.	PHP_EOL .
													'		<input type="hidden" name="project_name" value="'.$project_name.'">'				.	PHP_EOL .
													'		<input class="projectBtn" type="submit" value="'.$project_name.'">'					.	PHP_EOL .
													'	</form>'																																			.	PHP_EOL ;
				}
				return $html_str;
			}
			//カテゴリー表示部
			private static function set_category($member_category)
			{	
				$result	=	null;
				switch($member_category)
					{
						case 1:
						$result	=	"管理者";
						break;
						case 2:
						$result	=	"編集者";
						break;
						case 3:
						$result	=	"購読者";
						break;
					}
				$html_str	=	'			<option value="'.$member_category.'">'.$result.'</option>';
				return $html_str;
			}
			//プロジェクト管理者かの判定とオプション表示部
			public static function is_project_master($member_id,$project_id){
					require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
					$instance = new mysql_class();
					$result  	= $instance->select_func("hexa_project_subscription","project_id",$project_id);
					$html_str	=	null;
					$row = $result -> fetch(PDO::FETCH_ASSOC);
					if($row['member_category']!=1){
						return $html_str;
						exit();
					}
					$project_name	= project_module::get_project_name($row['project_id']);
					$members	=	$instance->select_func("hexa_project_subscription","project_id",$project_id);
					$html_member	=null;
					while($member_list = $members -> fetch(PDO::FETCH_ASSOC)) {
						$category	=	project_module::set_category($member_list['member_category']);
						$html_member	=	$html_member	.
								'	<form  action="./hexa_update_project_member.php" method="post">'		.	PHP_EOL .
								'		<input type="text" name="member_id" value='.$member_list['member_id'].' readonly="readonly">'	.	PHP_EOL .
								'		<input type="hidden" name="project_id" value="'.$project_id.'">'	.	PHP_EOL .
								'		<select name="member_category">					'													.	PHP_EOL .
								project_module::set_category($member_list['member_category'])					.	PHP_EOL	.
								project_module::set_category(1)																				.	PHP_EOL	.
								project_module::set_category(2)																				.	PHP_EOL	.
								project_module::set_category(3)																				.	PHP_EOL	.
								'		</select>																'													.	PHP_EOL .
								'		<input  type="submit" value="変更">'															.	PHP_EOL .
								'	</form>'																														.	PHP_EOL ;
					}
					$html_str	=	$html_str	.	'<h2>メンバー</h2>'																						.	PHP_EOL	.
//						"<h2>".$project_name."</h2>"																										.	PHP_EOL	.
//						'	<form  action="./xxx.php" method="post">'																			.	PHP_EOL .
//						'		<input type="hidden" name="project_id" value="'.$project_id.'">'						.	PHP_EOL .
//						'		<input  type="submit" value="削除">'																				.	PHP_EOL .
//						'	</form>'																																			.	PHP_EOL .
							'	<form  action="./hexa_add_project_member.php" method="post">'									.	PHP_EOL .
							'		<input type="text" name="member_id" placeholder="member_name">		'					.	PHP_EOL .
							'		<input type="hidden" name="project_id" value="'.$project_id.'">'						.	PHP_EOL .
							'		<select name="member_category">					'																		.	PHP_EOL .
							'			<option value="1">管理者</option>			'																		.	PHP_EOL .
							'			<option value="2">編集者</option>		'																			.	PHP_EOL .
							'			<option value="3">購読者</option>'																					.	PHP_EOL .
							'		</select>																'																		.	PHP_EOL .
							'		<input  type="submit" value="追加">'																				.	PHP_EOL .
							'	</form>'																																			.	PHP_EOL .
							$html_member																																		.	PHP_EOL ;
					return	$html_str;
			}
			//登録されているメンバーか確認する
			public static function is_member($member_id){
				require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$result  	= $instance->select_func("hexa_member_master","member_id",$member_id);
				$row			=	$result->fetch(PDO::FETCH_ASSOC);
				return $row['member_id'];
			}
			//プロジェクトメンバーの追加
			public static function add_project_member($project_id,$member_id,$member_category){
				require_once( $_SERVER['DOCUMENT_ROOT'].'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$is_active	=	project_module::is_member($member_id);
				if($is_active!=null)	$instance->insert_project_member_func($project_id,$member_id,$member_category);
			}
			//プロジェクトの追加
			public static function add_project($member_id,$project_name,$description){
				require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$instance->insert_project_func($project_name,$description);
				$project_id=project_module::get_project_id($project_name);
				project_module::add_project_member($project_id,$member_id,1);
			}
			//プロジェクトの削除
			public static function delete_project($project_id){
				require_once( $_SERVER['DOCUMENT_ROOT']	.	'/hexa_mysql/mysql_class.php');
				$instance 	= 	new mysql_class();			
				$instance 	-> 	delete_func("hexa_project_master","project_id",$project_id);
				$instance 	-> 	delete_func("hexa_channel_master","project_id",$project_id);
				$instance 	-> 	delete_func("hexa_chat_tool","project_id",$project_id);
				$instance 	-> 	delete_func("hexa_project_subscription","project_id",$project_id);
				
			}
			public static function update_project_member($project_id,$member_id,$member_category){
				require_once( $_SERVER['DOCUMENT_ROOT'].'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$is_active	=	project_module::is_member($member_id);
				if($is_active!=null)	$instance->update_project_member_func($project_id,$member_id,$member_category);
			}
			
			public static function insert_other_tools($tools_name,$url,$project_name){
				require_once( $_SERVER['DOCUMENT_ROOT'].'/hexa_mysql/mysql_class.php');
				$instance = new mysql_class();
				$project_id	= project_module::get_project_id($project_name);
				$instance->insert_project_tools_func($tools_name,$url,$project_id);
			}
			public static function select_other_tools($project_name){
				require_once( $_SERVER['DOCUMENT_ROOT'].'/hexa_mysql/mysql_class.php');
				$instance 	= new mysql_class();
				$project_id	= project_module::get_project_id($project_name);
				$result  		= $instance->select_func("hexa_project_other_tools","project_id",$project_id);
				$html_str		=	null;
				while($tool_list = $result -> fetch(PDO::FETCH_ASSOC)) {
					$html_str	=	$html_str	.	'<li class="toolsList"><a class="toolsName" href="'.$tool_list['url'].'" target="_blank">'.$tool_list['tools_name'].'</a></li>'.PHP_EOL;
				}
				$html_str	=	$html_str	.
				'<form class="insertButton" action="../hexa_project/hexa_other_insert.php" method="post">'	.	PHP_EOL .
				'<input class="toolForm" type="text" name="tools_name" placeholder="tools name">'.	PHP_EOL .
				'<input class="toolForm" type="text" name="url" placeholder="url">'.	PHP_EOL .
				'<input class="toolForm" type="submit" value="追加">'.	PHP_EOL .
				'</form>'.	PHP_EOL;
				return $html_str;
			}
	}
?>