<?php
/*ʵ��˼·������Ϣ�ӿ��д���˵�event�¼������е�click����˵������
ͨ����Ӧ�˵��ṹ�е�keyֵ��Ӧ��Ϣ��viewʱ��������Ӧ����ֱ����תָ����URL���д���
*/
define("TOKEN", "jingyingweixin");
//��Ϣ��������ʵ��
$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
} else {
    $wechatObj->valid();
}

//����У��
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

    //ǩ��У��ʵ��
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

    //����ҵ��ʵ��
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            //�û����͵���Ϣ�����ж�
            switch ($RX_TYPE) {
                case "text": //�ı���Ϣ
                    $result = $this->receiveText($postObj);
                    break;
                case "event": //�¼���Ϣ
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

   

    //��������¼�
    private function receiveEvent($object)
    {
        $openid = $object->FromUserName;
        $contentStr = "";
        switch ($object->Event) {
            case "subscribe": //��ע�¼�
                $contentStr = "��ӭ��ע���������Ķ�������������ע�ᱨ����";
                if (isset($object->EventKey)) {
                    $contentStr = "��ӭ��ע���������Ķ�������������ע�ᱨ����" . $object->EvenKey;
                }
                break;
            case "unsubscribe": //ȡ����ע�¼�
                break;
                
            case "CLICK": //click�¼�
                switch ($object->EventKey) {
                   
                     case "ע����֤": //EventKeyֵ
                        $contentStr[] = array("Title" => "ע����֤",
                            "Description" => "�����ע����֤��",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/information.php?openid=$openid");
                        break;     
                        
                      case "��Ϣ����": //EventKeyֵ
                        $contentStr[] = array("Title" => "��Ϣ����",
                            "Description" => "�������ע����֤�������Ϣ���ƣ�",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/myinfo.php?openid=$openid");
                        break;  
                        
                       case "��ֵ�ɷ�": //EventKeyֵ
                        $contentStr[] = array("Title" => "��ֵ�ɷ�",
                            "Description" => "�������ע����֤��",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/card_momey.php?openid=$openid");
                        break;
                         
                       
                        
                       case "��������": //EventKeyֵ
                        $contentStr[] = array("Title" => "��������",
                            "Description" => "�������Ķ��������򣬰��������ע�ᱨ����",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/rule.php");
                        break;     
                        
                        case "ѧУ��ͼ": //EventKeyֵ
                        $contentStr[] = array("Title" => "ѧУ��ͼ",
                            "Description" => "ѧԺ��ͼ��",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://www.sise.com.cn/720hr/");
                        break;       
                        
                        case "��ָͨ��": //EventKeyֵ
                        $contentStr[] = array("Title" => "��ָͨ��",
                            "Description" => "����ǰ�����ݴ�ѧ�������ѧԺ��·�ߣ�",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "https://mp.weixin.qq.com/s/F6nAZ_xvenZ_X2S-o7FVHg");
                        break;    
                        
                        case "־Ը����Ϣ": //EventKeyֵ
                        $contentStr[] = array("Title" => "־Ը����Ϣ",
                            "Description" => "���κ����⻶ӭ��ϵ־Ը���ǣ�",
                            "PicUrl" => "http://1.393198212.applinzi.com/pic/logo.jpg",
                            "Url" => "http://1.393198212.applinzi.com/volunteers.php");
                        break;       

                   
                }
                break;
                
        
                
            case "SCAN":
                $contentStr = "ɨ��" . $object->EventKey;
                //Ҫʵ��ͳ�Ʒ���������Ҫɨ���¼�д�����ݿ⣬������Լ�¼EventKey���û�OpenID,ɨ��ʱ�䣬Ȼ��д���Զ������ݿ��н���ͳ�Ʒ�����������˼��ʵ�֡�
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

    //�ı���Ϣ�ظ�
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

    //ͼ����Ϣ�ظ�
    private function transmitNews($object, $arr_item, $funcFlag = 0)
    {
        //��������28�֣���������39��
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