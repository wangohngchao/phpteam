<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Toexecl extends CI_Controller{
		public function index()
		{
			$theArray = $this->input->get_post('data');
	        echo $theArray[0]['id'];
		}
	}