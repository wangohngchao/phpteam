<?php
/**
  * wechat php 
  */

//define your token
define("TOKEN", "weixin");

require_once "./face/SearchFace.php";   //调用人脸识别封装函数
require_once "./face/TuLing.php";       //调用图灵机器人API封装函数
require_once "./distance.php";          //调用距离计算函数

$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}


class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
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
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];                      //响应消息方法首先接收上述原始POST数据
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//将数据载入到对象中，对象名为SimpleXMLElement，LIBXML_NOCDATA表示将CDATA合并为文本节点
            $RX_TYPE = trim($postObj->MsgType);                                       //提取消息类型从而实现各种消息类型的分离

            switch ($RX_TYPE)
            {
                case "text":           //文本消息
                    $resultStr = $this->receiveText($postObj);
                    break;
                case "event":         //事件消息
                    $resultStr = $this->receiveEvent($postObj);
                    break;
                case "location":   //地理位置  
                    $resultStr = $this->receiveEvent($postObj);
                    break;
                case "image":
                    $resultStr = $this->receiveImage($postObj);
                    break;
                default:
                    $resultStr = "";
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

    private function receiveText($object)                                   //文本消息接收函数
    {
        $funcFlag = 0;
        $a = new user;
        $data = $object->Content;
        $message = $a->Chat($data);
        //$tlrecevie->Chat();
        $contentStr = $message;
        //$contentStr = $a->Chat($data);
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }
  
    public function receiveImage($object)
    {
        $image = $object->PicUrl;
        $openid = $object->openid;
        $result = SearchFace(null,$image);
        $contentStr = "";  
        foreach($result as $re ){
            $str = $this->getfaceid($re);
            $contentStr = $contentStr.$str."\n";
        }
        $contentStr = $contentStr."已通过人脸识别签到";
        if(!$result){
            $contentStr = "未检测到人脸或不匹配，请重新拍照！";
        }
        $resultStr = $this->transmitText($object, $contentStr, $funcFlag);
        return $resultStr;
    }

    private function receiveEvent($object)                                     //响应事件消息接收函数
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                $contentStr = "欢迎关注武纺课程服务测试号！";
                break;
            case "unsubscribe":
                $openid = $object-> FromUserName;
                $this->rmstuband($openid);
                $this->rmband($openid);
                break;
            case "LOCATION":        //获取地理位置信息
                $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);
                if($link){          
                    mysql_select_db(SAE_MYSQL_DB, $link);mysql_query("SET NAMES UTF8");
                    $openid = $object-> FromUserName;
                    $Latitude = $object-> Latitude;
                    $Longitude = $object-> Longitude;
                    $findopenid = "SELECT * FROM s_location WHERE wxid='$openid'";
                    $query2 = mysql_query($findopenid, $link); 
                    $newArray = mysql_fetch_array($query2);
                    $result = $newArray[0];                   
                    if($result=="")
                    {
                        
                        $sql = "INSERT INTO s_location (wxid,latitude,longitude,dt) VALUES ('$openid','$Latitude','$Longitude',now())";
                        $query = mysql_query($sql, $link);                                            
                    }
                    else{
                        $sql = "UPDATE s_location SET latitude='$Latitude',longitude='$Longitude',dt=now() WHERE wxid='$openid'";
                        $query = mysql_query($sql, $link);
                    }
                     
                }
                break;
            case "SCAN":
                $openid = $object-> FromUserName;
                $result = $this->qiandao($openid); 
                if($result==1){              
                    $contentStr[] = array("Title" =>"签到状态", 
                    "Description" =>"签到成功了呦！\n好好学习，天天签到", 
                    "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/qiandao.jpg", 
                    //"Url" =>""
                    );
                }
                else if($result==2){              
                    $contentStr[] = array("Title" =>"签到状态", 
                    "Description" =>"已经签到了，请不要重复签到", 
                    "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/qiandao.jpg", 
                    //"Url" =>""
                    );
                }
                else if($result==3){              
                    $contentStr[] = array("Title" =>"签到状态", 
                    "Description" =>"签到失败了！\n不在访问位置内", 
                    "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/qdno.jpg", 
                    //"Url" =>""
                    );
                }
                else
                    {              
                    $contentStr[] = array("Title" =>"签到状态", 
                    "Description" =>"已经签到了，请不要重复签到", 
                    "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/qiandao.jpg", 
                    //"Url" =>""
                    );
                }
                break;
            case "CLICK":
                switch ($object->EventKey)
                {
                    case "信息查询":
                        $openid = $object-> FromUserName;
                        $contentStr[] = array("Title" =>"信息查询", 
                        "Description" =>"查询签到，请假，通知等详细信息！", 
                        "PicUrl" =>"http://pic5.huitu.com/res/20121206/5299_20121206161214788200_1.jpg", 
                        "Url" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/teacher/ask?openid=$openid");                 //图片事件响应链接
                        break;
                    case "学生信息":
                        $openid = $object-> FromUserName;
                        $contentStr[] = array("Title" =>"查看我的信息", 
                        "Description" =>"", 
                        "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/fall.jpeg", 
                        "Url" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/stu/userinfo?openid=$openid");                 //图片事件响应链接
                        break;
                    case "教师信息":
                        $openid = $object-> FromUserName;
                        $contentStr[] = array("Title" =>"查看我的信息", 
                        "Description" =>"", 
                        "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/fall.jpeg", 
                        "Url" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/teacher/userinfo?openid=$openid");                 //图片事件响应链接
                        break;
                    case "教师解绑":
                        $openid = $object-> FromUserName;
                        $this->rmband($openid);
                        $contentStr[] = array("Title" =>"解绑成功", 
                        "Description" =>"", 
                        "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/noband.jpg", 
                        "Url" =>"");                 //图片事件响应链接
                        break;
                    case "学生解绑":
                        $openid = $object-> FromUserName;
                        $this->rmstuband($openid);
                        $contentStr[] = array("Title" =>"解绑成功", 
                        "Description" =>"", 
                        "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/noband.jpg", 
                        "Url" =>"");                 //图片事件响应链接
                        break;
                    case "我要请假":
                        $openid = $object-> FromUserName;
                        $contentStr[] = array("Title" =>"请假条，点击输入请假信息", 
                        "Description" =>"", 
                        "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/qj.jpg", 
                        "Url" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/stu/ask?openid=$openid");                 //图片事件响应链接
                        break;
                    case "通知信息":
                        $openid = $object-> FromUserName;
                        $contentStr[] = array("Title" =>"通知信息", 
                        "Description" =>"", 
                        "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/tz1.jpg", 
                        "Url" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/teacher/notice?openid=$openid");                 //图片事件响应链接
                        break;
                    case "查看通知":
                        $openid = $object-> FromUserName;
                        $contentStr[] = array("Title" =>"查看近期通知信息", 
                        "Description" =>"", 
                        "PicUrl" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/images/tz.jpg", 
                        "Url" =>"http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/stu/notice?openid=$openid");                 //图片事件响应链接
                        break;
                    default:
                        $contentStr[] = array("Title" =>"默认菜单回复", 
                        "Description" =>"您正在使用的是自定义菜单测试接口", 
                        "PicUrl" =>"http://pic5.huitu.com/res/20121206/5299_20121206161214788200_1.jpg", 
                        "Url" =>"");
                        break;
                }
                break;
            default:
                break;      

        }
        if (is_array($contentStr)){
            $resultStr = $this->transmitNews($object, $contentStr);
        }else{
            $resultStr = $this->transmitText($object, $contentStr);
        }
        return $resultStr;
    }

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
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $funcFlag);
        return $resultStr;
    }

    private function transmitNews($object, $arr_item, $funcFlag = 0)
    {
        //首条标题28字，其他标题39字
        if(!is_array($arr_item))
            return;

        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
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

        $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item), $funcFlag);
        return $resultStr;
    }
    public function qiandao($openid){
        $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
        if($link){  
        # 选择数据库  
            mysql_select_db(SAE_MYSQL_DB, $link);mysql_query("SET NAMES UTF8");
            $repeat = sign($openid);            //返回0表示未签到，1表示已签到
            $distance = coordinates($openid);   //返回距离
            if($distance<150&&$repeat==0)
            {
            
                $sql1 = "SELECT s_id,s_class FROM s_student where s_wxid='".$openid."'"; 
                $query = mysql_query($sql1, $link); 
                $newArray = mysql_fetch_array($query);
                $sid = $newArray[0];
                $class = $newArray[1];
                // your code goes here      
                // query array of 0 ~ 30   
                $sql = "INSERT INTO s_sign (s_id,sign_id,q_s_wxid,q_time,class) VALUES ('$sid','0','$openid',now(),'$class')";    
                $result = mysql_query($sql, $link); 
                return 1;                    //成功签到
            }
            else if($distance<150&&$repeat==1)//重复签到
                return 2;
            else if($distance>150&&$repeat==0)//距离不够
                return 3;
            else
                return 4;
        }
        //} 
        return 0;
    }
    public function rmband($openid){
        $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
        if($link){  
        # 选择数据库  
        mysql_select_db(SAE_MYSQL_DB, $link);
        $sql1 = "UPDATE s_teacher set t_wxid=NULL  WHERE t_wxid = '".$openid."'"; 
        $result = mysql_query($sql1,$link); 
        
       /* $sql1 = "INSERT INTO s_sign (q_time) VALUES ('".$date."')";
        $result1 = mysql_query($sql1, $link); */
        } 
        $s = new SaeStorage();
        $a=$s->read( 'at' , 'Access_Token.txt');
        $data = '{"openid":"'.$openid.'","to_groupid":0}';
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token='.$a;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
    }
    public function rmstuband($openid){
        $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
        if($link){  
        # 选择数据库  
        mysql_select_db(SAE_MYSQL_DB, $link);
        $sql1 = "UPDATE s_student set s_wxid = NULL  WHERE s_wxid = '".$openid."'"; 
        $query = mysql_query($sql1, $link); 
        
       /* $sql1 = "INSERT INTO s_sign (q_time) VALUES ('".$date."')";
        $result1 = mysql_query($sql1, $link); */
        } 
        $s = new SaeStorage();
        $a=$s->read( 'at' , 'Access_Token.txt');
        $data = '{"openid":"'.$openid.'","to_groupid":0}';
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token='.$a;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
    }
    public function getfaceid($studentid){
        $link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
        if($link){  
        # 选择数据库  
            mysql_select_db(SAE_MYSQL_DB, $link);mysql_query("SET NAMES UTF8");
            $sql1 = "SELECT s_wxid,s_class,s_name FROM s_student where s_id='".$studentid."'"; 
            $query = mysql_query($sql1, $link); 
            $newArray = mysql_fetch_array($query);
            $wxid = $newArray[0];
            $class = $newArray[1];
            $name = $newArray[2];
            // your code goes here      
            // query array of 0 ~ 30   
            $sql = "INSERT INTO s_sign (s_id,sign_id,q_s_wxid,q_time,class) VALUES ('$studentid','0','$wxid',now(),'$class')";    
            $result = mysql_query($sql, $link); 
        }
        //} 
        return $class.$name;
    }
    
}

?>
