<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function repost() {
			self.location = "againrepost";
		}
		var num = 60;
		function loop() {
			if(num == 0) {
				$('#email').attr('disabled',false);
				$('#time').css('display','none');
				return;
			}
			setTimeout("loop()",1000);
			$("#time").text(num+'后');
			num--;
		}
		$(function() {
			$('#email').attr('disabled',true);
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
		<p>已发送确认邮件至您的新邮箱，请去新邮箱点击确认链接激活邮箱</p>
		<p id="time"></p>
		<button id="email" onclick="repost()">重新发送</button>
		</div>
	</body>
</html>