$(document).ready(function(){
	// 图片展示
	$('.picture a').fancybox();

	var news_num = get_news_num();
	var current_news_start = 20;

	// 查看更多新闻
	$('#showMore').click(function(){
		$this = $(this);
		$this.addClass('loading');

		$.get(
			'api.php',
			{
				intent: 'get_live_news',
				start: current_news_start,
				length: 10
			},
			function(data){
				var parent = $this.parent().parent();

				parent.before(data);
				current_news_start += 10;
				$this.removeClass('loading');
				$('a.comment').each(show_comment);

				if (current_news_start > news_num)
				{
					parent.hide();
				}
			}
		);

		return false;
	});

	// 显示评论
	$('a.comment').each(show_comment);

	function show_comment()
	{
		var $this = $(this);
		var id = parseInt($this.attr('id'));
		var $comment;

		$this.click(function(){
			
			if ($this.hasClass('loaded'))
			{
				$comment.toggle();
			}
			else
			{
				// 评论输入框
				$this.parent().parent().parent().parent().after(
					'<div class="comment" id="' + id + '_comment">' +
						'<div class="comment_form">' +
							'<div>' +
								'<textarea class="comment textedit"></textarea>' +
							'</div>' +
							'<div class="submit">' +
								'<button type="submit" class="button">发送</button>' +
							'</div>' +
						'</div>' +
					'</div>'
				);

				$comment = $('#' + id + '_comment');
				$comment_input = $('textarea.comment', $comment);
				$this.addClass('loaded');

				// Ajax 获取评论
				$.get(
					'api.php',
					{
						intent: 'get_live_comment',
						follow: id
					},
					function(data){
						$comment.append(data);

						// 回复
						$('a.reply', $comment).click(function(){
							var $username = $('strong', $(this).parent().parent().parent().parent().parent());
							var username = $username.text();
							$comment_input.val('@' + username + ' ').focus();
							return false;
						});
					}
				);

				// 发送评论
				$('button', $comment).click(function(){
					$.post(
						'api.php?intent=send_comment&follow=' + id,
						{comment: $comment_input.val()},
						function(data){
							if (data == '')
							{
								alert('评论成功');
								$comment_input.val('');
							}
							else
							{
								alert(data);
							}
						}
					);

					return false;
				});
			}

			return false;
		});
	}

	function get_news_num()
	{
		var num;

		$.ajax({
			url: 'api.php',
			data: {intent: 'get_news_num'},
			async: false,
			success: function(data){
				num = parseInt(data);
			}
		});

		return num;
	}
});
