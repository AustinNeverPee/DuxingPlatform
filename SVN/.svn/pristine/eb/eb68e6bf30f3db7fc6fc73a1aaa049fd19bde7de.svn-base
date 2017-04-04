 
 var albumid;
$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";
    albumid = getParam("albumid");
    showAlbumPhotos(albumid);

})

 function getParam(name){
    var locationhref = window.location.href;
    return locationhref.split("album/")[1];
 }

 function showAlbumPhotos(para) {
    $.ajax({
        url : commonURL + "/Home/ActivityFeedback/getPhotos",
        data : {"albumid":para},
        success : function(data){
            //获取相册成功
            if (data.statu == "1") {
                for (var i = 0; i < data.imgsrc.length; i++){
      
                    var loadPhoto = "";
                    //载入第一张照片
                    var eachPhotoLoad = 
                    "<div class='col-sm-6 col-md-2'>"+
                      "<a href='"+data.imgsrc[i]+"' class='thumbnail'>"+
                          "<img src='"+data.imgsrc[i]+"' alt='通用的占位符缩略图'/>"+
                      "</a>"+
               
                     "</div>";

                    $("#gallery").append(eachPhotoLoad);
                    
                }
            } else if (data.statu == "0") {           
                    alert("当前活动没有相册");
            }
            $('#gallery img').fsgallery();
        },
        error : function() {
            alert("获取图片失败");
        }
    });
}