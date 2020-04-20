<?php
require_once "Request.php";

/**
 * 提供有关于人脸识别、人脸比对、人脸搜索、设置人脸ID的操作类
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
     * 检测人脸
     * @param string $filename 提供检测的本地图片路径
     * @param string $imageurl 提供检测的url
     * @param int $landmark 是否检测并返回人脸五官和轮廓的83个关键点。(1:检测,0:不检测。默认值为0)
     * @param string $attributes 是否检测并返回根据人脸特征判断出的年龄，性别，微笑、人脸质量等属性
     * @return string 返回json字符串
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
     * 人脸比对（可使用人脸token或者本地图片）
     * @param string $filename1 本地图片1
     * @param string $filename2 本地图片2
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
     * 设置人脸ID，为检测出的某一个人脸添加标识信息，该信息会在Search接口结果中返回，用来确定用户身份。
     * @param string $facetoken 人脸标识face_token
     * @param string $userid 用户自定义的user_id，不超过255个字符，不能包括^@,&=*'"
     */
    public function SetUserId($facetoken, $userid){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/face/setuserid";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'face_token'=>$facetoken, 'user_id'=>$userid);

        return $request->doPost($url, $param);
    }

    /**
     * 在Faceset中找出与目标人脸最相似的一张或多张人脸。
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