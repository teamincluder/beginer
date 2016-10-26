<?php
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/chat_module.php');
	$project = new chat_project();
	$subscription	= $project->get_subscription_projects($member_id);
?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<?php echo $subscription;?>
	</body>
</html>
