<?php

session_start();
$target = isset($_GET['target']) ? $_GET['target'] : 'new';
if (!admin_logined())
{
	$target = 'login';
}
include "{$target}.php";

?>
