<?php
include 'AES.php';
@$m = $_SERVER['argv'][1];
@$d = $_SERVER['argv'][2];
@$c = $_SERVER['argv'][3];
strlen($m) * strlen($d) * strlen($c) || die('!eid');
echo (new AES($d))->$m($c);