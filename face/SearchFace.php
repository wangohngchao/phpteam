<?php
require_once "FaceOperate.php";


function SearchFace($imagefile,$url){
    $op = new FaceOperate("ewmW9SPA9Te4S0jKzT9RJyIZRfZmnGJJ", "Hiss1XtHqhNn55SVWKcYnAkoqg2-zkci");
    //���ȼ���Ƿ������һ������
    $result = json_decode($op->FaceDetect($imagefile,$url,0,null));
    if(sizeof($result->faces) == 0){
        return null;
    }
    //���������������

    //�ҳ���������
    $faces=$result->faces;
    $retStr=array();
    $i=0;
    foreach($faces as $face){
        $theface=json_decode($op->SearchFace(null,null,$face->face_token,"7a28ee7a1b2245b918ab2e412097ea76"));
        $rs=$theface->results;
        $retStr[$i]=$rs[0]->user_id;
        $i++;
    }

    return $retStr;
}

?>