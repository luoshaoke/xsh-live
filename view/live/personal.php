<h2 class="target">用户信息管理</h2>

<?php

global $user_personal;

echo <<< EOT
<div class="personal_wrap">
<div class="left">
<form action="?intent=live&amp;target=personal&amp;operate=email" method="POST" class="personal mail" enctype="multipart/form-data">
	<fieldset>
		<legend>邮箱修改</legend>
		<p>
			<label for="email">邮箱：</label>
			<input id="email" class="textedit" name="email" type="text" value="{$user_personal['email']}" />
			<button class="button" type="submit">更改邮箱</button>
		</p>
	</fieldset>
</form>
<form action="?intent=live&amp;target=personal&amp;operate=name" method="POST" class="personal name" enctype="multipart/form-data">
	<fieldset>
		<legend>名称修改</legend>
		<p>
			<label for="name">名称：</label>
			<input id="name" class="textedit" name="name" type="text" value="{$_SESSION['user_name']}" />
			<button class="button" type="submit">更改名称</button>
		</p>
	</fieldset>
</form>
<form action="?intent=live&amp;target=personal&amp;operate=password" method="POST" class="personal password" enctype="multipart/form-data">
	<fieldset>
		<legend>密码修改</legend>
		<p>
			<label for="password">原始密码：</label>
			<input id="password" class="textedit" name="password_primitive" type="password" />
		<p>
			<label for="password">新密码　：</label>
			<input id="password" class="textedit" name="password" type="password" />
		</p>
		<p>
			<label for="password_again">确认密码：</label>
			<input id="password_again" class="textedit" name="password_again" type="password" />
		</p>
		<p class="submit">
			<button class="button" type="submit">更改密码</button>
		</p>
	</fieldset>
</form>
</div>
<form action="?intent=live&amp;target=personal&amp;operate=avatar" method="POST" class="personal avatar" enctype="multipart/form-data">
<div class="clear"></div>
	<fieldset>
		<legend>头像修改</legend>
		<p class="avatar">
			<img width="150" height="150" class="avatar" src="img/avatar/{$user_personal['avatar']}" alt="头像" />
			<br />
			<label for="avatar">上传图片：</label>
			<input id="avatar" name="avatar" type="file" />
			<br />
			<br />
			<button class="button" type="submit">更改头像</button>
		</p>
	</fieldset>
</form>
<div class="clear"></div>
</div>
EOT;

?>
