<?php
/**
 *作者：胡国治
 *时间：2014-8-22
 *修改时间：2014-9-1
 *所属部分：活动首页的导航栏
 *主要包括导航栏的链接地址、登陆模块、注册模块以及消息接收
*/
namespace Home\Controller;
use Think\Controller;
require_once "user.php";
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");
class MainNavigationController extends Controller {
	/**
	 1级页面
     功能：提供给前端实时显示验证码的函数
     */
	public function verify() {
		$Verify = new \Think\Verify();
		$Verify->entry();
	}

	/**
     前端调用此验证函数即可
     由keyup事件触发此函数
     */
	public function checkVerify() {
		$Verify = new \Think\Verify();
		$verifyvalue = I('post.verifycode');
		
		if(!ajaxCheck($verifyvalue)) {
			die();
		}
		
        if($Verify->check($verifyvalue)) {
          $data['status'] = '1';
        }
        else {
          $data['status']= '0';
        }
        $this->ajaxReturn($data,'json');
    }

	/*登录模块*/
	public function login() {
		//定义一个图片路径前缀！
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");

		session("uid","vistor");
		$username = I('post.username');
		if(!ajaxCheck($username)) {
			die();
		}

		$password = I('post.password');
		
		$user = M('User');
		$message = M('Message');
		$img = M('Image');

		$msgUrl = array();
		/*增添正则表达式验证*/
		$userfind = $user->where("uname = '$username'")->find();
		if(!queryCheck($userfind)) {
			die();
		}
		
		if($userfind) {
            // MD5
		    //if($userfind["password"] != md5($password)) {
		    if($userfind["password"] != $password) {
			    $return['status'] = 0;
			    $return['msg'] = "pword";
				$this->ajaxReturn($return,'json');
				die();
			}
			$return['status'] = 1;
            $return['userid'] = $userfind['uid'];
            $uiconsrc = $img->where('iid="'.$userfind['uicon'].'"')->find();
			if(!queryCheck($uiconsrc)) {
				die();
			}
			if($uiconsrc == null) {
				$consts = require "consts.php";
				$return['imagesrc'] = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_USER"];
			}
			else {
            	$return['imagesrc'] = PREDIR.$uiconsrc['imgpath'];
        	}

				//设置session的值
			session('uid', $userfind['uid']);

				//查询信息的数量！
			$allMessage = M('message')->where('msgrecvuid = "'.$userfind['uid'].'" and msgstate = 1')->select();
			if(!queryCheck($allMessage)) {
				die();
			}
			$return['newmsgnumber'] = count($allMessage);
			$return['username'] = $username;
		} else {
			$return['status'] = 0;
            $return['msg'] = "uname";
		}

		$this->ajaxReturn($return,'json');
	}

	/*
	修改人：hxd，hh
	最后一次修改：hxd
	*/
	public function register() {
		$username = I('post.username');

		if(!ajaxCheck($username)) {
			//die();
		}

		$password = I('post.password');
		$email = I('post.email');

		/*定义保存返回数据的数组*/
		$img = M('Image');
		$message = M('Message');
		$return = array();

		$user = new \User();
		/*如果注册用户成功*/
        if($user->CreateUser($username, md5($password), $email)) {
		    $newUser = M('User');
			$con['uname'] = $username;
			$return['status'] = 1;
			/*查询新注册用户的id*/

			$uid = $newUser->where($con)->find();
			if(!queryCheck($uid)) {
				die();
			}

			if($uid) {
				/*查询新用户信息以便返回*/
				$return['userid'] = $uid['uid'];
				$uiconsrc = $img->where("iid='".$uid['uicon']."'")->find();
				if(!queryCheck($uiconsrc)) {
					die();
				}
				$return['imagesrc'] =$uiconsrc['imgpath'];

				$msgcon['msgrecvuid'] = $uid['uid'];
				/*新增一个字段表示是否已读*/
				$msgcon['msgstate'] = 0;
				$messageList = $message->where($msgcon)->select();
				if(!queryCheck($messageList)) {
					die();
				}
				if($messageList) {
					/*遍历得到所有的未读信息的url*/
					$return['message'] = count($messageList);

					foreach ($messageList as $value) {
						foreach ($value as $key => $src) {
							$msgUrl[] = $src;
						}
					}
                    $return['messageurl'] = $msgUrl;

				}
				/*如果没有最新未读消息,messageUrl为null*/
				else {
					$return['messageurl']=null;
				}
			}
        }
        else {
            die();
        }

		$this->ajaxReturn($return,'json');
	}

	public function logout() {
		session(null);
		session('[destroy]');
		$response['status'] = 1;
		$this->ajaxReturn($response, 'json');
	}

	public function activate() {
		$uid = I("get.uid");
		$token = I("get.token");
		
		$user = new \User();
		$commonURL = "/maitian/welfare/index.php";
		if ($user->active($uid, $token) ) {
			echo "<script>alert('激活成功!');window.location = '$commonURL/Home/HomePage/index';</script>";
		} else {
			echo "<script>alert('激活失败!');window.location = '$commonURL/Home/HomePage/index';</script>";
		}
	}

	public function fgpasswordindex() {
	    $this->display();
	}

	public function forgetpassword() {
	    $User = M("user");
 	    $username = I("post.username");
		
		if(!ajaxCheck($username)) {
			die();
		}
		
		$username = 'aspkni';
		$data = $User->where("uname = '$username'")->find();
		if(!queryCheck($data)) {
			die();
		}
		if($data) {
			$uid = $data['uid'];
			$email = $data['emailaddr'];
			$user = new \User();
			$user->sendactive($uid,$email,3);
			$text["status"] = 1;
		}
		else {
		    $text["status"] = 0;
		}
		
		echo json_encode($text);
	}
	
	public function svpasswordindex() {
	    $this->display();
	}
	
	public function savepassword() {
	    $password = I("post.password");
		
		if(!ajaxCheck($password)) {
			die();
		}

		$uid = session("uid");
		
		$User = M("user");
		$data["password"] = $password;

		$mid_var1 = $User->where("uid = '$uid'")->data($data)->save();
		if(!queryCheck($mid_var1)) {
			die();
		}
		$text["status"] = 1;
		
		echo json_encode($text);
	}
}
