<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Viewmessage extends CI_Controller {
  	public function index(){
	  	$class = $this->input->get_post('class');        //班级
	    $course = $this->input->get_post('course');      //课程
	    $types = $this->input->get_post('types');        //消息类型
	    $openid = $this->input->get_post('wxid');        //openid
	    $data=array($class,$course,$types,$openid);
	    $this->load->model("Notice_Model");
	    $query = $this->Notice_Model->view($data);
	    $list = array();
        $i = 0;
	    foreach ($query->result_array() as $row)
		{
            $list[$i]['class'] = $row['class'];
            $list[$i]['course'] = $row['course'];
            $list[$i]['send_date'] = $row['send_date'];
            $list[$i]['species'] =$row['species'];
            $list[$i]['content'] =$row['content'];
            $i++;
		}
		$data['list'] = $list;
        $this->load->view("showquery.php",$data);
  	}
  }