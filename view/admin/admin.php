<h2 class="target">管理员管理</h2>
<div id="admin_wrap">
	<dl class="admin">

		<?php
		// 显示管理员列表
		global $admin;
		for ($i = 0, $size = count($admin); $i < $size; $i++)
		{
			echo <<< EOT
			<dd>
				<div class="avatar">
					<img class="avatar" width="96" height="96" alt="头像" src="img/avatar/{$admin[$i]['avatar']}" title="{$admin[$i]['name']}" />
				</div>
				<p class="name">
					<strong>{$admin[$i]['name']}</strong>
				</p>
			</dd>
EOT;
		}
		?>

	</dl>
	<div class="new_admin">
		<p>
			<em>
				<a href="?intent=admin&amp;target=admin&amp;operate=new">创建管理员</a>
			</em>
		</p>
	</div>
</div>
