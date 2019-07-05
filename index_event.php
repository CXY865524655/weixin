<?php
/*实现思路：在消息接口中处理菜单event事件，其中的click代表菜单点击，
通过响应菜单结构中的key值回应消息，view时间无须相应，将直接跳转指定的URL进行处理。
*/
define("TOKEN", "jingyingweixin");
//消息交互流程实现
$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
} else {
    $wechatObj->valid();
}

//接入校验
class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    //签名校验实现
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);

        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    //具体业务实现
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            //用户发送的消息类型判断
            switch ($RX_TYPE) {
                case "text": //文本消息
                    $result = $this->receiveText($postObj);
                    break;
                case "event": //事件消息
                    $result = $this->receiveEvent($postObj);
                    break;
                default:
                    $result = "";
                    break;
            }
            echo $result;
        } else {
            echo "";
            exit;
        }
    }

   

    //处理接收事件
    private function receiveEvent($object)
    {
        $openid = $object->FromUserName;
        $contentStr = "";
        switch ($object->Event) {
            case "subscribe": //关注事件
                $contentStr = "欢迎关注！请认真阅读报到规则后进行注册报到！";
                if (isset($object->EventKey)) {
                    $contentStr = "欢迎关注！请认真阅读报到规则后进行注册报到！" . $object->EvenKey;
                }
                break;
            case "unsubscribe": //取消关注事件
                break;
                
            case "CLICK": //click事件
                switch ($object->EventKey) {
                   
                     case "注册认证": //EventKey值
                        $contentStr[] = array("Title" => "注册认证",
                            "Description" => "请完成注册认证！",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/information.php?openid=$openid");
                        break;     
                        
                      case "信息完善": //EventKey值
                        $contentStr[] = array("Title" => "信息完善",
                            "Description" => "请先完成注册认证再完成信息完善！",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/myinfo.php?openid=$openid");
                        break;  
                        
                       case "充值缴费": //EventKey值
                        $contentStr[] = array("Title" => "充值缴费",
                            "Description" => "请先完成注册认证！",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/card_momey.php?openid=$openid");
                        break;
                         
                       
                        
                       case "报到规则": //EventKey值
                        $contentStr[] = array("Title" => "报到规则",
                            "Description" => "请认真阅读报到规则，按步骤完成注册报到！",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/rule.php");
                        break;     
                        
                        case "学校地图": //EventKey值
                        $contentStr[] = array("Title" => "学校地图",
                            "Description" => "学院地图！",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://www.sise.com.cn/720hr/");
                        break;       
                        
                        case "交通指引": //EventKey值
                        $contentStr[] = array("Title" => "交通指引",
                            "Description" => "各种前往广州大学华软软件学院的路线！",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "https://mp.weixin.qq.com/s/F6nAZ_xvenZ_X2S-o7FVHg");
                        break;    
                        
                        case "志愿者信息": //EventKey值
                        $contentStr[] = array("Title" => "志愿者信息",
                            "Description" => "有任何问题欢迎联系志愿者们！",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/volunteers.php");
                        break;       

                   
                }
                break;
                
        
                
            case "SCAN":
                $contentStr = "扫描" . $object->EventKey;
                //要实现统计分析，则需要扫描事件写入数据库，这里可以记录EventKey及用户OpenID,扫描时间，然后写入自定义数据库中进行统计分析，请自行思考实现。
                break;
            default:
                break;
        }
        if (is_array($contentStr)) {
            $result = $this->transmitNews($object, $contentStr);
        } else {
            $result = $this->transmitText($object, $contentStr);
        }
        return $result;
    }

    //文本消息回复
    private function transmitText($object, $content, $funcFlag = 0)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>%d</FuncFlag>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $funcFlag);
        return $result;
    }

    //图文消息回复
    private function transmitNews($object, $arr_item, $funcFlag = 0)
    {
        //首条标题28字，其他标题39字
        if (!is_array($arr_item))
            return;
        $itemTpl = " <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        $newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
<FuncFlag>%s</FuncFlag>
</xml>";
        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
        return $result;
    }
}

?>