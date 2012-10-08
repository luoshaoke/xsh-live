<?php

if (admin_logined())
{
	$message = "
		<strong>
			<a class='name' href='?intent=admin&amp;target=personal'>
				{$_SESSION['admin_name']}
			</a>
		</strong>
		已登录，
		<a href='?intent=admin&amp;target=logout' class='logout'>注销</a>
	";

	view('message');
}
else if (
	isset($_POST['name']) &&
	$_POST['name'] != '' &&
	isset($_POST['password'])
)
{
	try
	{
		admin_login($_POST['name'], $_POST['password']);
		$message = "登录成功";
		view('message');
	}
	catch (Exception $e)
	{
		$warning = $e->getMessage();
		view('warning');
	}
}
else
{
	view('login');
}

?>
