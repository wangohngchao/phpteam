            <!doctype html> 
            <html lang="en"> 
            <head> 
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" /><!--设置手机适应屏幕,且不能伸缩页面-->
            <title>学生查看通知</title>
             <script type="text/javascript" src="/CodeIgniter-3.1.0/Script/jquery.js"></script>
     <script type="text/javascript" src="/CodeIgniter-3.1.0/Script/tzstudent.js"></script>
        <link href="/CodeIgniter-3.1.0/css/public.css" rel="stylesheet">
    <link href="/CodeIgniter-3.1.0/css/tzstudent.css" rel="stylesheet">
            </head>
            <body>                                      
            <header id="header" class="dark">
            <h2>学生查看消息通知</h2>
            </header>
            <div class="content">
            <div class="notice">
            <p>注意事项：</p>
            <p> 1.<span class="error">*</span>红色标记为必填项。</p>
            <p style="word-break:break-all; word-wrap:break-word ;">2.学生可通过选择的方式来查看老师发送的通知。<p>
            </div>
            <form action="http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/viewmessage" method="post">
            <div class="main_form">
            
            <div class="form_course">
            <label class="form_lable">课程名称:<span class="error">*</span></label>
            <select id="Select2" class="select_1" name="course">
            <option value="0">请选择</option>
            <option>asp.net</option>
            <option>数据结构</option>
            </select>
            </div>
            <input type="hidden" value="<?php echo $openid;?>" name="wxid">
            <div class="form_type">
            <label class="form_lable">通知类型:<span class="error">*</span></label>
            <select id="Select2" class="select_1" name="types">
            <option>请选择</option>
            <option>作业通知</option>
            <option>调课通知</option>
            </select>
            <div>
            <input id="Submit1" class="submit1" type="submit" value="提交" />
            </div>
            </div>
            </form>
            </div>
            </body>
            </html>