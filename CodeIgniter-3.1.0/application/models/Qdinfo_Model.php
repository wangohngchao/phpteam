<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Qdinfo_Model extends CI_Model{
		public function index($data){
			/*
            *  数据库查询操作
            */  
            try{       
			    $query2 = $this->db->query("SELECT s_id,s_name from s_student where s_class='".$data[0]."'");
	            return $query2;
            }
            catch(Exception $e){
                $this->load->view("find_fault.php");
            }
		    
		}
		public function qiandao($data,$stuid){
			/*
			*  查询签到信息
			*/
			$query = $this->db->query("SELECT t_id from s_teacher where t_wxid='".$data[4]."'");
		    $row = $query->row_array();
		    $tid = $row['t_id'];

		    $query1 = $this->db->query("SELECT signid from s_message where coursename='".$data[1]."' and t_id = '".$tid."' and class='".$data[0]."' ");
		    $row1 = $query1->row_array();
		    $signid = $row1['signid'];

		    $query3 = $this->db->query("SELECT s_id from s_sign where sign_id='".$signid."' and q_time='".$data[3]."' ");
		    $row2 = $query3->row_array();
		    $qiandao = array();
		    $j = 0;
            foreach ($query3->result_array() as $row2)
            {
                 $qiandao[$j] = $row2['s_id'];
                 $j++;
            }
            foreach ($qiandao as $value)
			{
			     if($value==$stuid)
			     	return 1;
			}
			return 0;
		}
		public function getpersonqd($data){
			$query2 = $this->db->query("SELECT s_wxid,s_name from s_student where s_id='".$data[3]."'");
		    $row = $query2->row_array();
		    $openid = $row['s_wxid'];

		    $name = $row['s_name'];

		    $query = $this->db->query("SELECT t_id from s_teacher where t_wxid='".$data[2]."'");
		    $row = $query->row_array();
		    $tid = $row['t_id'];

		    $query1 = $this->db->query("SELECT signid from s_message where coursename='".$data[1]."' and t_id = '".$tid."' and class='".$data[0]."' ");
		    $row1 = $query1->row_array();
		    $signid = $row1['signid'];

            if($data[4]=="1"){
            	$daynum = date('Y-m-d',strtotime('-14 day'));
            	$number = 4;
            }
            if($data[4]=="2"){
            	$daynum = date('Y-m-d',strtotime('-1 month'));
            	$number = 8;
            }
		    $result = $this->db->query("SELECT * from s_sign where sign_id='".$signid."' and q_s_wxid = '".$openid."' and q_time>'".$daynum."' ");
		    $count = $result->num_rows();
		    $data['qdcount'] = $count;
		    $data['totalcount'] = $number;
		    $data['name'] = $name;

            $this->load->view("qrinfo_person.php",$data);
		}
	} 
	