<?php
ini_set('display_errors',1);
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if($_SESSION['is_log']==TRUE)
{
    header('Location: ./index.html');
    exit;
}
class serch
{
    private $id,$email;
    public function __construct($_email,$_id)
    {
	$this->email=$_email;
	$this->id=$_id;
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
	if(empty($this->id))
	{
	    echo "아이디 비어있음"."<br/>";
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
	$sql = "SELECT age FROM info WHERE email='{$this->email}' and id='{$this->id}'";
	$res = $conn->query($sql);
	if($res->num_rows !=0)
	{
	    $_SESSION['id']=$this->id;
	    $_SESSION['email']=$this->email;
	    header('Location: ./cpass.html');
	    exit;
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
$ob = new serch($_POST['email'],$_POST['id']);
?>
