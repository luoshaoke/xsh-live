<?php

global $data;

for ($i = 0, $size = count($data); $i < $size; $i++)
{
	echo <<< EOT
	<dl class="news">
		<dt class="admin_avatar">
			<img src="img/avatar/{$data[$i]['avatar']}" width="64" height="64" alt="头像" title="{$data[$i]['name']}" />
		</dt>
		<dd class="content">
			<div class="master">
				<span class="master">
					<strong>{$data[$i]['name']}：</strong>
				</span>
			</div>
			<p class="news">
				<em>{$data[$i]['news']}</em>
			</p>
EOT;
	
	// 显示直播图片
	if ($data[$i]['picture'] != '')
	{
		echo <<< EOT
		<div class="picture">
			<a href="img/news/{$data[$i]['picture']}" target="_blank">
				<img src="img/news/{$data[$i]['picture']}" alt="直播图片" title="查看图片" height="128" />
			</a>
		</div>
EOT;
	}

	echo <<< EOT
	<div class="bottom">
		<p>
			<span class="time" title="{$data[$i]['time']}">{$data[$i]['ago']}</span>
			<em class="operate">
				<span>
					<a href="{$data[$i]['forwards']}" class="share" title="转发到新浪微博" target="_blank">转发</a>
				</span>
				<span class="separator">|</span>
				<span>
					<a id="{$data[$i]['id']}_news" class="comment" title="评论" href="?intent=live&amp;target=comment&amp;follow={$data[$i]['id']}">评论{$data[$i]['comment_num']}</a>
				</span>
EOT;
	
	// 管理员高级操作
	if (admin_logined())
	{
		echo <<< EOT
		<span class="separator">|</span>
		<span>
			<a href="?intent=admin&amp;target=modify&amp;operate=edit&amp;id={$data[$i]['id']}" class="edit" target="_blank" title="编辑">编辑</a>
		</span>
		<span class="separator">|</span>
		<span>
			<a href="?intent=admin&amp;target=modify&amp;operate=delete_confirm&amp;id={$data[$i]['id']}" class="delete" target="_blank" title="删除">删除</a>
		</span>
EOT;
	}

	echo <<< EOT
					</em>
				</p>
				<div class="clear"></div>
			</div>
		</dd>
	</dl>
EOT;

	if ($i != $size - 1)
	{
		echo '<hr class="separator" />';
	}
}

?>
