/**
 * Author:杨柳
 * Date:2014-8-30
 * Function:我的公益日志页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    //变量：当有一次申请页面不成功，则不会再申请
    canApply = 1;
    //当前申请页面
    currentpage = 1;
    loadMore();

});

/*$(window).scroll(function(){
        if(delay == 1){
          delay = 0;
          setTimeout(function(){
            if($(document).height()-$(this).scrollTop()-$(this).height()<100 && canApply == 1)
                    {
                        loadMore();
                    }
                delay = 1;
          },500);
        }
    });
*/
/**
 * 获取日志信息
 * 将信息以收缩栏形式展示出来
 * Ajax发送、接收数据
 */
function loadMore(){
    $.post(commonURL + "/Home/PersonalBlog/moreBlog",{"currentpage":currentpage},function(data){
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
                                    "<div class='logTitle text-center'>"+
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
                                        "<button class='btn btn-danger btn-xs' onclick=deleteBlog("+data.blogid[i]+")>删除</button>"+
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
                                 "<div class='logTitle text-center'>"+
                                 "<a href='" + data.blogurl[i] + "'><h3>" + 
                                        data.titles[i] +
                                      "</h3></a>"+
                                 "</div>"+
                                 "<div class='logMain'>"+
                                 //头像，点击可跳转日志主人的主页
                                 "<div id='more" + addNumber + "'>" + 
                                 cont_2 + "<button class='btn btn-danger btn-xs' onclick=deleteBlog("+data.blogid[i]+")>删除</button>"+
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
        }//end success function
      );//end ajax
}//end loadmore


    /*删除博客按钮事件绑定*/
    function deleteBlog(para){
      var veryfy = window.confirm("确定删除此博客?");
      if(veryfy){
          $.post(commonURL+"/Home/PersonalBlog/deleteBlog",{"blogid":para},function(data){
            if(data.statu==1){
              alert("删除成功");
              window.location.reload();
            }
        });
      }
    }
