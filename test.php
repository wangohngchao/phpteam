<?php

require_once "./distance.php"; 
$openid= 'oAMv_s2wxbeIRLcqS_IHcH0urdiQ';
$studentid = 1404240626;
$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
	if($link){  
	# 选择数据库  



		$link = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);  
        if($link){  
        # 选择数据库  
            mysql_select_db(SAE_MYSQL_DB, $link);mysql_query("SET NAMES UTF8");
            $sql1 = "SELECT s_wxid,s_class FROM s_student where s_id='".$studentid."'"; 
            $query = mysql_query($sql1, $link); 
            $newArray = mysql_fetch_array($query);
            $wxid = $newArray[0];
            $class = $newArray[1];
            echo $wxid;
           // echo $class;
            // yor code goes here      
            // query array of 0 ~ 30   
            $sql = "INSERT INTO s_sign (s_id,sign_id,q_s_wxid,q_time,class) VALUES ('$studentid','0','$wxid',now(),'$class')";    
            $result = mysql_query($sql, $link); 
        }
	    /*mysql_select_db(SAE_MYSQL_DB, $link);mysql_query("SET NAMES UTF8");
	    
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
	    echo $lat1;       
	    $lng1 = $row['1'];echo $lng1;

	    $query7 = mysql_query("SELECT latitude,longitude from s_location where wxid='".$openid."' ");   
	    $row = mysql_fetch_row($query7);
	    $lat2 = $row['0'];   echo $lat2;       //获取学生经纬度
	    $lng2 = $row['1'];echo $lng2;
	    echo "<br />";
	    $distance = getDistance($lat1, $lng1, $lat2, $lng2);
	    echo $distance;
	    echo "13";*/
	}
    <script type="text/javascript"> 
       function validity()  
        {  
            if(usernum.value==""){
            	var mychar = document.getElementById("class1");
                mychar.imap_alerts = "未填写学（工）号";
            }
            else if(username.value==""){
            	var mychar = document.getElementById("class1");
                mychar.style.display = "未填写姓名";
            }
        }  
    </script>