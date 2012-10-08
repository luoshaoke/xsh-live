<?php

session_start();
$target = isset($_GET['target']) ? $_GET['target'] : 'live';
include "{$target}.php";

?>
