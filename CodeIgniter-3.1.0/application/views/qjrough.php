<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>学生请假情况表</title>
 <script type="text/javascript" src="/CodeIgniter-3.1.0/Script/jquery.js"></script>
    <script type="text/javascript" src="/CodeIgniter-3.1.0/Script/teacher_ask.js"></script>
 <link href="/CodeIgniter-3.1.0/css/public.css" rel="stylesheet">
    <link href="/CodeIgniter-3.1.0/css/table_ask.css" rel="stylesheet">
</head>
<body>
    <header id="header" class="dark">
        <h2>某班某课程请假情况</h2>
    </header>
    <div class="content">
        <div class="process">
            <div class="part1">
                <span class="left">学年学期</span>
                        <span id="date" class="right">15-16</span><label>年</label>
            </div>
            <div class="part1">
                <span class="left">请假总人数</span>
                <span id="sumPlan" class="right">0</span><label>人</label>
            </div>

            <div class="part2">
                <div></div>
            </div>
            </div>
            <div class="search">
                <div><input type="search" placeholder="请输入学生姓名" value="" class="searchTxt" /></div><!-- 搜索框 -->
                <div><input type="button" class="searchClick" value="搜索" /></div><!-- 搜索按钮 -->
            </div>

            <table border="1" cellpadding="0" cellspacing="0" class="goodsForm">
                <tr>
                    <th width="15%">序号</th>
                    <th width="15%">学号</th>
                    <th width="15%">姓名</th>
                    <th width="15%">日期</th>
                    <th width="30%">请假原因</th>
                    <th>附件</th>
                </tr>
            </table>
    </div>
    <footer>
    </footer>
</body>
</html>