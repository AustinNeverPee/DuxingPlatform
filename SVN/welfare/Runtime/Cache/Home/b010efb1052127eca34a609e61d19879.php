<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function message() {
			$("#myframe").attr("src","message");
		}
		function logout() {
			self.location = 'logout';
		}
		function change(pattern) {
			if(pattern == 1) {
				$("#myframe").attr("src","../Ownwelfare/index");
			}
			else if(pattern == 2) {	
				self.location = '../Site/index';
			}
		}
		function check() {
			$("#myframe").attr("src","../Register/index");
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
							//self.location="index?username="+username;
							$("#block1").remove();
							$("#block2").css('display','block');
							break;
						case 'admin':
						    self.location = '../Admin/index';
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
	<?php
 if($login) echo "<div id='block2' style='position:relative;float:right;display:none'>"; else echo "<div id='block2' style='position:relative;float:right;'>"; ?>
		<button onclick='message()'>消息</button>
		<button onclick='logout()'>登出</button>
	</div>
	<?php
 if($login) echo "<div id='block1' style='position:relative;float:right;'>"; else echo "<div id='block1' style='position:relative;float:right;display:none'>"; ?>
		<form id='formstyle' action='chec' method='POST'>
			<fieldset id='fieldstyle'>
				<p id='tip'></p>
				账号:<input  type='text' name='username' placeholder='' autofocus>
				密码:<input  type='password' name='password'>
				<br />
				<button id='othersub1' onclick='sign()' type='button'>登陆</button>
				<button onclick='check()' id='othersub' type='button'>注册</button>
			</fieldset>
		</form>
	</div>
	<div>
		<button onclick="change(2)">地点</button>
		<button onclick="change(1)">我的公益</button>
	</div>
	<iframe id="myframe" height="620px" width="1000px" frameborder="0" name="myframe"></iframe>
</body>
</html>