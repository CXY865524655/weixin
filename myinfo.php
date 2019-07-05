<?php
header("Content-Type:text/html; charset=utf-8");
//$conn=mysqli_connect("localhost:3306","root","123456","vx");
$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
//mysqli_query($conn,"set names 'utf8'");
$mysqliObj ->query("set names 'utf8'");

//openid
$openid=$_GET["openid"];

$sql="SELECT * FROM student WHERE openid='$openid'";
$result=$mysqliObj ->query($sql);
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
<script type="text/javascript">
    document.addEventListener('WeixinJSBridgeReady', function onBirdgeReady() {
        WeixinJSBridge.call('hideOptionMenu');
    });
    document.addEventListener('WeixinJSBridgeReady', function onBirdgeReady() {
        WeixinJSBridge.call('hideToolbar');
    });

</script>
<div data-role="page">
    <div data-role="header">
        <h1>完善信息</h1>
    </div>
    <div data-role="main" class="ui-content">
        <form method="get" action="http://393198212.applinzi.com/myinfoselect.php">
            <div class="ui-field-contain">
                <label for="name">姓名：</label>
                <input type="text" name="name" id="name" value="<?php echo $arr['name']; ?>" readonly>
            </div>

            <div class="ui-field-contain">
                <label for="xuehao">学号：</label>
                <input type="text" name="stnum" id="stnum" value="<?php echo $arr['stnum']; ?>" readonly>
            </div>

            <div class="ui-field-contain">
                <label for="sex">性别：</label>
                <input type="text" name="sex" id="sex" value="<?php echo $arr['sex']; ?>" readonly>
            </div>
            
            <div class="ui-field-contain">
                <label for="xibu">系部：</label>
                <input type="text" name="xibu" id="xibu" placeholder="系部">
            </div>

            <div class="ui-field-contain">
                <label for="phone">手机：</label>
                <input type="text" name="phone" id="phone" placeholder="手机号">
            </div>

            <div class="ui-field-contain">
                <label for="sushe">宿舍：</label>
                <input type="text" name="room" id="room" value="<?php echo $arr['room']; ?>" readonly >
            </div>
            
            
             <div class="ui-field-contain">
                <label for="idnum">身份证号：</label>
                <input type="text" name="idnum" id="idnum" placeholder="身份证号">
            </div>
            
            
            <div class="ui-field-contain">
                <label for="cardnum">校园一卡通卡号：</label>
                <input type="text" name="cardnum" id="cardnum" value="<?php echo $arr['cardnum']; ?>" readonly >
            </div>
            
            
            

            <div class="ui-field-contain">
                <label for="junfu">军服：</label>
                <input type="text" name="size" id="size" placeholder="军训服装码数">
            </div>

            <div class="ui-field-contain">
                <label for="img0">照片：</label>
                <input type="file" name="file0" id="pic" multiple="multiple" />
            </div>
            <div class="ui-field-contain">
                <img src="" id="img0">
            </div>
			
            <input type="submit" data-inline="true" value="保存">
        </form>
    </div>
</div>
<script>
    $("#file0").change(function(){
        // getObjectURL是自定义的函数，见下面
        // this.files[0]代表的是选择的文件资源的第一个，因为上面写了 multiple="multiple" 就表示上传文件可能不止一个
        // ，但是这里只读取第一个
        var objUrl = getObjectURL(this.files[0]) ;
        // 这句代码没什么作用，删掉也可以
        // console.log("objUrl = "+objUrl) ;
        if (objUrl) {
            // 在这里修改图片的地址属性
            $("#img0").attr("src", objUrl) ;
            $("#img0").attr("width", 200) ;
            $("#img0").attr("height", 200) ;
        }
    }) ;
    //建立一個可存取到該file的url
    function getObjectURL(file) {
        var url = null ;
        // 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
</script>
</body>
</html>