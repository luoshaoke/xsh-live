<h2 class="target">发布新闻</h2>

<form class="news" action="?intent=admin&amp;target=new" method="POST" enctype="multipart/form-data">
	<fieldset>
		<legend>发布新闻</legend>
		<p class="news">
			<label for="news">内容：</label>
			<br />
			<textarea id="news" class="textedit" name="news"></textarea>
		</p>
		<p class="img">
			<label for="img">图片：</label>
			<br />
			<input id="img" name="img" type="file" />
		</p>
		<div class="submit">
			<button type="submit" class="button">发布</button>
		</div>
	</fieldset>
</form>
