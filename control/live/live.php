<?php

$length = isset($_GET['length']) ? (int)$_GET['length'] : 20;
$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;
$data = get_live_news($start, $length);
view('live');

?>
