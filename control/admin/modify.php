<?php

if (admin_logined())
{
	if (isset($_GET['operate']))
	{
		switch ($_GET['operate'])
		{
			case 'edit':
				$id = (int)$_GET['id'];

				if (isset($_POST['news']))
				{
					$news = $_POST['news'];
					news_edit($id, $news);
					$message = '修改成功';
					view('message');
				}
				else
				{
					$result = result(query("
						SELECT news
						FROM live_news
						WHERE id = {$id}
					"));

					$news = $result[0]['news'];
					view('edit');
				}

				break;
			
			case 'delete_confirm':
				$id = (int)$_GET['id'];

				$warning = "
					警告：此操作不可撤销！
					<a
						class='danger'
						href='?
							intent=admin&amp;
							target=modify&amp;
							operate=delete&amp;
							id={$id}
						'
					>确定</a>
				";

				view('warning');
				break;

			case 'delete':
				news_delete((int)$_GET['id']);
				$message = '删除成功';
				view('message');
				break;
		}
	}
	else
	{
		$length = isset($_GET['length']) ? (int)$_GET['length'] : 20;
		$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

		$news = result(query("
			SELECT
				live_admin.name,
				live_news.id,
				live_news.news,
				live_news.time, 
				live_news.picture
			FROM live_news, live_admin
			WHERE live_news.master = live_admin.id
			LIMIT {$start}, {$length}
		"));

		for ($i = 0, $size = count($news); $i < $size; $i++)
		{
			$news[$i]['news'] = html($news[$i]['news']);
		}

		view('modify');
	}
}
else
{
	header('localtion:?intent=admin&target=login');
}

?>
