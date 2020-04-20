<?
	defined('BASEPATH') OR exit('No direct script access allowed');


class Nb_model extends CI_Model {

  public function __construct()
  {
    //连接数据库
    $this->load->database();
  }

  public function get_coursename(){
 $query=$this->db->query('select courseName from course');
return $query->result();
}

public function get_dateTime(){
$query=$this->db->query('SELECT dataTime FROM `course` WHERE 1');
return $query->result();
}
public function add_qjInf($data){
      $sql1 = "SELECT s_id,s_name,s_class from s_student where s_wxid='".$data[3]."'";
      $query = $this->db->query($sql1); 
      $row = $query->row_array();
      $stuid = $row['s_id'];
      $name = $row['s_name'];
      $class = $row['s_class'];
      $sql = "insert into qj(stuid,name,class,openid,course,date,reason)  
      values('$stuid','$name','$class','".$data[3]."','".$data[0]."','".$data[1]."','".$data[2]."')";
      $result = $this->db->query($sql); 
      $sql2 = "SELECT t_id from s_message where coursename='".$data[0]."' and class='".$class."'";
      $query1 = $this->db->query($sql2); 
      $row1 = $query1->row_array();
      $teaid = $row1['t_id'];
      $sql3 = "SELECT t_wxid from s_teacher where t_id='".$teaid."' ";
      $query2 = $this->db->query($sql3); 
      $row2 = $query2->row_array();
      $openid = $row2['t_wxid'];
      /*
      * 向教师发送请假信息
      */
      
        $s = new SaeStorage();
        $access_token=$s->read( 'at' , 'Access_Token.txt');

       

       $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
       $data = '{

    "touser":"'.$openid.'",

    "template_id":"b_Lx0KZPH-HbSrtXA0ReNRE1cfbdeay_-tMDi_HcHZc",

    "url":"",            
           "data":{
                   "first": {
                       "value":"\n",
                       "color":"#000000"
                   },
                   "class":{
                       "value":"'.$class.'.\n",
                       "color":"#173177"
                   },
                   "Name": {
                       "value":"'.$name.'.\n",
                       "color":"#173177"
                   },
                   "id": {
                       "value":"'.$stuid.'.\n",
                       "color":"#173177"
                   },
                   "time": {
                       "value":"'.$data[1].'.\n",
                       "color":"#173177"
                   },
                   "reason": {
                       "value":"'.$data[2].'.\n",
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
    
  }
}