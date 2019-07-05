<?php

$openid=$_GET["openid"];

$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
$mysqliObj ->query("set names 'utf8'");

$sql="SELECT count(*) FROM student WHERE openid='$openid'";
$result=$mysqliObj ->query($sql);
$arr=$result->fetch_array();
if($arr[0]!=0){
	echo "<script>alert('你已完成注册！请完善个人信息')</script>";
    echo "<script>window.location.href='http://1.393198212.applinzi.com/myinfo.php?openid=$openid'</script>";  		
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <link rel="stylesheet" href="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<div data-role="page">
    <div style="width: 100%;height: 150px;"></div>
    <div data-role="main" class="ui-content" align="center">
        <div style="width: 400px;" align="center">
            <form action="http://393198212.applinzi.com/select.php" method="get" style="width: auto">
                <div class="ui-field-contain">
                    <label for="studentname">姓名：</label>
                    <input type="text" name="studentname" id="studentname">
                </div>
                <div class="ui-field-contain">
                    <label for="ksnumber">考生号：</label>
                    <input type="text" name="ksnumber" id="ksnumber">
                </div>
                <div class="ui-field-contain">
                    <input type="submit" value="信息认证">
                    <input type="hidden" name="openid" value="<?php echo $openid; ?>">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>