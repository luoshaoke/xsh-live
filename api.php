<?php

include 'config.php';
include 'function.php';

session_start();
$intent = $_GET['intent'];
switch ($intent)
{
	case 'add_news':
	{
		if (admin_logined())
		{
			add_news();
		}
		break;
	}

	case 'get_admin_info':
	{
		if (admin_logined())
		{
			$admin_info['admin_name'] = $_SESSION['admin_name'];
			$admin_info['admin_id'] = $_SESSION['admin_id'];
			echo json_encode($admin_info);
		}
		break;
	}

	case 'set_admin_name':
	{
		if (admin_logined())
		{
			$name = $_POST['name'];
			if ($name != '')
			{
				try
				{
					set_admin_name($_SESSION['admin_id'], $name);
					$_SESSION['admin_name'] = $name;
				}
				catch (Exception $e)
				{
					echo $e->getMessage();
				}
			}
		}
		break;
	}

	case 'set_admin_password':
	{
		if (admin_logined())
		{
			$password = $_POST['password'];
			if ($password != '')
			{
				query("
					UPDATE live_admin
					SET password = '{$password}'
					WHERE id = {$_SESSION['admin_id']}
				");
			}
		}
		break;
	}

	case 'set_admin_avatar':
	{
		echo $_FILES['avatar']['name'];
		if ($_FILES['avatar']['name'] != '')
		{
			try
			{
				set_admin_avatar($_SESSION['admin_id'], $_FILES['avatar']);
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}
		break;
	}

	case 'get_live_news':
	{
		$length = isset($_GET['length']) ? (int)$_GET['length'] : 20;
		$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
		$data = get_live_news($start, $length);
		include 'view/live/news.php';
		break;
	}

	case 'get_news_num':
	{
		echo get_news_num();
		break;
	}

	case 'get_live_comment':
	{
		$length = isset($_GET['length']) ? (int)$_GET['length'] : 20;
		$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
		$follow = (int)$_GET['follow'];
		$comment = get_live_comment($start, $length, $follow);
		include 'view/live/comment_base.php';
		break;
	}

	case 'send_comment':
	{
		try
		{
			send_comment($_POST['comment'], (int)$_GET['follow']);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}

		break;
	}

	case 'has_name':
	{
		if (has_name($_POST['name']))
		{
			echo 'had';
		}

		break;
	}
}

?>
