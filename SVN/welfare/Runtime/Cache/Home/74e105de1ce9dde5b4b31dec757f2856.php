<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function back() {
			self.location="index";
		}
		function check() {
			var newpassword = $("input[name='newpassword']").val();
			var renewpassword = $("input[name='renewpassword']").val();
			if(newpassword != renewpassword) {
				alert("两次输入密码不同ͬ");
				return;
			}
			$.post('savenewpassword', {
					password:newpassword
				},
				function(data) {
					$("#block1").css("display","none");
					$("#block2").css("display","block");
				}
			);
		}
		$(function(){
			$("#block2").css("display","none");
		});
		</script>
</head>
<body>
<div id="block1">
<form action="" method="POST">
	新密码<input type="password" name="newpassword"/>
	重复新密码<input type="password" name="renewpassword" />
</form>
<button onclick="check()">确定</button>
</div>
<div id="block2">
<p style="">修改成功</p>
</div>
<button onclick="back()">返回</button>
</body>
</html>