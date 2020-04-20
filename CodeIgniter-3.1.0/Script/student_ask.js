
    $(function () {
        //alert(course);
        //页面加载
        //init();

        //提交
        $("#Submit1").bind("click", function () {
            //获取页面元素的值

            $(this).val("正在提交");//点击时，显示正在提交
            $(this).attr("disabled", true);//防止页面多次提交
            if (confirm("确认表单信息无误？")) {
                return true;
            }
            else {
                return false;
            }
        });
    });
    function fun() {
        if ($("#TextArea1").val().length < 15)
            alert("字数少于15个...");

    }
    function confirm() {
        var course = $("#Select1").val();
        var datatime = $("#Select2").val()//
        if ('请选择' == course) {
            alert("请选择课程");
            $("#Select1").focus();
            $("#Submit1").val("提交");
            $("#Submit1").removeAttr("disabled");
        }
        else {
            if ('请选择' == datatime) {
                alert("日期未选");
                $("#Select2").focus();
                $("#Submit1").val("提交");
                $("#Submit1").removeAttr("disabled");
            }
            else {
                if ($("#TextArea1").val().length < 15) {
                    alert("请假理由字数少于15个字...");
                    $("#TextArea1").focus();
                    $("#Submit1").val("提交");
                    $("#Submit1").removeAttr("disabled");
                }
                else {
                    $("#Submit1").val("提交");
                    $("#Submit1").removeAttr("disabled", false);
                    
                    return true;
                //  window.open("http://WWW.BAIDU.COM");//实现跳转*/
                }

            }

        }
    }

