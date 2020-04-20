<?php

require_once "Request.php";

/**
 * �ṩ�й��������ϵ���ز���
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
     * ����һ�������ļ���FaceSet�����ڴ洢������ʶface_token��һ��FaceSet�ܹ��洢1,000��face_token��
     * @param string $displayname �������ϵ����֣�256���ַ������ܰ����ַ�^@,&=*'"
     * @param string $outerid �˺���ȫ��Ψһ��FaceSet�Զ����ʶ��������������FaceSet�����255���ַ������ܰ����ַ�^@,&=*'"
     * @param string $tags FaceSet�Զ����ǩ��ɵ��ַ�����������FaceSet���顣�255���ַ������tag�ö��ŷָ���ÿ��tag���ܰ����ַ�^@,&=*'"
     * @param string $facetokens ������ʶface_token��������һ�����߶�����ö��ŷָ�����಻����5��face_token
     * @param string $userdata �Զ����û���Ϣ��������16KB�����ܰ����ַ�^@,&=*'"
     * @param int $forcemerge �ڴ���outer_id������£����outer_id�Ѿ����ڣ��Ƿ�face_token�����Ѿ����ڵ�FaceSet��(0������face_tokens�����Ѵ��ڵ�FaceSet�У�ֱ�ӷ���FACESET_EXIST����1����face_tokens�����Ѵ��ڵ�FaceSet�У�Ĭ��ֵΪ0��
     */
    public function FaceSetCreate($displayname,$outerid,$tags,$facetokens,$userdata,$forcemerge){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/create";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret, 'display_name'=>$displayname,'outer_id'=>$outerid, '$tags'=>$tags, 'face_tokens'=>$facetokens, 'user_data'=>$userdata, 'force_merge'=>$forcemerge);

        return $request->doPost($url, $param);
    }

    /**
     * ɾ��һ���������ϡ�
     * @param string $facesettoken FaceSet�ı�ʶ
     * @param string $outerid �û��ṩ��FaceSet��ʶ
     * @param int $checkempty ɾ��ʱ�Ƿ���FaceSet���Ƿ����face_token��Ĭ��ֵΪ1(0�������,1�����,�������Ϊ1����FaceSet�д���face_token����ɾ��)
     */
    public function FaceSetDelete($facesettoken, $outerid, $checkempty){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/delete";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid, 'check_empty'=>$checkempty);

        return $request->doPost($url, $param);
    }

    /**
     * ��ȡһ��FaceSet��������Ϣ
     * @param string $facesettoken �������ϱ�ʶ
     * @param string $outerid �û��ṩ���������ϱ�ʶ
     */
    public function GetDetail($facesettoken, $outerid){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/getdetail";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid);

        return $request->doPost($url, $param);
    }

    /**
     * Ϊһ���Ѿ�������FaceSet���������ʶface_token��һ��FaceSet���洢1,000��face_token��
     * @param string $facesettoken FaceSet�ı�ʶ
     * @param string $outerid �û��ṩ��FaceSet�ı�ʶ
     * @param string $facetokens ����ʶ��face_token��ɵ��ַ�����������һ�����߶�����ö��ŷָ�����಻�������
     */
    public function AddFace($facesettoken, $outerid, $facetokens){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/addface";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid, 'face_tokens'=>$facetokens);

        return $request->doPost($url, $param);
    }

    /**
     * �Ƴ�һ��FaceSet�е�ĳЩ����ȫ��FaceToken
     * @param string $facesettoken FaceSet�ı�ʶ
     * @param string $outerid �û��Զ����FaceSet��ʶ
     * @param string $facetokens ��Ҫ�Ƴ���������ʶ�ַ�����������һ�����߶��face_token��ɣ��ö��ŷָ�����಻�ܳ���1,000��face_token��ע��face_tokens�ַ������롰RemoveAllFaceTokens������Ƴ�FaceSet�����е�face_token����
     */
    public function RemoveFace($facesettoken, $outerid,$facetokens){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/removeface";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'faceset_token'=>$facesettoken, 'outer_id'=>$outerid, 'face_tokens'=>$facetokens);

        return $request->doPost($url, $param);
    }

    /**
     * ����һ���������ϵ�����
     * @param string $facesettoken FaceSet�ı�ʶ
     * @param string $outerid �û��Զ����FaceSet��ʶ
     * @param string $newouterid ��api_key��ȫ��Ψһ��FaceSet�Զ����ʶ��������������FaceSet�����255���ַ������ܰ����ַ�^@,&=*'"
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
     * ��ȡ���е�FaceSet
     * @param string $tags ������Ҫ��ѯ��FaceSet��ǩ���ַ������ö��ŷָ�
     * @param int $start �������start�����ƴӵڼ���Faceset��ʼ���ء����ص�Faceset���մ���ʱ������ÿ�η���1000��FaceSets��Ĭ��ֵΪ1��
     */
    public function GetFaceSets($tags=null, $start=null){
        $request = new Request();
        $url = "https://api-cn.faceplusplus.com/facepp/v3/faceset/getfacesets";

        $param = array('api_key'=>$this->apikey, 'api_secret'=>$this->apisecret,'tags'=>$tags,'start'=>$start);

        return $request->doPost($url, $param);
    }
}