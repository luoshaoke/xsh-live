<?php

if (admin_logined())
{
	if (
		isset($_POST['name']) &&
		isset($_POST['password']) &&
		isset($_POST['password_again'])
	)
	{
		$flag = true;
		$error_msg = array();

		// 名称验证
		$name = trim($_POST['name']);
		if ($name == '')
		{
			array_push($error_msg, '请输入名称');
			$flag = false;
		}
		else
		{
			if (has_name($name))
			{
				array_push($error_msg, '您输入的昵称已存在');
				$flag = false;
			}
		}

		// 密码验证
		$password = $_POST['password'];
		if ($password == '')
		{
			array_push($error_msg, '请输入密码');
			$flag = false;
		}
	

		$password_again = $_POST['password_again'];
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
				INSERT INTO live_admin(`name`, `password`)
				VALUES('{$name}', '{$password}')
			");

			$message = '创建成功';
			view('message');
		}
		else
		{
			view('error_list');
		}
	}
	else
	{
		view('new_admin');
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

?>
