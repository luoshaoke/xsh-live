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
			<div class="center">
				<a href="#" class="up">上一条</a>
				<a href="#" class="top">返回顶部</a>
				<a href="#" class="down">下一条</a>
			</div>
			<div class="right">
				<div class="personal">
					<img src="img/avatar/default.png" class="avatar" alt="我的头像" title="我的头像" />
					<div class="name">昵称</div>
				</div>
				<p class="setting">
					<a href="?intent=live&amp;target=setting" id="setting">设置</a>
				</p>
			</div>
		</div>
		<div id="body">
			<?php include "$view.php";?>
		</div>
		<div id="footer"></div>
	</body>
</html>
