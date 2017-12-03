<?php
class Make
{
    private $id,$password,$email,$nick,$age;
    public function __construct($_id,$_password,$_email,$_nick,$_age)
    {
	$this->id = $_id;
	$this->password = md5($_password);
	$this->email = $_email;
	$this->nick = $_nick;
	$this->age = $_age;
	$this->empty_c();
    }

    private function  empty_c()
    {
	if(preg_match("/[^a-z0-9-_]/i", $this->id)) 
	{
	     echo "아이디는 영문, 숫자, -, _ 만 사용할 수 있습니다."."<br/>";
	     ?>
	     <a href="make.html">되돌아가기</a>
	     <?php	 
	     exit;
	}
	if(preg_match("/[^a-z0-9-_]/i",$this->nick))
	{
	    echo "닉네임은 영문,숫자,-,_만 사용하실수 있습니다."."<br/>";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?php
	    exit;
	}
	if(empty($this->id))
	{
	    echo "아이디 비어있음"."<br/>";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?php
	    exit;
	}
	if(empty($this->password))
	{
	    echo "비밀번호 비어있음";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?
	    exit;
	}
	if(empty($this->email))
	{
	    echo "이메일 비어있음"."<br/>";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?php
	    exit;
	}
	if(empty($this->nick))
	{
	    echo "닉네임 비어있음"."<br/>";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?php
	    exit;
	}
	if(empty($this->age))
	{
	    echo "나이 비어있음"."<br/>";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?php
	    exit;
	}
	$this->repetition();
    }
    private function repetition()
    {
	include "./dbcon.php";
	$sql = "SELECT * FROM info WHERE id='{$this->id}'";
	$res = $conn->query($sql);
	if($res->num_rows >=1)
	{
	    echo '이미 사용하는중인 아이디'."<br/>";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?php
	    exit;
	}
	$sql = "SELECT * FROM info WHERE nickname='{$this->nick}'";
	$res = $conn->query($sql);
	if($res->num_rows >=1)
	{
	    echo '이미 사용중인 닉네임'."<br/>";
	    ?>
	    <a href="make.html">되돌아가기</a>
	    <?php
	    exit;
	}
	$sql = "SELECT * FROM info WHERE email='{$this->email}'";
	$res = $conn->query($sql);
	if($res->num_rows >=1)
	{
	    echo '이미 사용중인 이메일';
	    exit;
	}
	$this->make();
    }
    private function make()
    {
	include "./dbcon.php";
	$sql = "INSERT INTO info VALUES('$this->id','$this->password','$this->email','$this->nick','$this->age',now())";
	if($conn->query($sql))
	{
	    echo $this->nick.'님 회원가입이 성공적으로 이루어졌습니다.';
	    ?>
	    <a href="index.html">홈페이지로 이동</a>
	    <?php
	}
    }
}

$nn = new Make($_POST['id'],$_POST['pass'],$_POST['email'],$_POST['nick'],$_POST['age']);
?>
