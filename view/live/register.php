<div class="wrap">
	<form id="register_form" class="form register" action="?intent=live&amp;target=register" method="POST">
		<fieldset>
			<legend>注册</legend>
			<ol class="direction">
				<li class="email">
					<h3>邮箱</h3>
					<p>作为你的帐号，此外，一些重要信息会通过此地址发送给你。</p>
					<div class="info warning">
						<p>请填写你的邮箱地址</p>
					</div>
				</li>
				<li class="name">
					<h3>昵称</h3>
					<p>作为你的标识，在评论中显示，可修改。</p>
					<div class="info warning">
						<p>请填写你的昵称</p>
					</div>
				</li>
				<li class="password">
					<h3>密码</h3>
					<p>我们懒得对你的密码做限制，请自行选择一个合适的密码。</p>
					<div class="info warning">
						<p>请填写你的密码</p>
					</div>
				</li>
				<li class="password_again">
					<h3>确认密码</h3>
					<p>再次输入密码以确认。</p>
					<div class="info warning">
						<p>请输入确认密码</p>
					</div>
				</li>
			</ol>
			<ol class="input">
				<li class="email selected">
					<p>
						<label for="email">邮箱：</label>
						<br />
						<span class="point error" title="请填写你的邮箱地址"></span>
						<input id="email" class="textedit" name="email" type="text" title="邮箱" tabindex="1" />
					</p>
				</li>
				<li class="name">
					<p>
						<label for="name">昵称：</label>
						<br />
						<span class="point error" title="请填写你的昵称"></span>
						<input id="name" class="textedit" name="name" type="text" title="昵称" tabindex="2" />
					</p>
				</li>
				<li class="password">
					<p>
						<label for="password">密码：</label>
						<br />
						<span class="point error" title="请填写你的密码"></span>
						<input id="password" class="textedit" name="password" type="password" title="密码" tabindex="3" />
					</p>
				</li>
				<li class="password_again">
					<p>
						<label for="password_again">确认密码：</label>
						<br />
						<span class="point error" title="请输入确认密码"></span>
						<input id="password_again" class="textedit" name="password_again" type="password" title="确认密码" tabindex="4" />
					</p>
				</li>
			</ol>
			<div class="submit">
				<button id="submit" type="submit" class="button">注册</button>
			</div>
		</fieldset>
	</form>
</div>
