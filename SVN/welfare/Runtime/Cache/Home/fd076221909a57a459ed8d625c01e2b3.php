<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
			function check() {
				self.location = "../Register/index";
			}
			function sign() {
				var regx = /^[a-zA-Z0-9]+$/;
				$("input").on('focus',function() {
					$("#tip").css({"border":"solid 2px white","color":"red"});
					$("#tip").text('');
				});
				var username = $("input[name='username']").val();
				var password = $("input[name='password']").val();	
				if(regx.test(username)&&regx.test(password)) {
					$.post('check', {
						username:username,
						password:password
					},
					function(data) {
						var data = eval('('+data+')');
						switch(data.state) {
						case 'username':
							$("#tip").css({"border":"solid 2px red","color":"red"});
							$("#tip").text('输入的账号不存在');
							break;
						case 'password':
							$("#tip").css({"border":"solid 2px red","color":"red"});
							$("#tip").text('密码错误');
							break;
						case 'right':
							self.location="index?username="+username;
							break;
						case 'wrong':
							alert('对不起，您的账号未激活，请点击确定发送激活邮件');
							self.location = '../Register/repost';
							break;
						}
					}
					);
				}
				else
					$("#tip").text('非法字符');
			}
		</script>
</head>
<body>
		<form id="formstyle" action="chec" method="POST">
			<fieldset id="fieldstyle">
				<p id="tip"></p>
				<p id="textstyle">
					username:<input  type="text" name="username" placeholder="" autofocus>
				</p>
				key:<input  type="password" name="password">
				<button id="othersub1" onclick="sign()" type="button">登陆</button>
				<button onclick="check()" id="othersub" type="button">注册</button>
			</fieldset>
		</form>
</body>
</html>