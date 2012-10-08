$(document).ready(function(){
	var admin_name;
	var admin_id;

	$.get('api.php?intent=get_admin_info', function(data){
		admin_name = data.admin_name;
		admin_id = data.admin_id;
	}, 'json');

	/*
	var password_warning = $(
		'<div class="info warning">' +
			'<p>密码不一致</p>' +
		'</div>'
	);

	$('#password_again').blur(function(){
		var password = $('#password').val();
		var password_again = $(this).val();

		if (password != password_again)
		{
			$(this).parent().after(password_warning);
		}
		else
		{
			$(password_warning).remove();
		}
	});
	*/

	$('#name_form').submit(function(){
		var name = $('#name_input').val();

		if (name == '')
		{
			alert('名称不能空');
			$('#name_input').val(admin_name);
		}
		else if (name != admin_name)
		{
			$.post(
				'api.php?intent=set_admin_name',
				{
					name: name
				},
				function(response){
					if (response != '')
					{
						alert(response);
					}
					else
					{
						alert('修改成功');
						admin_name = name;
					}
				}
			);
		}

		return false;
	});

	$('#password_form').submit(function(){
		var password = $('#password_input').val();
		var password_again = $('#password_again_input').val();

		if (password != password_again)
		{
			alert('密码不一致');
		}
		else if (password != '')
		{
			$.post(
				'api.php?intent=set_admin_password',
				{
					password: password,
				},
				function(response){
					if (response != '')
					{
						alert(response);
					}
					else
					{
						alert('修改成功');
					}
				}
			);
		}

		return false;
	});

	// 其实……这段代码没啥用
	$('#avatar_form').submit(function(){
		if ($('#avatar_input').val() == '')
		{
			return false;
		}
	});

	$('.table tr').mouseover(function(){
		$('td', this).addClass('hover');
	}).mouseout(function(){
		$('td', this).removeClass('hover');
	});

	// 查看图片
	$('a.img').fancybox();
});
