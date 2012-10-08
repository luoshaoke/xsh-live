<?php

if (admin_logined())
{
	if (isset($_GET['operate']))
	{
		switch ($_GET['operate'])
		{
			case 'delete_confirm':
				$id = (int)$_GET['id'];

				$warning = "
					警告：此操作不可撤销！
					<a
						class='danger'
						href='?
							intent=admin&amp;
							target=comment&amp;
							operate=delete&amp;
							id={$id}
						'
					>确定</a>
				";

				view('warning');
				break;

			case 'delete':
				comment_delete((int)$_GET['id']);
				$message = '删除成功';
				view('message');
				break;
		}
	}
	else
	{
		$length = isset($_GET['length']) ? (int)$_GET['length'] : 20;
		$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

		$comment = result(query("
			SELECT
				live_user.name,
				live_comment.id,
				live_comment.comment,
				live_comment.time
			FROM live_user, live_comment
			WHERE live_user.id = live_comment.user
			LIMIT {$start}, {$length}
		"));

		for ($i = 0, $size = count($comment); $i < $size; $i++)
		{
			$comment[$i]['comment'] = html($comment[$i]['comment']);
		}

		view('comment');
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

?>
