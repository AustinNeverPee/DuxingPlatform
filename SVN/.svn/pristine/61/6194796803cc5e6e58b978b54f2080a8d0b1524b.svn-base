<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function writing() {
			$("#block1").css('display','none');
			$("#block2").css('display','block');
		}
		function cancel() {
			$("#tip").val('');
			$('#receiver').val('');//?
			$('#content').val('');
			$("#block2").css('display','none');
			$("#block1").css('display','block');
		}
		function send() {
			var receiver = $("#receiver").val();
			var content = $("#content").val();
			$.post('sendmessage',{
				receiver:receiver,
				content:content
			},function(data) {
				var data = eval('('+data+')');
				if(data.state == 'right') {
					$("#tip").text('发送成功');
					//$('receiver').text('');
					//$('content').text('');
				}
			});
		}
		function test() {
			//self.location='sendmessage';
		}
		function message(num,pattern) {
			$.post('target',{
				mid:num,
				pattern:pattern
			},function(data) {
				if(pattern == 0) {
					var data = eval('('+data+')');
					$("#block1").css('display','none');
					$("#block3").css('display','block');
					$("#context").text(data.content);
					$("#sender").text(data.sender);
					$("#"+num+'2').remove();
				}
				else if(pattern == 1) {
					$("#"+num).remove();
				}
				else 
					$("#"+num+'2').remove();
			});
		}
		function back() {
			$("#block3").css('display','none');
			$("#block1").css('display','block');
		}
		$(function() {
			$("#block2").css('display','none');
			$("#block3").css('display','none');
		});
		</script>
</head>
<body>
	<div id="block1">
	<h1>我的消息</h1>
	<div>
		<?php
 $num = count($data); for($i=0;$i<$num;$i++) { $mid = $data[$i]['mid']; $sender = $data[$i]['sender']; echo "<div id=$mid>
					  <button onclick='message($mid,0)' >".$sender."发的消息</button>
					  <button onclick='message($mid,1)' >删除</button>"; if($data[$i]['isread'] == 0) echo "<button onclick='message($mid,2)' id=".$mid."2>标记已读</button>"; echo "</div>"; } ?>
	</div>
	<div>
		<button onclick="writing()">写信</button>
		<button onclick="concentrate()">我关注的人</button>
		<button onclick="black()">黑名单管理</button>
	</div>
	</div>
	<div id="block2">
	<div>
		<textarea rows="1" cols="60" name="receiver" id="receiver"></textarea>
		<textarea rows="10" cols="100" name="content" id="content"></textarea>
		<p id="tip"></p>
		<button onclick="send()">发送</button>
		<button onclick="cancel()">撤销</button>
	</div>
	<div>
		<button onclick="concentrate()">我关注的人</button>
		<button onclick="black()">黑名单管理</button>
	</div>
	</div>
	<div id="block3">
		发送者：<p id="sender"></p>
		内容：<p id="context"></p>
		<button onclick="back()">返回</button>
	</div>
</body>
</html>