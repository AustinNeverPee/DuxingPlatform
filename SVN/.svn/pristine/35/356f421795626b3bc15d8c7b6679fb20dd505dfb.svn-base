<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
			var num = 5;
			function loop() {
				if(num == 0)
					self.location="../Homepage/login";
				setTimeout("loop()",1000);
				$("#time").text(num);
				num--;
			}
			$(function() {
				loop();
			});
		</script>
		<style>
			#tip {
				border:2px solid green;
				position:fixed;
				top:30%;
				left:40%;
				width:200px;
				height:200px;
			}
		</style>
	</head>
	<body style="text-align:center">
		<div id="tip">
		<?php if($text == 'right'): ?><h1>恭喜激活成功</h1>
			<?php else: ?><h1>激活失败，请查看链接是否正确</h1><?php endif; ?>
		<h1 id="time"></h1>
		<h1>秒跳转到登陆页面</h1>
		</div>
	</body>
</html>