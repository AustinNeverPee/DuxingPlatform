/**
 * Author:chen_xl
 * Date:2014-10-27
 * Function:地点索引
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */



$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";
    init();
    addMap();
    $("#province").change(function(){
        provinceChange();
    });
    $("#cities").change(function(){
        cityChange();
    });
    $("#contries").change(function(){
        contryChange();
    });
    $("#towns").change(function(){
        townChange();
    });
});

function init(){
    $.ajax({
        "url": commonURL + "/Home/LocationIndex/initate",
        "type":"post",
        "success":function(data){
            if (data.status == "1") {
                var option="";
                for (var i = 0; i < data.provincenames.length; i++) {
                    //依次载入省份
                    option+="<option value='"+data.provinceids[i]+"'>"+data.provincenames[i]+"</option>";
                }
                $("#province").append(option);
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
        }//end success function
    });//end ajax
}

//手动更改select的值时才会触发change函数。

function provinceChange(){
    //如果“省”选项不为空，动态载入地点，如果为空，重置“市”，县等为空
    if($("#province").val() != "0"){
        var prols = $("#province").find("option:selected").text();
        var map = newamap(prols,9);
        $.ajax({
            "url": commonURL + "/Home/LocationIndex/getCity",
            "data":{"provinceid":$("#province").val()},//传递省份信息
            "success":function(data){
                if (data.status == "1") {
                    //初始化“市”
                    $("#cities").html("<option value='1'>-市-</option>");
                    var option = "";
                    //循环载入“市”的资料
                    for(var i = 0; i < data.citynames.length;i++){
                        option+="<option value='"+data.cityids[i]+"'>"+data.citynames[i]+"</option>";
                    }
                    $("#cities").append(option);
                    //载入地点
                    addLocation(data.schoolids, data.schoolurls, data.schools,
                            data.latitude, data.longitude, map,
                            data.descrps, data.imgurls, data.detailaddr);
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
            }//end success function
        });//end ajax
    }//end if "province != ''"

    //如果改为空，则不触发ajax请求，重置接下来的地点和学校列表
    else
    {
        $("#main-box").html("");
        $("#cities").html("<option value='0'>--选择市--</option>");
    }
    //不论“省”是否为空，县与乡镇都得重置
    $("#contries").html("<option value='0'>--选择县--</option>");
    $("#towns").html("<option value='0'>--选择乡镇--</option>");
}

//当cities changed
function cityChange(){
    if($("#cities").val() != "0"){
        var prols = $("#cities").find("option:selected").text();
        var map = newamap(prols,10);
        $.ajax({
            "url": commonURL + "/Home/LocationIndex/getCounty",
            "data":{"cityid":$("#cities").val()},
            "success":function(data){
                if (data.status == "1"){
                    //重置“县”
                    $("#contries").html("<option value='1'>-县/区-</option>");
                    var option = "";
                    //载入“县”
                    for(var i = 0; i < data.countynames.length;i++){
                        option+="<option value='"+ data.countyids[i]+"'>" + data.countynames[i]+"</option>";
                    }
                    $("#contries").append(option);
                    //载入地点
                    addLocation(data.schoolids, data.schoolurls, data.schools,
                            data.latitude, data.longitude, map,
                            data.descrps, data.imgurls, data.detailaddr);
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
            }//end success function
        });//end ajax
    }//end if "city != ''"
    else
    {
        $("#contries").html("<option value='0'>--选择县--</option>");
    }
    //不论怎么更改更改，重置“乡镇”
    $("#towns").html("<option value='0'>--选择乡镇--</option>");
}

function contryChange(){
    if($("#contries").val() != "0"){
        var prols = $("#cities").find("option:selected").text();
        var map = newamap(prols,10);
        $.ajax({
            "url": commonURL + "/Home/LocationIndex/getTown",
            "data":{"countyid":$("#contries").val()},
            "success":function(data) {
                if (data.status == "1") {
                    $("#towns").html("<option value='1'>-村镇-</option>");
                    var option = "";
                    for(var i = 0; i < data.townnames.length;i++){
                        option+="<option value='"+data.townids[i]+"'>" + data.townnames[i]+"</option>";
                    }
                    $("#towns").append(option);
                    //载入地点
                    addLocation(data.schoolids, data.schoolurls, data.schools,
                            data.latitude, data.longitude, map,
                            data.descrps, data.imgurls, data.detailaddr);
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
            }// end success function
        });//end ajax
    }//end if "country != ''"
    else
    {
        $("#towns").html("<option value='0'>--选择乡镇--</option>");
    }
}

function townChange(){
    if($("#towns").val() != "0"){
        var prols = $("#cities").find("option:selected").text();
        var map = newamap(prols,10);
        $.ajax({
            "url": commonURL + "/Home/LocationIndex/getSchool",
            "data":{"townid":$("#towns").val()},
            "success":function(data){
                if (data.status == "1") {
                    //载入地点
                    addLocation(data.schoolids, data.schoolurls, data.schools,
                            data.latitude, data.longitude, map,
                            data.descrps, data.imgurls, data.detailaddr);
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
            }//end success function
        });//end ajax
    }//end if "town != ''"
}

function addLocation(ids, urls, schools, latitude, longitude, map, briefloc, imgurls, detailaddr){
    option = "";
    for(var i = 0; i < urls.length; i++){
        option = "<a href='"+urls[i]+"'><h3>"+schools[i]+"</h3></a>"+
                 "<img class='infoWindowimg' src = '"+imgurls[i]+"'/>"+
                 "<p class= 'infoWindowp'>"+briefloc[i]+"</p>";
        var points = new BMap.Point(Number(longitude[i]),Number(latitude[i]));
        addMarkers(map,points,option);
    }
}

function addMap(){
    var map = new BMap.Map("main-school");
    var point = new BMap.Point(116.331398,39.897445);
    map.centerAndZoom(point,11);
    map.enableScrollWheelZoom(true);
    return map;
}

function addMarkers(map,point,instring){
    var marker = new BMap.Marker(point);
    var infoWindow = new BMap.InfoWindow(instring);
    map.addOverlay(marker);
    marker.addEventListener("click", function(e){ 
            this.openInfoWindow(infoWindow);
        });
}

function newamap(name,size){
    $("#main-box").html("<div id='main-school'></div>");
    var map = new BMap.Map("main-school");
    map.centerAndZoom(name,size);
    map.enableScrollWheelZoom(true);
    return map;
}
