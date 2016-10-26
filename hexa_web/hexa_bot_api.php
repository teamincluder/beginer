<?php 
	class hexa_bot_api{
		
		/*
			slackと独自チャットにメッセージ飛ばす関数
			$channel 		= チャンネル名
			$user_name	=	ユーザー名
			$message		=	メッセージ
		*/
		public static function send_message($channel,$user_name,$message)
		{
			require_once( 	$_SERVER['DOCUMENT_ROOT']	.	'/slack_bot.php');
			$slack 		= 	new slack_class();
			$slack		->	send_report($channel,$user_name,$message);
			require_once( 	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
			$chat 		=	 	new chat_module();
			$chat			->	set_new_message($channel,$user_name,$message);
		}
		//Report用のメッセージを発行する
		public static function make_report_message($now,$will)
		{
			$result = "～～～進捗報告～～～"		. PHP_EOL .
								"【やったこと】" 							.	PHP_EOL .
								hexa_bot_api::set_array($now)	.	"【これからやること】"	. PHP_EOL .
								hexa_bot_api::set_array($will)	;
			return $result;
		}
		//make_report_messageで使う
		private static function set_array ($origin)
		{
			$origin 	= str_replace(array('\r\n','\r','\n'), '\n', $origin);
			$array 		= explode("\n", $origin);
			$message	=	"";
			$num			=	0;
			for($a=0;$a<count($array);$a++)
			{
				if(2>strlen($array[$a]))//空白行があったら飛ばす
					continue;
				$num++;
				$message = $message.($num).".".$array[$a].PHP_EOL;
			}
			return $message;
		}
	
	
	
	
	}



?>