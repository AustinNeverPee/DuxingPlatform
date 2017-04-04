$(document).ready(function(){

	commonURL = "/maitian/welfare/index.php";
	/*
	拆分URL获取参数schoolid
	*/
    var locationhref = window.location.href;
    schoolid = locationhref.split("schoolid/")[1];
	initate();
})

function initate(){
	$.post(commonURL+"/Home/School/getFeedBackBySiteid",{"siteid":schoolid},function(json){
		for(var i = 0;i<json.length;i++){
			/*var content_left = '<h4><b>' + json[i].fdbckdt + '</b></h4>';
			$("#poster").append(content_left);
			var content_right = '<div class="historyfbklist">'+
			'<div class="page-header"><h2><b>历史反馈表 '+(i+1)+'</b></h2></div><p><div><b>学校建筑物状态:&nbsp;&nbsp;</b>'+json[i].schbuildingstate+
			'</div><div><b>学生人数:&nbsp;&nbsp;</b>'+json[i].studentnum+'</div><div><b>麦田少年社建议:&nbsp;&nbsp;</b>'+
			json[i].teamsuggest+'</div><a href="' + json[i].feedbackurl + '">>>详情</a></p></div>';
			$("#main-box").append(content_right);

			<!-- 左侧-->
	        <div class="col-sm-3">
	          <div class="list_time" id="poster">
	          </div>
	          
	        </div><!-- /左侧-->

	        <!-- 右侧-->
	        <div class="col-sm-9 list_table" id="main-box" role="main">
	            
	        </div><!-- /右侧-->*/

	        var feedback = '<div class="list_time col-sm-3">' + json[i].fdbckdt + '</div>'
	        				+ '<div class="col-sm-9 list_table historyfbklist">'
	        				+ '<div class="page-header"><h2><b>历史反馈表 '+(i+1)+'</b></h2></div><p><div><b>学校建筑物状态:&nbsp;&nbsp;</b>'
	        				+ json[i].schbuildingstate + '</div><div><b>学生人数:&nbsp;&nbsp;</b>'
	        				+ json[i].studentnum+'</div><div><b>麦田少年社建议:&nbsp;&nbsp;</b>'
	        				+ json[i].teamsuggest+'</div><a href="' + json[i].feedbackurl + '">>>详情</a></p></div>';
	        $("#feedbacklists").append(feedback);
		}
	});
}