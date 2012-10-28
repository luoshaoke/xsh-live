<?php global $user_logined;?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>广西民族大学相思湖网站图问直播</title>
		<link rel="stylesheet" href="css/live.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
		<script src="js/jquery.fancybox.pack.js" type="text/javascript"></script>
		<script src="js/live.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="toolbar">
			<div class="left">
				<h1 class="title"><a href="?intent=live" title="相思湖网站图文直播">图文直播</a></h1>
				<div class="detail"></div>
			</div>
			<div class="center"></div>
			<div class="right">
				<div class="personal">
					<?php if (!$user_logined) echo '<a href="?target=login" title="登录">'?>
					<?php if ($user_logined) echo '<a href="?target=personal" title="个人中心">'?>
						<img src="img/avatar/default.png" class="avatar" width="24" height="24" alt="我的头像" />
						<span class="name"><?php echo $_SESSION['user_name']?></span>
					</a>
				</div>
			</div>
		</div>
		<br />
		<div id="body">
			<?php include "$view.php";?>
		</div>
		<div id="footer"></div>
	</body>
</html>
