<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/29
 * Time: 11:04
 */
$appid="wxede727c82cac3adb";
$appsecret="78fbfd1e463c5ebde4261c2d45cd48dd";
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$output=curl_exec($ch);
$jsoninfo=json_decode($output,true);
$access_token=$jsoninfo["access_token"];
$expires_in=$jsoninfo["expires_in"];
var_dump($access_token);
var_dump($expires_in);
?>

