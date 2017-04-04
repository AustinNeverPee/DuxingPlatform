/**
 * Author:黄嘉敏
 * Date:2014-10-12
 * Function:活动页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 * Modified by 黄嘉敏 @ 2014-11-16 14:34 修改缩略图样式
 */

 $(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    init();
    $("#province").change(function(){
        provinceChange();
    });
    $("#city").change(function(){
        cityChange();
    });
    $("#county").change(function(){
        countyChange();
    });
    $("#town").change(function(){
        townChange();
    });
});

function init(){
	$("#actimg").empty();
    $.ajax({
        url : commonURL + "/Home/Activity/initate",
		success : function(json){
            if (json.status == "1") {
                var option="";
                var pids = json.provinceids;
			    var pnames = json.provincenames;
			    // 修改省的下拉菜单
			    // 待修改
			    for (var i = 0; i < pids.length; i++) {
				    var opt = $("<option/>").text(pnames[i]).attr("value", pids[i]);
				    $("#province").append(opt);
			    }
                //$("#main-box").html("");
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
        }//end success function
    });//end ajax
}

//手动更改select的值时才会触发change函数。
function provinceChange(){
    //如果“省”选项不为空，动态载入地点，如果为空，重置“市”，县等为空
    if($("#province").val() != "0"){
        $.ajax({
            url : commonURL + "/Home/Activity/getCity",
			data : "provinceid=" + $("#province").val(),
			success : function(json) {
                console.log(json);
                if(json.status == "1"){
                	var ids = json.cityids;
					var names = json.citynames;
					var imgs = json.imagesrcs;
					var acids = json.activityids;
					var urls = json.activityurls;

					$("#actimg").empty();

                    //初始化“市”
                    $("#city").empty();
							addSelOption($("#city"));
                    //循环载入“市”的资料

                    for (var i = 0; i < ids.length; i++) {
						var opt = $("<option/>").text(names[i]).attr("value", ids[i]);
						$("#city").append(opt);
					}

                    // 重新填充图片
					addImg(imgs,acids,urls);
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
            }//end success function
        });//end ajax
    }//end if "province != ''"

    //如果改为空，则不触发ajax请求，重置接下来的地点和学校列表
    else {
        $("#city").empty();
		addSelOption($("#city"));
    }
    //不论“省”是否为空，县与乡镇都得重置
    $("#county").empty();
	addSelOption($("#county"));
	$("#town").empty();
	addSelOption($("#town"));
}

//当city changed
function cityChange(){
    if($("#city").val() != "0"){
        $.ajax({
        	url : commonURL + "/Home/Activity/getCounty",
			data : "cityid=" + $("#city").val(),
			success : function(json) {
                //接受数据成功
                if(json.status == "1"){
                	var ids = json.countyids;
					var names = json.countynames;
					var imgs = json.imagesrcs;
					var acids = json.activityids;
					var urls = json.activityurls;
                    //重置“县”
                    $("#county").empty();
					addSelOption($("#county"));
                    //载入“县”
                    for (var i = 0; i < ids.length; i++) {
						var opt = $("<option/>").text(names[i]).attr("value", ids[i]);
						$("#county").append(opt);
					}

					// 重新填充图片
					$("#actimg").empty();
					addImg(imgs,acids,urls);
                    
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
            }//end success function
        });//end ajax
    }//end if "city != ''"
    else {
        $("#county").empty();
		addSelOption($("#county"));
    }
    //不论怎么更改更改，重置“乡镇”
    $("#town").empty();
	addSelOption($("#town"));
}

function countyChange(){
    if($("#county").val() != "0"){
        $.ajax({
        	url : commonURL + "/Home/Activity/getTown",
			data : "countyid=" + $("#county").val(),
			success : function(json) {

                if (json.status == "1") {              
                	var ids = json.townids;
					var names = json.townnames;
					var imgs = json.imagesrcs;
					var acids = json.activityids;
					var urls = json.activityurls;

                    $("#town").empty();
					addSelOption($("#town"));

                    for (var i = 0; i < ids.length; i++) {
						var opt = $("<option/>").text(names[i]).attr("value", ids[i]);
						$("#town").append(opt);
					}
					// 重新填充图片
					$("#actimg").empty();
					addImg(imgs,acids,urls);
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
            }// end success function
        });//end ajax
    }//end if "county != ''"
    else {
        $("#town").empty();
		addSelOption($("#town"));
    }
}

function townChange(){

    if($("town").val() != "0"){

        $.ajax({
        	url : commonURL + "/Home/Activity/getActivity",
			data : "townid=" + $("#town").val(),
			success : function(json){
                console.log(json);
                if (json.status == "1") {
                	var imgs = json.imagesrcs;
					var acids = json.activityids;
					var urls = json.activityurls;


					// 重新填充图片
					$("#actimg").empty();
					addImg(imgs,acids,urls);
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
            }//end success function
        });//end ajax
    }//end if "town != ''"
}

// 方法addSelOption：为匹配对象添加一项“请选择”
	// jq : jQuery对象
	var addSelOption = function(jq) {
		// 创建option对象，并设置文本为"请选择"，value值为-1
		// 这个创建方法没有看懂
		var opt = $("<option/>").text("请选择").attr("value", "-1");

		// 将option对象添加到select中
		jq.append(opt);
	}

	// 方法addImg：显示相应图片
	// jq是图片地址，ids是activityids
	var addImg = function(jq,ids,urls) {
		for (var i = 0; i < jq.length; i++) {

			var img = "<div class='col-sm-6 col-md-3'> <a style='background:#F0F0F0;' href='"+urls[i]+"' class='thumbnail'> <img style='height:100px;' src='"+jq[i]+"'></a></div>";
			$("#actimg").append(img);
		}
	}

