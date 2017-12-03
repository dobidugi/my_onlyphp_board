<?php
session_start();
if($_SESSION['is_log']==TRUE)
{
    header('Location: ./index.html');
    exit;
}
class serch
{
    private $email,$nick;
    public function __construct($_email,$_nick)
    {
	$this->email=$_email;
	$this->nick=$_nick;
	$this->empty_c();
    }
    private function empty_c()
    {
	if(empty($this->email))
	{
	    echo "이메일 비어있음"."<br/>";
	    ?>
	    <a href="serch.html">되돌아가기</a>
	    <?php
	    exit;
	}
	if(empty($this->nick))
	{
	    echo "닉네임 비어있음"."<br/>";
	    ?>
	    <a href="serch.html">되돌아가기</a>
	    <?php
	    exit;
	}
	$this->qu();
    }
    private function qu()
    {
	include "./dbcon.php";
	$sql = "SELECT id FROM info WHERE email='{$this->email}' and nickname='{$this->nick}'";
	$res = $conn->query($sql);
	if($res->num_rows !=0)
	{
	    $row = $res->fetch_array(MYSQLI_ASSOC);
	    if($row!=null)
	    {
		?>
		<a>당신의 아이디는 : </a>
		<?php
		echo $row['id'];
		?>
		<br/>
		<a href="login.html">로그인하로 돌아가기</a>
		<?php
	    }	
	} 
	else
	{
	    echo '찾을수없음'."<br/>";
	    ?>
	    <a href="serch.html">되돌아가기</a>
	    <?php
	}	    
    }

}
$ob = new serch($_POST['email'],$_POST['nick']);
?>
