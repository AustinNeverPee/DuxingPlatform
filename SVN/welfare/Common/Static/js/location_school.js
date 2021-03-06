/**
 * Author:chen_xl
 * Date:2014-10-27
 * Function:地点之学校页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */
//获取学校id


$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    currentpage = 0;
    var locationhref = window.location.href;
    schoolid = locationhref.split("schoolid/")[1];
    //初始化页面；
    init();
    hrefChange();
})

function init(){
    $.ajax({
        "type":"post",
        "url": commonURL + "/Home/School/initate",
        "data":{"schoolid":schoolid},
        "success":function(data){
            if (data.status == "1") {
                var additem = "";
                //设定学校头像；
                $("#block-img-school").html("<img src='"+data.src+"' id='img-school' class='img-rounded'>");
                //载入关注者
                if(data.followerids != null){
                    for(var i = 0; i < data.followerids.length; i++){
                        additem +=  "<img src='" + data.followersrcs[i] + "' class='attention-photo'>"+
                                    "<div>"+
                                    "<a href='../UserHomepage/index?uid=" + data.followerids[i] + "'>" +
                                    data.followernames[i] +
                                    "</a>"+
                                    "</div>";
                   };
                }
                $("#attentionPeople").html(additem);
                //载入学校简介
                $("#briefIntroduction").html(data.descrp);

                $("#schooltitle").html("<h2>"+data.sitename+"<h2><small>"+data.lastmddt+"</small>");
                //载入海报；
                additem = "";
                $("#posterBox").html(additem);
                morePoster();
                //载入评论by嘉敏；
                $("#divcontent").empty();
                var comment = data.comments;
                var ownerid = data.ownerids;
                var ownername = data.ownernames;
                var ownersrc = data.ownersrcs;
                var time = data.times;
                var commentid = data.commentids;
                setcomment(comment,ownerid,ownername,ownersrc,time,commentid);
                initComment();
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

function reLoad(){
    $.ajax({
        "type":"post",
        "url": commonURL + "/Home/School/initate",
        "data":{"schoolid":schoolid},
        "success":function(data){
            if (data.status == "1") {
                $("#divcontent").empty();
                var comment = data.comments;
                var ownerid = data.ownerids;
                var ownername = data.ownernames;
                var ownersrc = data.ownersrcs;
                var time = data.times;
                var commentid = data.commentids;
                setcomment(comment,ownerid,ownername,ownersrc,time,commentid);
                initComment();
                $(".touid").hide();
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

function initComment(){
    $(".answer").hide();
    $("#subcomment").click(function(){
        var com = $("#valcomment").val();
        comment1(com,schoolid);
    });
    //回复评论by嘉敏
    $(".toComment").click(function(){
        // 这里需要去除空格
        // 得到回复对象的名字
        var name = $.trim($(this).parent().prev().find(".comname").text());

        // 回复的目标留言或者目标评论的id，去空格
        var recmntid = $.trim($(this).parent().prev().find(".touid").text());

        var rtcmntid = $.trim($(this).parent().parent().parent().parent().find(".comment").children().children().find(".touid").text());;
        // alert(rtcmntid);

        // 显示输入框
        $(this).parent().parent().parent().parent().find(".answer").show();
        $(this).parent().parent().parent().parent().find(".answer").html("<textarea class='valtocomment form-control' rows='2'></textarea>" +
                                                                         "<button type='button' class='btn btn-primary btn-xs sub' >提交</button>");
        $(this).parent().parent().parent().parent().find(".answer").find(".valtocomment").val("回复"+name.toString()+": ").focus();

        // 点击回复的提交之后的ajax
        $(this).parent().parent().parent().parent().find(".answer").find(".sub").click(function(){
            // 获得输入框的内容
            var com = $(this).prev().val();
            // alert(com);
            comment2(com,schoolid,recmntid,rtcmntid);
        });
    });
}

function hrefChange(){
    $("#blogHref").attr("href", commonURL + "/Home/Historyblog/index/schoolid/"+schoolid);
    $("#photoHref").attr("href", commonURL + "/Home/Photograph/index/schoolid/"+schoolid);
    $("#schoolHref").attr("href", commonURL + "/Home/School/historyfbk/schoolid/"+schoolid);
    $("#reportHref").attr("href", commonURL + "/Home/School/historyfbk/schoolid/"+schoolid);
}

//初始化评论区by嘉敏
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
                          "<div class='comname'>" + ownername[i][0] +"</div>" +"<br/>"+
                          "<span class='touid'>" + commentid[i][0] + "</span>" +
                          "<span class='val'>" + comment[i][0] + "</span>" +
                          "</div>" +
                          "<div class='col-md-offset-9'>" +
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
                               "<span class='comname'>" + ownername[i][j] + "</span>" +"<br/>"+
                               "<span class='touid'>" + commentid[i][j] + "</span>" +
                               "<span class='val'>" + comment[i][j] + "</span>" +
                               "</div>" +
                               "<div class='col-md-offset-8'>" +
                               "<span class='time'>" + "发表时间：" + time[i][j] + "</span>" +
                               "<button type='submit' class='toComment btn btn-primary btn-xs sub' >回复</button>" +
                               "</div></div>";
                    }
                    tmp = tmp + "</div>";
                    opt = opt + tmp;
                }
                opt = opt + "<div class='answer col-md-12 text-right'>" +
                      "<textarea class='valtocomment form-control' rows='2'></textarea>" +
                      "<button type='submit' class='btn btn-primary btn-xs sub' >提交</button>" +
                      "</div></div>";
                $("#divcontent").append(opt);
                $("#subButton").empty();
                opt = "<button type='button' class='btn btn-primary' id='subcomment'>提交</button>"
                $("#subButton").append(opt);
            }
            $(".touid").hide();

}

//点击发起活动
function creatActivity(){
    window.location.href= commonURL + "/Home/NewActivity/index";
}


//点击关注
function clickAttention(){
    $.ajax({
        "type":"post",
        "url": commonURL + "/Home/School/follow",
        "data":{"schoolid":schoolid},
        "success":function(data){

            if (data.status == "1") {
                //Do nothing
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

//载入更多海报
function morePoster(){
    $.ajax({
        "url": commonURL + "/Home/School/moreActivity",
        "type":"post",
        "data":{"currentpage":currentpage,"schoolid":schoolid},
        "success":function(data){
            if (data.status == "1") {
                additem = "";
                if(data.acids != null){
                    for (var i = 0; i < data.acids.length; i++) {
                        additem += "<div class='col-md-4 text-center'>"+
                                   "<div class='poster'>"+
                                   "<a href='"+ data.activityurls[i] +"'>"+
                                   "<img src='"+ data.imagesrcs[i] +"' title='" + data.descriptions[i] + "' class='img-poster'>"+
                                   "</a>"+
                                   "</div>"+
                                   "<div>"+
                                   data.descriptions[i]+
                                   "</div>"+
                                   "</div>";
                    };
                }
                $("#posterBox").append(additem);
                currentpage++;
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

// 点击留言by嘉敏
function comment1(com,schoolid) {
    $.ajax({
        url : commonURL + "/Home/School/leaveMessage",
        data : {"schoolid":schoolid,"content":com},
        success : function(data) {
            if (data.status == "1") {
                //Do nothing
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
    setTimeout(function(){reLoad();},400);
}

//点击回复by嘉敏
function comment2(com,schoolid,recmntid,rtcmntid) {
 /*   alert(com);
    alert(schoolid);
    alert(recmntid);
    alert(rtcmntid);*/
    $.ajax({
        url : commonURL + "/Home/School/comment",
        data : {"content":com,"schoolid":schoolid,"recmntid":recmntid,"rtcmntid":rtcmntid},
        success : function(data) {
            if (data.status == "1") {
                alert("回复成功");
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
    setTimeout(function(){reLoad();},300);
}
