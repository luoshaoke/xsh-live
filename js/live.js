$(document).ready(function(){

// 图片展示
$('.picture a').fancybox();

// 查看更多新闻及评论
(function(){
	var news_num = get_news_num();
	var current_news_start = 20;

	$('a.comment').each(show_comment);

	// 查看更多新闻
	$('#showMore').click(function(){
		$this = $(this);
		$this.addClass('loading').attr('title', '加载中……');

		$.get(
			'api.php', {
				intent: 'get_live_news',
				start: current_news_start,
				length: 10
			}, function(data){
				var parent = $this.parent().parent();

				parent.before(data);
				current_news_start += 10;
				$('a.comment').each(show_comment);
				$this.removeClass('loading').attr('title', '查看更多');

				if (current_news_start > news_num)
					parent.hide();
			}
		);

		return false;
	});

	// 显示评论
	function show_comment()
	{
		var $this = $(this);
		var id = parseInt($this.attr('id'));
		var $comment;

		$this.click(function() {

			// 如果评论已加载，则只做‘隐藏/显示’切换
			if ($this.hasClass('loaded'))
			{
				$comment.toggle();
			}
			else
			{
				// 创建评论输入框
				$this.parent().parent().parent().parent().after(
					'<div class="comment" id="' + id + '_comment">' +
						'<div class="comment_form">' +
							'<div>' +
								'<textarea class="comment textedit" title="在此输入评论"></textarea>' +
							'</div>' +
							'<div class="submit">' +
								'<button type="submit" class="button">评论</button>' +
							'</div>' +
							'<br />' +
						'</div>' +
					'</div>'
				);

				$comment = $('#' + id + '_comment');
				$comment_btn = $('button', $comment);
				$comment_input = $('textarea.comment', $comment);
				$comment_input.point();
				$comment_input.keyup(function(){
					if ($(this).val() == '')
						$comment_btn.addClass('invalid');
					else
						$comment_btn.removeClass('invalid');
				});

				// 评论按钮效果
				$comment_btn.addClass('invalid').click(function(){
					if (!$(this).hasClass('invalid'))
					{
						$.post(
							'api.php?intent=send_comment&follow=' + id,
							{
								comment: $comment_input.val()
							},
							function(data) {
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
					}

					return false;
				});

				// Ajax 获取评论
				$this.addClass('loaded');

				$.get(
					'api.php', {
						intent: 'get_live_comment',
						follow: id
					}, function(data){
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
})();

// 登录验证
(function(){
	var $login_form = $('#login_form');
	var $btn_submit = $('#submit', $login_form);
	var flag = [false, false];

	$btn_submit.addClass('invalid');
	$('label', $login_form).hide();
	$('br', $login_form).hide();

	$('input.textedit', $login_form).each(function(i){
		$(this).point();

		$(this).keyup(function(){
			if ($(this).val() == '' || $(this).val() == $(this).attr('title'))
				flag[i] = false;
			else
				flag[i] = true;

			if (flag[0] && flag[1])
				$btn_submit.removeClass('invalid');
			else
				$btn_submit.addClass('invalid');
		});
	});

	$login_form.submit(function(){
		if ($btn_submit.hasClass('invalid'))
			return false;
	});
})();

// 注册表单验证
(function(){
var $register_form = $('#register_form');
if ($register_form.length != 0)
{
	var $inputs = $('input.textedit', $register_form);
	var $status_span = $('span.point', $register_form);
	var $msg = $('div.info p', $register_form);
	var $direction_li = $('ol.direction li', $register_form);
	var $btn_submit = $('#submit', $register_form);
	var selected = 0;

	$direction_li.eq(selected).show();
	$btn_submit.addClass('invalid');
	$inputs[0].focus();

	$inputs.each(function(index){
		$(this).focus(function(){
			if (selected != index)
			{
				$direction_li.eq(selected).hide();
				$inputs.eq(selected).parent().parent().removeClass('selected');
				selected = index;
			}

			$(this).parent().parent().addClass('selected');
			$direction_li.eq(index).show();
		});

		$(this).blur(function(){
			switch (index)
			{
				// 邮箱验证
				case 0:
				{
					var email = $(this).val();

					if (email == '')
					{
						warning(index, '请填写你的邮箱地址');
					}
					else
					{
						$.get(
							'api.php', {
								intent: 'email_exists',
								email: email
							}, function(response){
								if (response == '0')
									pass(index);
								else if (response == '1')
									warning(index, '该邮箱地址已被注册');

								update_btn();
							}
						);
					}

					break;
				}

				// 昵称验证
				case 1:
				{
					var name = $(this).val();

					if (name == '')
					{
						warning(index, '请填写你的昵称');
					}
					else
					{
						$.get(
							'api.php', {
								intent: 'name_exists',
								name: name
							}, function(response){
								if (response == '0')
									pass(index);
								else if (response == '1')
									warning(index, '该昵称已被使用');

								update_btn();
							}
						);
					}

					break;
				}

				// 密码验证
				case 2:
				case 3:
				{
					var password = $inputs.eq(2).val();
					var password_again = $inputs.eq(3).val();

					if (password == '')
					{
						warning(2, '请填写你的密码');
						break;
					}
					else
					{
						pass(2);
					}

					if (password_again == '')
					{
						warning(3, '请输入确认密码');
						break;
					}

					if (password != '' && password_again != '' && password != password_again)
					{
						warning(3, '两次输入的密码不一致');
						break;
					}
					else
					{
						pass(3);
					}

					break;
				}
			}

			update_btn();
		});
	});

	$register_form.submit(function(){
		if ($btn_submit.hasClass('invalid'))
			return false;
	});

	function update_btn()
	{
		if (!$status_span.hasClass('error'))
			$btn_submit.removeClass('invalid');
		else
			$btn_submit.addClass('invalid');
	}

	function pass(index)
	{
		$inputs.eq(index).prev().removeClass('error').addClass('ok');
		$msg.eq(index).text('输入正确').parent().removeClass('warning').addClass('success');
	}

	function warning(index, warning_msg)
	{
		$inputs.eq(index).prev().removeClass('ok').addClass('error').attr('title', warning_msg);
		$msg.eq(index).text(warning_msg).parent().removeClass('success').addClass('warning');
	}
}
})();


/*
// 验证登陆注册表单
(function (){

	// 检查输入是不是正确
	var check_bool = {
		email: false,
		name: false,
		password: false,
		password_again: false
	};

	// 验证方式
	var check_way = {
		email: function(){
			return $('#email').val().search(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,3}$/g) == -1;
		},
		name: function(){
			var has_name;
			$.ajax({
				url: 'api.php?intent=has_name',
				type: 'POST',
				data: {name: $('#name').val()},
				async: false,
				success: function(data){
					has_name = (data == 'had');
				}
			});
			return has_name;
		},
		password: function(){
			return $('#password').val().length <= 3
		},
		password_again: function(){
			return $('#password').val() != $('#password_again').val();
		}
	};

	// 验证邮箱
	check_error('email', '请输入正确的邮箱!', check_way.email);

	// 验证昵称
	check_error('name', '昵称已存在!', check_way.name);

	// 验证密码
	check_error('password', '密码过短', check_way.password);

	// 验证第二次密码
	check_error('password_again', '两次密码不相同!', check_way.password_again);

	// 验证绑定
	function check_error(input_name, addContent, check)
	{
		var $input_node = $('#' + input_name);

		$input_node.blur(function(){
			show_check(input_name, check);
			if (
				check_bool.email &&
				check_bool.name &&
				check_bool.password &&
				check_bool.password_again
			)
			{
				$("#submit").removeClass("invalid");
			}
			else {
				$("#submit").addClass("invalid");
			}
		});
		$input_node.focus(function(){
			hide_check(input_name);
		});
		$input_node.after(
			'<span class="error" >' +
				addContent + 
			'</span>' +
			'<span class="ok" >' +
			'</span>'
		);
		hide_check(input_name);
		$("#submit").addClass("invalid");
	}
	
	// 显示验证
	function show_check(input_name, check){
		var $input_node = $('#' + input_name);
		if ($input_node.val() == '')
		{
			eval('check_bool.' + input_name + ' = false');
		}
		else if (check())
		{
			$('p.' + input_name + ' .error').show();
			eval('check_bool.' + input_name + ' = false');
		}
		else
		{
			$('p.' + input_name + ' .ok').show();
			eval('check_bool.' + input_name + ' = true');
		}
	}
	// 隐藏验证
	function hide_check(input_name)
	{
		$('p.' + input_name + ' .error').hide();
		$('p.' + input_name + ' .ok').hide();
	}

	
	// 提交表单事件控制
	$('#register_form').submit(function(){
		if (
			check_bool.email &&
			check_bool.name &&
			check_bool.password &&
			check_bool.password_again
		)
		{
			return true;
		}
		else
		{
			show_check('email', check_way.email);
			show_check('name', check_way.name);
			show_check('password', check_way.password);
			show_check('password_again', check_way.password_again);
			return false;
		}
	});

})();
*/

});

// jquery 扩展
(function($){

// 点击后显示‘target’指向的元素，点击任意地方隐藏
$.fn.global_toggle = function(target){
	var $this = $(this);
	var $target = $(target);
	var isHide = true;

	$this.click(function(event){
		if (isHide)
		{
			$target.show();
			isHide = false;
		}
		else
		{
			$target.hide();
			isHide = true;
		}

		event.stopPropagation();
	});

	$(document).click(function(){
		if (!isHide)
		{
			$target.hide();
			isHide = true;
		}
	});
};

// 输入框内部提示信息
// 该扩展会获取输入框的‘title’值作为提示信息
// 当没有输入时，显示输入提示
// 输入框聚焦或有输入后去掉输入提示信息
$.fn.point = function(){
	var $this = $(this);
	var point_msg = $this.attr('title');
	var input_type = $this.attr('type');

	// IE下的‘type’是只读的，于是就没办法进行下去了
	// 暂时无法无法解决
	// PS. 也不是无法解决，只是很麻烦，你有空的话，就解决下吧
	if (!$.browser.msie)
	{
		$this[0].type = 'text';
	}

	$this.val(point_msg).addClass('without');

	$this.focus(function(){
		if ($this.val() == point_msg)
		{
			$this.val('');

			if (!$.browser.msie)
			{
				$this[0].type = input_type;
			}
		}

		$this.removeClass('without');
	});

	$this.blur(function(){
		if ($this.val() == '')
		{
			$this.val(point_msg).addClass('without');

			if (!$.browser.msie)
			{
				$this[0].type = 'text';
			}
		}
	});
};

// 阻尼动画切换效果
$.extend(
	$.easing, {
		easeOutExpo: function (x, t, b, c, d) {
			return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
		}
	}
);

})(jQuery);
