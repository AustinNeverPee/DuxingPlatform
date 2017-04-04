$(document).ready(function(){

	commonURL = "/maitian/welfare/index.php";
	/*
	拆分URL获取参数schoolid
	*/
    var locationhref = window.location.href;
    blogid = locationhref.split("blogid/")[1];
	initate();
})

function initate(){
	$.post(commonURL+"/Home/PersonalBlog/getBlogByblogid",{"blogid":blogid},function(json){
		if(json.status == 1) {
			var content_left = '<p><img style="width:100px;height:100px;" src='+json.uicon+' alt="favicon" />'+
			json.uname+'</p>';
			$("#favicon").append(content_left);
			var content_right = '<h2 id="blogtitle"><b>' + json.blogtitle + '</b></h2>' + json.blogcontent;
			$("#main-box").append(content_right);
			//console.log(json);
		}
		else if(json.status == 2) {
			alert("数据库错误!");
		}
	});
}