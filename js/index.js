$(document).ready(function(){

$('#toolbar .center').append(
	'<p>' +
		'<a href="#" class="up" id="btn_up" title="上一条">上一条</a>' +
		'<a href="#" class="top" id="btn_top" title="返回顶部">返回顶部</a>' +
		'<a href="#" class="down" id="btn_down" title="下一条">下一条</a>' +
	'</p>'
).css('display', 'inline-block');

// 控制按钮，上下翻页，回到首页
(function(){

	// 按钮点击事件
	$('#btn_down').click(function(){
		goto_news('down');
		return false;
	});
	$('#btn_up').click(function(){
		goto_news('up');
		return false;
	});
	$('#btn_top').click(function(){
		goto_news('top');
		return false;
	});

	// 两次移动重叠发生时
	var num; // 上次的位置
	var move_timeout = null; // 是否在移动,null表示不在移动
	var dir; // 移动的方向

	// 跳转新闻
	function goto_news(arg)
	{
		// 兼容获得body
		var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
		var scrollTop = $(window).scrollTop();
		// 动画参数
		options = {
			duration: 3000,
			easing: 'easeOutExpo',
			queue: false
		};

		var i = 0;

		// 表示 计算目前所在第几个新闻时 的 允许偏移
		var diff = 20;

		if (move_timeout == null || arg != dir)
		{
			// i = 目前所在新闻序号
			for (; i < $('#body > .news').length; i++)
			{
				var i_top = $("#body > .news:eq(" + i + ")").offset().top;
				if (i_top - scrollTop >= diff) {
					if (arg != 'up') i--;
					break;
				}
				if (i_top - scrollTop < diff && i_top - scrollTop > - diff) break;
			}
		}
		else {
			// 两次移动重叠发生时
			if (arg == 'up') i = --num;
			else if (arg == "down") i = ++num;
		}

		// 记录上次的移动
		dir = arg;
		num = i;

		// i = 要跳到新闻的offset().top
		switch (arg)
		{
			case 'up': 
				i = (i <= 0) ? 0 : $("#body > .news:eq(" + (i - 1) + ")").offset().top;
				break;
			case 'down':
				i = $("#body > .news:eq(" + (i + 1) + ")").offset().top;
				break;
			case 'top':
				i = 0;
				break;
			case 'bottom':
				i = $(document).height();
				break;
		}

		// 回调函数
		clearTimeout(move_timeout);
		move_timeout = setTimeout(function(){
			move_timeout = null;
		}, options.duration);

		// 执行动画
		$body.stop(); 
		$body.animate({scrollTop: i}, options);
	}
})();

});
