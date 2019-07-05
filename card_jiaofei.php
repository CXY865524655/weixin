<?php
header("Content-Type:text/html; charset=utf-8");
//$conn=mysqli_connect("localhost:3306","root","123456","vx");
$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
//mysqli_query($conn,"set names 'utf8'");
$mysqliObj ->query("set names 'utf8'");
$openid=$_GET['openid'];
$cardnum=$_GET['cardnum'];

$result=$mysqliObj ->query("select * from student where openid='$openid'");
$arr=$result->fetch_array(); 
$jiaofei=$_GET['jiaofei']+0;
$card_money=$_GET['card_money']+0;

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
            <form action="http://1.393198212.applinzi.com/card_info.php" method="get" style="width: auto">
                
                <div class="ui-field-contain">
                    <?php if($jiaofei==0){
						$label="无需缴费！";	
					}else if($jiaofei > $card_money){
						$label="余额不足，请充值!";	
					}else{
                        $mysqliObj ->query("update student set card_money=card_money-$jiaofei where openid='$openid'");
                        $mysqliObj ->query("update student set qianfei=qianfei-$jiaofei where openid='$openid'");
						$label="缴费成功！";	
					}
                    ?>
                    <label><?= $label?></label>
                    <input type="submit" value="返回">
                    <input type="hidden" name="openid" value="<?php echo $openid; ?>">
                    <input type="hidden" name="cardnum" value="<?php echo $cardnum; ?>">
                    
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
