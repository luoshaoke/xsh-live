<?php

if (admin_logined())
{
	if (isset($_GET['operate']))
	{
		switch ($_GET['operate'])
		{
			case 'name':
				name_modify();
				break;

			case 'avatar':
				avatar_modify();
				break;

			case 'password':
				password_modify();
				break;
		}
	}
	else
	{
		default_view();
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

// 默认视图
function default_view()
{
	global $personal;

	$personal = result(query("
		SELECT avatar
		FROM live_admin
		WHERE id = {$_SESSION['admin_id']}
	"));

	$personal = $personal[0];
	view('personal');
}

// 姓名修改
function name_modify()
{
	$name = $_POST['name'];
	if ($name != $_SESSION['admin_name'] && $name != '')
	{
		try
		{
			set_admin_name($_SESSION['admin_id'], $name);
			$_SESSION['admin_name'] = $name;

			global $message;
			$message = '修改成功';
			view('message');
		}
		catch (Exception $e)
		{
			global $warning;
			$warning = $e->getMessage();
			view('warning');
		}
	}
	else
	{
		default_view();
	}
}

// 密码修改
function password_modify()
{
	$password = $_POST['password'];
	if ($password != '')
	{
		$password_again = $_POST['password_again'];
		if ($password == $password_again)
		{
			query("
				UPDATE live_admin
				SET password = '{$password}'
				WHERE id = {$_SESSION['admin_id']}
			");

			$message = '修改成功';
			view('message');
		}
		else
		{
			global $warning;
			$warning = '密码不一致';
			view('warning');
		}
	}
	else
	{
		default_view();
	}
}

// 头像修改
function avatar_modify()
{
	if ($_FILES['avatar']['name'] != '')
	{
		try
		{
			set_admin_avatar($_SESSION['admin_id'], $_FILES['avatar']);

			global $message;
			$message = '修改成功';
			view('message');
		}
		catch (Exception $e)
		{
			global $warning;
			$warning = $e->getMessage();
			view('warning');
		}
	}
	else
	{
		default_view();
	}
}

?>
