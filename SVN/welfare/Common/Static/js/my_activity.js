/**
 * Author:杨柳
 * Date:2014-8-30
 * Function:我的公益活动页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

	//当前请求页面（全局变量）
	currentpage = 1;

    //初始化
    getActivities();

	//点击“更多”按钮，触发ajax请求
	$("#moreButton").click(function() {
		getActivities();
	});
});

/**
 * 获取活动信息
 * 将信息以海报形式展示出来
 * Ajax发送、接收数据
 */
function getActivities() {
	//Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url : commonURL + "/Home/PersonalActivity/moreActivity",
        //发给php的数据有一项，是上面传来的page
        data: 'currentpage='+currentpage,
        //如果调用php成功
        success: function(data, textStatus) {
            if (data.status == "1") {
                //根据data创建相应的活动图片
                for (var i = 0; i < data.acids.length; i++) {
                    $('<div class="activityItem col-md-3"><a class="thumbnail"><img /><div class="activityInfo"></div></a></div>')
                    .find('a').attr('href', data.acurls[i]).end()
                    .find('img').attr('src', data.imagesrcs[i]).end()
                    .find('img').attr('alt', data.description[i]).end()
                    .find('.activityInfo').html(data.description[i]).end()
                    .appendTo('.activityContainer');
                }

                //请求页面+1
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