/**
 * Author:chen-xl
 * Date:2014-10-6
 * Function:活动反馈页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */

var aid;
//记录当前blog页数；
var blogcount = 0;
//记录当前photo页数；
var photocount = 0;

var canAddLog = 1;

var canAddPhoto = 1;

var delay = 1;

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    $("#divfeedback").empty();
    $("#divphoto").empty();
    aid = getParam("aid");
    
    srcChange();
    feedback();
    moreAlbum();
   /* initLo();*/

    $("#feedback").click(function(){
        var url;
        changeURL(url);
    });
    $("#blog").click(function(){
        var url;
        changeURL(url);
    });
    $("#photo").click(function(){
        var url;
        changeURL(url);
    });

    $("#moreblog").click(function(){
        if (canAddLog == 1) {
            moreBlog();
        };
    });

    $("#sureCreat").click(function(){
    	creatNewAl();
    });
    //监测到当前处于页面尾时，载入新相册
    $(window).scroll(function(){
        if(delay == 1){
        	delay = 0;
        	setTimeout(function(){
    		    if($(document).height()-$(this).scrollTop()-$(this).height()<100 && canAddPhoto == 1)
                    {
                        moreAlbum();
                    }
                delay = 1;
    	    },500);
        }
    });

    $("#chooseLocation").change(function(){
        chooseChange();
    });

    $("#chooseAl").change(function(){
        chooseChange();
    });
    $("#uploadPhoto").hide();
});

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

// url没有给出
// js修改URL
function changeURL(url) {
    window.location = url;
}

//载入地点信息

/**
 * 文档加载后初始化页面
 * 填充反馈表
 */
function feedback(){
    $.post(commonURL+"/Home/ActivityFeedback/initate",{"acid":aid},function(json){
            
            if (json.statu==0) {
                $(".feedbacktable").hide();
                $(".alttextred").removeClass("alttext");
                return;
            } 
            console.log(json);
            for(var i = 0;i<json.length;i++){
                    var sponsor="";

                    /*反馈表详细内容*/
                    $(".actname").append("<p>"+json[i].aname+"</p>");
                    $(".feedrelsite").append("<p>"+json[i].sitename+"</p>");
                    $(".feeduser").append("<p>"+json[i].fdbakuser+"</p>");
                    $(".feeddate").append("<p>"+json[i].fdbckdt+"</p>");
                    $(".actdate").append("<p>"+json[i].eventdate+"</p>");

                    $(".actperiod").append("<p>"+json[i].eventdur+"</p>");
                    for(var j = 0;j<json[i].sponsorname.length;j++){
                        sponsor+=(json[i].sponsorname[j].uname+",");
                    }
                    $(".actleader").append("<p>"+sponsor+"</p>");
                    $(".schoolstate").append("<p>"+json[i].repairstate+"</p>");
                    $(".studentnum").append("<p>"+json[i].studentnum+"</p>");


                    $(".gradenum").append("<p>"+json[i].gradenum+"</p>");
                    $(".classnum").append("<p>"+json[i].classnum+"</p>");
                    $(".studentstate").append("<p>"+json[i].studentstate+"</p>");
                    $(".teacherstate").append("<p>"+json[i].teacherstate+"</p>");
                    $(".buildingstate").append("<p>"+json[i].schbuildingstate+"</p>");


                    $(".libstate").append("<p>"+json[i].schlibdescrp+"</p>");
                    $(".otherstate").append("<p>"+json[i].schotherdescrp+"</p>");
                    $(".organizationstate").append("<p>"+json[i].shaonianshestate+"</p>");
                    $(".infrastructure").append("<p>"+json[i].facilitystate+"</p>");

                    $(".evaluate").append("<p>"+json[i].teameval+"</p>");
                    $(".advice").append("<p>"+json[i].teamsuggest+"</p>");

                }
               
        }
    );
}

/*function initLo(){
    $("#chooseLocation").html("<option value='-1'>--选择地点--</option>");
    $("#chooseLocation2").html("<option value='-1'>--选择地点--</option>");
    $("#chooseAl").html("<option value='-1'>--选择相册--</option>");
    $.ajax({
        url : commonURL + "/Home/ActivityFeedback/getLocation",
        data: {"acid":acid},
        success: function(data) {
            var siteid = data.siteid;
            var sitename = data.sitename;

            if (data.status == "1") {
                var option = "";
                for (var i = 0; i < siteid.length; i++) {
                    option+="<option value='"+siteid[i]+"'>"+sitename[i]+"</option>";
                };
                $("#chooseLocation").append(option);
                $("#chooseLocation2").append(option);
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

    $.ajax({
        url : commonURL + "/Home/ActivityFeedback/getAlbum",
        data: {"acid":acid},
        success: function(data) {
            var id = data.albumid;
            var name = data.albumname;

            if (data.status == "1") {
                var option = "";
                for (var i = 0; i < id.length; i++) {
                    option+="<option value='"+id[i]+"'>"+name[i]+"</option>";
                };
                $("#chooseAl").append(option);
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
}*/




// 这里不完全拷贝地点页的相册页
function moreAlbum() {
    $.ajax({
        url : commonURL + "/Home/ActivityFeedback/moreAlbum",
        data : {"currentpage":photocount, "acid":aid},
        success : function(data){
            //获取相册成功
            if (data.statu == "1") {
                for (var i = 0; i < data.imagesrcs.length; i++){
                    var currentbox = (((photocount)*3)+i).toString();
                    var loadPhoto = "";
                    //载入第一张照片
                    var eachPhotoLoad = 
                    "<div class='col-sm-6 col-md-2'>"+
                      "<a href='"+data.imagesrcs[i][0]+"' class='thumbnail'>"+
                          "<img src='"+data.imagesrcs[i][0]+"' alt='通用的占位符缩略图'/>"+
                      "</a>"+
                      "<div>"+
                      "<a href='"+commonURL+"/Home/ActivityFeedback/photos/album/"+data.albumids[i]+"' target='_blank'><h3>"+data.albumnames[i]+"<br/><small>"+data.uploadtimes[i]+"</small></h3></a>"+
                      "</div>"+
                     "</div>";

                    $("#gallery").append(eachPhotoLoad);
                    
                }
                photocount++;
                $('#gallery img').fsgallery();
            } else if (data.statu == "0") {
                canAddPhoto = 0;
                if (data.msg == "2") {
                    //alert("当前活动没有相册");
                }
            }
        },
        error : function() {
            alert("获取相册失败");
        }
    });
}

function creatNewAl(){
	if ($("#chooseLocation2").val() == "-1" || $("#InputStreet").val() == "" ||
		$("#alDescription").val() == "") {
		alert("请选择正确的地点并填写相册名与描述");
	} 
	else{
		$.ajax({
			url : commonURL + "/Home/ActivityFeedback/addAlbum",
			data: {"acid": aid, "siteid": $("#chooseLocation2").val(),
			       "albumname": $("#InputStreet").val(), "description": $("#alDescription").val()},
			success: function(data){
                if (data.status == "1") {
                    alert("创建成功");
                    initLo();
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
}

function chooseChange(){
	if($("#chooseLocation").val() != -1 && $("#chooseAl").val() != -1){
		$("#uploadPhoto").show();
		FuploadPhoto();
	} 
	else{
		$("#uploadPhoto").hide();
	}
}

function FuploadPhoto(){
    $('#file_upload').uploadify({
    	  'formData' :{
    	  	'acid': aid,
    	  	'siteid' : $("#chooseLocation").val(),
    	  	'albumid': $("#chooseAl").val()
    	  },
          'swf'      : '/welfare/Common/Static/swf/uploadify.swf',
          'uploader' : commonURL + '/Home/ActivityFeedback/upload'
    });
}