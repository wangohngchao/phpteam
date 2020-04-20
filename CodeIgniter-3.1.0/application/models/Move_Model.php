<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Move_Model extends CI_Model
	{
		public function index($openid){

		
			$s = new SaeStorage();
            $a=$s->read( 'at' , 'Access_Token.txt');
	        $data = '{"openid":"'.$openid.'","to_groupid":103}';
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
	        $this->load->view("band_success.html");
		}
		public function move($openid){

		
			$s = new SaeStorage();
            $a=$s->read( 'at' , 'Access_Token.txt');
	        $data = '{"openid":"'.$openid.'","to_groupid":102}';
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
	        $this->load->view("band_success.html");
		}
		
	}