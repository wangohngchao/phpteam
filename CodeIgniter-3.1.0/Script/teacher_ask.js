    function unitshow()  
        {  
            if(Select4.value=="个人"){var mychar = document.getElementById("class1");
        mychar.style.display = "none";}
           /* if(Select4.value=="1"){
        var mychar = document.getElementById("person");
        mychar.style.display = "block";
        var mychar = document.getElementById("class1");
        mychar.style.display = "none";}
        else{
             var mychar = document.getElementById("person");
        mychar.style.display = "none";
        var mychar = document.getElementById("class1");
        mychar.style.display = "block";
        }*/
        }  
    
    $(function () {
        //alert(course);
        //页面加载
        //init();
        //提交
        $("#Submit1").bind("click", function () {
            //获取页面元素的值
            $(this).val("正在提交");//点击时，显示正在提交
            $(this).attr("disabled", true);//防止页面多次提交
            if (confirm()) {
                return true;
            }
            else {
                return false;
            }
        });
    });
   
    function confirm() {
        var options = $("#Select1").val();
        var classes = $("#Select2").val();//
        if ('0' == options) {
            alert("请选择查询类型");
            $("#Select1").focus();
            $("#Submit1").val("提交");
            $("#Submit1").removeAttr("disabled");
        }
        else {
            if ('0' ==classes) {
                alert("请选择查询课程");
                $("#Select1").focus();
                $("#Submit1").val("提交");
                $("#Submit1").removeAttr("disabled");
            }
            else {
                $("#Submit1").val("提交");
                $("#Submit1").removeAttr("disabled", false);
                alert("提交成功。");
                return true;
                //window.open();//实现跳转
            }
        }
    }