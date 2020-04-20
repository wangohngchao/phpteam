<?php
require_once "FaceOperate.php";


function SearchFace($imagefile,$url){
    $op = new FaceOperate("ewmW9SPA9Te4S0jKzT9RJyIZRfZmnGJJ", "Hiss1XtHqhNn55SVWKcYnAkoqg2-zkci");
    //首先检查是否存在着一张人脸
    $result = json_decode($op->FaceDetect($imagefile,$url,0,null));
    if(sizeof($result->faces) == 0){
        return null;
    }
    //若存在则进行搜索

    //找出人脸集合
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