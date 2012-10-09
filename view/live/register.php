<form id="register_form" class="form register" action="?intent=live&amp;target=register" method="POST">
	<fieldset>
		<legend>注册</legend>
		<p class="email">
			<label for="email">邮箱：</label>
			<br />
			<input id="email" class="textedit" name="email" type="text" />
			<span class="ok"></span>
		</p>
		<p class="name">
			<label for="name">昵称：</label>
			<br />
			<input id="password" class="textedit" name="name" type="text" />
			<span class="error">昵称“test”已被使用</span>
		</p>
		<p class="password">
			<label for="password">密码：</label>
			<br />
			<input id="password" class="textedit" name="password" type="password" />
		</p>
		<p class="password">
			<label for="password_again">确认密码：</label>
			<br />
			<input id="password_again" class="textedit" name="password_again" type="password" />
		</p>
		<p class="submit">
			<button id="submit" type="submit" class="button">注册</button>
		</p>
	</fieldset>
</form>
