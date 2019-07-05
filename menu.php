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
            "name": "新生报到",
            "sub_button": [
                {
                    "type": "click",
                    "name": "注册认证",
                    "key": "注册认证"
                },
                {
                    "type": "click",
                    "name": "信息完善",
                    "key": "信息完善"
                },
                {
                    "type": "click",
                    "name": "充值缴费",
                    "key": "充值缴费"
                }
            ]
        },
        {
            "name": "报到须知",
            "sub_button": [
                {
                    "type": "click",
                    "name": "报到规则",
                    "key": "报到规则"
                },
                {
                    "type": "click",
                    "name": "学校地图",
                    "key": "学校地图"
                },
                 {
                    "type": "click",
                    "name": "交通指引",
                    "key": "交通指引"
                },
                 {
                    "type": "click",
                    "name": "志愿者信息",
                    "key": "志愿者信息"
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