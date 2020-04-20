<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" /><!--设置手机适应屏幕-->
<title>我的信息</title>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/jquery.js"></script>
<script type="text/javascript" src="/CodeIgniter-3.1.0/Script/teacher_ask.js"></script>
<link href="/CodeIgniter-3.1.0/css/public.css" rel="stylesheet">
<link href="/CodeIgniter-3.1.0/css/teacher_ask.css" rel="stylesheet">
</head>
<body>
<div class="main">
<header id="header" class="dark"><h2>我的信息</h2></header>
<div class="content" >

<?php

     
    echo "<table width='100%' border='0' cellpadding='1' cellspacing='1' font-size='20'>";
     
    echo "<tr><td>    工号</td><td>{$list['id']}</td></tr>";
    echo "<tr><td>    姓名</td><td>{$list['name']}</td></tr>";
    echo "<tr><td>    性别</td><td>{$list['sex']}</td></tr>";
    echo "<tr><td>    院校</td><td>武汉纺织大学</td></tr>";
     
    
     
    echo "</table>";
    
    ?>
    </div>
</body>
</html>
