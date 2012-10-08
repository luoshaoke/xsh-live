<?php

global $follow, $reply, $news;

echo <<< EOT
<dl class="news">
	<dt class="admin_avatar">
		<img src="img/avatar/{$news['avatar']}" width="64" height="64" alt="头像" title="{$news['name']}" />
	</dt>
	<dd class="content">
		<div class="master">
			<span class="master">
				<strong>{$news['name']}：</strong>
			</span>
		</div>
		<p class="news">
			<em>{$news['news']}</em>
		</p>
		<div class="bottom">
			<p>
				<span class="time" title="{$news['time']}">{$news['ago']}</span>
				<em class="operate">
					<span>
						<a href="#" class="share" title="转发到新浪微博" target="_blank">转发</a>
					</span>
EOT;

// 管理员高级操作
if (admin_logined())
{
	echo <<< EOT
	<span class="separator">|</span>
	<span>
		<a href="?intent=admin&amp;target=modify&amp;operate=edit&amp;id={$follow}" class="edit" title="编辑" target="_blank">编辑</a>
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

<div class="comment single">
	<form class="comment_form" action="?intent=live&amp;target=comment&amp;follow={$follow}" method="POST">
		<fieldset>
			<legend>发表评论</legend>
				<p class="textarea">
					<textarea class="comment textedit" name="comment">{$reply}</textarea>
				</p>
				<div class="submit">
					<button type="submit" class="button">发送</button>
				</div>
		</fieldset>
	</form>
	<div class="comments">
EOT;

include 'comment_base.php';

	echo <<< EOT
		</div>
	</div>
EOT;

// 查看更多的连接
global $length;
$more = $length + 20;

if ($length < get_comment_num($follow))
{
	echo <<< EOT
	<div class="more">
		<p>
			<a href="?intent=live&amp;target=comment&amp;follow={$follow}&amp;length={$more}" title="查看更多">查看更多</a>
		</p>
	</div>
EOT;
}

?>
