<?php 
header("Content-Type:text/html; charset=utf-8");
//$conn=mysqli_connect("localhost:3306","root","123456","vx");
$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
//mysqli_query($conn,"set names 'utf8'");
$mysqliObj ->query("set names 'utf8'");
$openid=$_GET['openid'];
$result=$mysqliObj ->query("select * from student where openid='$openid'");
$arr=$result->fetch_array(); 
if($arr==null){
	echo "<script>alert('请先完成注册认证！')</script>";
   	echo "<script>window.location.href='http://1.393198212.applinzi.com/information.php?openid=$openid'</script>";
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
            <form action="http://1.393198212.applinzi.com/card_login.php" method="get" style="width: auto">
                <div class="ui-field-contain">
                    <label for="stnum">卡号：</label>
                    <input type="text" name="cardnum" id="cardnum" placeholder="卡号&学号">
                </div>
                <div class="ui-field-contain">
                    <label for="password">密码：</label>
                    <input type="text" name="password" id="password">
                </div>
                <div class="ui-field-contain">
                    <input type="submit" value="登陆">
                    <input type="hidden" name="openid" value="<?php echo $openid; ?>">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
                        