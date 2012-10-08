<h2 class="target">用户管理</h2>
<table class="table" id="user_table">
	<tr class="theader">
		<th>呢称</th>
		<th>头像</th>
		<th>邮箱</th>
		<th>操作</th>
	</tr>

	<?php
	global $users;
	for ($i = 0, $size = count($users); $i < $size; $i++)
	{
		echo <<< EOT
		<tr>
			<td class="name diff right">
				{$users[$i]['name']}
			</td>
			<td class="avatar center">
				<a class="avatar img" href="img/avatar/{$users[$i]['avatar']}" target="_blank">查看</a>
			</td>
			<td class="email right diff">
				<a class="email" href="mailto:{$users[$i]['email']}">{$users[$i]['email']}</a>
			</td>
			<td class="operate">
				<a href="?intent=admin&amp;target=user&amp;operate={$users[$i]['gag?']}&amp;id={$users[$i]['id']}" class="_blank {$users[$i]['gag?']}">{$users[$i]['gag_txt']}</a>
			</td>
		</tr>
EOT;
	}
	?>

</table>

<?php

global $length, $start;
$user_num = get_user_num();

if ($user_num > $length)
{
	paging(
		'?intent=admin&amp;target=user&amp;',
		$length,
		$user_num,
		$start
	);
}

?>
