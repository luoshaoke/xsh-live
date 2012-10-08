<h2 class="target">转发设置</h2>

<?php

global $config;
echo <<< EOT
<form action="?intent=admin&amp;target=forwards" method="POST" class="forwards">
	<fieldset>
		<legend>转发设置</legend>
		<p>
			<label for="ralateUid_input">关联UID：</label>
			<br />
			<input class="textedit" type="text" id="ralateUid_input" name="ralateUid" value="{$config['ralateUid']}" />
		</p>
		<p>
			<label for="host_input">URL：</label>
			<br />
			<input class="textedit" type="text" id="host_input" name="host" value="{$config['host']}" />
		</p>
		<p>
			<label for="topic_input">话题：</label>
			<br />
			<input class="textedit" type="text" id="topic_input" name="topic" value="{$config['topic']}" />
		</p>
		<div class="submit">
			<button type="submit" class="button">修改</button>
		</div>
	</fieldset>
</form>
EOT;

?>
