/**
 * Author:杨柳
 * Date:2014-8-30
 * Function:我的公益个人资料页
 * Modified by Roy Yang @ 2014-09-26 09:39
 * Modified by Austin Yang @ 2014-10-02 11:00
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 *Modified by Huguozhi @ 2014-10-27 13:45,添加头像上传插件的前端
 */

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    //初始化
    init();

    //bootstrap日期插件
    $('.datepicker').datepicker();

    //前端验证输入合法性
    judgePersonalInfo();

    //点击“修改个人资料”按钮，显示修改个人信息部分
    $("#modifyInfoBtn").click(function() {
        modifyInfo();
    });

    //点击“修改密码”按钮，显示修改密码部分
    $("#modifyPasswordBtn").click(function() {
        modifyPassword();
    });

    //点击“修改邮箱”按钮，显示修改邮箱部分
    $("#modifyEmailBtn").click(function() {
        modifyEmail();
    });

    //点击“修改头像”按钮，显示修改头像部分
    $("#modifyHeadBtn").click(function() {
        modifyHead();
    });

    //点击“上传头像”按钮，触发事件
    $(".uploadHead").click(function() {
        uploadHeadFunc();
    });

    //点击“确认修改个人信息”按钮，触发事件
    $(".ensureModifyInfo").click(function() {
        ensureModifyInfoFunc();
    });

    //点击“确认修改密码”按钮，触发事件
    $(".ensureModifyPassword").click(function() {
        ensureModifyPasswordFunc();
    });

    //点击“下一步”按钮，触发事件
    $(".nextStep").click(function() {
        nextStepFunc();
    });

    //点击“确认修改邮箱”，触发事件
    $(".testEmailBtn").click(function() {
        testEmailFunc();
    });
});

/**
 * 初始化页面信息
 * 将ajax获取的数据显示在页面上
 */
function init() {
    //Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url : commonURL + "/Home/PersonalHomepage/initate",
        //如果调用php成功
        success: function(data, textStatus) {
            if (data.status == "1") {
                //显示个人信息到显示页面上
                $(".headIcon").attr("src", data.src);
                $(".nicknameInfo ").html(data.nickname);
                $(".realnameInfo ").html(data.realname);
                if (data.gender == 0) {
                    $(".genderInfo ").html("女");
                } else if (data.gender == 1) {
                    $(".genderInfo ").html("男");
                }
                $(".livingplaceInfo ").html(data.livingplace);
                $(".emailInfo ").html(data.email);
                $(".qqInfo ").html(data.qq);
                $(".phoneInfo ").html(data.phone);
                $(".idcardInfo ").html(data.idcard);
                $(".birthdayInfo ").html(data.birthday);
                $(".descriptionInfo ").html(data.description);

                //显示个人信息到修改个人信息页面上
                $('#inputNickname').val(data.nickname);
                $('#inputRealname').val(data.realname);
                if (data.gender == 0) {
                    $("#radioFemale").attr('checked', true);
                } else if (data.gender == 1) {
                    $("#radioMale").attr('checked', true);
                }
                $('#inputLivingplace').val(data.livingplace);
                $('#inputQQ').val(data.qq);
                $('#inputPhone').val(data.phone);
                $('#inputIdcard').val(data.idcard);
                $('#inputBirthday').val(data.birthday);
                $('#inputDescription').val(data.description);

                //显示当前邮箱到修改邮箱页面上
                $('#EmailNow').val(data.email);
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


/**
*修改者:胡国治
*头像上传功能
*使用头像上传插件
*/

/*定义全局变量，用于在上传图片后图片路径和大小的返回*/
var img_w,img_h,img_x,img_y,orgid;

$(function() {
    $('#file_upload').uploadify({
                
        'swf'      : '/maitian/welfare/Common/Static/swf/uploadify.swf',
        'uploader' : commonURL+'/Home/PersonalHomepage/uploadUicon',
        'onUploadSuccess':function(file,data,res) {
            var url = JSON.parse(data);/*使用json解析器转化为js对象*/
            $('img#selectbanner').attr('src',url.imgpath);
            $('#prevArea').attr('src',url.imgpath);
            orgid = url.iid;
            $.cookie("imagesrc", url.imgpath, { expires: 7, path: '/'});
            window.location.reload();
        }
    });
})

/**
 * 前端验证个人信息输入的合法性
 * 填写内容是否为空；
 * 再次确认输入内容是否一致；
 * 对应输入内容格式是否正确；
 */
function judgePersonalInfo() {   
    $("#inputNickname").click(function() {
        $("#tipNickname").html("");
    });
    $("#inputNickname").blur(function() {
        if(!$(this).val()) {
            $("#tipNickname").html("昵称不能为空");
        } else {
            var reg = /^[a-zA-Z0-9\u4e00-\u9fa5]+$/;
            if (!reg.test($(this).val())) {
                $("#tipNickname").html("昵称只能包含中英文或数字");
            } else {
                // @杨柳 TODO: 与后台交互确认唯一性
                //缺少ajax接口
            }
        }
    });
    
    $("#inputRealname").click(function() {
        $("#tipRealname").html("");
    });
    $("#inputRealname").blur(function() {
        if (!$(this).val()) {
            $('#tipRealname').html("真实姓名不能为空");
        } else {
            var reg = /^[a-zA-Z\u4e00-\u9fa5]+$/;
            if (!reg.test($(this).val())) {
                $("#tipRealname").html("真实姓名只能包含中英文");
            }
        }
    });
    
    $("#inputLivingplace").click(function() {
        $("#tipLivingPlace").html("");
    });
    $("#inputLivingplace").blur(function() {
        if (!$(this).val()) {
            $("#tipLivingplace").html("常居地不能为空");
        }
    });
    
    // /**
    //  * 杨柳 TODO: 验证邮箱格式
    //  */
    
    // $("#inputQQ").click(function() {
    //     $("#nameTipQQ").html("");
    // });
    // $("#inputQQ").blur(function() {
    //     // @杨柳 TODO: 与后台交互确认唯一性
        
    //     if ($(this).val()) {
    //         var reg = /^[1-9]*[1-9][0-9]*$/;
    //         if (!reg.test($(this).val())) {
    //             $("#nameTipQQ").html("QQ号码格式不正确");
    //         }
    //     }
    // });
    
    $("#inputQQ").click(function() {
        $("#tipQQ").html("");
    });
    $("#inputQQ").blur(function() {
        if (!$(this).val()) {
            $('#tipQQ').html("QQ号码不能为空");
        } else {
            var reg = /^\d{5,10}$/;
            if (!reg.test($(this).val())) {
                $("#tipQQ").html("QQ号为5到10位的数字");
            } else {
                // @杨柳 TODO: 与后台交互确认唯一性
                //缺少ajax接口
            }
        }
    });

    $("#inputPhone").click(function() {
        $("#tipPhone").html("");
    });
    $("#inputPhone").blur(function() {
        if (!$(this).val()) {
            $('#tipPhone').html("手机号码不能为空");
        } else {
            var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
            if (!reg.test($(this).val())) {
                $("#tipPhone").html("手机号码格式不正确");
            } else {
                // @杨柳 TODO: 与后台交互确认唯一性
                //缺少ajax接口
            }
        }
    });
    
    $("#inputIdcard").click(function() {
        $("#tipIdcard").html("");
    });
    $("#inputIdcard").blur(function() {
        if (!$(this).val()) {
            $("#tipIdcard").html("身份证不能为空");
        } else {
            //身份证号码为15位或者18位，
            //15位时全为数字，
            //18位前17位为数字，最后一位是校验位，可能为数字或字符X  
            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/; 
            if (!reg.test($(this).val())) {
                $("#tipIdcard").html("身份证号码格式有误");
            } else {
                // @杨柳 TODO: 与后台交互确认唯一性
                //缺少ajax接口
            }
        }
    });

    $("#inputDescription").click(function() {
        $("#tipDescription").html("");
    });
    $("#inputDescription").blur(function() {
        if (!$(this).val()) {
            $("#tipDescription").html("简介不能为空");
        }
    });

    $("#inputPassword5").click(function() {
        $("#tipPassword1").html("");
    });
    $("#inputPassword5").blur(function() {
        //密码文本框失去焦点触发验证事件
        //此处验证不能为空
        if(!$(this).val()) {
            $("#tipPassword1").html("当前密码不能为空");
        }
    });

    $("#inputPassword6").click(function() {
        $("#tipPassword2").html("");
    });
    $("#inputPassword6").blur(function() {
        //密码文本框失去焦点触发验证事件
        //此处验证不能为空，且为英文和数字，长度在6到20之间
        if(!$(this).val()) {
            $("#tipPassword2").html("新密码不能为空");
        } else {
            var reg = /^[a-zA-Z0-9]{6,20}$/;
            if (!reg.test($(this).val())) {
                $("#tipPassword2").html("密码只能包含大小写字母和数字，且长度在6和20之间！");
            } else if ($(this).val() == $("#inputPassword5").val()) {
                $("#tipPassword2").html("新密码不能为当前密码");
        }
        }
    });

    $("#inputPassword7").click(function() {
        $("#tipPassword3").html("");
    });
    $("#inputPassword7").blur(function() {
        //密码文本框失去焦点触发验证事件
        //此处验证不能为空，且与上一个输入框的内容一致
        if(!$(this).val()) {
            $("#tipPassword3").html("密码不能为空");
        } else if ($(this).val() != $("#inputPassword6").val()) {
            $("#tipPassword3").html("与上边的密码不符");
        }
    });

    $("#inputPassword4").click(function() {
        $("#tipPassword4").html("");
    });
    $("#inputPassword4").blur(function() {
        //密码文本框失去焦点触发验证事件
        //此处验证不能为空，且与上一个输入框的内容一致
        if(!$(this).val()) {
            $("#tipPassword4").html("密码不能为空");
        }
    });
}

/**
 * 点击“修改个人资料”按钮，触发函数
 */
function modifyInfo() {
    $(".infoContainer").removeClass("show");
    $(".infoContainer").addClass("hide");
    $(".modifyInfo").removeClass("hide");
    $(".modifyInfo").addClass("show");
}

/**
 * 点击“修改密码”按钮，触发函数
 */
function modifyPassword() {
    $(".infoContainer").removeClass("show");
    $(".infoContainer").addClass("hide");
    $(".modifyPassword").removeClass("hide");
    $(".modifyPassword").addClass("show");
}

/**
 * 点击“修改邮箱”按钮，触发函数
 */
function modifyEmail() {
    $(".infoContainer").removeClass("show");
    $(".infoContainer").addClass("hide");
    $(".modifyEmail").removeClass("hide");
    $(".modifyEmail").addClass("show");
}

/**
 * 点击“修改头像”按钮，触发函数
 */
function modifyHead() {
    $(".headShow").removeClass("show");
    $(".headShow").addClass("hide");
    $(".headModify").removeClass("hide");
    $(".headModify").addClass("show");
}

/**
 * 点击“上传头像”按钮，触发事件
 */
function uploadHeadFunc() {
    //TO DO!
    //需要国治的插件
}

/*
*修改者:胡国治
*裁剪插件的前端效果
*/
 /*裁剪功能*/
            


/*此处需要添加 上传函数后图片的url和id，即orgid 和 orgurl 的代码*/
$('img#selectbanner').imgAreaSelect({ 
    handles: true,
    aspectRatio: '4:3', /*加载图片压缩比例*/
    maxWidth:950,minWidth:1,minHeight:1,maxHeight:400,
     
    movable:true,
    onSelectChange: preview,
    onSelectEnd: preview 
});

/*裁剪功能暂时不用
/*$("#sliceButton").click(function() {  
   
    $.post(commonURL+"/Home/PersonalHomepage/sewImage",{
        xaxis:img_x,
        yaxis:img_y,          
        width:img_w,          
        heigh:img_h,
        iid:orgid,
    },function(data){
    //回调函数,把裁剪后图片加载到原处
    if(data.status==1){
        $('#selectbanner').attr('src',data.imagepath);
        $.cookie("imagesrc", data.imagepath, { expires: 7, path: '/'});
    }
    else{
        $('</br><span>头像裁剪失败<span>').css({
            color:'red'
        }).insertAfter($('#selectbanner'));
    }

});
});*/

function preview(img, selection) {
    var scaleX = 120 / (selection.width || 1);
    var scaleY = 90 / (selection.height || 1);
  
    $('#prevArea').css({
        width: Math.round(scaleX * 400) + 'px',
        height: Math.round(scaleY * 300) + 'px',
        marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
        marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
    });  

    img_x = selection.x1;             
    img_y = selection.y1;            
    img_w = selection.width;            
    img_h = selection.height;
}


/**
 * 点击“确认修改个人信息”按钮，触发事件
 * 将新的个人信息传到更新到数据库
 */
function ensureModifyInfoFunc() {
    var nickname = $('#inputNickname').val();
    var realname = $('#inputRealname').val();
    if ($('#radioFemale').is(':checked')) {
        var gender = 0;
    } else if ($('#radioMale').is(':checked')) {
        var gender = 1;
    }
    var livingplace = $('#inputLivingplace').val();
    var qq = $('#inputQQ').val();
    var phone = $('#inputPhone').val();
    var idcard = $('#inputIdcard').val();
    var birthday = $('#inputBirthday').val();
    var description = $('#inputDescription').val();

    console.log(birthday);

    //Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url : commonURL + "/Home/PersonalHomepage/changeinfo",
        //发给php的数据有九项
        //分别是上面传来的昵称、真是姓名、性别、长居地、
        //qq、手机号、身份证号、生日、简介
        data: {nickname:nickname,
            realname:realname,
            sex:gender,
            address:livingplace,
            qq:qq,
            phonenumber:phone,
            id:idcard,
            birthday:birthday,
            description:description},
        //如果调用php成功
        success: function(data, textStatus) {
            if (data.status == "1") {
                alert('修改个人信息成功！');
                window.location.reload();
            } else if (data.status == "0") {
                alert("修改个人信息失败");

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

/**
 * 点击“确认修改密码”按钮，触发事件
 */
function ensureModifyPasswordFunc() {
    var oldpassword = $('#inputPassword5').val();
    var newpassword = $('#inputPassword6').val();

    //Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url : commonURL + "/Home/PersonalHomepage/changepassword",
        //发给php的数据有两项，分别是上面传来的新旧密码
        data: {oldpassword:oldpassword, newpassword:newpassword},
        //如果调用php成功
        success: function(data, textStatus) {
            console.log(data);
            if (data.status == "1") {
                alert('修改密码成功！')
                console.log("ok?");
                window.location.reload();
            } else if (data.status == "0") {
                if (data.msg == "1") {
                    var username = $.cookie("username");
                    if (username) {
                        //清除cookie中存储的用户信息
                        $.cookie('username', null, {expires: -1, path: '/'});
                        $.cookie("imagesrc", null, { expires: -1, path: '/'});
                        $.cookie("newmsgnumber", null, { expires: -1, path: '/'});
                        
                        //hidePortrait();
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

/**
 * 点击“下一步”按钮，触发事件
 * 发送邮件给用户验证
 */
function nextStepFunc() {
    var password = $('#inputPassword4').val();

    //Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url: commonURL + "/Home/PersonalHomepage/changeemail",
        //发给php的数据为上面传来的密码
        data: {password:password},
        //如果调用php成功
        success: function(data, textStatus) {
            if (data.status == "1") {
                var EmailNow = $('#EmailNow').val();
                alert("请到邮箱" + EmailNow + "中接收邮件，并点击邮件中的链接进行下一步操作。");
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

/**
 * 修改邮箱
 * 输入新邮箱和密码
 */
function testEmailFunc() {
    var emailaddr = $('#EmaiNew').val();
    var password = $('#inputPassword8').val();
    var token = getUrlParam("token");
    var id = getUrlParam("uid");

    //Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url: commonURL + "/Home/PersonalHomepage/testemail",
        //发给php的数据有四个
        //分别为上面传来的邮箱、密码、用户令牌、用户id
        data: {emailaddr:emailaddr,
            password:password,
            token:token,
            id:id},
        //如果调用php成功
        success: function(data, textStatus) {
            if (data.status == "1") {
                var EmailNew = $('#EmailNew').val();
                alert("请到邮箱" + EmailNew + "中接收邮件，并点击邮件中的链接进行下一步操作。");
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

/**
 * 获取URL中某个特定的参数值
 */
function getUrlParam(name) {
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) {
        return unescape(r[2]); 
    }

    return null;
}