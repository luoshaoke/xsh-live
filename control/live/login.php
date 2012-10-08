<?php

if (user_logined())
{
	$message = "
		<strong class='name'>{$_SESSION['user_name']}</strong> 已登录，
		<em>
			<a href='?intent=live&amp;target=logout' class='logout'>注销</a>
		</em>
	";

	view('message');
}
else if (isset($_POST['email']) && isset($_POST['password']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	// 根据邮箱查询数据库
	$result = result(query("
		SELECT id, name, password, email 
		FROM live_user
		WHERE email='{$email}'
	"));

	if (!isset($result[0]))
	{
		$warning = '邮箱不存在';
		view('warning');
	}
	else if ($result[0]['password'] != $password)
	{
		$warning = '密码错误';
		view('warning');
	}
	else
	{
		// 注册会话变量
		$_SESSION['user_name'] = $result[0]['name'];
		$_SESSION['user_id'] = $result[0]['id'];

		$message = "登录成功";
		view('message');
	}
}
else
{
	view('login');
}

?>
