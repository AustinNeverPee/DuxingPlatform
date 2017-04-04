/**
 * Author:黄嘉敏
 * Date:2014-10-26
 * Function:日志编辑页
 */

 function GetQueryString(name) {
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}

var blogid="";
var blogtitle="";
var blogcontent="";
var acid="";
var siteids="";

$(document).ready(function(){
    //全局URL
    commonURL = "/maitian/welfare/index.php";

    initate();

    $("#newBlogBtn").click(function(){
        saveBlog();
    });

    $("#abortBtn").click(function(){
        $("#editor").code('');
        $(".addBlogForm").find("input").val('');
        $(".addBlogForm").find("option").removeAttr('selected');
    });

    $("#activity").change(function(){
        $("#sites").empty().append("<option>请选择地点</option>")
        var aciddata = $(this).find("option:selected").val();
        $.post(commonURL + "/Home/PersonalBlog/getUserActRelSite",{"aid":aciddata},function(resJson){
            for(var i = 0;i<resJson.length;i++){
                $("#sites").append("<option value='"+resJson[i].siteid+"'>"+resJson[i].sitename+"</option>");
            }
        });
    });
    
});

function initate() {
    // 编辑日志时，需要取得当前编辑日志的id
   /* var editBlogid = GetQueryString("editBlogid");*/
    var uid = $.cookie("uid");
    // alert(editBlogid);
    $.post(commonURL + "/Home/PersonalBlog/getUserRelAct",function(json) {
            
                for (var i = 0; i < json.length; i++) {
                    var opt = '<option value="'+json[i].aid+'">'+json[i].aname+'</option>';
                    /*插入新的option选项*/
                    $("#activity").append(opt);
                }
            

        });
}

// 获得siteids
// 格式：'{"id":["id1","id2"]}'

function saveBlog() {
    if(($.cookie("uid")==null)){
        alert("请登录");
        return;
    }

	blogtitle = $('#InputTitle').val();
	blogcontent = $('#editor').code();
	acid = $("#activity").find("option:selected").val();
    siteids = new Array();
    $("#sites").find("option:selected").each(function(){
        siteids.push($(this).val());
    });
    var uid = $.cookie("uid");
	
   
    if(acid==""||siteids.length==0||blogtitle==""||blogcontent=="") {
        alert("请勾选完整");
        return;
    }

	else{
        $.post("../PersonalBlog/saveBlog",
            {
                "title":blogtitle,
                "content":blogcontent,
                "acid":acid,
                "siteids":siteids
            },
            function(json) {
                if(json.statu == 0) {
                    console.log(json.msg);
                }
                else if(json.statu == 1){
                    console.log(json);
                    alert("新增日志成功");
                    window.location.href="../PersonalBlog/index";
                }
            }
        );

    } 
}

/*function acidChange(acid) {
	$.ajax({
		url : "../PersonalBlog/querySites",
		data : "acid=" + acid,
		success : function(json) {
			if (json.status == '1') {
				var sitelist2 = json.siteidlist; 
                var sitename2 = json.sitename; // 没有传！

                $("#selectSites").empty();

                // 活动地点更改
                var k = 0;
                for (var i = 0; i < sitelist2.length; i++) {
                	var opt = '<input type="checkbox"'+' name="'+ sitelist2[i] +'">'+sitename2[i];
                	$("#selectSites").append(opt);
                }
			} else {
				alert(json.msg);
			}
		}
	});
}*/
