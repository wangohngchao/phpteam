<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		/**
		* Created by PhpStorm.
		* User: john
		* Date: 2016/7/20
		* Time: 9:11
		*/
		class Test extends CI_Controller{
		//文件名首字母大写
			public function getinfo(){//新建一个方法
			 $query = $this->db->query('SELECT s_name FROM s_student');
			$row = $query->row_array();
			echo $row['name'];
		}		