<?php
require_once "Request.php";

/**
 * �ṩ�й�������ʶ�������ȶԡ�������������������ID�Ĳ�����
 *
 *
 * @version 1.0
 * @author Vascal
 * 
 * @var $apikey string
 * @var $apisecret string
 */
class FaceOperate
{
    private $apikey;
    private $apisecret;

    /**
     * @param string $api_key API Key
     * @param string $api_secret API Secret
     */
    public function __construct($api_key, $api_secret){
        $this->apikey=$api_key;
        $this->apisecret=$api_secret;
    }

    /**
     * �������
     * @param string $filename �ṩ���ı���ͼƬ·��
     * @param string $imageurl �ṩ����url
     * @param int $landmark �Ƿ��Ⲣ����������ٺ�������83���ؼ��㡣(1:���,0:����⡣Ĭ��ֵΪ0)
     * @param string $attributes �Ƿ��Ⲣ���ظ������������жϳ������䣬�Ա�΢Ц����������������
     * @return string ����json�ַ���
     */
    public function FaceDetect($filename, $imageurl, $landmark, $attributes){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/detect";

        if($filename != null){
            $imagefile=curl_file_create($filename);
            $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'image_file'=>$imagefile, 'return_landmark'=>$landmark, 'return_attributes'=>$attributes);
        }
        else{
            $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'image_url'=>$imageurl, 'return_landmark'=>$landmark, 'return_attributes'=>$attributes);
        }
        return $request->doPost($url, $param);
    }

    /**
     * �����ȶԣ���ʹ������token���߱���ͼƬ��
     * @param string $filename1 ����ͼƬ1
     * @param string $filename2 ����ͼƬ2
     * @param string $facetoken1    face_token1
     * @param string $facetoken2    face_token2
     * @return string
     */
    public function FaceCompare($filename1, $filename2, $facetoken1, $facetoken2){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/compare";
        $param = null;
        if($filename1 != null){
            $img1 = curl_file_create($filename1);
            $img2 = curl_file_create($filename2);

            $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'image_file1'=>$img1,'image_file2'=>$img2);
        }else{

            $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'face_token1'=>$facetoken1,'face_token2'=>$facetoken2);
        }
        
        return $request->doPost($url, $param);
    }

    /**
     * ��������ID��Ϊ������ĳһ��������ӱ�ʶ��Ϣ������Ϣ����Search�ӿڽ���з��أ�����ȷ���û���ݡ�
     * @param string $facetoken ������ʶface_token
     * @param string $userid �û��Զ����user_id��������255���ַ������ܰ���^@,&=*'"
     */
    public function SetUserId($facetoken, $userid){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/face/setuserid";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'face_token'=>$facetoken, 'user_id'=>$userid);

        return $request->doPost($url, $param);
    }

    /**
     * ��Faceset���ҳ���Ŀ�����������Ƶ�һ�Ż����������
     * @param string $imageurl
     * @param string $facesettoken
     * @return mixed
     */
    public function SearchFace($imageurl,$imagefile, $facetoken,$facesettoken){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/search";

        if($imagefile != null){
            $imagefile=curl_file_create($imagefile);
            $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'face_token'=>$facetoken,'faceset_token'=>$facesettoken, 'image_file'=>$imagefile);
        }
        else{
            $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'face_token'=>$facetoken, 'faceset_token'=>$facesettoken, 'image_url'=>$imageurl);
        }

        

        return $request->doPost($url, $param);

    }
}