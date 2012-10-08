<?php

if (admin_logined())
{
	if (
		isset($_POST['ralateUid']) &&
		isset($_POST['host']) &&
		isset($_POST['topic'])
	)
	{
		$config_str = file_get_contents('config.php');

		$config_str = str_replace(
			$config['ralateUid'],
			$_POST['ralateUid'],
			$config_str
		);

		$config_str = str_replace(
			$config['host'],
			$_POST['host'],
			$config_str
		);

		$config_str = str_replace(
			$config['topic'],
			$_POST['topic'],
			$config_str
		);

		file_put_contents('config.php', $config_str);

		$message = '修改成功';
		view('message');
	}
	else
	{
		view('forwards');
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

?>
