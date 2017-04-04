$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    initate();

});

function initate(){
    //alert("test");
    //alert(acid);
    $.ajax({
        url : commonURL + "/Home/HomePage/initate",
        success : function(json) {
            if (json.status == "1") {
                console.log(json);

                var activities = json.activities;
                if(activities != null)
                for (var i = 0; i < activities.length; i= i+3) {
                  var act = "<div class='secondaryhead'>";
                  for (var j = 0; j < 3; j++) {
                    var n = i+j;
                    if (n < activities.length) {

                      var tmp = "<div class='sconndaryblock'>" +
                      "<a href='"+activities[n].activityurl+"'><img style='width:100px;height:100px' src='"+activities[n].apostimg+"'></a>" +
                      "<h3>"+activities[n].aname+"</h3>" +
                      "</div>";

                      act = act + tmp;
                    }
                  }
                  act = act + "</div>";
                  $("#activity").append(act);
                }

                var blogs = json.blogs;
                if(blogs != null)
                for (var i = 0; i < blogs.length; i= i+3) {
                  var act = "<div class='secondaryhead'>";
                  for (var j = 0; j < 3; j++) {
                    var n = i+j;
                    if (n < blogs.length) {

                      var tmp = "<div class='sconndaryblock'>" +
                      '<h3><a href="' + blogs[n].blogurl + '">' +blogs[n].blogtitle+'</a></h3>' +
                      "<p>"+blogs[n].uname+"</p>" +
                      "</div>";

                      act = act + tmp;
                    }
                  }
                  act = act + "</div>";
                  $("#blog").append(act);
                }

                var sites = json.sites;
                if(sites != null)
                for (var i = 0; i < sites.length; i= i+3) {
                  var act = "<div class='secondaryhead'>";
                  for (var j = 0; j < 3; j++) {
                    var n = i+j;
                    if (n < sites.length) {

                      var tmp = "<div class='sconndaryblock'>" +
                      "<a href='"+sites[n].siteurl+"'><img src='"+sites[n].sitemainpic+"' style='width:100px;height:100px'></a>" +
                      "<h3>"+sites[n].sitename+"</h3>" +
                      "</div>";

                      act = act + tmp;
                    }
                  }
                  act = act + "</div>";
                  $("#location").append(act);
                }




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
            alert("initate操作失败");
        }
    });
}
