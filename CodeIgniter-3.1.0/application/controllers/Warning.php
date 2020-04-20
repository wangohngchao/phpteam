<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Warning extends CI_Controller {

		function index(){

			$lquery = $this->db->query('SELECT coursename FROM s_message');
            $lrow = $lquery->row_array();
            foreach ($lquery->result_array() as $lrow){
            	$lessondata = $lrow['coursename'];
            	//echo $lessondata;  

            	$sql1 = "SELECT class FROM s_message where coursename='".$lessondata."'";
                $dquery = $this->db->query($sql1); 
                $drow = $dquery->row_array();
                foreach ($dquery->result_array() as $drow){
                	//echo $drow['class'];
                	//echo "<br>";

                	$sql2 = "SELECT s_wxid FROM s_student Where s_class='".$drow['class']."'";
                	$query = $this->db->query($sql2); 
                    $row = $query->row_array();
                    foreach ($query->result_array() as $row)
                    {             
                        $data = $row['s_wxid'];
                        $this->load->model("Warn_Model");
                        $this->Warn_Model->index($data);
                    }
                }
            	
            }
			

		}

	}
