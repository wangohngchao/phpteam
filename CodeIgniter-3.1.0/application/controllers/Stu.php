<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
*   
*     学生端控制器
*/
class Stu extends CI_Controller{

	/*
	*  签到成功，获取当前扫描学生信息
	*/

	public function getinfo(){//新建一个方法
			$this->load->model('Qrinfo');
			$this->Qrinfo->putinfo();
		}		

	/*
	* 签到失败
	*/
	public function faultmsg()
	{ 
		$this->load->view("fault.html");
	}

	/*
	* 学生请假
	*/
	public function ask()
	{
		$openid = $_GET["openid"];
	    $this->load->database();
		$this->load->model("Nb_model");
        $data['nb1']=$this->Nb_model->get_coursename();
    	$data['nb2']=$this->Nb_model->get_dateTime();
    	$data['openid'] = $openid;
        $this->load->view("qjstu",$data);
	}
    
    public function notice()
	{
		$openid = $_GET["openid"];
		$data['openid'] = $openid;
		$this->load->view('tzstudent.php',$data);
	}
	

	/*
	*  解除绑定，移除openid
	*/
	public function noband(){
		$this->load->model('');
		$this->load->view('noband.html');
	}
	/*
	*  点击获取学生信息

	*/
	public function userinfo(){
		$openid = $_GET["openid"];
		$this->load->model('Userinfo_Model');
		$this->Userinfo_Model->stuindex($openid);
	}
}