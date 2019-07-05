<?php

//
// �����û���Ϣ
// ΢�Ź����˺Ž��յ��û�����Ϣ�����ж�
//

define("TOKEN", "jingyingweixin");

$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            //�û����͵���Ϣ�����ж�
            switch ($RX_TYPE)
            {
                case "text":    //�ı���Ϣ
                    $result = $this->receiveText($postObj);
                    break;
                case "image":   //ͼƬ��Ϣ
                    $result = $this->receiveImage($postObj);
                    break;

                case "voice":   //������Ϣ
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":   //��Ƶ��Ϣ
                    $result = $this->receiveVideo($postObj);
                    break;
                case "location"://λ����Ϣ
                    $result = $this->receiveLocation($postObj);
                    break;
                case "link":    //������Ϣ
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $result;
        }else {
            echo "";
            exit;
        }
    }

    /*
     * �����ı���Ϣ
     */
    private function receiveText($object)
    {
        $content = "�㷢�͵����ı�������Ϊ��".$object->Content;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    /*
     * ����ͼƬ��Ϣ
     */
    private function receiveImage($object)
    {
        $content = "�㷢�͵���ͼƬ����ַΪ��".$object->PicUrl;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    /*
     * ����������Ϣ
     */
    private function receiveVoice($object)
    {
        $content = "�㷢�͵���������ý��IDΪ��".$object->MediaId;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    /*
     * ������Ƶ��Ϣ
     */
    private function receiveVideo($object)
    {
        $content = "�㷢�͵�����Ƶ��ý��IDΪ��".$object->MediaId;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    /*
     * ����λ����Ϣ
     */
    private function receiveLocation($object)
    {
        $content = "�㷢�͵���λ�ã�γ��Ϊ��".$object->Location_X."������Ϊ��".$object->Location_Y."�����ż���Ϊ��".$object->Scale."��λ��Ϊ��".$object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    /*
     * ����������Ϣ
     */
    private function receiveLink($object)
    {
        $content = "�㷢�͵������ӣ�����Ϊ��".$object->Title."������Ϊ��".$object->Description."�����ӵ�ַΪ��".$object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }

    /*
     * �ظ��ı���Ϣ
     */
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
}
?>