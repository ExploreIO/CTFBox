<?php
$log = file_get_contents("/var/www/logs.txt");
$flag = '<>' . htmlspecialchars(getenv('GZCTF_FLAG'), ENT_QUOTES, 'UTF-8') . '<>';
?>