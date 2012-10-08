<?php

if (admin_logined())
{
	if (isset($_GET['operate']))
	{
		switch ($_GET['operate'])
		{
			case 'gag':
				$id = (int)$_GET['id'];
				gag($id);
				$message = '操作成功';
				view('message');
				break;

			case 'ungag':
				$id = (int)$_GET['id'];
				ungag($id);
				$message = '操作成功';
				view('message');
				break;
		}
	}
	else
	{
		$length = isset($_GET['length']) ? (int)$_GET['length'] : 20;
		$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

		$users = get_users($start, $length);
		for ($i = 0, $size = count($users); $i < $size; $i++)
		{
			if ($users[$i]['gag'] == '0')
			{
				$users[$i]['gag?'] = 'gag';
				$users[$i]['gag_txt'] = '禁言';
			}
			else
			{
				$users[$i]['gag?'] = 'ungag';
				$users[$i]['gag_txt'] = '恢复';
			}
		}

		view('user');
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

?>
