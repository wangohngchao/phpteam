<?php  defined('BASEPATH') OR exit('No direct script access allowed');
/*
*    
*     教师端控制器
*
*/
class Teacher extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    /*
    *  测试其他代码
    */
   public function test(){
            $query = $this->db->query('SELECT s_name FROM s_student');
            $row = $query->row_array();
            foreach ($query->result_array() as $row)
            {             
                echo $row['s_name'];
            }
   }
	/*
	*  生成签到二维码
	*/
	public function index()
	{
		/*$this->load->library("Qrcode.php");
        $level = "L";
        $data = 'http://1.phpteam2016.applinzi.com/CodeIgniter-3.1.0/index.php/stu/getinfo';
        $size=10;	    
        QRcode::png($data,false,$level,$size);*/
        //echo $this->qrcode->png("http://1.phpteam2016.applinzi.com/CodeIgniter-3.1.0/index.php/stu/getinfo");
        $s = new SaeStorage();
        $a=$s->read( 'at' , 'Access_Token.txt');
        $data = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}';
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$a;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $info = json_decode($output);
        $ticket = $info->ticket;
        $qrurl = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='$qrurl'";
        echo "</script>";
        //echo $qrurl;
        //header("Location:".$qrurl);
        //exit();
	}  
    /*
    * 教师查看信息
    */
    public function ask()
    {   
        $data['openid'] = $_GET["openid"];
    	$this->load->view("qjteacher",$data);
    }
    /*
    * 教师查看请假概况
    */
    public function rough()
    {
    	$this->load->view("qjrough");
    }
    
    public function notice()
    {
        $data['openid'] = $_GET["openid"];
    	$this->load->view("tztea",$data);
    }
    /*
    * 用户信息查看
    */
    public function userinfo()
    {
        $openid = $_GET["openid"];
    	$this->load->model('Userinfo_Model');
        $this->Userinfo_Model->teaindex($openid);
    }
   
}
