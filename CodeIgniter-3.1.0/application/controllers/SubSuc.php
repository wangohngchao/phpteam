<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* 处理请假信息
*/

class SubSuc extends CI_Controller{//文件名首字母大写
	 public function __construct()
    {
    parent::__construct();
    $this->load->model('nb_model');
  //加载数据模型
  }
    public function index(){
      $course = $this->input->get_post('course');      
      $date = $this->input->get_post('date');         
      $reason = $this->input->get_post('reasons');      
      $openid = $this->input->get_post('wxid');       
      $data=array($course,$date,$reason,$openid);
      $add = $this->nb_model->add_qjInf($data);
    
      $this->load->view('qj_success');
      
    }
}
?>
