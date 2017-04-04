<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function back() {
			self.location="index";
		}
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
		<?php if($text == 'right'): ?><p>邮箱修改成功</p>
			<?php else: ?><p>邮箱修改失败，请查看链接是否正确</p><?php endif; ?>
		</div>
		<button onclick="back()">返回</button>
	</body>
</html>