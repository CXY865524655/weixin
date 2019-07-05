<?php
header("Content-Type:text/html; charset=utf-8");
//$conn=mysqli_connect("localhost:3306","root","123456","vx");
$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
//mysqli_query($conn,"set names 'utf8'");
$mysqliObj ->query("set names 'utf8'");

$stnum=$_GET['stnum'];
$phone=$_GET['phone'];
$size=$_GET['size'];
$idnum=$_GET['idnum'];
$xibu=$_GET['xibu'];


$mysqliObj ->query("UPDATE student SET xibu=$xibu,phone=$phone,idnum=$idnum,size=$size WHERE stnum=$stnum");

echo "<script>alert('信息完善成功！')</script>";
?>