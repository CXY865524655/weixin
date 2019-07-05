<?php
header("Content-Type:text/html; charset=utf-8");
//$conn=mysqli_connect("localhost:3306","root","123456","vx");
$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
//mysqli_query($conn,"set names 'utf8'");
$mysqliObj ->query("set names 'utf8'");

$ksnumber=$_GET["ksnumber"];
$studentname=$_GET["studentname"];

//openid;
$openid=$_GET["openid"];

$sql1="SELECT COUNT(*) ,stnum ,sex FROM student WHERE ksnum='$ksnumber' AND name='$studentname'";

$result1=$mysqliObj ->query($sql1);
$arr1=$result1->fetch_array();
$sex=$arr1[2];



if($arr1[0]>0){

    if($arr1[1]==null){
        $info=$mysqliObj ->query("SELECT MAX(stnum) FROM student");
        $num = $info->fetch_array();
        $stnum = $num[0] + 1;    
        
        //添加宿舍
        if($sex=="男"){
        	$sql2="SELECT MIN(room),bed FROM boyroom WHERE bed>0";
            $result2=$mysqliObj ->query($sql2);
			$arr2=$result2->fetch_array();
            $boyroom=$arr2[0];
            $boybed=$arr2[1]-1;
            $mysqliObj ->query("UPDATE boyroom SET bed=$boybed WHERE room=$boyroom");
            $mysqliObj ->query("UPDATE student SET stnum=$stnum,openid='$openid',room=$boyroom WHERE ksnum=$ksnumber");       
        }else{
        	$sql3="SELECT MIN(room),bed FROM girlroom WHERE bed>0";
            $result3=$mysqliObj ->query($sql3);
			$arr3=$result3->fetch_array();
            $girlroom=$arr3[0];
            $girlbed=$arr3[1]-1;
            $mysqliObj ->query("UPDATE girlroom SET bed=$girlbed WHERE room=$girlroom");
            $mysqliObj ->query("UPDATE student SET stnum=$stnum,openid='$openid',room=$girlroom WHERE ksnum=$ksnumber");
        }
        
        //添加校园一卡通
        $sql3="SELECT MAX(cardnum) FROM student";
            $result3=$mysqliObj ->query($sql3);
			$arr3=$result3->fetch_array();
            $cardnum=$arr3[0]+1;         
            $mysqliObj ->query("UPDATE student SET cardnum=$cardnum WHERE ksnum=$ksnumber");
        	$mysqliObj ->query("UPDATE student SET password=123456 WHERE ksnum=$ksnumber");
       		$mysqliObj ->query("UPDATE student SET card_money=0 WHERE ksnum=$ksnumber");
        	$mysqliObj ->query("UPDATE student SET qianfei=20000 WHERE ksnum=$ksnumber");
                  
        echo "<script>alert('信息认证成功，请完善个人信息！')</script>";
        
    }else{
        
        echo "<script>alert('信息已认证完毕，请完善个人信息！')</script>";

        }
}else{
    
    echo "<script>alert('信息认证错误，请认真核实信息！')</script>";


}


?>