<?php

/**
 * POST请求包装类
 *
 * @version 1.0
 * @author Vascal
 */
class Request
{

    /**
     * 发送facepp函数调用
     * @param $url string 请求的函数调用地址
     * @param $param array 函数调用参数
     * @return mixed 返回的json字符流
     */
    public function doPost($url,$param){
        $url=curl_init($url);
        curl_setopt($url,CURLOPT_POST,true);
        curl_setopt($url, CURLOPT_FRESH_CONNECT, false);
        curl_setopt($url,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $param);
        if(version_compare(phpversion(),"5.5","<=")){
            curl_setopt($url, CURLOPT_CLOSEPOLICY,CURLCLOSEPOLICY_LEAST_RECENTLY_USED);
        }else{
            curl_setopt($url, CURLOPT_SAFE_UPLOAD, false);
        }
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($url, CURLOPT_SSL_VERIFYHOST, FALSE);
        $response = curl_exec($url);
        curl_close($url);
        return $response;
    }
}