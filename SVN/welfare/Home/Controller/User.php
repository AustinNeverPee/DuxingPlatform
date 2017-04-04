<?php
header("Content-Type: text/html; charset=utf-8");

/**
 *这个文件也没有太多需要改动的地方
 *跟前几个文件一样，需要考虑怎样调整这些代码的结构
 */

/**
 *引入工具类
 *functioin.php是自定义的用来验证访客身份(游客、注册用户和管理员)
 *smtp.php是下载的类，用于做什么的，暂时还不太清楚
 */
require_once "functions.php";
require_once "smtp.php";
class User {
	/**
	 *这里定义的私有变量应该是在session中的用户唯一标识符
	 */
	private $uid;
	private $mysql;
	
	/**
	 *这里thinkphp不是不允许用户写构造函数的吗？ ！！！
	 *  BP ！
	 */
	public function __construct() {
		$consts = require "consts.php";
		$url = $consts["DATA_BASE"]["HOST"].":".$consts["DATA_BASE"]["PORT"];
		$db_name = $consts["DATA_BASE"]["NAME"];
		$db_user = $consts["DATA_BASE"]["USER"];
		$db_pwd = $consts["DATA_BASE"]["PWD"];
		$this->mysql = new mysqli($url,$db_user,$db_pwd,$db_name);
	}
	
	/**
	 *创建一个新的用户
	 *@param $username, $password, $email : string, string, string 创建用户需要通过url传递的3个参数
	 */
	public function CreateUser($username,$password,$email) {
		$result = $this->mysql->query("select * from user where uname = '$username'");		//未考虑查询失败的情况
		if($result->num_rows) {
		    $data["status"] = 0;
		    $data["msg"] = "uname";
			echo json_encode($data);
			return false;
		}
		$result = $this->mysql->query("select * from user where emailaddr = '$email'");
		if($result->num_rows) {
		    $data["status"] = 0;
			$data["msg"] = "email";
			echo json_encode($data);
			return false;
		}
		$time = date('y-m-d h:i:s',time());
		$this->mysql->query("insert into user(uname,password,emailaddr,sex,createdt,ugid) values ('$username','$password','$email',-1,'$time',0)");
		$uid = $this->mysql->insert_id;
		$this->sendactive($uid,$email);
		return true;
	}
	
	/**
	 *这里的在使用163邮箱进行注册激活的动作，这个函数可以保留下来直接用
	 *@param $email, $uid, $token, $pattern : string, string, string, string 邮箱注册通过url传递的参数
	 */
	private function sendemail($email,$uid,$token,$pattern = 0) {
		$commonHost = "http://localhost";
		//$commonHost = "";
		$commonURL = "/maitian/welfare/index.php";
		$url = $commonHost.$commonURL;
		$token = md5($token);
		$newuid = md5($uid);
		$smtpserver = "smtp.163.com";//SMTP服务器
		$smtpserverport = 25;//SMTP服务器端口
		$smtpusermail = "13802447724@163.com";//SMTP服务器的用户邮箱
		$smtpemailto = $email;//发送给谁
		$smtpuser = "13802447724";//SMTP服务器的用户帐号
		$smtppass = "aspknihxd2014";//SMTP服务器的用户密码
		$mailsubject = "注册激活邮件";//邮件主题 
		if($pattern == 0)
			$mailbody = "<h1>感谢您的注册</h1>
					 <p>请点击</p><a href='$url/Home/MainNavigation/activate?uid=$uid&&token=$token'>$url/Home/MainNavigation/activate?uid=$newuid&&token=$token</a><span>激活账号</span>
					";//邮件内容
		else if($pattern == 1)
			$mailbody = "<h1>感谢您使用本网站</h1>
					 <p>请点击</p><a href='$url/Home/PersonalHomepage/emailindex?uid=$uid&&token=$token'>$url/Home/MainNavigation/passwordindex?uid=$newuid&&token=$token</a><span>修改密码</span>
					";
		else if($pattern == 2)
			$mailbody = "<h1>感谢您使用本网站</h1>
					 <p>请点击</p><a href='$url/Home/Ownwelfare/reactive?uid=$uid&&token=$token'>$url/Home/Register/active?uid=$newuid&&token=$token</a><span>确认修改邮箱</span>
					";
		else if($pattern == 3)
		    $mailbody = "<h1>感谢您使用本网站</h1>
					 <p>请点击</p><a href='$url/Home/MainNavigation/svpasswordindex?uid=$uid&&token=$token'>$url/Home/MainNavigation/svpasswordindex?uid=$newuid&&token=$token</a><span>修改密码</span>
					";
		$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
		##########################################
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = TRUE;//是否显示发送的调试信息
		$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
	}

	/**
	 *这个页面都额函数，似乎都是可以保留的！
	 *发激活信息，通过调用上面的sendemail函数，实现用户的邮箱激活
	 *@param $uid, $email, $pattern = 0 : string, string, string 发送激活信息的参数，通过url传递
	 */
	public function sendactive($uid,$email,$pattern = 0) {
		$time = date('y-m-d h:i:s',time());
		$token = random_text(10);
		$this->mysql->query("delete from userverify where uid='$uid'");
		$this->mysql->query("insert into userverify(vuid,token,vstartdt,vemailaddr,vdur) values ('$uid','$token','$time','$email','1')");
		$this->sendemail($email,$uid,$token,$pattern);
	}
	
	/**
	 *执行邮箱激活操作！
	 *@param $uit, $token, $pattern : string, string, string 执行激活操作的参数，通过url传递
	 */
	public function active($uid,$token,$pattern = 0,$password = 0) {
		$result = $this->mysql->query("select * from userverify where vuid='$uid'");
		if(!$result->num_rows)
			return false;
		$data = $result->fetch_object();
		$result->close();
		$time = date('y-m-d h:i:s',time());
		if($token == md5($data->token)) {
			if($pattern == 0)
				$this->mysql->query("update user set ugid=1,validdt='$time' where uid='$uid'");
			if($pattern == 2)
				$this->mysql->query("update user set emailaddr='$data->emailaddr' where uid='$uid'");
		    if($pattern == 3)
			    $this->mysql->query("update user set password = $password where uid='$uid'");
			$this->mysql->query("delete from userverify where vuid='$uid'");
			return true;
		}
		return false;
	}
}