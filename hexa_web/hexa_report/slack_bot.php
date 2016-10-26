<?php
	/*
			Bot作ろう計画①Slack
			参考サイト：http://docs.hatenablog.jp/entry/slack-Incoming-webhooks
	*/
	class slack_class{
		public static function send_report($channel,$user_name,$message)
		{
			$channel ='#'.$channel;
			$url='https://hooks.slack.com/services/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';
			$msg = array(
				'channel'			=> 	$channel,
				'username'		=> 	$user_name,
				'icon_emoji' 	=>	':bust_in_silhouette:',
				'text' 				=>	$message
			);
			$msg = json_encode($msg);
			$msg = 'payload=' . urlencode($msg);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
			curl_exec($ch);
			curl_close($ch);
		}
	}
?>