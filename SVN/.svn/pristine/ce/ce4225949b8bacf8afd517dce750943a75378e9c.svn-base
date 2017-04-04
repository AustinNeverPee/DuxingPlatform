<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
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
		<?php if($text == 'right'): ?><h1>确认成功</h1>
			<form action="againrepost" method="POST">
				新密保邮箱：<input type="text" name="email"/>
				<input type="submit" value="确定" />
			</form>
			<?php else: ?><h1>邮箱确认失败，请查看链接是否正确</h1><?php endif; ?>
		</div>
	</body>
</html>