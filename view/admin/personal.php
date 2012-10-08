<h2 class="target">个人信息管理</h2>

<?php
global $personal;
echo <<< EOT
<form id="name_form" action="?intent=admin&amp;target=personal&amp;operate=name" method="POST" class="personal" enctype="multipart/form-data">
	<fieldset>
		<legend>名称修改</legend>
		<p>
			<label for="name_input">名称：</label>
			<br />
			<input id="name_input" class="textedit" name="name" type="text" value="{$_SESSION['admin_name']}" />
		</p>
		<div class="submit">
			<button class="button" type="submit">提交更改</button>
		</div>
	</fieldset>
</form>

<br />

<form id="avatar_form" action="?intent=admin&amp;target=personal&amp;operate=avatar" method="POST" class="personal" enctype="multipart/form-data">
	<fieldset>
		<legend>头像修改</legend>
		<p class="avatar">
			<img width="96" height="96" class="avatar" src="img/avatar/{$personal['avatar']}" alt="头像" />
		</p>
		<p>
			<label for="avatar_input">上传头像：</label>
			<br />
			<input id="avatar_input" name="avatar" type="file" />
		</p>
		<div class="submit">
			<button class="button" type="submit">提交更改</button>
		</div>
	</fieldset>
</form>

<br/>

<form id="password_form" action="?intent=admin&amp;target=personal&amp;operate=password" method="POST" class="personal" enctype="multipart/form-data">
	<fieldset>
		<legend>密码修改</legend>
		<p>
			<label for="password_input">新密码：</label>
			<br />
			<input id="password_input" class="textedit" name="password" type="password" />
		</p>
		<p>
			<label for="password_again_input">确认密码：</label>
			<br />
			<input id="password_again_input" class="textedit" name="password_again" type="password" />
		</p>
		<div class="submit">
			<button class="button" type="submit">提交更改</button>
		</div>
	</fieldset>
</form>
EOT;
?>
