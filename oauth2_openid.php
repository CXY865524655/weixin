<?php
$code = $_GET['code'];
$userinfo = getUserInfo($code);
function getUserInfo($code)
{
    $appid = "wxede727c82cac3adb";//appid
    $appsecret = "78fbfd1e463c5ebde4261c2d45cd48dd";//appsecret
    //oauth2�ķ�ʽ���openid
    $access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
    $access_token_json = https_request($access_token_url);
    $access_token_array = json_decode($access_token_json, true);
    $openid = $access_token_array['openid'];
    //��oauth2�ķ�ʽ���ȫ��access_token
    $new_access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    $new_access_token_json = https_request($new_access_token_url);
    $new_access_token_array = json_decode($new_access_token_json, true);
    $new_access_token = $new_access_token_array['access_token'];
    //ȫ��access_token����û�������Ϣ
    $userinfo_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$new_access_token&openid=$openid";
    $userinfo_json = https_request($userinfo_url);
    $userinfo_array = json_decode($userinfo_json, true);
    return $userinfo_array;
}

function https_request($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);//��ʼ��CURL�Ự���ӵ�ַ������Ҫץȡ��URL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);//����֤֤����Դ�ļ�飬FALSE��ʾ��ֹ��֤��Ϸ��Եļ��
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);//��֤����SSL�����㷨�Ƿ����
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//���ý���õĽ���������ַ����л����������Ļ�ϣ�0Ϊֱ�������Ļ����0�����
    $output = curl_exec($curl);//ִ�����󣬻�ȡ���ؽ��
    if (curl_errno($curl)) {
        return 'error' . curl_error($curl);
    }
    curl_close($curl);//�ر�curl�Ự
    return $output;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>OAuth2.0��֤</title>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1">
    <link rel="stylesheet" href="css/jquery.mobile-1.3.2.css">
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery.mobile-1.3.2.js"></script>
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
<div data-role="page" id="page1">
    <div data-role="content">
        <div style="text-align: center">
            <img style="width: 99%;height: %" src="<?php echo $userinfo['headimgurl'] ?>" alt="">
        </div>
        <ul data-role="listview" data-inset="true">
            <li>
                <p>
                <div class="fieldcontain">
                    <label for="subscribe">�Ƿ��ע</label>
                    <input type="text" name="subscribe" id="subscribe" value="<?php echo $userinfo['subscribe'] ?>">
                </div>
                <div class="fieldcontain">
                    <label for="openid">OpenID</label>
                    <input type="text" name="openid" id="openid" value="<?php echo $userinfo['openid'] ?>">
                </div>
                <div class="fieldcontain">
                    <label for="nickname">�ǳ�</label>
                    <input type="text" name="nickname" id="nickname" value="<?php echo $userinfo['nickname'] ?>">
                </div>
                <div class="fieldcontain">
                    <label for="sex">�Ա�</label>
                    <input type="text" name="sex" id="sex" value="<?php echo $userinfo['sex'] ?>">
                </div>
                <div class="fieldcontain">
                    <label for="country">����</label>
                    <input type="text" name="country" id="country" value="<?php echo $userinfo['country'] ?>">
                </div>
                <div class="fieldcontain">
                    <label for="'province">ʡ��</label>
                    <input type="text" name="'province" id="'province" value="<?php echo $userinfo['province'] ?>">
                </div>
                <div class="fieldcontain">
                    <label for="city">����</label>
                    <input type="text" name="city" id="city" value="<?php echo $userinfo['city'] ?>">
                </div>
                <div class="fieldcontain">
                    <label for="subscribe_time">��עʱ��</label>
                    <input type="text" name="subscribe_time" id="subscribe_time"
                           value="<?php echo $userinfo['subscribe_time'] ?>">
                </div>
                </p>
            </li>
        </ul>
    </div>
    <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>���羫Ӣ����</h3>
    </div>
</div>
</body>
</html>