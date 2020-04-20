<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Notice extends CI_Controller {
		public function index()
		{
		$class = $this->input->get_post('class');        //班级
            $course = $this->input->get_post('course');      //课程
            $types = $this->input->get_post('types'); 
            $content = $this->input->get_post('content');
            $openid = $this->input->get_post('wxid');
            $data=array($class,$course,$types,$content,$openid);
            $this->load->model('Notice_Model');
            $this->Notice_Model->index($data);
            
            $this->load->view('tzsuccess');
           
		}
	}