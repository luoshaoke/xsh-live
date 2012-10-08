<ul>

	<?php
	global $error_msg;
	for ($i = 0; $i < count($error_msg); $i++)
	{
		echo <<< EOT
		<li>
			{$error_msg[$i]}
		</li>
EOT;
	}
	?>

</ul>
