<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    </head>
    <body> 
    <?php 
    session_start();
    include "./dbcon.php";
    $sql = "SELECT nickname,subj,main FROM board WHERE nickname='{$_SESSION['nick']}' and num={$_GET['num']} ";
    if($res = $conn->query($sql))
    {
	if($res->num_rows !=0)
	{
	    $row = $res->fetch_array(MYSQLI_ASSOC);
	    if(!strcmp($_SESSION['nick'],$row['nickname']))
	    {
		//
	    }
	    else
	    {
		header('Location: ./index.html');
		exit;
	    }
	    
	}
	else
	{
	    header('Location: ./index.html');
	    exit;
	}
    }
    else
    {   
	header('Location: ./index.html');
	exit;
    }   
    ?>
	<form enctype ="multipart/form-data"  method="POST" action="./modify2.php?num=<?php echo $_GET['num'] ?>"> 
	<table border="1px">
	    <tr>
		<td>제목</td><td><input type="text" size=98 maxlength=12  name="subject" value="<?php echo $row['subj']?>"></td>
	    </tr>
	    <tr>
		<td>내용</td><td><textarea rows=30 cols=100 maxlength=500  name="main" ><?php echo $row['main']?></textarea></td>
	    </tr>
	    <tr>
		<td>파일</td>
		<td>
		<input type="hidden" name="MAX_FILE_SIZE" value="300000"/>
		<input style="width:80%" type="file" name="userfile"/>
		</td>
	    </tr>
	    <tr>
		<td></td><td><input type="submit" style="width:100%" value="수정"></td>
	    </tr>
	</table>
	</form>
    </body>
</html>
