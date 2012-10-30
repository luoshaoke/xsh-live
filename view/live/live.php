<script src="js/index.js" type="text/javascript"></script>
<div id="header">
	<div id="intro">
		<h2 style="text-indent: 2em;">简介：</h2>
		<p style="text-indent: 4em;">关于直播的说明，基本信息之类的。</p>
	</div>
</div>
<div id="sidebar">
	<h3 id="sina">微博直播</h3>
<?php
global $config;
echo <<< EOT
	<iframe width="250" height="500"  frameborder="0" scrolling="no" src="http://widget.weibo.com/livestream/listlive.php?language=zh_cn&width=250&height=500&uid={$config['ralateUid']}&skin=1&refer=1&appkey=&pic=0&titlebar=0&border=1&publish=1&atalk=1&recomm=0&at=0&atopic=test&ptopic={$config['topic']}&colordiy=0&dpc=1"></iframe>
EOT;
?>
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
