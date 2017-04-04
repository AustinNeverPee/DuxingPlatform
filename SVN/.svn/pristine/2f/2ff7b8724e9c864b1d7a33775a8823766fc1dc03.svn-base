<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function change(path) {
			$("#image").attr("src",path);
		}
		function back() {
			self.location="index";
		}
		</script>
</head>
<body>
	<form action="upload" method="post" target="newframe" enctype="multipart/form-data">
		<input type="file" name="file"/>
		<input type="submit" value="确定" />
	</form>
<iframe name="newframe" width="0" height="0" src="" style="display:none;"></iframe>
<img style="width:100px;height:100px;" id="image" src="<?php echo ($path); ?>"/>
<button onclick="back()">后退</button>
</body>
</html>