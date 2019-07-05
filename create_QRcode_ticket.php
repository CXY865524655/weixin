<?php
/*
 实现内容：创建二维码ticket案例实现
 实现思路：首先获取自己测试号的$access_token，然后组织临时二维码和永久二维码创建时需要提交的POST数据内容，最后根据临时二维码和永久二维码接口生成2种二维码的ticket值
 */
$appid = "wxede727c82cac3adb";//appid
$appsecret  = "78fbfd1e463c5ebde4261c2d45cd48dd";//appsecret
$url1 = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$output = https_request($url1);
$json = json_decode($output,true);//将json数据转换为php数组
$access_token = $json['access_token'];//获取access_token

//临时二维码
//$qrcode = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 001}}}';
//永久二维码
$qrcode='{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "002"}}}';

$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
$result = https_request($url, $qrcode);
var_dump($result);
$jsoninfo = json_decode($result, true);
$ticket = $jsoninfo['ticket'];
var_dump($ticket);
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);//初始化CURL会话链接地址，设置要抓取的URL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);//对认证证书来源的检查，FALSE表示阻止对证书合法性的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);//从证书检查SSL加密算法是否存在
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//设置将获得的结果保存在字符串中还是输出到屏幕上，0为直接输出屏幕，非0则不输出
    $output = curl_exec($curl);//执行请求，获取返回结果
    var_dump($output);
    curl_close($curl);//关闭curl会话 
    return $output;
}
?>