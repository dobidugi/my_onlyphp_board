<?php
session_start();
class read
{
    private $num,$sub,$main,$nick,$see,$time,$file;
    public function __construct($_num)
    {
	$this->num = $_num;
	$this->empty_c();
    }
    private function empty_c()
    {
	if(empty($this->num))
	{
	    echo "잘못된접근"."<br/>";
	    ?>
	    <a href="./index.html">홈페이지로</a>
	    <?php
	    exit;
	}
	else
	{
	    $this->db();	    
	}
    }
    private function db()
    {
	include "./dbcon.php";
	$sql = "SELECT * FROM board WHERE num='{$this->num}'";
	$res = $conn->query($sql);
	if($res->num_rows!=0)
	{
	    $row = $res->fetch_array(MYSQLI_ASSOC);
	    $this->sub = $row['subj'];
	    $this->main = $row['main'];
	    $this->nick = $row['nickname'];
	    $this->file = $row['file'];
	    $this->see = $row['see'];
	    $this->time = $row['time'];
	    $this->see = $this->see + 1;
	    $conn->query("UPDATE board SET see='{$this->see}' WHERE num='{$this->num}'");
	}
	else
	{   
	    echo "존재하지 않거나 삭제된 글입니다."."<br/>";
	    ?>
	    <a href="./index.html">홈페이지로</a>
	    <?php
	    exit;
	}
    }
    public function nick()
    {
	echo $this->nick;
    }
    public function sub()
    {
	echo $this->sub;
    }
    public function main_()
    {
	echo $this->main;
    }
    public function see()
    {
	echo $this->see;
    }
    public function file()
    {
	if($this->file !=NULL)
	{
	    echo '<a href="./download.php?num='.$this->num.'">'.$this->file."</a>";
	}
	else
	{
	    echo "첨부된 파일이 없습니다.";
	}
    }
    public function time()
    {
	echo $this->time;
    }
    public function rnick()
    {
	return $this->nick;
    }
    public function num()
    {
	echo $this->num;
    }
};
$obj = new read($_GET['num']);
?>
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
	<div id="snow"> </div>
    <div>	
	<table border="1px" height="500" width="500">
	    <tr>
		<td align="center" width = "15%" height="10%">작성자</td><td width="85"><?php $obj->nick(); ?></td>
	    </tr>
	    <tr>    
		<td align="center" height="10%">조회수</td><td><?php $obj->see();?></td>
	    </tr>
	    <tr>
		<td align="center" height="10%"> 제목</td><td><?php $obj->sub(); ?></td>
	    </tr>
	    <tr>
		 <td align="center" height="50%">내용</td><td><?php $obj->main_(); ?></td>
	    </tr>
	    <tr>
		<td align="center" height="10%">파일</td><td><?php $obj->file();?></td>
	    </tr>
	    <tr>
		<td align="center"  HEIGHT="10%">작성시간</td><td><?php $obj->time(); ?></td>
	    </tr>
	</table>
	<?php
	if(!strcmp($_SESSION['nick'],$obj->rnick()))
	{
	    ?>
	    <input type="button" onclick="window.open('./modify.php?num=<?php echo $obj->num();?>')" value="글수정">
	    <input type="button" onclick="window.open('./del.php?num=<?php echo $obj->num();?>')" value="글삭제">
	    <?php
	}
	?>
	</div>
    </body>
</html>
