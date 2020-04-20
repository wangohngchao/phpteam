<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Sub  extends CI_Controller {
         
    
       
   /* function callback(){
      define("TOKEN","weixin");
      $APPID='wx1e899749eca23a11';
      $REDIRECT_URI='http://1.phpteam2016.applinzi.com/CodeIgniter-3.1.0/index.php/Sub/out';
      //$scope='snsapi_base';
      $scope='snsapi_userinfo';//需要授权
      $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$APPID.'&redirect_uri='.urlencode($REDIRECT_URI).'&response_type=code&scope='.$scope.'&state=123#wechat_redirect';
      header("Location:".$url);
    }
    
    public function  out(){
             
      //获取用户openid
      $appid = "wx1e899749eca23a11";
      $secret = "9bfbf12883785558d5daea935b65c812";
      $code = $_GET["code"];
      
      $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
      
      $ch = curl_init();
      curl_setopt($ch,CURLOPT_URL,$get_token_url);
      curl_setopt($ch,CURLOPT_HEADER,0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      $res = curl_exec($ch);
      curl_close($ch);
      $json_obj = json_decode($res,true);
      $openid = $json_obj['openid'];  //用户微信openid
            
      //加载页面
      $this->load->view('qjteacher', $json_obj);
    }

    */

    
      

    public function index(){//新建一个方法
      $class = $this->input->get_post('class');        //班级
      $course = $this->input->get_post('course');      //课程
      $types = $this->input->get_post('types');        //消息类型
      $date = $this->input->get_post('riqi');          //日期 
      $openid = $this->input->get_post('wxid');        //openid
      $name = $this->input->get_post('stuname');       //学号
      $period = $this->input->get_post('period');      //查询时段
      $unit = $this->input->get_post('unit');          //查询单位
      $data=array($class,$course,$types,$date,$openid);
      $pdata=array($class,$course,$openid,$name,$period);
  //    echo $data[0];
      if($types == 1){
          if($unit=="班级"){
              $this->load->model("Qdinfo_Model");
              $query = $this->Qdinfo_Model->index($data);
              $list = array();
              $i = 0;
              foreach ($query->result_array() as $row)
              {
                  $list[$i]['id'] = $i+1;
                  $list[$i]['s_id'] = $row['s_id'];
                  $list[$i]['s_name'] = $row['s_name'];
                  $list[$i]['qiandao'] = $this->Qdinfo_Model->qiandao($data,$list[$i]['s_id']);
                  $list[$i]['date'] = $date;
                  $i++;
              }
             // //$query1 = $this->Qdinfo_Model->qiandao($data);

              $data1['list'] = $list;
              $this->load->view("qrinfo.php",$data1);
          }
          if($unit == "个人"){
              $this->load->model("Qdinfo_Model");
              $query = $this->Qdinfo_Model->getpersonqd($pdata);
          }
      }
    }
}