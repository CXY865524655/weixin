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
$qianfei=$arr['qianfei'];
$card_money=$arr['card_money'];
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <link rel="stylesheet" href="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
     <SCRIPT LANGUAGE="JavaScript">
        $("#singleList").listview('refresh');
        window.onload = function () {
            setTimeout('myrefresh()', 10000);
        }

        function myrefresh() {
            window.location.reload();
        }
    </SCRIPT>
</head>
<body>
<div data-role="page">
    <div style="width: 100%;height: 150px;"></div>
    <div data-role="main" class="ui-content" align="center">
        <div style="width: 400px;" align="center">
            <form action="" method="get" style="width: auto">
                <div class="ui-field-contain">
                    <label for="stnum">卡号：</label>
                    <input type="text" name="stnum" id="stnum" value="<?=$cardnum ?>"readonly>
                </div>
                <div class="ui-field-contain">
                    <label for="stnum">余额：</label>
                    <input type="text" name="card_money" id="card_money" value="<?=$card_money ?>" readonly>
                </div>
                <div class="ui-field-contain">
                    <label for="stnum">应缴费：</label>
                    <input type="text" name="qianfei" id="qianfei" value="<?=$qianfei ?>" readonly>
                </div>
               
               </form>
                <div class="ui-field-contain">
                    <a href="#chongzhi1" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all ui-icon-check ui-btn-icon-left">充值</a>
                	<a href="#jiaofei1" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all ui-icon-check ui-btn-icon-left">缴费</a>
                </div>
                <div class="ui-field-contain">
                	<div data-role="popup" id="chongzhi1" class="ui-content" style="min-width:250px;">
                          <form method="get" action="http://1.393198212.applinzi.com/card_chongzhi.php">
                            <div>
                              <label for="chongzhi" class="ui-hidden-accessible">充值金额:</label>
                              <input type="text" name="chongzhi" id="chongzhi" placeholder="RMB">
                              <input type="submit" data-inline="true" value="充值">
                              <input type="hidden" name="openid" value="<?php echo $openid; ?>">
                              <input type="hidden" name="cardnum" value="<?php echo $cardnum; ?>">
                            </div>
                          </form>
                    </div>
                    <div data-role="popup" id="jiaofei1" class="ui-content" style="min-width:250px;">
                          <form method="get" action="http://1.393198212.applinzi.com/card_jiaofei.php">
                            <div>
                              <label for="jiaofei" class="ui-hidden-accessible">缴费:</label>
                              <input type="text" name="jiaofei" id="jiaofei" placeholder="RMB" value="<?=$qianfei ?>" readonly>
                              <input type="submit" data-inline="true" value="缴费">
                              <input type="hidden" name="openid" value="<?php echo $openid; ?>">
                              <input type="hidden" name="cardnum" value="<?php echo $cardnum; ?>">
                              <input type="hidden" name="card_money" value="<?php echo $card_money; ?>">
                            </div>
                          </form>
                	</div>
                    
                </div>
            
            	
            
        </div>
    </div>
</div>
</body>
</html>