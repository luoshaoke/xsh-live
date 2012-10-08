<?php 
if (user_logined())
{
	if (isset($_GET['operate']))
	{
		switch ($_GET['operate'])
		{
			case 'email':
				$email = filter($_POST['email']);
				if ($email != '')
				{
					$warning = '邮箱不能为空';
					view('warning');
				}
				else
				{
					$result = result(query("
						SELECT id
						FROM live_user
						WHERE live_user.email = '{$email}'
					"));
					if (isset($result[0]))
					{
						$warning = '您输入的邮箱已被使用';
						view('warning');
					}
					else
					{
						query("
							UPDATE live_user
							SET name = '{$name}'
							WHERE id = '{$_SESSION['user_id']}'
						");
						$message = '修改成功';
						view('message');
					}
				}
				break;

			case 'name':
				$name = filter($_POST['name']);
				if ($name != $_SESSION['user_name'])
				{
					if ($name == '')
					{
						$warning = '名称不能为空';
						view('warning');
					}
					else
					{
						$result = result(query("
							SELECT id
							FROM live_user
							WHERE live_user.name = '{$name}'
						"));
						if (isset($result[0]))
						{
							$warning = '您输入的名称已被使用';
							view('warning');
						}
						else
						{
							query("
								UPDATE live_user
								SET name = '{$name}'
								WHERE id = '{$_SESSION['user_id']}'
							");
							$_SESSION['user_name'] = $name;
							$message = '修改成功';
							view('message');
						}
					}
				}
				else
				{
					default_view();
				}
				break;

			case 'avatar':
				if ($_FILES['avatar']['name'] != '')
				{
					try
					{
						$img_name = $_SESSION['user_id'];
						$img_name .= '.';
						$img_name .= pathinfo(($_FILES['avatar']['name']), PATHINFO_EXTENSION);
						img_upload(
							$_FILES['avatar'],
							$img_name,
							'img/avatar'
						);
						query("
							UPDATE live_user
							SET avatar = '{$img_name}'
							WHERE id = {$_SESSION['user_id']}
						");
						$info = '修改成功';
						view('message');
					}
					catch (Exception $e)
					{
						$waring = $e->getMessage();
						view('warning');
					}
				}
				else
				{
					default_view();
				}
				break;

			case 'password':
				$password_primitive = $_POST['password_primitive'];
				$password = filter($_POST['password']);

				if ($password_primitive != '' && $password != '')
				{
					$result = result(query("
						SELECT password
						FROM live_user
						WHERE id = '{$_SESSION['user_id']}'
					"));
					if ($result[0]['password'] == $password_primitive)
					{
						$password_again = filter($_POST['password_again']);
						if ($password == $password_again)
						{
							query("
								UPDATE live_user
								SET password = '{$password}'
								WHERE id = {$_SESSION['user_id']}
								");
							$message= '修改成功';
							view('message');
						}
						else
						{
							$warning = '两次输入的密码不一致';
							view('warning');
						}
					}
					else
					{
						$warning = '原始密码错误';
						view('warning');
					}
				}
				else
				{
					default_view();
				}
				break;
				
		}
	}
	else
	{
		default_view();
	}
}
else
{
	header('localtion:?intent=view&target=login');
}

function default_view()
{
	global $user_personal;
	$user_personal = result(query("
		SELECT email, avatar 
		FROM live_user
		WHERE id = {$_SESSION['user_id']}
	"));
	$user_personal = $user_personal[0];
	view('personal');
}

?>
