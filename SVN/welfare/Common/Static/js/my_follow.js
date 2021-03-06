/**
 * Author:杨柳
 * Date:2014-9-27
 * Function:我的公益我的关注页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    //初始化
    init();
});

/**
 * 初始化页面信息
 * 将ajax获取的数据显示在页面上
 * 获取数据为关注的人、地点和活动
 */
function init() {
    //Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url : commonURL + "/Home/PersonalFollow/initate",
        //如果调用php成功
        success: function(data, textStatus) {
            if (data.status == "1") {
                //显示获取的三部分数据到页面上
                //显示人
                for (var i = 0; i < data.userids.length; i++) {
                    $('<div class="followConcernedItem col-md-3"><a class="img-wrap"><img /><div class="followConcernedInfo"></div></a></div>')
                    .find('a').attr('href', '#').end()
                    .find('img').attr('src', data.usersrcs[i]).end()
                    .find('img').attr('alt', data.usernames[i]).end()
                    .find('.followConcernedInfo').html(data.usernames[i]).end()
                    .appendTo('.followConcerned');
                }

                //显示地点
                for (var i = 0; i < data.siteids.length; i++) {
                    $('<div class="locationConcernedItem col-md-3"><a class="thumbnail"><img /><div class="locationConcernedInfo"></div></a></div>')
                    .find('a').attr('href', '../School/index?schoolid=' + data.siteids[i]).end()
                    .find('img').attr('src', data.sitesrcs[i]).end()
                    .find('img').attr('alt', data.sitenames[i]).end()
                    .find('.locationConcernedInfo').html(data.sitenames[i]).end()
                    .appendTo('.locationConcerned');
                }

                //显示活动
                for (var i = 0; i < data.activityids.length; i++) {
                    $('<div class="activityConcernedItem col-md-3"><a class="thumbnail"><img /><div class="activityConcernedInfo"></div></a></div>')
                    .find('a').attr('href', '../ActivityDisplay/index/acid/' + data.activityids[i]).end()
                    .find('img').attr('src', data.activitysrcs[i]).end()
                    .find('img').attr('alt', data.activitynames[i]).end()
                    .find('.activityConcernedInfo').html(data.activitynames[i]).end()
                    .appendTo('.activityConcerned');
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