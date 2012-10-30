<?php

// 显示
function view($view)
{
	global $intent;
	include "view/{$intent}/__view__.php";
}

function html($s)
{
	return nl2br(htmlspecialchars($s));
}

// 执行 SQL 数据库查询
function query($query)
{
	global $config;

	$db = mysql_connect(
		$config['db_host'],
		$config['db_user'],
		$config['db_pwd']
	);

	mysql_select_db($config['db_name'], $db);
	mysql_real_escape_string($query, $db);
	mysql_query("SET NAMES {$config['db_charset']}");
	$result = mysql_query($query);
	mysql_close($db);

	return $result;
}

// 以键值对形式返回数据库查询结果
function result($result)
{
	$array = array();
	$count = 0;
	while ($row = mysql_fetch_assoc($result))
	{
		$array[$count++] = $row;
	}
	mysql_free_result($result);
	return $array;
}

// 判断管理员是否已登录
function admin_logined()
{
	if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

// 判断用户是否已登录
function user_logined()
{
	if (
		isset($_SESSION['user_id']) &&
		isset($_SESSION['user_name']) &&
		$_SESSION['user_name'] != '游客' &&
		$_SESSION['user_id'] != 0
	)
	{
		return true;
	}
	else
	{
		return false;
	}
}

// 判断一个文件是否是图片
// 限于 jpg、png、gif 格式
function is_img($type)
{
	switch ($type)
	{
		case 'image/pjpeg':
		case 'image/jpeg':
		case 'image/png':
		case 'image/x-png':
		case 'image/gif':
			return true;

		default:
			return false;
	}
}

// 上传图片
function img_upload($img, $img_name, $dir)
{
	if ($img['size'] > 1048576)
	{
		throw new Exception('文件大小不能大于 1M');
	}
	else if (!is_img($img['type']))
	{
		throw new Exception('只能上传jpeg、png或gif格式的图片');
	}
	else
	{
		move_uploaded_file($img['tmp_name'], "{$dir}/{$img_name}");
	}
}

// 发布新闻
function add_news()
{
	$news = trim($_POST['news']);

	if ($news == '')
	{
		throw new Exception('内容不能为空');
	}
	else
	{
		if (isset($_FILES['img']) && $_FILES['img']['name'] != '')
		{
			// 构造图片文件名
			$img_name = uniqid();
			$img_name .= '.';
			$img_name .= pathinfo(
				$_FILES['img']['name'],
				PATHINFO_EXTENSION
			);

			img_upload($_FILES['img'], $img_name, 'img/news');
		}
		else
		{
			$img_name = '';
		}

		query("
			INSERT INTO live_news(master, news, picture)
			VALUES('{$_SESSION['admin_id']}', '{$news}', '{$img_name}')
		");
	}
}

// 管理员登录
function admin_login($name, $password)
{
	$result = result(query("
		SELECT id, name, password
		FROM live_admin
		WHERE name = '{$name}'
	"));

	if (!isset($result[0]))
	{
		throw new Exception("管理员“{$name}”不存在");
	}
	else if ($result[0]['password'] != $password)
	{
		throw new Exception('密码错误');
	}
	else
	{
		$_SESSION['admin_id'] = $result[0]['id'];
		$_SESSION['admin_name'] = $result[0]['name'];
	}
}

// 管理员名称修改
function set_admin_name($id, $name)
{
	if ($name != '')
	{
		if (name_exists($name))
		{
			throw new Exception("名称“{$name}”已被使用");
		}
		else
		{
			query("
				UPDATE live_admin
				SET name = '{$name}'
				WHERE id = '{$id}'
			");
		}
	}
	else
	{
		throw new Exception("名称不能为空");
	}
}

// 管理员头像修改
function set_admin_avatar($id, $avatar)
{
	// 构造图片文件名
	$img_name = $_SESSION['admin_id'];
	$img_name .= '.';
	$img_name .= pathinfo(($_FILES['avatar']['name']), PATHINFO_EXTENSION);

	img_upload(
		$avatar,
		$img_name,
		'img/avatar'
	);

	query("
		UPDATE live_admin
		SET avatar = '{$img_name}'
		WHERE id = {$id}
	");
}

// 修改新闻内容
function news_edit($id, $news)
{
	query("UPDATE live_news SET news = '{$news}' WHERE id = {$id}");
}

// 删除新闻
function news_delete($id)
{
	query("DELETE FROM live_news WHERE id = {$id}");
}

// 删除评论
function comment_delete($id)
{
	query("DELETE FROM live_comment WHERE id = {$id}");
}

// 获取管理员信息列表
function get_admins($begin = 0, $num = 10)
{
	return result(query("SELECT * FROM live_admin LIMIT {$begin}, {$num}"));
}

// 获取用户信息列表
function get_users($begin = 0, $num = 10)
{
	return result(query("SELECT * FROM live_user LIMIT {$begin}, {$num}"));
}

// 禁言指定 id 的用户
function gag($id)
{
	query("UPDATE live_user SET gag = 1 WHERE id = {$id}");
}

// 判断一个用户是否被禁言
function is_gag($id)
{
	$result = result(query("SELECT gag FROM live_user WHERE id = {$id}"));
	return $result[0]['gag'] == 0 ? false : true;
}

// 恢复指定 ID 用户的发言
function ungag($id)
{
	query("UPDATE live_user SET gag = 0 WHERE id = {$id}");
}

// 获取指定 follow 评论数
function get_comment_num($follow = null)
{
	if ($follow == null)
	{
		$result = query("
			SELECT count(*)
			FROM live_comment
		");
	}
	else
	{
		$result = query("
			SELECT count(*)
			FROM live_comment
			WHERE follow = '{$follow}'
		");
	}

	$result = mysql_fetch_row($result);
	return $result[0];
}

// 获取新闻数
function get_news_num()
{
	$result = query("
		SELECT count(*)
		FROM live_news
	");

	$result = mysql_fetch_row($result);
	return $result[0];
}

// 获取用户数
function get_user_num()
{
	$result = query("
		SELECT count(*)
		FROM live_user
	");

	$result = mysql_fetch_row($result);
	return $result[0];
}

// 分页
function paging($url, $step, $length, $curren)
{
	echo '<p class="paging">';
	echo '<a';

	if ($curren >= $step)
	{
		$start = $curren - $step;
		echo " href='{$url}start={$start}&amp;length={$step}'";
	}
	else
	{
		echo ' class="invalid"';
	}

	echo '> &lt; </a>';

	for ($i = 0; $i < $length; $i += $step)
	{

		echo '<a';

		if ($i == $curren)
		{
			echo ' class="current"';
		}
		else
		{
			echo " href='{$url}start={$i}&amp;length={$step}'";
		}

		$cardinal = ($i / $step) + 1;
		echo "> {$cardinal} </a>";
	}

	echo '<a';

	if ($curren + $step < $length)
	{
		$start = $curren + $step;
		echo " href='{$url}start={$start}&amp;length={$step}'";
	}
	else
	{
		echo ' class="invalid"';
	}

	echo '> &gt; </a>';
	echo '</p>';
}

// 获取直播新闻，返回 PHP 数组形式
function get_live_news($start, $length)
{
	global $config;

	$data = result(query("
		SELECT
			live_admin.avatar,
			live_admin.name,
			live_news.id,
			live_news.news,
			live_news.picture,
			live_news.time
		FROM live_news, live_admin
		WHERE live_news.master = live_admin.id
		ORDER BY live_news.id DESC
		LIMIT {$start}, {$length}
	"));

	$url = urlencode($config['host']);

	for ($i = 0, $size = count($data); $i < $size; $i++)
	{
		// 新浪微博分享连接
		$title = urlencode("#{$config['topic']}# {$data[$i]['news']}");

		if ($data[$i]['picture'] == '')
		{
			$pic = '';
		}
		else
		{
			$pic = "{$url}img/news/{$data[$i]['picture']}";
		}

		$data[$i]['forwards'] = "http://service.weibo.com/share/share.php?url={$url}&amp;title={$title}&amp;pic={$pic}&amp;ralateUid={$config['ralateUid']}";

		// 评论数
		$comment_num = get_comment_num($data[$i]['id']);
		if ($comment_num == '0')
		{
			$data[$i]['comment_num'] = '';
		}
		else
		{
			$data[$i]['comment_num'] = "({$comment_num})";
		}

		$data[$i]['ago'] = ago($data[$i]['time']);
		$data[$i]['news'] = html($data[$i]['news']);
	}

	return $data;
}

// 计算经过的时间
function ago($time)
{
	$time = strtotime($time); 
	$time_diff = time() - $time;

	$second = floor($time_diff);
	$minite = floor($time_diff / 60);
	$hour = floor($time_diff / 3600);
	$day = floor($time_diff / 3600 / 24);
	$month = floor($time_diff / 3600 / 24 / 30);
	$year = floor($time_diff / 3600 / 24 / 365);

	if($year > 0)
	{
		return $year."年前";
	}
	elseif ($month>0)
	{
		return "{$month}个月前";
	}
	elseif ($day > 0)
	{
		return "{$day}天前";
	}
	elseif ($hour > 0)
	{
		return "{$hour}小时前";
	}
	elseif ($minite > 0)
	{
		return "{$minite}分钟前";
	}
	else
	{
		return '刚刚';
	}
} 

function get_live_comment($start, $length, $follow)
{
	$comment = result(query("
		SELECT
			live_user.avatar,
			live_user.name,
			live_user.id AS user_id,
			live_comment.time,
			live_comment.comment,
			live_comment.id AS comment_id
		FROM live_user, live_comment
		WHERE
			live_user.id = live_comment.user AND
			live_comment.follow = {$follow}
		ORDER BY live_comment.id DESC
		LIMIT {$start}, {$length}
	"));

	if (isset($_GET['reply']))
	{
		$id = $_GET['reply'];
		$reply = result(query("
			SELECT name
			FROM live_user
			WHERE id = '{$id}'
		"));
		$reply = "@{$reply[0]['name']} ";
	}

	for ($i = 0, $size = count($comment); $i < $size; $i++)
	{
		$comment[$i]['comment'] = html($comment[$i]['comment']);
		$comment[$i]['ago'] = ago($comment[$i]['time']);
	}

	return $comment;
}

function send_comment($comment, $follow)
{
	if (user_logined())
	{
		$user_id = $_SESSION['user_id'];

		if (is_gag($_SESSION['user_id']))
		{
			throw new Exception('禁言中');
			return;
		}
	}
	else
	{
		$user_id = 0;
	}

	if ($comment == '')
	{
		throw new Exception('不能发送空评论');
	}
	else
	{
		query("
			INSERT INTO live_comment(user, comment, follow, ip)
			VALUES(
				'{$user_id}',
				'{$comment}',
				'{$follow}',
				'{$_SERVER['REMOTE_ADDR']}'
			)
		");
	}
}

function name_exists($name)
{
	$result = result(query("
		SELECT live_user.id, live_admin.id
		FROM live_user, live_admin
		WHERE live_user.name = '{$name}' OR live_admin.name = '{$name}'
	"));

	return isset($result[0]);
}

function email_exists($email)
{
	$result = result(query("
		SELECT id
		FROM live_user
		WHERE live_user.email = '{$email}'
	"));

	return isset($result[0]);
}

?>
