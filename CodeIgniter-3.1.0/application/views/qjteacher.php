<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" /><!--设置手机适应屏幕-->
<title>信息查询</title>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/jquery.js"></script>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/teacher_ask.js"></script>
<link href="/CodeIgniter-3.1.0/css/public.css" rel="stylesheet">
<link href="/CodeIgniter-3.1.0/css/teacher_ask.css" rel="stylesheet">
 <script type="text/javascript"> 
       function unitshow()  
        {  
            
            

                if(Select4.value=="个人"){
                	var mychar = document.getElementById("class1");
                    mychar.style.display = "none";
                    var mychar1 = document.getElementById("person");
                    mychar1.style.display = "block";
                }
                else{
                	var mychar = document.getElementById("class1");
                    mychar.style.display = "block";
                    var mychar1 = document.getElementById("person");
                    mychar1.style.display = "none";
                }
            
           
        }  
    </script>
</head>
<body>
<div class="main">
<header id="header" class="dark"><h2>学生信息查询</h2></header>
<div class="content">
    <div class="notice">
        <p> 老师，您好！<br />当前时间为：<?php
        date_default_timezone_set("Asia/Shanghai");
        echo date("Y-m-d"). '  '.date("h:i:sa");
        ?>
        </p>
    </div>
    <form action="http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/sub" method="post">
    <div class="main_form">
        <div class="form_option">
            <div class="left">请选择查询类型:<span class="error">*</span></div>
                <select id="Select1" class="select_1" name="types">
				<option value="1">签到信息</option>
				<option value="2">通知信息</option>
				</select>
        </div>
        <div class="form_option">
            <div class="left">请选择查询课程:<span class="error">*</span></div>
				<select id="Select3" class="select_1" name="course">
				<option value="0">请选择</option>
				<option>asp.net</option>
				<option>数据结构</option>
				</select>
        </div>
        <div class="form_class">
            <div class="left">请选择查询班级:<span class="error">*</span></div>
				<select id="Select2" class="select_1" name="class">
				<option>请选择</option>
				<option>软件11403班</option>
				<option>计科11506班</option>
				</select>
    <div id="tz">
         <div class="form_option">
            <div class="left">请选择查询单元:<span class="error">*</span></div>
				<select id="Select4" class="select_1" onclick="unitshow()" name="unit">
				<option value="班级">班级</option>
				<option value="个人">个人</option>
				</select>
        </div><br /><br />
        <div id="class1">
            <div class="left">请选择查询日期:<span class="error">*</span></div>
                <input type="datetime" class="select_1" name="riqi"></input>
        </div>
        <div id="person" style="display: none;" >
            <div class="left">请输入查询学号:<span class="error">*</span></div>
                <input type="text" class="select_1" name="stuname"></input><br /><br />
            <div class="left">请选择查询时段:<span class="error">*</span></div>
                <select id="Select5" class="select_1" name="period">
				<option value="0">请选择</option>
				<option value="1">最近两周</option>
				<option value="2">最近一个月</option>
				<option value="3">本学期</option>
				</select>
        </div>
    </div>
                <input type="hidden" value="<?php echo $openid;?>" name="wxid">
        </div>
        <div>
            <input id="Submit1" class="submit1" type="submit" value="查       询" />
        </div>
    </div>
    </form>
</div>
</div>
</body>
</html>
