"use strict"
var aid;

// 获取url链接的参数
 function getParam(name){
    var locationhref = window.location.href;
    return locationhref.split("acid/")[1];
 }

 $(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    

    aid = getParam("aid");
    srcChange();
    initate();

    $("#submitButton").click(function(){
        sublimeFeedback();
    });

});

 function srcChange(){
    $("#activityNameHref").attr("href", commonURL + "/Home/ActivityDisplay/index/acid/"+aid);
    $("#feedbackHref").attr("href", commonURL + "/Home/ActivityFeedback/feedbacktable/acid/"+aid);
    $("#joinHref").attr("href", commonURL + "/Home/ActivityFeedback/index/acid/"+aid);
}

var eventleaderuid; // 发起者UID，大概
var eventdate;

function initate(){

    $.ajax({
        url : commonURL + "/Home/NewFeedback/initate",

        data : "aid="+aid,
        success : function(json) {
            if (json.status == "1") {
                console.log(json);

                var activity = json.activity;

                eventdate = activity.startdate;
                eventleaderuid = activity.creatoruid;

                $("#InputActivity").val(activity.aname);
                $("#InputSite").val(json.sites[0].sitename);
                $("#InputTime").val(activity.startdate + "至" + activity.enddate);
                $("#InputPeriod").val(activity.apostimg);

                
                
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

function createDate() {
    var date = new Date();
    return date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate();
}

function sublimeFeedback() {

    $.ajax({
        "url": commonURL + "/Home/NewFeedback/createFeedback",
        "data":{"relsiteid": $("#activitytype").val(),
                "relaid":aid,
                "fdbckuid":$.cookie("uid"),
                "eventdate":createDate(),
                "eventdur":null,
                "eventleaderuid":eventleaderuid,
                "studentnum":$("#InputTotalstu").val(),
                "gradenum":$("#InputGrade").val(),
                "classnum":$("#InputClass").val(),
                "studentstate":$("#InputStudent").val(),
                "teacherstate":$("#InputTeacher").val(),

                "schlibdescrp":$("#InputLibrary").val(),
                "schotherdescrp":$("#InputMaterial").val(),
                "shaonianshestate":$("#InputYouthClub").val(),
                "facilitystate":$("#InputArchitecture").val(),
                "teameval":$("#InputEstimate").val(),

                "teamsuggest":$("#InputSuggest").val()
            },
        "success":function(data){
            if (data.status == "1") {
                alert("创建成功");
                // window.location=commonURL + "/Home/ActivityFeedback/feedbacktable/acid/"+aid;
            } else if (data.status === "0") {

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