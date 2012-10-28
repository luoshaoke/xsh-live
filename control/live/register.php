<?php 

if (user_logined())
{
	$message = "
		<strong>{$_SESSION['user_name']}</strong> 已登录，
		<em>
			<a href='?intent=live&amp;target=logout' class='logout'>注销</a>
		</em>
	";

	view('message');
}
else if (
	isset($_POST['email']) &&
	isset($_POST['name']) &&
	isset($_POST['password']) &&
	isset($_POST['password_again'])
)
{
	$flag = true; // 错误标志
	$error_msg = array(); // 错误信息列表

	// 邮箱验证
	$email = $_POST['email'];

	if ($email == '')
	{
		array_push($error_msg, '邮箱不能为空');
		$flag = false;
	}
	else
	{
		if (email_exists($email))
		{
			array_push($error_msg, "邮箱“{$email}”已被注册");
			$flag = false;
		}
		else if (false) // 验证邮箱的真实性，未实现
		{
			array_push($error_msg, '请输入有效的邮箱');
			$flag = false;
		}
	}

	// 呢称验证
	$name = trim($_POST['name']);

	if ($name == '')
	{
		array_push($error_msg, '昵称不能为空');
		$flag = false;
	}
	else
	{
		if (name_exists($name))
		{
			array_push($error_msg, "昵称“{$name}”已被使用");
			$flag = false;
		}
	}

	// 密码验证
	$password = $_POST['password'];
	$password_again = $_POST['password_again'];

	if ($password == '')
	{
		array_push($error_msg, '密码不能为空');
		$flag = false;
	}

	if ($password_again == '')
	{
		array_push($error_msg, '请输入确认密码');
		$flag = false;
	}
	else if ($password != $password_again)
	{
		array_push($error_msg, '两次输入的密码不一致');
		$flag = false;
	}

	if ($flag)
	{
		query("
			INSERT INTO live_user(`name`, `email`, `password`)
			VALUES('{$name}', '{$email}', '{$password}')
		");

		$message = '注册成功';
		view('message');

		// 获取 id 并注册会话变量
		$id = result(query("
			SELECT id
			FROM live_user
			WHERE name = '{$name}'
		"));

		$_SESSION['user_id'] = $name;
		$_SESSION['user_name'] = $id[0]['id'];
	}
	else
	{
		view('error_list');
	}
}
else
{
	view('register');
}

?>
