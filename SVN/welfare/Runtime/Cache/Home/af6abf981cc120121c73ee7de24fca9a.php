<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>
		function changesite(pattern,id) {
		var id = id;
		$.post('../site/otherchangesite',{
			id:id,
			pattern:pattern
		},
		function(data) {
			var data = eval('('+data+')');
			if(pattern!=4 && data.content != null)
				var num = data.content.length;
			$('#site').empty();
			if(pattern == 1) {
				$('#city').empty();
				$('#county').empty();
				$('#town').empty();
				for(var i=0;i<num;i++) {
					$('#city').append('<option value='+data.content[i].cityid+'>'+data.content[i].cityname+'</option>');
				}
				changesite(2,data.content[0].cityid);
			}
			else if(pattern == 2) {
				$('#county').empty();
				$('#town').empty();
				for(var i=0;i<num;i++) {
					$('#county').append('<option value='+data.content[i].countyid+'>'+data.content[i].countyname+'</option>');
				}
				changesite(3,data.content[0].countyid);
			}
			else if(pattern == 3) {
				$('#town').empty();
				for(var i=0;i<num;i++) {
					$('#town').append('<option value='+data.content[i].townid+'>'+data.content[i].townname+'</option>');
				}
				changesite(4,data.content[0].townid);
			}
			for(var key in data.school) {
				$('#site').append('<option value='+data.school[key]+'>'+key+'</option>');
			}
		});
	}
	function changeday() {
			for(var i = 29; i <= 31;i++)
				$("#day [value='"+i+"']").remove()
			var month = parseInt($("#month").val());
			var year = $("#year").val();
			var day;
			switch(month) {
				case 1:
				case 3:
				case 5:
				case 7:
				case 8:
				case 10:
				case 12:
					day = 31;
					break;
				case 4:
				case 6:
				case 9:
				case 11:
					day = 30;
					break;
				case 2:
					if(year%100==0 && year%400==0) {
						day = 29;
					}
					else if(year%100!=0 && year%4==0){
						day = 29;
					}
					else
						day = 28;
					break;
			}
			for(var i=29;i<=day;i++) {
				$("#day").append("<option value='"+i+"'>"+i+"日</option>");
			}
		}
		function release() {
			var atypeid = $('#atype').val();
			var siteid = $('#site').val();
			var aname = $('#aname').val();
			var limitnum = $('#limitnum').val();
			var adescrp = $('#descrp').text();
			var startdate = $('#syear').val()+'-'+$('#smonth').val()+'-'+$('#sday').val();
			var enddate = $('#eyear').val()+'-'+$('#emonth').val()+'-'+$('#eday').val();
			$.post('release',{
				atypeid:atypeid,
				siteid:siteid,
				aname:aname,
				limitnum:limitnum,
				adescrp:adescrp,
				startdate:startdate,
				enddate:enddate
			},function(data) {
				var data = eval('('+data+')');
			});
		}
		$(function() {
		});
	</script>
</head>
<body>
<div>
<h1>活动管理页</h1>
<p>活动分类：
<select id="atype">
<?php
 foreach($atype as $atype) { echo "<option value=".$atype['atypeid'].">".$atype['atypename']."</option>"; } ?>
</select>
</p>
<p>组织者：<input type="text"/><button id="">添加组织者</button>
</p>
<div id="addsite">活动地点：<button id="add">添加地点</button>
	<div id="block">
	<input id="number" value="0" style="display:none;"/>
	<select onchange='changesite(1,this.value)' id="province">
		<?php
 $num = count($data); for($i=0;$i<$num;$i++) { $provinceid = $data[$i]['provinceid']; $provincename = $data[$i]['provincename']; echo "<option value='$provinceid'>$provincename</option>"; } ?>
	</select>
	<select onchange='changesite(2,this.value)' id="city">
	</select>
	<select onchange='changesite(3,this.value)' id="county">
	</select>
	<select onchange='changesite(4,this.value)' id="town">
	</select>
	<select id="site">
	</select>
	<button id="addsite">确定</button>
	</div>
</div>
<p>
活动标题：<input type="text" id="aname"/>
</p>
<p>
<?php
 echo"开始时间：<select name='year' id='syear' onchange='changeday()'>"; $today = (int)date('Y'); for($i = -5;$i < 120;$i++) { $time = $today - $i; echo "<option value='$time'>".$time."年</option>"; } echo "</select>"; echo "<select name='month' id='smonth' onchange='changeday()'>"; for($i = 1;$i < 13;$i++) { echo "<option value='$i'>".$i."月</option>"; } echo "</select>"; echo "<select name='day' id='sday'>"; for($i = 1;$i <= 31;$i++) { echo "<option value='$i'>".$i."日</option>"; } echo "</select>"; echo"结束时间：<select name='eyear' id='year' onchange='changeday()'>"; $today = (int)date('Y'); for($i = -5;$i < 120;$i++) { $time = $today - $i; echo "<option value='$time'>".$time."年</option>"; } echo "</select>"; echo "<select name='month' id='emonth' onchange='changeday()'>"; for($i = 1;$i < 13;$i++) { echo "<option value='$i'>".$i."月</option>"; } echo "</select>"; echo "<select name='day' id='eday'>"; for($i = 1;$i <= 31;$i++) { echo "<option value='$i'>".$i."日</option>"; } echo "</select>"; ?>
</p>
活动详情：
<p>
<textarea id="descrp" rows="10" cols="50"></textarea>
</p>
<p>需要志愿者人数：<input id="limitnum" type="text"/></p>
<p>
<button onclick="release()">发布</button>
</p>
</div>
<?php
 echo "<script>changesite(1,".$data[0]['provinceid'].")</script>"; ?>
</body>
</html>