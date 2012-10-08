<?php

$follow = (int)$_GET['follow'];

if (isset($_POST['comment']))
{
	try
	{
		send_comment($_POST['comment'], $follow);
		$message = '评论成功';
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
	$news = result(query("
		SELECT
			live_admin.avatar,
			live_admin.name,
			live_news.news,
			live_news.picture,
			live_news.time
		FROM live_news, live_admin
		WHERE
			live_news.master = live_admin.id AND
			live_news.id = {$follow}
	"));

	$news = $news[0];
	$news['ago'] = ago($news['time']);

	$start = isset($_GET['start']) ? $_GET['start'] : 0;
	$length = isset($_GET['length']) ? $_GET['length'] : 20;

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

	view('comment');
}

?>
