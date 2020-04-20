<!doctype html> 
<html lang="en"> 
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" /><!--设置手机适应屏幕-->
<title>信息通知</title>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/jquery.js"></script>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/teacher_ask.js"></script>
<link href="/CodeIgniter-3.1.0/css/public.css" rel="stylesheet">
<link href="/CodeIgniter-3.1.0/css/teacher_ask.css" rel="stylesheet">
 
</head>
<body>
<div class="main">
<header id="header" class="dark"><h2>信息通知</h2></header>
<div class="content">
    <div class="notice">
        <p>注意事项：</p>
            <p><span class="error">*</span>红色标记为必填项。</p>
    </div>
    <form action="http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/notice" method="post">
    <div class="main_form">
        <div class="form_option">
            <div class="left">请选择通知班级:<span class="error">*</span></div>
                <select name="class" id="class" class="select_1" >
                <option>请选择</option>
                <option>软件11403班</option>
                <option>计科11506班</option>
                </select>
        </div>
        <div class="form_option">
            <div class="left">请选择通知课程:<span class="error">*</span></div>
                <select name="course" id="kecheng" class="select_1" >
                <option>请选择</option>
                <option>asp.net</option>
                <option>数据结构</option>
                </select>
        </div>
        <div class="form_class">
            <div class="left">请选择通知类型:<span class="error">*</span></div>
                <select name="types" id="tongzhi" class="select_1" >
                <option>请选择</option>
                <option>作业通知</option>
                <option>调课通知</option>
                </select>
         <div class="form_option">
           
        
        <div class="left">请输入通知内容:<span class="error">*</span></div>
                <textarea name="content" style="width:58%; height:80px;"></textarea></div>
                <input type="hidden" value="<?php echo $openid;?>" name="wxid">
        </div>
        <div>
            <input id="Submit1" class="submit1" type="submit" value="提交" />
        </div>
    </div>
    </form>
</div>
</div>
</body>
</html>
