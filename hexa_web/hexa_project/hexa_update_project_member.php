<?php
	session_start();
	header('location: ./hexa_project_admin.php');
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project = new project_module();
	$project->update_project_member($_POST['project_id'],$_POST['member_id'],$_POST['member_category']);

?>