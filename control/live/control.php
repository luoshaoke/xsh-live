<?php

session_start();

if (!user_logined())
{
	$_SESSION['user_name'] = '游客';
	$_SESSION['user_id'] = 0;
	$user_logined = false;
}
else
{
	$user_logined = true;
}

$target = isset($_GET['target']) ? $_GET['target'] : 'live';
include "{$target}.php";

?>
