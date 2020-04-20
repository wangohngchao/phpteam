<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Userinfo_Model extends CI_Model{
		public function stuindex($openid){
            $sql = "SELECT * FROM s_student WHERE s_wxid = '".$openid."'";
			$query = $this->db->query($sql);
			$list = array();
			foreach ($query->result_array() as $row)
			{
			    $list['id'] = $row['s_id'];
			    $list['name'] = $row['s_name'];
			    $list['sex'] = $row['s_sex'];
			    $list['class'] = $row['s_class'];
			}
			$data1['list'] = $list;
			$this->load->view("tuserinfo.php",$data1);
		}
		public function teaindex($openid){
            $sql = "SELECT * FROM s_teacher WHERE t_wxid = '".$openid."'";
			$query = $this->db->query($sql);
			$list = array();
			foreach ($query->result_array() as $row)
			{
			    $list['id'] = $row['t_id'];
			    $list['name'] = $row['t_name'];
			    $list['sex'] = $row['t_sex'];
			} 
			$data1['list'] = $list;
			$this->load->view("userinfo.php",$data1);
		}
	}