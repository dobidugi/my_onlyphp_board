<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    </head>
	<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<script src="jquery-3.2.1.min.js"></script>
	<script>
		$(function(){
			var i =0;
			var removecnt=0;
			var lastremovecnt=0;
			var time = document.body.offsetHeight * 50;   
		        $("a").css("color","white");
		        $("td").css("color","white");
			$("body").css("background","#363636");
			$("input").css("background","#363636");
			$("input").css("color","white");
			function init(pos,id)
			{
			    var pos;
			    $("#snow").css("background","black");
			    $("#snow").css("position","relative");
			    var img = $("<img id="+id+" src='./snow.png' width=5 height = 5>")
			    img.css("position","absolute");
			    img.css("left",pos);
			    img.appendTo(snow);
			    img.animate({
			    right: '+=150',
			    top: document.body.offsetHeight,
			    },(document.body.offsetHeight)*20);
			}
			function getPos()
			{
					return parseInt(Math.random()*(document.body.offsetWidth-0)+1);
			}
			setInterval(function()
				    {
				    for(var loop = 0; loop< (document.body.offsetWidth)/100; loop++)
				    {
				 	init(getPos(),i++);
				    }
				    },500);
			setInterval(function()
				    {
				  setTimeout(function()
				    {
					removecnt = i;
					setTimeout(function()
						    {
							 for(var del = lastremovecnt ; del < removecnt; del++)
							 {
							    $("#"+del).remove();
							 }
							 lastremovecnt = removecnt;
							 },time/2);
						    },time/2);
				    },time);
		});
	</script>
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
