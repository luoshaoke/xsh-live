<h2 class="target">创建管理员</h2>

<form action="?intent=admin&amp;target=admin&amp;operate=new" method="POST" enctype="multipart/form-data" class="new_admin">
	<fieldset>
		<legend>创建管理员</legend>
		<p>
			<label for="name">名称：</label>
			<br />
			<input class="textedit" type="text" id="name" name="name" />
		</p>
		<p>
			<label for="password">密码：</label>
			<br />
			<input class="textedit" type="password" id="password" name="password" />
		</p>
		<p>
			<label for="password_again">确认密码：</label>
			<br />
			<input class="textedit" type="password" id="password_again" name="password_again" />
		</p>
		<div class="submit">
			<button type="submit" class="button">提交</button>
		</div>
	</fieldset>
</form>
