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

	// 跳转新闻
	function goto_news(arg)
	{
		$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
		var scrollTop = $(window).scrollTop();
		options = {
			duration: 'slow',
			easing: 'easeOutExpo',
			queue: false
		};
		var i = 0;
		var diff = 20;
		for (; i < $('#body > .news').length; i++)
		{
			var i_top = $("#body > .news:eq(" + i + ")").offset().top;
			if (i_top - scrollTop >= diff) {
				if (arg != 'up') i--;
				break;
			}
			if (i_top - scrollTop < diff && i_top - scrollTop > - diff) break;
		}
		if (i == -1) i = 0;
		switch (arg)
		{
			case 'up': 
				i = (i == 0 || i == 1) ? 0 : $("#body > .news:eq(" + (i - 1) + ")").offset().top;
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
		$body.animate({scrollTop: i}, options);
	}
})();

});
