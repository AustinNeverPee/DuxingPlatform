/**
 * Author:陈祥麟
 * Date:2014-9-1
 * Function:新建地点
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */

/*目前缺乏对内容的判断。
 */

//判断图片格式，上传并显示在页面；

//载入“省”资料
$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";
    //初始化地点id
    newlocid = -1;

    init();
    $("#province").change(function(){
        provinceChange();
    });
    $("#cities").change(function(){
        cityChange();
    });
    $("#contrises").change(function(){
        contryChange();
    });
    $("#addSiteImg").hide();
   
});

function init(){
    $.ajax({
        "url": commonURL + "/Home/NewLocation/initate",
        "type":"get",
        "success":function(data){
            if (data.status == "1") {
                var option="";
                for (var i = 0; i < data.provinceids.length; i++) {
                    option = "<option value='"+data.provinceids[i]+"'>"+data.provincenames[i]+"</option>";
                    $("#province").append(option);
                }
            } else if (data.status == "0") {
                if (data.msg == "1") {
                    var username = $.cookie("username");
                    if (username) {
                        //清除cookie中存储的用户信息
                        $.cookie('username', null, {expires: -1, path: '/'});
                        $.cookie("imagesrc", null, { expires: -1, path: '/'});
                        $.cookie("newmsgnumber", null, { expires: -1, path: '/'});
                        
                        hidePortrait();
                    }

                    alert("请重新登录！");
                    //TO DO!!!
                } else if (data.msg == "2") {
                    alert("数据库访问错误");
                }
            }
        }
    });
}


function provinceChange(){
    //如果“省”选项不为空，动态载入地点，如果为空，重置“市”，县等为空
    if($("#province").val() != "-1"){
        $.ajax({
            "url": commonURL + "/Home/NewLocation/getCity",
            "data":{"provinceid":$("#province").val()},//传递省份信息
            "success":function(data){
                if (data.status == "1") {
                    $("#cities").html("<option value='-1'>--选择市--</option>");
                    var option = "";
                    for(var i = 0; i < data.cityids.length;i++){
                        option = "<option value='"+data.cityids[i]+"'>"+data.citienames[i]+"</option>";
                        $("#cities").append(option);
                    }
                } else if (data.status == "0") {
                    if (data.msg == "1") {
                        var username = $.cookie("username");
                        if (username) {
                            //清除cookie中存储的用户信息
                            $.cookie('username', null, {expires: -1, path: '/'});
                            $.cookie("imagesrc", null, { expires: -1, path: '/'});
                            $.cookie("newmsgnumber", null, { expires: -1, path: '/'});
                            
                            hidePortrait();
                        }

                        alert("请重新登录！");
                        //TO DO!!!
                    } else if (data.msg == "2") {
                        alert("数据库访问错误");
                    }
                }
            }//end success function
        });//end ajax
    } else{
        $("#cities").html("<option value='-1'>--选择市--</option>");
        $("#contrises").html("<option value='-1'>--选择县--</option>");
        $("#towns").html("<option value='-1'>--选择乡镇--</option>");
    }
}

function cityChange(){
    if($("#cities").val() != "-1"){
        $.ajax({
            "url": commonURL + "/Home/NewLocation/getCounty",
            "data":{"cityid":$("#cities").val()},
            "success":function(data){
                if (data.status == "1") {
                    //初始化”县“列表
                    $("#contrises").html("<option value='-1'>--选择县--</option>");
                    var option = "";
                    //载入添加的”县“
                    for(var i = 0; i < data.countyids.length;i++){
                        option = "<option value='"+ data.countyids[i]+"'>" + data.countynames[i]+"</option>";
                        $("#contrises").append(option);
                    }
                } else if (data.status == "0") {
                    if (data.msg == "1") {
                        var username = $.cookie("username");
                        if (username) {
                            //清除cookie中存储的用户信息
                            $.cookie('username', null, {expires: -1, path: '/'});
                            $.cookie("imagesrc", null, { expires: -1, path: '/'});
                            $.cookie("newmsgnumber", null, { expires: -1, path: '/'});
                            
                            hidePortrait();
                        }

                        alert("请重新登录！");
                        //TO DO!!!
                    } else if (data.msg == "2") {
                        alert("数据库访问错误");
                    }
                }
            }//end success fuction
        });//end ajax
    } else{
        $("#contrises").html("<option value='-1'>--选择县--</option>");
        $("#towns").html("<option value='-1'>--选择乡镇--</option>");
    }
}

function contryChange(){
    if($("#contrises").val() != "-1"){
        $.ajax({
            "url": commonURL + "/Home/NewLocation/getTown",
            "data":{"countyid":$("#contrises").val()},
            "success":function(data) {
                if (data.status == "1") {
                    //初始化乡镇列表
                    $("#towns").html("<option value='-1'>--选择乡镇--</option>");
                    var option = "";
                    //载入添加的乡镇
                    for(var i = 0; i < data.townids.length;i++){
                        option = "<option value='"+data.townids[i]+"'>" + data.townnames[i]+"</option>";
                        $("#towns").append(option);
                    }
                } else if (data.status == "0") {
                    if (data.msg == "1") {
                        var username = $.cookie("username");
                        if (username) {
                            //清除cookie中存储的用户信息
                            $.cookie('username', null, {expires: -1, path: '/'});
                            $.cookie("imagesrc", null, { expires: -1, path: '/'});
                            $.cookie("newmsgnumber", null, { expires: -1, path: '/'});
                            
                            hidePortrait();
                        }

                        alert("请重新登录！");
                        //TO DO!!!
                    } else if (data.msg == "2") {
                        alert("数据库访问错误");
                    }
                }
            }//end success fuction
        });//end ajax
    } else{
        $("#towns").html("<option value='-1'>--选择乡镇--</option>");
    }
}



//点击提交
$("#submitButton").click(function(){
    $.ajax({
        "url": commonURL + "/Home/NewLocation/saveLocation",
        "data":{"provinceid":$("#province").val(),"cityid":$("#cities").val(),
                "countyid":$("#contrises").val(),"townid":$("#towns").val(),
                "village":$("#InputStreet").val(),"school":$("#InputSchool").val(),
                "sponsor":$("#InputPerson").val(),"description":$("#InputIntroduce").val()},
        "success":function(data){

            if (data.status == "1") {

                /*前端清空表单数据，防止重复提交*/
                $("#addSiteInfo").find('input').val('');
                $("#addSiteInfo").find('textarea').val('');

                /*获取新建地点的id,以便后面的头像上传*/
                alert("新建地点成功!");
                newlocid = data.siteid;

                           /*地点头像上传*/
                $(function() {
                    $('#file_upload').uploadify({
                        'formData' :{
                            'siteid' : newlocid
                          },
                                
                        'swf'      : '/maitian/welfare/Common/Static/swf/uploadify.swf',
                        'uploader' : commonURL+'/Home/NewLocation/uploadImage',
                        'onUploadSuccess':function(file,data,res) {

                            var url = JSON.parse(data);/*使用json解析器转化为js对象*/
                            $('#headImg').attr('src',url.imgpath);
                        }
                    });
                })
                console.log(newlocid);
                $("#addSiteImg").show();
                

            } else if (data.status == "0") {
                if (data.msg == "1") {
                    var username = $.cookie("username");
                    if (username) {
                        //清除cookie中存储的用户信息
                        $.cookie('username', null, {expires: -1, path: '/'});
                        $.cookie("imagesrc", null, { expires: -1, path: '/'});
                        $.cookie("newmsgnumber", null, { expires: -1, path: '/'});
                        
                        hidePortrait();
                    }

                    alert("请重新登录！");
                    //TO DO!!!
                } else if (data.msg == "2") {
                    alert("数据库访问错误");
                }
            }
        }
    });
})
