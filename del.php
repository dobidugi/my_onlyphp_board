<?php
session_start();
include "./dbcon.php";
$sql = "DELETE FROM board WHERE num='{$_GET['num']}' and nickname='{$_SESSION['nick']}'";
$conn->query($sql);
header ('Location: ./index.html');
?>
