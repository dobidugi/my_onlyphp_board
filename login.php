<html>
<body>
<?php
session_start();
if($_SESSION['is_log']==TRUE) header('Location: ./index.html');
class Login
{
    private $id,$password;
    public function __construct($_id,$_password)
    {
	if(empty($_id) || empty($_password))
	{
	    echo '아이디 또는 비밀번호가 비어있습니다.'."<br/>"; 
	    ?> 
	    <a href="./login.html">로그인페이지로이동</a>
	    <?php
	    exit;
	}
	else
	{
	    $this->id = $_id;
	    $this->password = md5($_password);
	    $this->login();    
	}
    }
    private function login()
    {
	include "./dbcon.php";
	$sql = "SELECT nickname from info WHERE id ='{$this->id}' and pass ='{$this->password}'";
	$res = $conn->query($sql);
	if($res->num_rows !=0)
	{
	    $row = $res->fetch_array(MYSQLI_ASSOC);
	    if($row!=null)
	    {
//		ini_set("session.cache_expire",15);
		$_SESSION['is_log'] = TRUE;
		echo $_SESSION['is_log'];
		$_SESSION['nick']= $row['nickname'];
		echo $_SESSION['nick'];
		$this->inputdb();
	    }
	}
	else
	{
	   echo '아이디 또는 비밀번호를 확인해주세요.'."<br/>";
	   ?>
	   <a href="./login.html">로그인페이지로이동</a>
	   <?php
	   exit;
	}
	
    }	

    private function inputdb()
    {
        include "./dbcon.php";
        $sql = "INSERT INTO login VALUES ('{$this->id}',now())";
        if($conn->query($sql))
        {
		header('Location: ./index.html');
         }
	else
        {
		echo "1";
	}
    }
}
$login=new Login($_POST['id'],$_POST['password']);
?>
</body>
</html>
