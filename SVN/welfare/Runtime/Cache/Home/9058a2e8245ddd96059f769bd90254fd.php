<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function back() {
			self.location="index";
		}
		function check() {
			var password = $("input[name='password']").val();
			$.post('check', {
					password:password
				},
				function(data) {
					var data = eval('('+data+')');
					if(data.state == 'right')
						self.location = 'modifypassword?token='+data.token;
					else if(data.state == 'overtime') {
						alert('您的会话已经过期，请重新登录');
						self.location = "../Homepage/login";
					}
					else
						alert('密码错误');
				}
				);
		}
		</script>
</head>
<body>
<form action="" method="POST">
	密码：<input type="password" name="password"/>
</form>
<button onclick="check()">确定</button>
<button onclick="back()">后退</button>
</body>
</html>