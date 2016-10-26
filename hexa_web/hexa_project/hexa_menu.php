<?php
	session_start();
	if(isset($_POST['project_name'])){
		$_SESSION['project']=$_POST['project_name'];
		header('location: ../hexa_chat/hexa_chat.php');
	}
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project = new project_module();
	$subscription	= $project->get_subscription_projects($_SESSION['user_id']);
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./css/menu.css">
	</head>
	<body>
		<div class="project">
			<h2 class="hexaChat">hexa_chat</h2>
			<?php echo $subscription;?>
			<a class="projectList" href="../menu.php">戻る</a>
		</div>
	</body>
</html>
