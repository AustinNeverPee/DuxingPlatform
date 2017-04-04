var aid;
//记录当前blog页数；
var currentpage = 0;

var canAddLog = 1;

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";
    aid = getParam("acid");
    srcChange();
    moreBlog();
})


function srcChange(){
    $("#activityNameHref").attr("href", commonURL + "/Home/ActivityDisplay/index/acid/"+aid);
    $("#feedbackHref").attr("href", commonURL + "/Home/ActivityFeedback/feedbacktable/acid/"+aid);
    $("#blogHref").attr("href", commonURL + "/Home/ActivityFeedback/actblogs/acid/"+aid);
    $("#albumHref").attr("href", commonURL + "/Home/ActivityFeedback/fbkalbum/acid/"+aid);
}

// 获取url链接的参数
 function getParam(name){
    var locationhref = window.location.href;
    return locationhref.split("acid/")[1];
 }


function moreBlog(){
    $.ajax({
        url : commonURL + "/Home/ActivityFeedback/moreBlog",
        data : {"acid":aid,"currentpage":currentpage},
        success : function(data) {

 			if (data.statu == 1) {
                for (var i = 0; i < data.contents.length; i++) {
                    //当前日志的数字代号；
                    var addNumber = (currentpage*10+i).toString();
                    var cont_2 = data.contents[i].replace(/\n/g,'<br/>');
                        cont_2 = cont_2.replace(/\s/g,'&nbsp;');
                    //如果字数超过350，会有折叠
                    if (data.contents[i].length>350) {
                        //折叠起来的文字为文章的前三百字
                        var less = data.contents[i].substr(0,300)+"......";
                        //载入的代码
                        var addLog = "";
                        less = less.replace(/\n/g,'<br/>');
                        less = less.replace(/\s/g,'&nbsp;');
                        //时间没有
                        addLog += "<div class='log well'>"+
                                    "<div class='text-center'>"+
                                      "<a href='" + data.blogurl[i] + "'><h3>" + 
                                        data.titles[i] +
                                      "</h3></a>"+
                                    "</div>"+
                                    "<div class='logMain'>"+
                                    //头像，点击可跳转日志主人的主页
                                      "<div id='less" + addNumber + "'>" +
                                        less + 
                                      "</div>"+
                                      "<div id='more" + addNumber + "'>" + 
                                        cont_2+
                                      "</div>"+
                                    "</div>"+
                                    "<div class='logMore text-center' id='changeLog" + addNumber + "'>"+

                                      "<span class='caret'></span>"+

                                    "</div>"+
                                  "</div>"+ 

                                  "<script type='text/javascript'>"+
                                    "$('#more"+ addNumber +"').toggle();"+
                                    "$('#changeLog"+ addNumber +"').click(function(){"+
                                      "$('#less"+addNumber+"').toggle();"+
                                      "$('#more"+addNumber+"').toggle();"+
                                    "})"+
                                  "</script>";
                        $("#accordion").append(addLog);
                    }
                    //字数没有350，不会有折叠
                    else{
                        var addLog = "";
                        addLog+= "<div class='log well'>"+
                                 "<div class='text-center'>"+
                                 "<a href='" + data.blogurl[i] + "'><h3>" + 
                                    data.titles[i] +
                                  "</h3></a>"+
                                 "</h3>"+
                                 "</div>"+
                                 "<div class='logMain'>"+
                                 //头像，点击可跳转日志主人的主页
                                 "<div id='more" + addNumber + "'>" + 
                                 cont_2+
                                 "</div></div>"+
                                 "<div class='text-center'>"+
                                 "<span class='caret'></span>"+
                                 "</div>"+
                                 "</div>";
                        $("#accordion").append(addLog);
                    }
                }
                currentpage++;
            } else if (data.statu == 0) {
              console.log(data);
              canApply = 0;
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
                    alert(currentpage);
                    alert("数据库访问错误");
                }
            }
        },
        error : function(){
            alert("moreBlog操作失败");
        }
    });
}