<?php
highlight_file(__FILE__);
session_start();
if (!isset($_SESSION['username'])) {
    die('我好像不知道你是谁，不能告诉你秘密');
}else{
    echo'欢迎'.$_SESSION['username'];
}
?>