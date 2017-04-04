<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>
	function createSite() {
		self.location = 'createsite';
	}
	function changesite(pattern,id) {
		var id = id;
		$.post('otherchangesite',{
			id:id,
			pattern:pattern
		},
		function(data) {
			$('#school').empty();
			var data = eval('('+data+')');
			if(pattern!=4)
				var num = data.content.length;
			if(pattern == 1) {
				$('#city').empty();
				$('#city').append('<option>--未选择--</option>');
				for(var i=0;i<num;i++) {
					$('#city').append('<option value='+data.content[i].cityid+'>'+data.content[i].cityname+'</option>');
				}
			}
			else if(pattern == 2) {
				$('#county').empty();
				$('#county').append('<option>--未选择--</option>');
				for(var i=0;i<num;i++) {
					$('#county').append('<option value='+data.content[i].countyid+'>'+data.content[i].countyname+'</option>');
				}
			}
			else if(pattern == 3) {
				$('#town').empty();
				$('#town').append('<option>--未选择--</option>');
				for(var i=0;i<num;i++) {
					$('#town').append('<option value='+data.content[i].townid+'>'+data.content[i].townname+'</option>');
				}
			}
			for(var key in data.school) {
				$('#school').append('<p><a href="school?id='+data.school[key]+'">'+key+'</a></p>');
			}
		});
	}
	</script>
</head>
<body>
	<div id="school" style="width:500px;height:500px;border:solid 2px black;float:left;">
	</div>
	<div style="float:right;">
	<p>
	<select onchange='changesite(1,this.value)' id="province">
	<option>--未选择--</option>
		<?php
 $num = count($data); for($i=0;$i<$num;$i++) { $provinceid = $data[$i]['provinceid']; $provincename = $data[$i]['provincename']; echo "<option value='$provinceid'>$provincename</option>"; } ?>
	</select>
	</p>
	<p>
	<select onchange='changesite(2,this.value)' id="city">
	<option>--未选择--</option>
	</select>
	</p>
	<p>
	<select onchange='changesite(3,this.value)' id="county">
	<option>--未选择--</option>
	</select>
	</p>
	<p>
	<select onchange='changesite(4,this.value)' id="town">
	<option>--未选择--</option>
	</select>
	</p>
	<button onclick="createSite()">新建地点</button>
	<div>
</body>
</html>