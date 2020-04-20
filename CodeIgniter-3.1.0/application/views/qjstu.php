<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title></title>
     <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" /><!--设置手机适应屏幕,且不能伸缩页面-->
    <meta charset="UTF-8">
    <meta name="Keywords" content="">
    <meta name="Description" content="">    
    <script type="text/javascript" src="/CodeIgniter-3.1.0/Script/jquery.js"></script>
    <script type="text/javascript" src="/CodeIgniter-3.1.0/Script/student_ask.js"></script>
        <link href="/CodeIgniter-3.1.0/css/public.css" rel="stylesheet">
    <link href="/CodeIgniter-3.1.0/css/student_ask.css" rel="stylesheet">
<style type="text/css" >
  .select_1{
     text-indent:10px;/*首行缩进效果*/
  }
</style>
</head>
<body style="margin-top: -14px;">  
     <header id="header" class="dark">
        <h2>请假申请表</h2>
    </header>
    <div class="content">
        <div class="notice">
            <p>注意事项：</p>
            <p> 1.<span class="error">*</span>红色标记为必填项。</p>
            <p style="word-break:break-all; word-wrap:break-word ;">2.此信息将作为授课老师对学生考评的重要依据，请申请学生如实填写此申请表。<p>
        </div>
        <form action="http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/SubSuc" method="post">
            <div class="form_course">
                <div class="left ">请假课程:<span class="error">*</span></div>
                <input type="hidden" value="<?php echo $openid;?>" name="wxid">
                <select id="Select1" class="select_1" name="course">
                     <option value="请选择">请选择</option>
                <?php 
               foreach($nb1 as $row)//在页面尝试循环输出内容
                     {echo '<option value="'.$row->courseName.'">'
                     .$row->courseName.'</option>';
            
                  }?>
                </select>
            </div>
            <div class="form_date">
                <div class="left">请假日期:<span class="error">*</span></div>
                <select id="Select2" class="select_1" name="date">
                    <option value="请选择">请选择</option>
                    <?php
                    $i=1;
                        foreach($nb2 as $row)//在页面尝试循环输出内容
                     {echo '<option value="'.$row->dataTime.'">'.$row->dataTime.'</option>';
                         $i++;
                     }
                    ?>
                </select>
            </div>
            <div class="form_reason">
                <div class="left">请假原因:<span class="error">*</span></div>
                <div class="clear"></div>
                <textarea id="TextArea1" rows="10" class="article" placeholder="字数不少于15字" name="reasons"></textarea>
            </div>
            <div class="form_img">
                <div class="left ">图片附件:</div>
                <div class="clear"></div>
                <div class="imgs" name="imgs">
                    上传图片
                    <!-- <input type="file" accept="image/*" /> --> 
                        <div class="imgs_notice">
                            最大不超过6MB
                        </div>
                    </a>
                </div>
             </div>
            <div>
                <input id="Submit1" class="submit1" type="submit" value="提交" />
            </div>
        </form>
    </div>
</body>
</html>

