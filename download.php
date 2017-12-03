<?php
include "./dbcon.php";
$sql = "SELECT file FROM board WHERE num='{$_GET['num']}'";
if($res = $conn->query($sql))
{
   if($res->num_rows!=0)
   {
	$row = $res->fetch_array(MYSQLI_ASSOC);
	if(!empty($row['file']))
	{
	     Header("Content-type: application/x-msdownload"); 
	     Header("Content-Disposition: attachment; filename=".$row['file'].""); 
	     Header("Content-Transfer-Encoding: binary"); 
	     Header("Pragma: no-cache"); 
             Header("Expires: 0"); 
             $handle = fopen($row['file'], "r"); 
             while(!feof($handle)){ 
              echo fread($handle,4096); 
             }; 
	}
	else
	{
	    header('Location: ./index.html');
	}
   }
}

//$row = $res->fetch_array(MYSQLI_ASSOC);
echo $row['file'];

?>
