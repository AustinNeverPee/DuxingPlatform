<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>
	function changesite(pattern,id) {
		var id = id;
		$.post('changesite',{
			id:id,
			pattern:pattern,
		},
		function(data) {
			var data = eval('('+data+')');
			var num = data.content.length;
			if(pattern == 1) {
				$('#city').empty();
				for(var i=0;i<num;i++) {
					$('#city').append('<option value='+data.content[i].cityid+'>'+data.content[i].cityname+'</option>')
				}
				changesite(2,data.content[0].cityid);
			}
			else if(pattern == 2) {
				$('#county').empty();
				for(var i=0;i<num;i++) {
					$('#county').append('<option value='+data.content[i].countyid+'>'+data.content[i].countyname+'</option>')
				}
				changesite(3,data.content[0].countyid);
			}
			else if(pattern == 3)
				$('#town').empty();
				for(var i=0;i<num;i++) {
					$('#town').append('<option value='+data.content[i].townid+'>'+data.content[i].townname+'</option>')
				}
			
		});
	}
	function save() {
		var sitename = $('#sitename').val();
		var descrp = $('#descrp').val();
		var provinceid = $('#province').val();
		var cityid = $('#city').val();
		var townid = $('#town').val();
		var	iid = $('#iid').val();
		var countyid = $('#county').val();
		$.post('savesite',{
			townid:townid,
			provinceid:provinceid,
			cityid:cityid,
			iid:iid,
			countyid:countyid,
			sitename:sitename,
			descrp:descrp
		},function(data) {
			var data = eval('('+data+')');
			if(data.state == 'right')
				alert('创建成功');
		});
	}	
	function change(path,id) {
			$("#image").attr("src",path);
			$("#iid").val(id);
	}
	</script>
</head>
<body>
	<div style="float:left;">
	<p>
	<select onchange='changesite(1,this.value)' id="province">
		<?php
 $num = count($data); for($i=0;$i<$num;$i++) { $provinceid = $data[$i]['provinceid']; $provincename = $data[$i]['provincename']; echo "<option value='$provinceid'>$provincename</option>"; } ?>
	</select>
	</p>
	<p>
	<select onchange='changesite(2,this.value)' id="city">
	</select>
	</p>
	<p>
	<select onchange='changesite(3,this.value)' id="county">
	</select>
	</p>
	<p>
	<select id="town">
	</select>
	</p>
	<p>
	村：<input type='text' id="sitedetailaddr"/>
	</p>
	<p>
	地点名称：<input type='text' id="sitename"/>
	</p>
	<p>
	资料收集人：<input type='text' id="creator"/>
	</p>
	简单介绍：
	<p>
	<textarea cols="50" rows="10" id="descrp"></textarea>
	</p>
	</div>
	<img style="width:100px;height:100px;" id="image"/>
	<form action="upload" method="post" target="newframe" enctype="multipart/form-data">
		<input type="file" name="file"/>
		<input type="submit" value="确定上传" />
		<input id="iid" type="text" value="" style="display:none;" />
	</form>
	<iframe name="newframe" width="0" height="0" src="" style="display:none;"></iframe>
	<button onclick="save()">创建改地点</button>
	<?php
 echo "<script>changesite(1,".$data[0]['provinceid'].")</script>"; ?>
</body>
</html>