<?php

require_once "Request.php";

/**
 * 提供有关人脸集合的相关操作
 *
 *
 * @version 1.0
 * @author Vascal
 *
 * @var $apikey string
 * @var $apisecret string
 */
class FaceSetOperate
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
     * 创建一个人脸的集合FaceSet，用于存储人脸标识face_token。一个FaceSet能够存储1,000个face_token。
     * @param string $displayname 人脸集合的名字，256个字符，不能包括字符^@,&=*'"
     * @param string $outerid 账号下全局唯一的FaceSet自定义标识，可以用来管理FaceSet对象。最长255个字符，不能包括字符^@,&=*'"
     * @param string $tags FaceSet自定义标签组成的字符串，用来对FaceSet分组。最长255个字符，多个tag用逗号分隔，每个tag不能包括字符^@,&=*'"
     * @param string $facetokens 人脸标识face_token，可以是一个或者多个，用逗号分隔。最多不超过5个face_token
     * @param string $userdata 自定义用户信息，不大于16KB，不能包括字符^@,&=*'"
     * @param int $forcemerge 在传入outer_id的情况下，如果outer_id已经存在，是否将face_token加入已经存在的FaceSet中(0：不将face_tokens加入已存在的FaceSet中，直接返回FACESET_EXIST错误，1：将face_tokens加入已存在的FaceSet中，默认值为0）
     */
    public function FaceSetCreate($displayname,$outerid,$tags,$facetokens,$userdata,$forcemerge){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/create";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'display_name'=>$displayname,'outer_id'=>$outerid, '$tags'=>$tags, 'face_tokens'=>$facetokens, 'user_data'=>$userdata, 'force_merge'=>$forcemerge);

        return $request->doPost($url, $param);
    }

    /**
     * 删除一个人脸集合。
     * @param string $facesettoken FaceSet的标识
     * @param string $outerid 用户提供的FaceSet标识
     * @param int $checkempty 删除时是否检查FaceSet中是否存在face_token，默认值为1(0：不检查,1：检查,如果设置为1，当FaceSet中存在face_token则不能删除)
     */
    public function FaceSetDelete($facesettoken, $outerid, $checkempty){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/delete";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid, 'check_empty'=>$checkempty);

        return $request->doPost($url, $param);
    }

    /**
     * 获取一个FaceSet的所有信息
     * @param string $facesettoken 人脸集合标识
     * @param string $outerid 用户提供的人脸集合标识
     */
    public function GetDetail($facesettoken, $outerid){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/getdetail";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid);

        return $request->doPost($url, $param);
    }

    /**
     * 为一个已经创建的FaceSet添加人脸标识face_token。一个FaceSet最多存储1,000个face_token。
     * @param string $facesettoken FaceSet的标识
     * @param string $outerid 用户提供的FaceSet的标识
     * @param string $facetokens 人脸识别face_token组成的字符串，可以是一个或者多个，用逗号分隔。最多不超过五个
     */
    public function AddFace($facesettoken, $outerid, $facetokens){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/addface";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid, 'face_tokens'=>$facetokens);

        return $request->doPost($url, $param);
    }

    /**
     * 移除一个FaceSet中的某些或者全部FaceToken
     * @param string $facesettoken FaceSet的标识
     * @param string $outerid 用户自定义的FaceSet标识
     * @param string $facetokens 需要移除的人脸标识字符串，可以是一个或者多个face_token组成，用逗号分隔。最多不能超过1,000个face_token（注：face_tokens字符串传入“RemoveAllFaceTokens”则会移除FaceSet内所有的face_token）。
     */
    public function RemoveFace($facesettoken, $outerid,$facetokens){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/removeface";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid, 'face_tokens'=>$facetokens);

        return $request->doPost($url, $param);
    }

    /**
     * 更新一个人脸集合的属性
     * @param string $facesettoken FaceSet的标识
     * @param string $outerid 用户自定义的FaceSet标识
     * @param string $newouterid 在api_key下全局唯一的FaceSet自定义标识，可以用来管理FaceSet对象。最长255个字符，不能包括字符^@,&=*'"
     * @param string $displayname
     * @param string $user_data
     * @param string $tags 
     */
    public function Update($facesettoken, $outerid, $newouterid, $displayname, $user_data, $tags){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/update";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid, 'new_outer_id'=>$newouterid, 'display_name'=>$displayname, 'user_data'=>$user_data, 'tags'=>$tags);

        return $request->doPost($url, $param);
    }

    /**
     * 获取所有的FaceSet
     * @param string $tags 包含需要查询的FaceSet标签的字符串，用逗号分隔
     * @param int $start 传入参数start，控制从第几个Faceset开始返回。返回的Faceset按照创建时间排序，每次返回1000个FaceSets。默认值为1。
     */
    public function GetFaceSets($tags=null, $start=null){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/getfacesets";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'tags'=>$tags,'start'=>$start);

        return $request->doPost($url, $param);
    }
}