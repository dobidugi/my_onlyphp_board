<?php 
session_start();
unset($_SESSION['nick']);
$_SESSION['is_log'] = FALSE;
header('Location: ./index.html');
?>
