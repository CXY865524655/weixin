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
	echo "<script>alert('�������ע����֤��')</script>";
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
        <h1>������Ϣ</h1>
    </div>
    <div data-role="main" class="ui-content">
        <form method="get" action="http://393198212.applinzi.com/myinfoselect.php">
            <div class="ui-field-contain">
                <label for="name">������</label>
                <input type="text" name="name" id="name" value="<?php echo $arr['name']; ?>" readonly>
            </div>

            <div class="ui-field-contain">
                <label for="xuehao">ѧ�ţ�</label>
                <input type="text" name="stnum" id="stnum" value="<?php echo $arr['stnum']; ?>" readonly>
            </div>

            <div class="ui-field-contain">
                <label for="sex">�Ա�</label>
                <input type="text" name="sex" id="sex" value="<?php echo $arr['sex']; ?>" readonly>
            </div>
            
            <div class="ui-field-contain">
                <label for="xibu">ϵ����</label>
                <input type="text" name="xibu" id="xibu" placeholder="ϵ��">
            </div>

            <div class="ui-field-contain">
                <label for="phone">�ֻ���</label>
                <input type="text" name="phone" id="phone" placeholder="�ֻ���">
            </div>

            <div class="ui-field-contain">
                <label for="sushe">���᣺</label>
                <input type="text" name="room" id="room" value="<?php echo $arr['room']; ?>" readonly >
            </div>
            
            
             <div class="ui-field-contain">
                <label for="idnum">���֤�ţ�</label>
                <input type="text" name="idnum" id="idnum" placeholder="���֤��">
            </div>
            
            
            <div class="ui-field-contain">
                <label for="cardnum">У԰һ��ͨ���ţ�</label>
                <input type="text" name="cardnum" id="cardnum" value="<?php echo $arr['cardnum']; ?>" readonly >
            </div>
            
            
            

            <div class="ui-field-contain">
                <label for="junfu">������</label>
                <input type="text" name="size" id="size" placeholder="��ѵ��װ����">
            </div>

            <div class="ui-field-contain">
                <label for="img0">��Ƭ��</label>
                <input type="file" name="file0" id="pic" multiple="multiple" />
            </div>
            <div class="ui-field-contain">
                <img src="" id="img0">
            </div>
			
            <input type="submit" data-inline="true" value="����">
        </form>
    </div>
</div>
<script>
    $("#file0").change(function(){
        // getObjectURL���Զ���ĺ�����������
        // this.files[0]�������ѡ����ļ���Դ�ĵ�һ������Ϊ����д�� multiple="multiple" �ͱ�ʾ�ϴ��ļ����ܲ�ֹһ��
        // ����������ֻ��ȡ��һ��
        var objUrl = getObjectURL(this.files[0]) ;
        // ������ûʲô���ã�ɾ��Ҳ����
        // console.log("objUrl = "+objUrl) ;
        if (objUrl) {
            // �������޸�ͼƬ�ĵ�ַ����
            $("#img0").attr("src", objUrl) ;
            $("#img0").attr("width", 200) ;
            $("#img0").attr("height", 200) ;
        }
    }) ;
    //����һ���ɴ�ȡ��ԓfile��url
    function getObjectURL(file) {
        var url = null ;
        // ���溯��ִ�е�Ч����һ���ģ�ֻ����Ҫ��Բ�ͬ�������ִ�в�ͬ�� js ��������
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