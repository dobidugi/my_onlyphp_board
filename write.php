<?php
session_start();
if($_SESSION['is_log']==FALSE)
{
    header('Location: ./login.html');
    exit;
}
class write
{
    private $sub,$main,$dir,$numc;
    public function __construct($_sub,$_main,$_nick)
    {	
	$this->sub=$_sub;
	$this->main=$_main;
	$this->nick=$_nick;
	$this->empty_c();
    }
    private function empty_c()
    {
	if(empty($this->sub))
	{
	    echo '제목이 비어있습니다'."<br/>";
	    ?>
	    <a href="write.html">되돌아가기</a>
	    <?php
	    exit;
	}
	if(empty($this->main))
	{
	    echo '내용이 비어있습니다'."<br/>";
	    ?>
	    <a href="write.html">되돌아가기</a>
	    <?php
	    exit;
	}
	$this->file();
	
    }
    private function file()
    {
    	$uploaddir = './upload/';
	$uploaddir = $uploaddir.$_SESSION['nick']."/";
	if(!is_dir($uploaddir))
	{
	    mkdir($uploaddir,0300,true);
	}
	$_dir=$uploaddir.$_FILES['userfile']['name'];
	$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
	if(!empty($_FILES['userfile']['name']))
	{
	    if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile))
	    {
		 $this->dir=$_dir;
		 $this->db();
	    }
	    else
	    {
		 echo '파일 업로드실패 공격의 가능성이 높습니다';
	    }
	}
	else
	{
	    $this->dir = NULL;
	    $this->db();
	}
    }
    private function db()
    {
	include "./dbcon.php";
	$sql = "SELECT count from count";
	$res = $conn->query($sql);
	if($res->num_rows !=0)
	{
	    $row = $res->fetch_array(MYSQLI_ASSOC);
	    if($row!=0)
	    {
		$this->numc=$row['count'];
	    }
	    $sql = "INSERT INTO board VALUES ('{$this->numc}','{$this->sub}','{$this->main}','{$this->nick}','{$this->dir}',0,now())";
	    if($conn->query($sql))
	    {
		$this->numc = $this->numc +1;
		$sql = "UPDATE count SET count='{$this->numc}'";
		$conn->query($sql);
		header('Location: ./index.html');
	    }
	}
	else
	{
	    echo '실패';
	}
    }
}
$ob = new write($_POST['subject'],$_POST['main'],$_SESSION['nick']);
?>
