<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>
	</script>
</head>
<body>
<div>
<h1>活动管理页</h1>
<p>活动分类：
<?php
 echo "$atype"; ?>
</p>
<p>组织者：<input type="text"/><button id="">添加组织者</button>
</p>
<div id="addsite">活动地点：<button id="add">添加地点</button>
	<div id="block">
	<input id="number" value="0" style="display:none;"/>
	<select onchange='changesite(1,this.value)' id="province">
		<?php
 ?>
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
?>
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
?>
</body>
</html>