<?php
$s = new SaeStorage();
$access_token=$s->read( 'at' , 'Access_Token.txt');

$jsonmenu = '{
      "button":[
       {
           "name":"签到",
           "sub_button":[
            {
               "type":"scancode_push",
               "name":"扫一扫签到",
               "key": "rselfmenu_0_0", 
               "sub_button": [ ]
            }
            ]
       

       },
	   {
		   "name":"其他事务",
		   "sub_button":[
		   {
			   "type":"click",
			   "name":"我要请假",
			   "key":"我要请假"
		   },
		   {
			   "type":"click",
			   "name":"查看通知",
			   "key":"查看通知"
		   }
		   ]
	   },
       {
           "name":"用户",
           "sub_button":[
            {
               "type":"click",
               "name":"我要解绑",
               "key":"学生解绑"
            },
            {
               "type":"click",
               "name":"我的信息",
               "key":"学生信息"
            }
            ]     
       }
	   ],
 "matchrule":{
  "group_id":"103",
  "sex":"",
  "country":"",
  "province":"",
  "city":"",
  "client_platform_type":""
  "language":""
  }
 }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){                                            //https_request是写的一个用于微信接口数据传输的万能函数，几乎适应于所有微信接口数据的访问及提交，
   
    // 初始化一个 cURL 对象
    $curl = curl_init();                                                             //其原理是使用curl实现向微信公众平台接口http及https协议时的get，post方式。
    // 设置你需要抓取的URL
    curl_setopt($curl, CURLOPT_URL, $url);
    //检测服务器的证书是否由正规浏览器认证过的授权CA颁发的
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    //检测服务器的域名与证书上的是否一致
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // 抓取URL并把它传递给浏览器
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
?>