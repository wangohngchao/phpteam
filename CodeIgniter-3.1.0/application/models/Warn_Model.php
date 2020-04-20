<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Warn_Model extends CI_Model{
		public function index($openid){
			echo $openid;
			echo "<br>";
			$starttime=date("Y-m-d", strtotime("-30 days", time()));//-30；从现在时间倒回30  
            $endtime=date("Y-m-d");
			$sql = "SELECT * FROM s_sign Where q_s_wxid='".$openid."' AND DATE_FORMAT(q_time, '%Y-%m-%d') >= '$starttime' and DATE_FORMAT(q_time, '%Y-%m-%d') <= '$endtime'";                  
            $query = $this->db->query($sql);
            $row = $query->num_rows();    
            echo $row;
            echo "<br>";
            if($row<=2){  //判断是否达到本月预设值
            	$query2 = $this->db->query("SELECT s_id,s_name,s_class from s_student where s_wxid='".$openid."'");
			    $row1 = $query2->row_array();
			    $stuid = $row1['s_id'];
			    $name = $row1['s_name'];
			    $class = "asp.net";
			    $times = 4-$row;
                
				$s = new SaeStorage();
		        $access_token=$s->read( 'at' , 'Access_Token.txt');
		        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
		        $data = '{

		        "touser":"'.$openid.'",

		        "template_id":"Gg06-OcVULcnrBo3-pAm-an8exI9TCbSn7NvstmO3rU",

		        "url":"",            
		           "data":{
		                   "first": {
		                       "value":"\n",
		                       "color":"#000000"
		                   },
		                   "Name": {
		                       "value":"'.$name.'.\n",
		                       "color":"#173177"
		                   },
		                   "id": {
		                       "value":"'.$stuid.'.\n",
		                       "color":"#173177"
		                   },
		                   "class": {
		                       "value":"'.$class.'.\n",
		                       "color":"#173177"
		                   },
		                   "times": {
		                       "value":"'.$times.'.\n",
		                       "color":"#173177"
		                   },
		                   "remark":{
		                       "value":"",
		                       "color":"#000000"
		                }
		            }

		        }';


		        //https_request是写的一个用于微信接口数据传输的万能函数，几乎适应于所有微信接口数据的访问及提交，
		   
		        // 初始化一个 cURL 对象的
		        $curl = curl_init(); //其原理是使用curl实现向微信公众平台接口http及https协议时的get，post方式。
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



                $openid1 = "oAMv_sw3BChLD0NSxa1q61yVkVOQ";
		        $url1 = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
		        $data1 = '{

		        "touser":"'.$openid1.'",

		        "template_id":"Gg06-OcVULcnrBo3-pAm-an8exI9TCbSn7NvstmO3rU",

		        "url":"",            
		           "data":{
		                   "first": {
		                       "value":"\n",
		                       "color":"#000000"
		                   },
		                   "Name": {
		                       "value":"'.$name.'.\n",
		                       "color":"#173177"
		                   },
		                   "id": {
		                       "value":"'.$stuid.'.\n",
		                       "color":"#173177"
		                   },
		                   "class": {
		                       "value":"'.$class.'.\n",
		                       "color":"#173177"
		                   },
		                   "times": {
		                       "value":"'.$times.'.\n",
		                       "color":"#173177"
		                   },
		                   "remark":{
		                       "value":"",
		                       "color":"#000000"
		                }
		            }

		        }';


		        //https_request是写的一个用于微信接口数据传输的万能函数，几乎适应于所有微信接口数据的访问及提交，
		   
		        // 初始化一个 cURL 对象的
		        $curl = curl_init(); //其原理是使用curl实现向微信公众平台接口http及https协议时的get，post方式。
		        // 设置你需要抓取的URL
		        curl_setopt($curl, CURLOPT_URL, $url1);
		        //检测服务器的证书是否由正规浏览器认证过的授权CA颁发的
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		        //检测服务器的域名与证书上的是否一致
		        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		        if (!empty($data)){
		           curl_setopt($curl, CURLOPT_POST, 1);
		           curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
		        }
		        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		        // 抓取URL并把它传递给浏览器
		        $output = curl_exec($curl);
		        curl_close($curl);
	        }
		}

	}
