<?php

/**
* @desc  根据两点间的经纬度计算距离 
* @param float $lat 纬度值 
* @param float $lng 经度值 
*/
function getDistance($lat1, $lng1, $lat2, $lng2) 
{ 
	$earthRadius = 6367000; //approximate radius of earth in meters  
	/* 
	Convert these degrees to radians 
	to work with the formula 
	*/
	 
	$lat1 = ($lat1 * pi() ) / 180; 
	$lng1 = ($lng1 * pi() ) / 180; 
	 
	$lat2 = ($lat2 * pi() ) / 180; 
	$lng2 = ($lng2 * pi() ) / 180; 
	 
	/* 
	Using the 
	Haversine formula 
	calculate the distance 
	*/
	 
	$calcLongitude = $lng2 - $lng1; 
	$calcLatitude = $lat2 - $lat1; 
	$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2); 
	$stepTwo = 2 * asin(min(1, sqrt($stepOne))); 
	$calculatedDistance = $earthRadius * $stepTwo; 
	return round($calculatedDistance); 
} 

/**
* @desc   查询两人位置坐标 
* @return 两人距离 
*/
function coordinates($openid)
{
	$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
	if($link){  
	# 选择数据库  
	    mysql_select_db(SAE_MYSQL_DB, $link);mysql_query("SET NAMES UTF8");
	    
	    $query3 = mysql_query("SELECT s_class from s_student where s_wxid='".$openid."'");
	    $row = mysql_fetch_row($query3);
	    $class = $row['0']; 
	    $query4 = mysql_query("SELECT t_id from s_message where class='".$class."' and coursename='asp.net' ");                        //此处课程先设为默认值asp.net
	    $row = mysql_fetch_row($query4);
	    $teaid = $row['0'];            //获取授课教师ID
	    $query6 = mysql_query("SELECT t_wxid from s_teacher where t_id='".$teaid."'");   
	    $row = mysql_fetch_row($query6);
	    $topenid = $row['0'];          //获取授课教师OPENID
	 
	    $query5 = mysql_query("SELECT latitude,longitude from s_location where wxid='".$topenid."' ");   
	    $row = mysql_fetch_row($query5);
	    $lat1 = $row['0'];             //获取教师经纬度      
	    $lng1 = $row['1'];

	    $query7 = mysql_query("SELECT latitude,longitude from s_location where wxid='".$openid."' ");   
	    $row = mysql_fetch_row($query7);
	    $lat2 = $row['0'];          //获取学生经纬度
	    $lng2 = $row['1'];

	    $diatance = getDistance($lat1, $lng1, $lat2, $lng2);
	    return $diatance;
	       
	    }

}

/**
* @desc   判断该openID是否已经签到 
* @return 两人距离 
*/
function sign($openid)
{
	$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
	if($link){  
	# 选择数据库  
	    mysql_select_db(SAE_MYSQL_DB, $link);mysql_query("SET NAMES UTF8");	    
	    $daynum = date('Y-m-d H:i:s',strtotime('-1 hours'));echo $daynum;
        $sql2 = "SELECT s_id FROM s_sign WHERE q_s_wxid='".$openid."' and sign_id='0' and   
                 q_time>'".$daynum."' ";
        $query2 = mysql_query($sql2, $link); 
        $newArray1 = mysql_fetch_row($query2);
        $sid = $newArray1[0];
        if($sid)
           return 1;
        else
           return 0;   //该返回值表示1小时之内为签到
	}
	else
	    return 1;
}