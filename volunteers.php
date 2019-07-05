<?php
header("Content-Type:text/html; charset=utf-8");
//$conn=mysqli_connect("localhost:3306","root","123456","vx");
$mysqliObj = new mysqli("w.rdc.sae.sina.com.cn:3306","o0xz4m0w30","xjhyw1x013ymwiw4zmzxjkiyxzly540l5ymy4li0","app_393198212");
//mysqli_query($conn,"set names 'utf8'");
$mysqliObj ->query("set names 'utf8'");

$sql="SELECT * FROM volunteers";
$result=$mysqliObj ->query($sql);
$arr=$result->fetch_array();



?>


<html>
<head>
   <TITLE>志愿者信息表</TITLE>
    <META charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        
</head>
<body>

    <div data-role="page" id="pageone">
    <div data-role="header">
        <h1>志愿者信息表</h1>
        
        
    </div>
    <div data-role="main" class="ui-content">
        <?while ($r=mysqli_fetch_assoc($result)){?>
            <ul data-role="listview" data-inset="true">
                <li>
                    
                    	<h2>姓名：<?= $r['name'] ?></h2>
                        <p>电话：<?=$r['phone'] ?></p>
                     	<p>学号：<?=$r['stnum'] ?></p>
                   
                </li>
            </ul>
        <?} ?>
    </div>
        
    <div data-role="footer">
        <h1>志愿者信息</h1>
    </div>
        
</div>



</body>
</html>
