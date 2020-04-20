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
</head>
<body>
<div class="main">
<header id="header" class="dark"><h2>查询学生信息</h2></header>
<div class="content">
<div class="notice">
<p> 王宏超老师，您好！<br />当前时间为：<?php
date_default_timezone_set("Asia/Shanghai");
echo date("Y-m-d"). '  '.date("h:i:sa");
?>
</p>

</div>
<h3>查询失败，请检查查询条件重新查询</h3>
</body>
</html>