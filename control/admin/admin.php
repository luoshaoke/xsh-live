<?php

if (admin_logined())
{
	if (isset($_GET['operate']))
	{
		switch ($_GET['operate'])
		{
			case 'new':
				include 'new_admin.php';
				break;
		}
	}
	else
	{
		$num = isset($_GET['num']) ? (int)$_GET['num'] : 20;
		$begin = isset($_GET['begin']) ? (int)$_GET['begin'] : 0;

		$admin = result(query("
			SELECT * FROM live_admin
			LIMIT {$begin}, {$num}
		"));

		view('admin');
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

?>
