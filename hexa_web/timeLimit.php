<?php
$url = 'http://doberan.gloomy.jp/hexa_test/hexa_web/callback.php';
$data = array(
	'message' => '22時になりました。日報を更新してください。
	http://doberan.gloomy.jp/hexa_web/hexa_message.php',
	'autosystem' => '10',
);
$options = array('http' => array(
	'method' => 'POST',
	'content' => http_build_query($data,"","&"),
));
$contents = file_get_contents($url, false, stream_context_create($options));
var_dump($contents);
?>