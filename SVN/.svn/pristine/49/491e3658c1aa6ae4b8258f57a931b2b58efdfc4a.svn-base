<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>	
			$(function() {
				$("#tip1").hide();
				$("#tip2").hide();
				$("input[name = 'username']").blur(function() {
					var username = $("input[name = 'username']").val();
					$.post('regist', {
						username:username,
					},
					function(data) {
						var data = eval('('+data+')');
						if(data.state == 'repeat') {
							$("#tip1").show();
						}
						else {
							$("#tip1").hide();
						}
					}
					);
				});
				$("input[type = 'password']").blur(function() {
					var password = $("input[name = 'password']").val();
					var repassword = $("input[name = 'repassword']").val();
					if(password != repassword) {
						$("#tip2").show();
					}
					else {
						$("#tip2").hide();
					}
				});
			});
			function check() {
				var i = 0;
				var password = $("input[name = 'password']").val();
				var repassword = $("input[name = 'repassword']").val();
					if(password != repassword) {
						$("#tip2").show();
					}
					else {
						i++;
					}
				var username = $("input[name = 'username']").val();
				var email = $("input[name = 'email']").val();
					$.post('regist', {
						username:username,
					},
					function(data) {
						var data = eval('('+data+')');
						if(data.state == 'repeat') {
							$("#tip1").show();
						}
						else {
							i++;
							if(i == 2) {
								$.post('reg', {
									username:username,
									password:password,
									email:email
								},
								function(data) {
									self.location="jump";
								}
								);
							}	
						}
					}
					);
			}	
			function change() {	
				self.location = "../Check/check";
			}
		</script>
	</head>
	<body>
	<form id="formstyle" action="regist" method="POST">
			<fieldset id="fieldstyle">
				<p id="textstyle">
					username:<input  type="text" name="username">
					<span id="tip1">用户名重复</span>
				</p>
				<p id="textstyle">
					key:<input  type="password" name="password">
				</p>
				<p id="textstyle">
					repeat key:<input type="password" name="repassword">
					<span id="tip2">两次输入密码不同</span>
				</p>
				<p id="textstyle">
					邮箱:<input type="text" name="email">
				</p>
				<p id="textstyle">
					验证码:<input type="text" name="verify">
				</p>
				<img src="verify"/>
				<p id="submitstyle">
					<button onclick="check()" id="othersub1" type="button">确定</button>
				</p>
				<button onclick="change()" id="othersub" type="button">返回登陆</button>
			</fieldset>
	</form>

	<body>
</html>