<?php
session_start();

$midFile = dirname(__FILE__)."/mids";
$json = json_decode(file_get_contents("php://input"), true);
$mids = explode(PHP_EOL, trim(file_get_contents($midFile)));
$newMids = array();
if (isset($json["result"])) {
		foreach ($json["result"] as $result) {
			$newMids[] = $result["content"]["from"];
			$messages[] = array(
					"contentType" => 1,
					"text" => $result["content"]["from"],
			);
		}
		$mids = array_merge($newMids, $mids);
		$mids = array_unique($mids);
		file_put_contents($midFile, implode(PHP_EOL, $mids));
}
else if(isset($_POST['autosystem']))
{
	$messages[] = array(
					"contentType" => 1,
					"text" => $_POST['message'],
			);
}
else if($_SESSION['user_id']!=null)
{
	$member_POST = $_SESSION['user_id'];
	$message_POST =SetArray($_POST['task']);
	$task_POST = SetArray($_POST['nowTask']);
	$messages[] = array(
					"contentType" => 1,
					"text" => $member_POST ."さんの進捗報告\n"."【やったこと】\n". $message_POST."【これからやること】\n".$task_POST,
			);
	header( "Location: http://doberan.gloomy.jp/hexa_web/menu.php" ) ;
}
$body = json_encode(
array(
    "to" => array_values($mids),
    "toChannel" => 1383378250,
    "eventType" => "140177271400161403",
    "content" => array(
        "messageNotified" => 0,
        "messages" => $messages,
    ),
	)
);
if(!isset($messages))
{
	exit();
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://trialbot-api.line.me/v1/events");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json; charser=UTF-8',
    'X-Line-ChannelID: 	1476992310',  // Channel ID
    'X-Line-ChannelSecret: 8125e7e5d82564e7595b836881618539',  // ChannelID Secret
    'X-Line-Trusted-User-With-ACL: uaae7c2eb7d15e008ba480ffbc7469e18',  // MID
));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
$result = curl_exec($ch);
function SetArray ($origin)
{
	$origin = str_replace(array('\r\n','\r','\n'), '\n', $origin);
	$array = explode("\n", $origin);
	$message="";
	$num=0;
	for($a=0;$a<count($array);$a++)
	{
		if(2>strlen($array[$a]))
			continue;
		$num++;
		$message = $message.($num).".".$array[$a]."\n";
	}
	return $message;
}
