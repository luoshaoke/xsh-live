<h2 class="target">新闻管理</h2>

<table class="table">
	<tr class="theader">
		<th>发布者</th>
		<th>发布时间</th>
		<th>内容</th>
		<th>图片</th>
		<th>操作</th>
	</tr>

	<?php
	global $news;
	for ($i = 0, $size = count($news); $i < $size; $i++)
	{
		echo <<< EOT
		<tr>
			<td class="master diff right">
				{$news[$i]['name']}
			</td>
			<td class="time">
				{$news[$i]['time']}
			</td>
			<td class="news diff">
				<em>{$news[$i]['news']}</em>
			</td>
			<td class="picture">
EOT;

		if ($news[$i]['picture'] == '')
		{
			echo <<< EOT
			<span>无</span>
EOT;
		}
		else
		{
			echo <<< EOT
			<a href="img/news/{$news[$i]['picture']}" class="picture img" target="_blank">查看</a>
EOT;
		}

		echo <<< EOT
			</td>
			<td class="operate diff">
				<a href="?intent=admin&amp;target=modify&amp;operate=edit&amp;id={$news[$i]['id']}" class="edit" target="_blank">编辑</a>
				|
				<a href="?intent=admin&amp;target=modify&amp;operate=delete_confirm&amp;id={$news[$i]['id']}" class="delete">删除</a>
			</td>
		</tr>
EOT;
	}

	?>

</table>

<?php

global $length, $start;
$news_num = get_news_num();

if ($news_num > $length)
{
	paging(
		'?intent=admin&amp;target=modify&amp;',
		$length,
		$news_num,
		$start
	);
}

?>
