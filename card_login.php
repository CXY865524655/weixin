<?php
header("Content-Type:text/html; charset=utf-8");
//$conn=mysqli_connect("localhost:3306","root","123456","vx");
$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
//mysqli_query($conn,"set names 'utf8'");
$mysqliObj ->query("set names 'utf8'");
$openid=$_GET['openid'];
$cardnum_form=$_GET['cardnum'];
$password_form=$_GET['password'];

$result=$mysqliObj ->query("select * from student where openid='$openid'");
$arr=$result->fetch_array(); 


if($arr==null){
	echo "<script>alert('请先完成注册认证！')</script>";
   	echo "<script>window.location.href='http://1.393198212.applinzi.com/information.php?openid=$openid'</script>";
}else{
    $cardnum=$arr['cardnum'];
    $password=$arr['password'];
    $qianfei=$arr['qianfei'];
	$card_money=$arr['card_money'];
    if($cardnum!=$cardnum_form || $password!=$password_form){
    	echo "<script>alert('卡号或者密码错误！')</script>";
        echo "<script>window.location.href='http://1.393198212.applinzi.com/card_momey.php?openid=$openid'</script>";
    }else{
    	echo "<script>window.location.href='http://1.393198212.applinzi.com/card_info.php?openid=$openid&cardnum=$cardnum_form&password=$password_form'</script>";
    }
}
?>