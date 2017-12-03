<?php
session_start();
$id= $_SESSION['id'];
$email= $_SESSION['email'];
$pass=md5($_POST['pass']);

include "./dbcon.php";
$sql = "UPDATE info SET pass='{$pass}' WHERE id='{$id}' and email='{$email}'";
if($conn->query($sql))
{
    unset($_SESSION['id']);
    unset($_SESSION['email']);
    echo '비밀번호 변경완료!'."<br/>";
    ?>
	<a href="login.html">로그인하로가기</a>
    <?php
}
else
{
    echo 'ㅁㅁㅁ';
}
?>
