<h2 class="target">编辑新闻</h2>

<?php
global $news, $id;
echo <<< EOT
<form class="edit" action="?intent=admin&amp;target=modify&amp;operate=edit&amp;id={$id}" method="POST">
	<fieldset>
		<legend>编辑</legend>
		<p class="news">
			<textarea id="news" name="news" class="textedit">{$news}</textarea>
		</p>
		<div class="submit">
			<button class="button" type="submit">保存</button>
		</div>
	</fieldset>
</form>
EOT;
?>
