
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF">
        <meta http-equiv="Content-Type" content="text/html; charset=utf" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" /><!--设置手机适应屏幕,且不能伸缩页面-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>用户绑定</title>
<meta name="Keywords" content="www.021news.cn">
<meta name="Description" content="www.021news.cn">

<!-- Bootstrap -->
<link href="/CodeIgniter-3.1.0/images/bootstrap.min.css" rel="stylesheet">
<link href="/CodeIgniter-3.1.0/images/main.css" rel="stylesheet">
<link href="/CodeIgniter-3.1.0/images/enter.css" rel="stylesheet">
<script src="/CodeIgniter-3.1.0/images/jquery.min.js"></script>
<script src="/CodeIgniter-3.1.0/images/bootstrap.min.js"></script>
<script src="/CodeIgniter-3.1.0/images/jquery.particleground.min.js"></script>
</head>
<body>
<div id="particles">
  <canvas class="pg-canvas" width="1920" height="911" style="display: block;"></canvas>
  <div class="intro" style="margin-top: -256.5px;">
    <div class="container">
      <div class="row" style="padding:30px 0;">
        <div class="col-md-3 col-centered tac"> <img src="/CodeIgniter-3.1.0/images/logo.png" alt="logo"> </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-8 col-centered">
          <form action="http://1.courseman.applinzi.com/CodeIgniter-3.1.0/index.php/band" method="post" id="register-form" autocomplete="off"  class="nice-validator n-default" novalidate>
            <div class="form-group">
              <input type="password" class="form-control" id="num"  name="u_num" placeholder="请输入学（工）号"  aria-required="true" >
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="name" name="u_name" placeholder="请输入姓名" aria-required="true" autocomplete="off">
            </div>
            <input type="hidden" value="<?php echo $openid;?>" name="wxid">
            <div id="validator-tips" class="validator-tips"></div>
            <div class="checkbox">
              <label>
                
                <input type="radio" id="teach" class="teach" name="u_id" value="teach">
                辅导员 </label>
              <label>
                <input type="radio" id="teacher" class="teacher" name="u_id" value="teacher">
                教师 </label>
                <label>
                <input type="radio" id="student" class="student" name="u_id" value="student">
                学生 </label>

                <p></p>
            <div class="form-center-button">
              <button type="submit" id="submit" value="提交" class="btn btn-primary btn-current">绑定</button>
              <a href="#" class="btn btn-primary btn-current">重置</a> </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" style="text-align: left" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            
          </div>
          <div class="modal-body" id="agreementContent"></div>
        </div>
      </div>
    </div>
    <link rel="stylesheet" href="/CodeIgniter-3.1.0/images/jquery.validator.css">
    <script src="images/zh-CN.js"></script><script src="/CodeIgniter-3.1.0/images/jquery.validator.min.js"></script> 
  </div>
</div>
<script>
    $(document).ready(function () {
        var intro = $('.intro');
        $('#particles').particleground({
            dotColor: 'rgba(52, 152, 219, 0.36)',
            lineColor: 'rgba(52, 152, 219, 0.86)',
            density: 130000,
            proximity: 500,
            lineWidth: 0.2
        });
        intro.css({
            'margin-top': -(intro.height() / 2 + 100)
        });
    });
</script>
<div style="text-align:center;">

</div>
</body>
</html>