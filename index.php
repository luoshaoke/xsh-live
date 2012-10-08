<?php

include 'config.php';
include 'function.php';

$intent = isset($_GET['intent']) ? $_GET['intent'] : 'live';
include "control/{$intent}/control.php";

?> 
