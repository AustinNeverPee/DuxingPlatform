/**
 * Author:黄嘉敏
 * Date:2014-9-1
 * Function:活动展示页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 * Modified by Amin Huang @ 2015-01-28 16:50 解除重复点击重复绑定的问题
 */


var acid;

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    // 这个函数不一定正确
    acid = getParam("acid");
    //alert(acid);

    initate();
    //$(".answer").hide();

    // 修改二级索引链接
    $("#actname").attr("href", commonURL + "/Home/ActivityDisplay/index/acid/"+acid);
    $("#actfeedback").attr("href", commonURL + "/Home/ActivityFeedback/feedbacktable/acid/"+acid);
    $("#actattend").attr("href","");

    $("#fol").click(function(){
        follow(acid);
    });

    // 点击回复留言的操作
    clickcomment();

    /*参加活动按钮*/
    $("#actattend").click(function(){
        var theuid = $.cookie("uid");
        if(theuid!=null){
            $.post(commonURL+"/Home/ActivityDisplay/participate",{"aid":acid},function(json){
                if(json.statu==1){
                    alert("参加活动成功！");
                }
                else{
                    alert("报名失败!");
                }
            });
        }
        else{
            alert("请登录后操作");
        }
    });

    srcChange();

});

// 获取url链接的参数
 function getParam(name){
    var reg = new RegExp("(^|\\?|&|/)"+ name +"/([^&]*)(\\s|&|$)", "i");
    if (reg.test(location.href)) return unescape(RegExp.$2.replace(/\+/g, " ")); return "";
 }

 function srcChange(){
    $("#activityNameHref").attr("href", commonURL + "/Home/ActivityDisplay/index/acid/"+acid);
    $("#feedbackHref").attr("href", commonURL + "/Home/ActivityFeedback/feedbacktable/acid/"+acid);
    $("#addfeedback").attr("href", commonURL + "/Home/NewFeedback/index/acid/"+acid);
    $("#joinHref").attr("href", commonURL + "/Home/ActivityFeedback/index/acid/"+acid);
    $(".feedbackhref").attr("href", commonURL + "/Home/ActivityFeedback/feedbacktable/acid/"+acid);

}

function aboutcomment(){
    $(".answer").hide();

    //$("#fol").click(function(){
        //follow(acid);
    //});
    $("#subcomment").click(function(){
        var com = $("#valcomment").val();
        $("#valcomment").val("");
        comment1(com,acid);


    });
    clickcomment();

}

// 点击回复留言的操作
function clickcomment(){
    $(".toComment").unbind("click").click(function(){
        // 这里需要去除空格
        // 得到回复对象的名字
        var name = $.trim($(this).parent().prev().find(".comname").text());

        // 回复的目标留言或者目标评论的id，去空格
        var recmntid = $.trim($(this).parent().prev().find(".touid").text());

        // 需要用到的上层结点
        var $parentbox = $(this).parent().parent().parent().parent();
        var rtcmntid = $.trim($parentbox.find(".comment").children().children().find(".touid").text());;
        // alert(rtcmntid);

        // 显示输入框
        $parentbox.find(".answer").show();
        $parentbox.find(".answer").find(".valtocomment").val("回复"+name.toString()+": ").focus();

        // 点击回复的提交之后的ajax
        $parentbox.find(".answer").find(".sub").unbind("click").click(function(){
            // 获得输入框的内容
            var com = $(this).prev().val();
            // alert(com);
            comment2(com,acid,recmntid,rtcmntid);
        });
    });
}


function initate(){
    //alert("test");
    //alert(acid);
    $.ajax({
        url : commonURL + "/Home/ActivityDisplay/initate",
        data : "acid="+acid,
        success : function(json) {
            if (json.status == "1") {

                // 修改海报
                $("#poster").empty();
                var tempsrc = "<img src='" + json.postersrc + "'>";
                $("#poster").append(tempsrc);

                // 修改活动介绍
                $("#activityde").empty();
                var tempact = json.activitydes;
                $("#activityde").append(tempact);
                //alert(json.activitydes);

                // 修改活动地点
                $("#location1").empty();
                var temploc = json.location;
                $("#location1").append(temploc);

                // 修改举办时间
                $("#time").empty();
                var temptime = json.activitytime;
                $("#time").append(temptime);

                // 修改举办时间
                $("#type").empty();
                var temptype = json.activitytype;
                $("#type").append(temptype);

                // 修改组织者
                $("#organizer").empty();
                var organizerid = json.organizerids;
                var organizername = json.organizernames;

                $("#activityname").append("<h2 >"+json.aname+"</h2>");
                //alert(json.organizerids);
                //alert(json.organizernames);
                // 因为这里为null，所以下面的循环报错
                /*
                for(var i = 0; i < organizerid.length; i++) {
                    var opt = "<a href='../ UserHomepage/index?uid=" + organizerid[i] + "'>" + organizername[i] + "</a>";
                    $("#organizer").append(opt);
                }*/

                // 修改关注的人
                $("#follower").empty();
                var followerid = json.followerids;
                var followername = json.followernames;
                var followerimg = json.followersrcs;
                var t = 1;
                for(var i = 0; i < followername.length; i++){
                    var opt = "<div class='col-sm-5 col-md-6'>" +
                              "<a href='../ UserHomepage/index?uid=" + followerid[i] + "' class='thumbnail' style='border-radius:50%'>" +
                               "<img src='" +  followerimg[i] + "'>" + followername[i] +
                               "</a></div>";
                    i++;
                    if (i < followername.length) {
                        opt = opt + "<div class='col-sm-5 col-md-6'>" +
                              "<a href='../ UserHomepage/index?uid=" + followerid[i] + "' class='thumbnail' style='border-radius:50%'>" +
                               "<img style='border-radius:50%' src='" +  followerimg[i] + "'>" + followername[i] +
                               "</a></div>";
                    }
                    opt = "<div class='follow'>"  + opt + "</div>";
                    $("#follower").append(opt);
                }

                // 修改留言
                $("#divcontent").empty();
                var comment = json.comments;
                var ownerid = json.ownerids;
                var ownername = json.ownernames;
                var ownersrc = json.ownersrcs;
                var time = json.times;
                var commentid = json.commentids;
                setcomment(comment,ownerid,ownername,ownersrc,time,commentid);
            } else if (json.status == "0") {
                if (json.msg == "1") {
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
                } else if (json.msg == "2") {
                    alert("数据库访问错误");
                }
            }

            aboutcomment();
        },
        error : function(){
            alert("initate操作失败");
        }
    });

    $.post(commonURL + "/Home/ActivityFeedback/initate",{"acid":acid},function(data){
        var l = data.length;
        for(var i =0;i<l;i++){
            $("#studentstate").text(data[i].studentstate);
            $("#teacherstate").text(data[i].teacherstate);
            $("#buildingstate").text(data[i].schbuildingstate);
            $("#libstate").text(data[i].schlibdescrp);
        }

    });

    $.post(commonURL+ "/Home/ActivityFeedback/moreAlbum",{"acid":acid},function(data){
            if (data.statu == "1") {
                var l = data.imagesrcs.length;
                for (var i = 0; i < l; i++){
                    if(i==0){
                        var eachPhotoLoad =
                        "<div class='col-sm-6 col-md-4'>"+
                          "<a href='"+data.imagesrcs[i][0]+"' class='thumbnail'>"+
                              "<img src='"+data.imagesrcs[i][0]+"' alt='通用的占位符缩略图'/>"+
                          "</a>"+
                          "<div>"+
                          "<a href='"+commonURL+"/Home/ActivityFeedback/photos/album/"+data.albumids[i]+"' target='_blank'><h3>"+data.albumnames[i]+"<br/><small>"+data.uploadtimes[i]+"</small></h3></a>"+
                          "</div>"+
                         "</div>";
                    }
                    else {

                        var eachPhotoLoad =
                        "<div class='col-sm-6 col-md-2'>"+
                          "<a href='"+data.imagesrcs[i][0]+"' class='thumbnail'>"+
                              "<img src='"+data.imagesrcs[i][0]+"' alt='通用的占位符缩略图'/>"+
                          "</a>"+
                          "<div>"+
                          "<a href='"+commonURL+"/Home/ActivityFeedback/photos/album/"+data.albumids[i]+"' target='_blank'><h3>"+data.albumnames[i]+"<br/><small>"+data.uploadtimes[i]+"</small></h3></a>"+
                          "</div>"+
                         "</div>";
                        }
                    $("#gallery").append(eachPhotoLoad);

                }
                $('#gallery img').fsgallery();
            }
    });
}

// 刷新留言区
function flash() {
    $.ajax({
        url : commonURL + "/Home/ActivityDisplay/initate",
        data : "acid="+acid,
        success : function(json){
            if (json.status == "1") {
                // 修改留言
                $("#divcontent").empty();
                var comment = json.comments;
                var ownerid = json.ownerids;
                var ownername = json.ownernames;
                var ownersrc = json.ownersrcs;
                var time = json.times;
                var commentid = json.commentids;
                setcomment(comment,ownerid,ownername,ownersrc,time,commentid);

                $(".answer").hide();
                clickcomment();
            } else if (json.status == "0") {
                if (json.msg == "1") {
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
                } else if (json.msg == "2") {
                    alert("数据库访问错误");
                }
            }
        },
        error : function(){
            alert("flash操作失败");
        }
    });
}

// 初始化
function setcomment(comment,ownerid,ownername,ownersrc,time,commentid){
    for(var i = 0; i < comment.length; i++){
                var opt = "<div class='content row'>" +
                          "<div class='comment'>" +
                          "<div>" +
                          "<div class='col-md-1'>" +
                          "<a href='' class='thumbnail'>" +
                          "<img src='" + ownersrc[i][0] + "'></a>" +
                          "</div>" +
                          "<div class='col-md-11'>" +
                          "<div class='comname'>" + ownername[i][0] +"</div>" +
                          "<span class='touid'>" + commentid[i][0] + "</span>" +
                          "<span class='val'>" + comment[i][0] + "</span>" +
                          "</div>" +
                          "<div class='col-md-offset-1'>" +
                          "<span class='time'>" + "发表时间：" + time[i][0] + "</span>" +
                          "<button type='button' class='toComment btn btn-default btn-xs'>回复</button>" +
                          "</div></div></div>";
                if(comment[i].length > 1) {
                    var tmp = "<div class='recomment col-md-12'>";
                    for(var j = 1; j < comment[i].length; j++){
                         tmp = tmp + "<div class='recom col-md-12'>" +
                               "<div class='col-md-1'>" +
                               "<div class='thumbnail'>" +
                               "<img src='" + ownersrc[i][j] + "'>" +
                               "</div>" +
                               "</div>" +
                               "<div class='col-md-11'>" +
                               "<span class='comname'>" + ownername[i][j] + "</span>" +
                               "<span class='touid'>" + commentid[i][j] + "</span>" +
                               "<span class='val'>" + comment[i][j] + "</span>" +
                               "</div>" +
                               "<div class='col-md-offset-1'>" +
                               "<span class='time'>" + "发表时间：" + time[i][j] + "</span>" +
                               "<button class='toComment btn btn-primary btn-xs sub' >回复</button>" +
                               "</div></div>";
                    }
                    tmp = tmp + "</div>";
                    opt = opt + tmp;
                }
                opt = opt + "<div class='answer col-md-12 text-right'>" +
                      "<textarea class='valtocomment form-control' rows='2'></textarea>" +
                      "<button class='btn btn-primary btn-xs sub' >提交</button>" +
                      "</div></div>";
                $("#divcontent").append(opt);
            }

}

// 点击“关注”按钮
function follow(acid){
    $.ajax({
        url : commonURL + "/Home/ActivityDisplay/follow",
        data : "acid="+acid,
        success : function(json){
            console.log(json);
            if (json.status == "1") {
                alert("关注成功!");
            } else if (json.status == "0") {
                if (json.msg == "1") {
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
                } else if (json.msg == "2") {
                    alert("数据库访问错误!");
                } else if (json.msg == "4") {
                    alert("已经关注!");
                }
            }
        },
        error : function(){
            alert("follow操作失败");
        }
    });

}

// 点击留言
// com：内容， acid：活动id
function comment1(com,acid) {
    $.ajax({
        url : commonURL + "/Home/ActivityDisplay/leaveMessage",
        data : "acid="+acid+"&content="+com,
        success : function(json) {
            if (json.status == "1") {
                flash();
            } else if (json.status == "0") {
                if (json.msg == "1") {
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
                } else if (json.msg == "2") {
                    alert("数据库访问错误");
                }
            }
        }
    });
}

// 点击回复
// com：内容， acid：活动id， toid:回复对象id
function comment2(com,acid,recmntid,rtcmntid) {
    $.ajax({
        url : commonURL + "/Home/ActivityDisplay/Comment",
        data : "content="+com+"&acid="+acid+"&recmntid="+recmntid+"&rtcmntid="+rtcmntid,
        success : function(json) {
            if (json.status == "1") {
                alert("留言成功");
                flash();
            } else if (json.status == "0") {
                alert("留言失败");

                if (json.msg == "1") {
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
                } else if (json.msg == "2") {
                    alert("数据库访问错误");
                }
            }
        }
    });
}
