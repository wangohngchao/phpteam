<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" /><!--设置手机适应屏幕-->
<title>查询结果</title>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/jquery.js"></script>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/teacher_ask.js"></script>
<link href="/CodeIgniter-3.1.0/css/public.css" rel="stylesheet">
<link href="/CodeIgniter-3.1.0/css/teacher_ask.css" rel="stylesheet">
</head>

</script>
<body>
<div class="main">
<header id="header" class="dark"><h2>班级信息通知</h2></header>
<div class="content">
<div class="notice">
            <p style="word-break:break-all; word-wrap:break-word ;">查询仅显示最近两个星期的通知。<p>
</div>
<?php 

    if($list){    
        for($i=0;$i<count($list);$i++)
        {       
            echo "<br>";    
            echo "通知班级：".$list[$i]['class']."<br>";
            echo "通知课程：".$list[$i]['course']."<br>";
            echo "通知日期：".$list[$i]['send_date']."<br>";
            echo "通知类型：".$list[$i]['species']."<br>";
            echo "通知内容：".$list[$i]['content']."<br>";   
            echo "<br>";            
        }
    }
    else
        echo "无近期通知";
?>
   
</body>
</html>
