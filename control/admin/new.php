<?php

if (admin_logined())
{
	if (isset($_POST['news']))
	{
		try
		{
			add_news();
			$message = '发布新闻成功';
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
		view('new');
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

?>
