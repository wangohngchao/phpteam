<?php
  class user{
    function Chat($date){

    	if($date=="王宏超"){
    		$intro = "武汉纺织大学软件11403班，中共预备党员！666";
    		return $intro;
    	}
    	else{
		    $APIkey='9cfff17f971849f49e5aa67e5e0694a7';
		    //$date = "天气？";
		    $url = "http://www.tuling123.com/openapi/api?key=".$APIkey."&info=".$date;    
		    $data = null;                                        
		    // 初始化一个 cURL 对象
		    $curl = curl_init();                                                              //其原理是使用curl实现向微信公众平台接口http及https协议时的get，post方式。
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
		    //return $output;
		    $res = json_decode($output);
		    return $res->text;
		}
    }   
}

