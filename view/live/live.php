<?php

include 'news.php';

// 查看更多的连接
global $length;
$more = $length + 20;

if ($length < get_news_num())
{
	echo <<< EOT
	<div class="more more_news">
		<p>
			<a id="showMore" href="?length={$more}" title="查看更多">查看更多</a>
		</p>
	</div>
EOT;
}

?>
