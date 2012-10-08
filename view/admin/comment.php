<h2 class="target">评论管理</h2>
<table class="table">
	<tr class="theader">
		<th>用户名</th>
		<th>时间</th>
		<th>评论</th>
		<th>操作</th>
	</tr>

	<?php
	global $comment;
	for ($i = 0, $size = count($comment); $i < $size; $i++)
	{
		echo <<< EOT
		<tr>
			<td class="name diff right">
				{$comment[$i]['name']}
			</td>
			<td class="time">
				{$comment[$i]['time']}
			</td>
			<td class="comment diff">
				<em>{$comment[$i]['comment']}</em>
			</td>
			<td class="operate">
				<a class="delete" href="?intent=admin&amp;target=comment&amp;operate=delete_confirm&amp;id={$comment[$i]['id']}">删除</a>
			</td>
		</tr>
EOT;
	}
	?>

</table>

<?php

global $length, $start;
$comment_num = get_comment_num();

if ($comment_num > $length)
{
	paging(
		'?intent=admin&amp;target=comment&amp;',
		$length,
		$comment_num,
		$start
	);
}

?>
