<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		$_SESSION["reqest"] = 0;
		header('location: ../login.php');
	}
	if(!isset($_SESSION['project']))	
	{
		header("location:	../hexa_project/hexa_menu.php");
	}
	if(	isset($_GET['option'])	)	{
		$_SESSION['option']	=	$_GET['option'];
		header("location: ./hexa_chat.php?channel=".$_GET['channel']);
		exit();
	}
	mb_internal_encoding("UTF-8");
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_project/project_module.php');
	$project					=	new	project_module();
	$project_id				=	$project->get_project_id($_SESSION['project']);
	
	require_once(	$_SERVER['DOCUMENT_ROOT']	.	'/hexa_chat/chat_module.php');
	$chat 						= new chat_module();
	
	$option_str=null;
	
	if(	!empty($_SESSION['option']))
	{	
		switch($_SESSION['option'])
		{
			case "tools":
				$option_str=$project->select_other_tools($_SESSION['project']);
				break;
			case "settings":
				$option_str=$chat->get_setting($_SESSION['project']);
				break;
		}
	}
	$channel_tag=null;
	if(	isset($_GET['channel'])	)	{
		$channel_name		=	$_GET['channel'];
		$channel_now			=	$chat	->	set_now_channel($channel_name);
		$channel_message	=	$chat	->	set_channel_message($channel_name,$project_id	);
		$channel_tag			=	"channel=".$_GET['channel'];
	}
		$channel_list 		= $chat	->	set_channel_list($project_id);
	

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="./css/chat.css">
		<link rel="stylesheet" href="./css/reset.css">
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
		<title><?php echo $_SESSION['project'] ;?></title>
	</head>
	<body>
		<div class="wrapper">
			<div class="sidebar">
				<div class="channelBox">
					<h2 class="channel"><?php echo $_SESSION['project'];?> <br> channels</h2>
					<ul class="channelListBox">
						<?php echo $channel_list; ?>
						<li class="channelList backbutton"><a href="../hexa_project/hexa_menu.php">戻る</a></li>
					</ul>
				</div>
			</div>
			<div class="contentsBox">
				<header class="headerBox">
					<?php if(isset($_GET['channel'])){ echo $channel_now; ?>
					<ul id="nav" class="optionMenu">
						<li class="options"><a href="#">OPTIONS</a></li>
						<ul class="optionList">
							<li class="innerOption"><a href="?<?php if(!empty($_GET['channel'])) echo $channel_tag."&"; ?>option=tools">TOOLS</a></li>
							<li class="innerOption"><a href="?<?php if(!empty($_GET['channel'])) echo $channel_tag."&"; ?>option=settings">SETTINGS</a></li>
							<li class="innerOption"><a href="../include_message.php">日報システム</a></li>
							<li class="innerOption"><a href="../logout.php">ログアウト</a></li>
							<li class="innerOption"><a href="#">submenu</a></li>
							<li class="innerOption"><a href="#">submenu</a></li>
							<li class="innerOption"><a href="#">submenu</a></li>
							<li class="innerOption"><a href="#">submenu</a></li>
						</ul>
					</ul>
					<?php } ?>
				</header>
				<main class="contents" >
				<?php if(isset($_GET['channel']))	echo $channel_message; ?>
				</main>
				<?php if(isset($_GET['channel'])){ ?>
					<form class="sendBox" action="hexa_chat_add_message.php" method="post">
						<textarea class="messageTextBox" type="text" name="message" placeholder="メッセージ"></textarea>
						<input type="hidden" name="channel_name" value=	<?php	echo $channel_name; ?>>
						<input type="submit" value="送信">
					</form>
				<?php }?>
			</div>
			<?php if(!empty($_SESSION['option'])){?>
				<div class="rightBox">
					<div class="innerRightBox">
						<h2 class="others">others</h2>
						<?php echo $option_str; ?>
						<a  class="closeRightBox" href="?<?php if(isset($_GET['channel'])) echo $channel_tag."&"; ?>option=""">閉じる</a>
					</div>
				</div>
			<?php } ?>
		</div>
		<script>
		//削除用確認画面
		function disp(){
				return window.confirm('本当に削除しますか？');
		}
		
		var option	=	document.getElementsByClassName("rightBox");
		if(option[0] != null){
			var main 	= document.getElementsByClassName("contents");
			main[0].style.width = "75%";
			var send	=	document.getElementsByClassName("sendBox");
			send[0].style.width = "60%";
		}
		</script>
	</body>
</html>