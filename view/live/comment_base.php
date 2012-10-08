<?php

global $comment, $follow;

for ($i = 0, $size = count($comment); $i < $size; $i++)
{
	echo <<< EOT
	<dl class="comment">
		<dt class="user_avatar">
			<img src="img/avatar/{$comment[$i]['avatar']}" width="32" height="32" alt="头像" title="{$comment[$i]['name']}" />
		</dt>
		<dd class="content">
			<div class="user">
				<span class="user">
					<strong>{$comment[$i]['name']}</strong>
				</span>
			</div>
			<p class="comment">
				<em>{$comment[$i]['comment']}</em>
			</p>
			<div class="bottom">
				<p>
					<span class="time" title="{$comment[$i]['time']}">{$comment[$i]['ago']}</span>
					<em class="operate">
						<span class="reply">
							<a href="?intent=live&amp;target=comment&amp;follow={$follow}&amp;reply={$comment[$i]['user_id']}" class="reply" title="回复">回复</a>
						</span>
EOT;

	// 管理员高级操作
	if (admin_logined())
	{
		echo <<< EOT
		<span class="separator">|</span>
		<span class="reply">
			<a href="?intent=admin&amp;target=comment&amp;operate=delete_confirm&amp;id={$comment[$i]['comment_id']}" class="delete" target="_blank" title="删除">删除</a>
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
	<hr class="separator" />
EOT;
}

?>
