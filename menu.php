<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/29
 * Time: 11:40
 */
$appid="wxede727c82cac3adb";
$appsecret="78fbfd1e463c5ebde4261c2d45cd48dd";
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$output=https_request($url);
$jsoninfo=json_decode($output,true);
$access_token=$jsoninfo["access_token"];

$jsonmenu='{
    "button": [
        {
            "name": "��������",
            "sub_button": [
                {
                    "type": "click",
                    "name": "ע����֤",
                    "key": "ע����֤"
                },
                {
                    "type": "click",
                    "name": "��Ϣ����",
                    "key": "��Ϣ����"
                },
                {
                    "type": "click",
                    "name": "��ֵ�ɷ�",
                    "key": "��ֵ�ɷ�"
                }
            ]
        },
        {
            "name": "������֪",
            "sub_button": [
                {
                    "type": "click",
                    "name": "��������",
                    "key": "��������"
                },
                {
                    "type": "click",
                    "name": "ѧУ��ͼ",
                    "key": "ѧУ��ͼ"
                },
                 {
                    "type": "click",
                    "name": "��ָͨ��",
                    "key": "��ָͨ��"
                },
                 {
                    "type": "click",
                    "name": "־Ը����Ϣ",
                    "key": "־Ը����Ϣ"
                }    
                
            ]
        }
    ]
}';
$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result=https_request($url,$jsonmenu);
var_dump($result);

function https_request($url,$data=null){
	$curl=curl_init();
  	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
    if(!empty($data)){
    	curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    }
    
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    
    $output=curl_exec($curl);
    curl_close($curl);
    return $output;

}
?>