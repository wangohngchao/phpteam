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

</script>
<body>
<div class="main">
<header id="header" class="dark"><h2>学生信息查询结果</h2></header>
<div class="content">
<div class="notice">
<p> 老师，您好！<br />当前时间为：<?php
date_default_timezone_set("Asia/Shanghai");
echo date("Y-m-d"). '  '.date("h:i:sa");
?>
</p>
<form action="http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/toexecl" method="post">
</div>
<?php 

    echo "<table id='infotb' width='100%' border='1' cellpadding='0' cellspacing='0' >";
     
    echo "<tr><td>序号</td><td>学号</td><td>姓名</td><td>日期</td><td>签到</td><td>是否请假</td></tr>";
     
    for($i=0;$i<count($list);$i++)
    {
        echo "<tr>";         
        echo "<td>{$list[$i]['id']}</td>";
        echo "<td>{$list[$i]['s_id']}</td>";
        echo "<td>{$list[$i]['s_name']}</td>";
        echo "<td>{$list[$i]['date']}</td>";
        echo "<td>{$list[$i]['qiandao']}</td>";               
        echo "<td></td>";
        echo "</tr>";
    }
     
    echo "</table>";
    $a=0;
    for($i=0;$i<count($list);$i++)
    {
        if($list[$i]['qiandao']==1)
            $a++;
    }
    echo "到课率：";
    echo ($a/count($list)*100)."%";
    ?>
    <input type="hidden" value="" name="data">
    
    </form>
</body>
</html>
