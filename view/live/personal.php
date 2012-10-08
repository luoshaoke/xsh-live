<h2 class="target">用户信息管理</h2>

<?php

global $user_personal;

echo <<< EOT
<form action="?intent=live&amp;target=personal&amp;operate=email" method="POST" class="personal" enctype="multipart/form-data">
	<fieldset>
		<legend>邮箱修改</legend>
		<p>
			<label for="email">邮箱</label>
			<br />
			<input id="email" class="textedit" name="email" type="text" value="{$user_personal['email']}" />
		</p>
		<p class="submit">
			<button class="button" type="submit">提交更改</button>
		</p>
	</fieldset>
</form>
<br />
<form action="?intent=live&amp;target=personal&amp;operate=name" method="POST" class="personal" enctype="multipart/form-data">
	<fieldset>
		<legend>名称修改</legend>
		<p>
			<label for="name">名称：</label>
			<br />
			<input id="name" class="textedit" name="name" type="text" value="{$_SESSION['user_name']}" />
		</p>
		<p class="submit">
			<button class="button" type="submit">提交更改</button>
		</p>
	</fieldset>
</form>
<br />
<form action="?intent=live&amp;target=personal&amp;operate=avatar" method="POST" class="personal" enctype="multipart/form-data">
	<fieldset>
		<legend>头像修改</legend>
		<p class="avatar">
			<img width="96" height="96" class="avatar" src="img/avatar/{$user_personal['avatar']}" alt="头像" />
		</p>
		<p>
			<label for="avatar">上传头像：</label>
			<br />
			<input id="avatar" name="avatar" type="file" />
		</p>
		<p class="submit">
			<button class="button" type="submit">提交更改</button>
		</p>
	</fieldset>
</form>
<br/>
<form action="?intent=live&amp;target=personal&amp;operate=password" method="POST" class="personal" enctype="multipart/form-data">
	<fieldset>
		<legend>密码修改</legend>
		<p>
			<label for="password">原始密码：</label>
			<br />
			<input id="password" class="textedit" name="password_primitive" type="password" />
		</p>
		<p>
			<label for="password">新密码：</label>
			<br />
			<input id="password" class="textedit" name="password" type="password" />
		</p>
		<p>
			<label for="password_again">确认密码：</label>
			<br />
			<input id="password_again" class="textedit" name="password_again" type="password" />
		</p>
		<p class="submit">
			<button class="button" type="submit">提交更改</button>
		</p>
	</fieldset>
</form>
EOT;

?>
