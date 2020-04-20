<?php

/**
 * POST�����װ��
 *
 * @version 1.0
 * @author Vascal
 */
class Request
{

    /**
     * ����facepp��������
     * @param $url string ����ĺ������õ�ַ
     * @param $param array �������ò���
     * @return mixed ���ص�json�ַ���
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
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, FALSE); // https���� ����֤֤���hosts
        curl_setopt($url, CURLOPT_SSL_VERIFYHOST, FALSE);
        $response = curl_exec($url);
        curl_close($url);
        return $response;
    }
}