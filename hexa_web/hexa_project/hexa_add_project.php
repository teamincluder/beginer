<?php

	session_start();
	header('location: ./hexa_project_admin.php');
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project = new project_module();
	$project->add_project($_SESSION['user_id'],$_POST['project_name'],$_POST['description']);

?>