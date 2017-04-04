/**
 * Author:杨柳
 * Date:2014-8-30
 * Function:我的公益相册页
 * Modified by Austin Yang @ 2014-10-20 00:00 添加全局URL，更改ajax判断返回值机制
 */

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";
    albid="";

	//当前请求页面（全局变量）
	currentpage = 0;

    //初始化
    getAlbums();
    $(".selectArea").hide();

	//点击“更多”按钮，触发ajax请求
	$("#moreButton").click(function() {
		getAlbums();
	});

});

function createAlbum() {
    if(($.cookie("uid")==null)){
        alert("请登录");
        return;
    }

	albumName = $('#InputTitle1').val();
	albumDesrp = $('#InputTitle2').val();
	acid = $("#activity").find("option:selected").val();
  siteid = $("#sites").find("option:selected").val();
  var uid = $.cookie("uid");
    $.post("../PersonalPhotograph/createAlbum",
        {
            "name": albumName,
            "descrp": albumDesrp,
            "aid": acid,
            "siteid": siteid
        },
        function(json) {
            if(json.status == 0) {
                console.log(json.msg);
            }
            else if(json.status == 1){
                alert("新增相册成功");
            }
        }
    );
}

/**
 * 获取相册信息
 * 将信息以幻灯形式展示出来
 * Ajax发送、接收数据
 */
function getAlbums() {
	//Ajax发送、接收数据
    $.ajax({
        //与此php页面沟通
        url : commonURL + "/Home/PersonalPhotograph/moreAlbum",
        //发给php的数据有一项，是上面传来的page
        data: 'currentpage='+currentpage,
        //如果调用php成功
        success: function(data, textStatus) {
            if (data.status == "1") {

              for (var i = 0; i < data.imagesrcs.length; i++) {
          var loadPhoto = "";
            //载入第一张照片，为active
            var addDiv = "<div class='col-sm-6 col-md-6'>" +
                         "<a href='" + data.imagesrcs[i][0] + "' class='thumbnail'>" +
                         "<img src='" + data.imagesrcs[i][0] + "'> </a>" +
                         "<div class='text-center albuminfo'>" +
                         "<p> <a href='"+commonURL+"/Home/ActivityFeedback/photos/album/"+data.albumids[i]+"'> " + data.albumnames[i] + "</a></p>" +
                         "<small>"+data.uploadtimes[i]+"</small>" +
                         "</div></div>";

            //载入当前相册所有照片与标签

            // 相册长度不大于5
            var albumlength = data.imagesrcs[i].length
            albumlength = albumlength > 5 ? 5 : albumlength;

          for (var j = 1; j < albumlength; j++){
            var eachPhotoLoad = "<div class='col-sm-6 col-md-3'>" +
                                "<a href='" + data.imagesrcs[i][j] + "' class='thumbnail'>" +
                                "<img src='" + data.imagesrcs[i][j] + "'> </a>" +
                                "</div>";
                addDiv = addDiv + eachPhotoLoad;
          };
          loadPhoto = "<div class='col-md-6'>"+ addDiv +  "</div>";
              $("#gallery").append(loadPhoto);
        }


                //请求页面+1
                currentpage++;

                $('#gallery img').fsgallery();
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
