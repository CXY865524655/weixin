<?php
/*
 ʵ�����ݣ�������ά��ticket����ʵ��
 ʵ��˼·�����Ȼ�ȡ�Լ����Ժŵ�$access_token��Ȼ����֯��ʱ��ά������ö�ά�봴��ʱ��Ҫ�ύ��POST�������ݣ���������ʱ��ά������ö�ά��ӿ�����2�ֶ�ά���ticketֵ
 */
$appid = "wxede727c82cac3adb";//appid
$appsecret  = "78fbfd1e463c5ebde4261c2d45cd48dd";//appsecret
$url1 = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$output = https_request($url1);
$json = json_decode($output,true);//��json����ת��Ϊphp����
$access_token = $json['access_token'];//��ȡaccess_token

//��ʱ��ά��
//$qrcode = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 001}}}';
//���ö�ά��
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
    curl_setopt($curl, CURLOPT_URL, $url);//��ʼ��CURL�Ự���ӵ�ַ������Ҫץȡ��URL
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);//����֤֤����Դ�ļ�飬FALSE��ʾ��ֹ��֤��Ϸ��Եļ��
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);//��֤����SSL�����㷨�Ƿ����
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//���ý���õĽ���������ַ����л����������Ļ�ϣ�0Ϊֱ�������Ļ����0�����
    $output = curl_exec($curl);//ִ�����󣬻�ȡ���ؽ��
    var_dump($output);
    curl_close($curl);//�ر�curl�Ự 
    return $output;
}
?>