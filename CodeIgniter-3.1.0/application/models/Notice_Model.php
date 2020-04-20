<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Notice_Model extends CI_Model{
		public function index($data)
		{
			$query = $this->db->query("SELECT t_id from s_teacher where t_wxid='".$data[4]."'");
		    $row = $query->row_array();
		    $id = $row['t_id'];
            $query1 = $this->db->query("INSERT INTO s_notice (t_id,class,course,send_date,species,content) VALUES ('".$id."','".$data[0]."','".$data[1]."',now(),'".$data[2]."','".$data[3]."')");
            
		}
		public function view($data){
			$query = $this->db->query("SELECT s_class from s_student where s_wxid='".$data[3]."'");
			$row = $query->row_array();
		    $class = $row['s_class'];
		    /*
		    *  查询改名学生所在课程教师ID  但因通知表构造，此查询可省去
		    $query1 = $this->db->query("SELECT t_id from s_message where class='".$data[0]."' and coursename='".$data[1]."'");
		    $row = $query->row_array();
		    $id = $row['t_id'];
		    */
		    $daynum = date('Y-m-d',strtotime('-14 day'));
		    $query2 = $this->db->query("SELECT * from s_notice where class='".$class."' and course='".$data[1]."' and species='".$data[2]."' and send_date>'".$daynum."' ");
		    return $query2;
		}
	}