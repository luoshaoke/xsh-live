<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>广西民族大学相思湖网站图问直播</title>
		<link rel="stylesheet" href="css/live.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.fancybox.pack.js" type="text/javascript"></script>
		<script src="js/live.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="header"></div>
		<div id="toolbar">
			<div class="left">
				<h1 class="title">图文直播</h1>
				<div class="detail"></div>
			</div>
			<div class="center">
				<p>
					<a href="#" class="up" id="btn_up" title="上一条">上一条</a>
					<a href="#" class="top" id="btn_top" title="返回顶部">返回顶部</a>
					<a href="#" class="down" id="btn_down" title="下一条">下一条</a>
				</p>
			</div>
			<div class="right">
				<div class="personal" title="<?php echo $_SESSION['user_name']?>">
					<img src="img/avatar/default.png" class="avatar" alt="我的头像" />
					<div class="name"><?php echo $_SESSION['user_name']?></div>
					<div class="menu login_and_logout">
						<a href="#" class="login">登录</a>
					</div>
				</div>
				<p class="setting">
					<a href="?intent=live&amp;target=setting" id="setting" title="设置">设置</a>
				</p>
			</div>
		</div>
		<div id="body">
			<?php include "$view.php";?>
		</div>
		<div id="footer"></div>
	</body>
</html>
