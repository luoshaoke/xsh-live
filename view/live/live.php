<script src="js/index.js" type="text/javascript"></script>
<div id="header">
	<div id="intro">
		<h2 style="text-indent: 2em;">简介：</h2>
		<p style="text-indent: 4em;">关于直播的说明，基本信息之类的。</p>
	</div>
</div>

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
