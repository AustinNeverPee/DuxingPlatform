<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>	
	function launch() {
		self.location="../Activity/launch";
	}
	</script>
</head>
<body>
	<img style="width:100px;height:100px;" src="<?php echo ($path); ?>"></img>
	<button id="" onclick="launch()">发起活动</button>
</body>
</html>