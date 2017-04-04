<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>
		function change() {
			self.location = 'changeicon';
		}
		function changeday() {
			for(var i = 29; i <= 31;i++)
				$("#day [value='"+i+"']").remove()
			var month = parseInt($("#month").val());
			var year = $("#year").val();
			var day;
			switch(month) {
				case 1:
				case 3:
				case 5:
				case 7:
				case 8:
				case 10:
				case 12:
					day = 31;
					break;
				case 4:
				case 6:
				case 9:
				case 11:
					day = 30;
					break;
				case 2:
					if(year%100==0 && year%400==0) {
						day = 29;
					}
					else if(year%100!=0 && year%4==0){
						day = 29;
					}
					else
						day = 28;
					break;
			}
			for(var i=29;i<=day;i++) {
				$("#day").append("<option value='"+i+"'>"+i+"日</option>");
			}
		}
		$(function() {
			//changeday();
		});
		function edit() {
			$("#block1").css('display','none');
			$("#block2").css('display','block');
		}
		function cancel() {
			$("#block2").css('display','none');
			$("#block1").css('display','block');
		}
		function save() {
			var unickname = $("input[name='unickname']").val();
			var sex = $("select[name='sex']").val();
			var birthdate = $("#year").val()+'-'+$("#month").val()+'-'+$("#day").val();
			var phonenum = $("input[name='phonenum']").val();
			var addr = $("input[name='addr']").val();
			var selfdescrp = $("#selfdescrp").val();
			$.post('information', {
			unickname:unickname,
			sex:sex,
			birthdate:birthdate,
			addr:addr,
			phonenum:phonenum,
			selfdescrp:selfdescrp
			},function (data) {
			    var data = eval('('+data+')');
				self.location = "";
			});
		}
		</script>
		
</head>
<body>
	<div>
		<img style="width:100px;height:100px" id="icon" src="<?php echo ($path); ?>"/>
		<button onclick="change()">修改头像</button>
	</div>
	<div>
		<p>密码<a href="changepassword">修改</a></p>
		<p>密保邮箱<a href="repost">修改</a></p>
	</div>
	<div id="block1">
		<p>昵称：<?php echo ($data["unickname"]); ?></p>
		<p>账号：<?php echo ($data["uname"]); ?></p>
		<p>个人：<?php echo ($data["sex"]); echo ($data["birthdate"]); ?></p>
		<p>居住地：<?php echo ($data["addr"]); ?></p>
		<p>电话：<?php echo ($data["phonenum"]); ?></p>
		<p>邮箱：<?php echo ($data["emailaddr"]); ?></p>
		<p>个人简介:<?php echo ($data["selfdescrp1"]); ?></p>
		<button onclick="edit()">编辑资料</button>
	</div>
	<div id="block2"  style="display:none;">
		昵称：<input type="text" value="<?php echo ($data["unickname"]); ?>" name="unickname"/>
		<br />
		<p>账号：<?php echo ($data["uname"]); ?></p>
		性别：<select name="sex" id="sex">
			<option value="male">男</option>
			<option value="female">女</option>
		</select>
		<?php
 echo "<script>changeday()</script>"; if($data['sex'] == '男') echo "<script>$('#sex [value=male]').attr('selected','true')</script>"; else echo "<script>$('#sex [value=female]').attr('selected','true')</script>"; echo "生日<select name='year' id='year' onchange='changeday()'>"; $today = (int)date('Y'); for($i = 0;$i < 120;$i++) { $time = $today - $i; echo "<option value='$time'>".$time."年</option>"; } echo "</select>"; $time = split("-",$data['birthdate']); if($time[1] < 10) $time[1] = str_replace('0','',$time[1]); if($time[2] < 10) $time[2] = str_replace('0','',$time[2]); echo "<script>$('#year [value=$time[0]]').attr('selected','true')</script>"; echo "<select name='month' id='month' onchange='changeday()'>"; for($i = 1;$i < 13;$i++) { echo "<option value='$i'>".$i."月</option>"; } echo "</select>"; echo "<script>$('#month [value=$time[1]]').attr('selected','true')</script>"; echo "<select name='day' id='day'>"; for($i = 1;$i <= 31;$i++) { echo "<option value='$i'>".$i."日</option>"; } echo "<script>$('#day [value=$time[2]]').attr('selected','true')</script>"; echo "</select>"; ?>
		<br />
		居住地：<input type="text" value="<?php echo ($data["addr"]); ?>" name="addr"/>
		<br />
		电话：<input type="text" value="<?php echo ($data["phonenum"]); ?>" name="phonenum"/>
		<br />
		<p>邮箱：<?php echo ($data["emailaddr"]); ?></p>
		<p>个人简历：</p>
		<textarea rows="10" cols="60" name="selfdescrp" id="selfdescrp"><?php echo ($data["selfdescrp"]); ?></textarea>
		<button onclick="save()">保存修改</button>
		<button onclick="cancel()">取消</button>
	</div>
</body>
</html>