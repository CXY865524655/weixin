<?php
	header("Content-Type:text/html; charset=utf-8");
	//$conn=mysqli_connect("localhost:3306","root","123456","vx");
	$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
	//mysqli_query($conn,"set names 'utf8'");
	$mysqliObj ->query("set names 'utf8'");
    if (isset($_GET['phone'])) {
            $phone = $_GET['phone'];
        }else{
            echo "û��get";
        }
	$sql="SELECT * FROM volunteers where phone = $phone";
	$result=$mysqliObj ->query($sql);
	
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="../css/jquery.mobile-1.4.5.min.css">
    <script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../js/jquery.mobile-1.4.5.min.js"></script>
    <SCRIPT LANGUAGE="JavaScript">

        $("#singleList").listview('refresh');
        window.onload = function () {
            setTimeout('myrefresh()', 10000);
        }

        function myrefresh() {
            window.location.reload();
        }
    </SCRIPT>
    <title>Document</title>
</head>
<body>


<div data-role="page">
        <div data-role="header">
            <a href="http://1.393198212.applinzi.com/volunteers.php"
               class="ui-btn ui-icon-home ui-btn-icon-left">����</a>
            <h1>��ϸ��Ϣ</h1>
        </div>

        <div data-role="content">

            <ul data-role="listview"  id="singleList" >
                <?php foreach ($result as $r) { ?>
                    <li>ѧ�ţ�<?php echo $r['stnum'] ?></li>
                    <li>������<?php echo $r['name'] ?></li>
                    <li>�绰��<?php echo $r['phone'] ?></li>
                <?php } ?>
            </ul>


        </div>

        <div data-role="footer" data-position="fixed">
            <h3>ѧ������ע��ƽ̨</h3>
        </div>
    </div>


</body>
</html>
