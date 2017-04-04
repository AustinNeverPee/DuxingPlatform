<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>	
			function check() {
				$("#verify").text("");
				var i = 0;
				var password = $("input[name = 'password']").val();
				var repassword = $("input[name = 'repassword']").val();
				if(password != repassword) {
						return;
					}
				var username = $("input[name = 'username']").val();
				var email = $("input[name = 'email']").val();
				var verify = $("input[name = 'verify']").val();
				var regx = /^[a-zA-Z0-9]+$/;
				if(regx.test(username)&&regx.test(password)) {
				$.post('register', {
					username:username,
					password:password,
					email:email,
					verify:verify
				},
				function(data) {
					var data = eval('('+data+')');
					if(data.state == 'right')
						self.location = "jump";
					else
						$("#verify").text('验证码错误');
				}
				);
				}
				else 
					alert("非法字符");
			}
			function change() {
				$("#fuck").attr("src","verify");
			}
			function back() {	
				parent.location = "../Homepage/index";
			}
		</script>
	</head>
	<body>
	<form id="formstyle" action="regist" method="POST">
			<fieldset id="fieldstyle">
				<p id="textstyle">
					账号:<input  type="text" name="username">
				</p>
				<p id="textstyle">
					密码:<input  type="password" name="password">
				</p>
				<p id="textstyle">
					重复密码:<input type="password" name="repassword">
				</p>
				<p id="textstyle">
					邮箱:<input type="text" name="email">
				</p>
				<p id="textstyle">
					验证码:<input type="text" name="verify">
				</p>
				<p id="verify"></p>
				<img id="fuck" src="verify"/>
				<button onclick="change()" type="button">更换</button>
				<p id="submitstyle">
					<button onclick="check()" id="othersub1" type="button">确定</button>
				</p>
				<button onclick="back()" id="othersub" type="button">返回登陆</button>
			</fieldset>
	</form>

	<body>
</html>