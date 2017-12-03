<?php
$host='localhost';
$user='root';
$pwd='tae3117';
$db='web';
$conn = new mysqli($host,$user,$pwd,$db);
if($conn->connect_error)
{
    echo 'connect error';
    exit;
}
?>
