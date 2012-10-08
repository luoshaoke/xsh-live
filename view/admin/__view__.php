<?php global $target;?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>广西民族大学相思湖网站图文直播</title>
		<link rel="stylesheet" href="css/admin.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.fancybox.pack.js" type="text/javascript"></script>
		<script src="js/admin.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="header">
			<div id="header-wrap">
				<h1>相思湖网站图文直播</h1>
				<ul id="nav">
					<li<?php if ($target == 'login') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=login">登录</a>
					</li>
					<li<?php if ($target == 'personal') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=personal">个人设置</a>
					</li>
					<li<?php if ($target == 'new') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=new">发布新闻</a>
					</li>
					<li<?php if ($target == 'modify') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=modify">修改新闻</a>
					</li>
					<li<?php if ($target == 'comment') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=comment">评论管理</a>
					</li>
					<li<?php if ($target == 'user') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=user">用户管理</a>
					</li>
					<li<?php if ($target == 'admin') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=admin">管理员</a>
					</li>
					<li<?php if ($target == 'forwards') echo ' class="current"'?>>
						<a href="?intent=admin&amp;target=forwards">转发设置</a>
					</li>
					<li>
						<a href="?intent=live&amp;target=live" target="_blank">直播首页</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="body">
			<?php include "$view.php";?>
		</div>
	</body>
</html>
