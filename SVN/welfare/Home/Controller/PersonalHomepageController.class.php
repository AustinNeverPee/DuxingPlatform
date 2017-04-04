<?php
/**
 *Author: 何衡
 *Date: 2014/8/30
 *Function: 实现“学校页”控制器
 */
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
require_once "User.php";
header("Content-Type: text/html; charset=utf-8");

class PersonalHomepageController extends Controller {
	/**
	 *第一次访问该页面时，调用该函数获取模板
	 *@param @void : void 无参数
	 */
	public function index() {
		$commonURL = "/maitian/welfare/index.php";
		if(!isUser(1)) {
			echo "<script>alert('请先登录!');window.location = '$commonURL/Home/HomePage/index';</script>";
			return;
		}
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}

	/**
	 *调用修改邮箱模板
	 */
	public function emailindex() {
	    $this->display();
	}

	/**
	 *调用激活邮箱模板
	 */
	public function activeemail() {
	    $this->display();
	}
	
	/**
	 *文档加载完毕后，调用该函数，初始化页面信息
	 *@param @uid : void 用户唯一身份标示符uid
	 */
	public function initate() {
		//定义一个图片路径前缀！
		define("PREDIR", "/welfare/Common/Static/resources/");
		
		//第一步，从sessioin中取出uid信息
		$uId = session('uid');
		//根据用户id查询数据库
		$user = M('user')->where("uid = '$uId'")->find();
		if(!queryCheck($user)) {
			die();
		}
		//根据查询结果，封装返回信息
		
		$response = null;
		$imagesrc = M('image')->where('iid='.$user['uicon'])->getField('imgpath');
		if(!queryCheck($imagesrc)) {
			die();
		}
		if($imagesrc == null) {
			$consts = require "consts.php";
			$response['src'] = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_USER"];
		}
		else {
			$response['src'] = C('STATIC_RESOURCE').'/resources/'.$imagesrc;
		}
		
		$response['nickname'] = $user['unickname'];
		$response['realname'] = $user['realname'];
		$response['gender'] = $user['sex'];
		$response['livingplace'] = $user['addr'];
		$response['email'] = $user['emailaddr'];
		$response['qq'] = $user['qqnum'];
		$response['phone'] = $user['phonenum'];
		$response['password'] = $user['password'];
		$response['idcard'] = $user['idnum'];
		$response['birthday'] = $user['birthdate'];
		$response['description'] = $user['selfdescrp'];
		$response['status'] = 1;

		//ajax返回初始化信息
		$this->ajaxReturn($response, "json");
	}

	public function changeinfo() {
	
	    if(!ajaxCheck(I("post.nickname"))) {
			die();
		}
	    $nickname = I("post.nickname") ? I("post.nickname") : null;
		$realname = I("post.realname") ? I("post.realname") : null;
		$sex = I("post.sex") ? I("post.sex") : null;
		$address = I("post.address") ? I("post.address") : null;
		$qq = I("post.qq") ? I("post.qq") : null;
		$phonenumber = I("post.phonenumber") ? I("post.phonenumber") : null;
		$id = I("post.id") ? I("post.id") : null;
		$birthday = I("post.birthday") ? I("post.birthday") : null;
		$description = I("post.description") ? I("post.description") : null;
		
		$data["unickname"] = $nickname;
		$data["sex"] = $sex;
		$data["qqnum"] = $qq;
		$data["phonenum"] = $phonenumber;
		$data["realname"] = $realname;
		$data["birthdate"] = $birthday;
		$data["addr"] = $address;
		$data["selfdescrp"] = $description;
		$data["idnum"] = $id;
		
		$uid = session("uid");
		$User = M("user");
		
		$mid_var1 = $User->where("uid = '$uid'")->data($data)->save();
		if(!queryCheck($mid_var1)) {
			die();
		}
		
		$text['status'] = 1;
		echo json_encode($text);
	}
	
	public function changepassword() {
	    $oldpassword = I("post.oldpassword");
		if(!ajaxCheck($oldpassword)) {
			die();
		}
		
		$newpassword = I("post.newpassword");
		
		$User = M("user");
		$uid = session("uid");
		$password = $User->where("uid = '$uid'")->getField("password");
		if(!queryCheck($password)) {
			die();
		}
		
		if(md5($oldpassword) == $password) {
		    $data["password"] = md5($newpassword);
			$mid_var2 = $User->where("uid = '$uid'")->data($data)->save();
		    if(!queryCheck($mid_var2)) {
				die();
			}
			$text['status'] = 1;
		}
		else {
		    $text["status"] = 0;;
		}
		
		echo json_encode($text);
	}
	
	public function changeemail() {
	    $pword = I("post.password");
		
		if(!ajaxCheck($pword)) {
			die();
		}
		
		$User = M("user");
		$uid = session("uid");
		
		$data= $User->where("uid = '$uid'")->find();
		if(!queryCheck($data)) {
			die();
		}
		
		if(md5($pword) == $data["password"]) {
			$my = new \User();
		    $my->sendactive($uid,$data["emailaddr"],1);
			$text["status"] = 1;
		}
		else {
		    $text["status"] = 0;
		}
		
		echo json_encode($text);
	}
	
	public function testemail() {
	    $emailaddr = I("post.emailaddr");
		
		if(!ajaxCheck($emailaddr)) {
			die();
		}
		
		$uid = session("uid");
		
		$my = new \User();
		$my->sendactive($uid,$emailaddr,2);
		
		$text["status"] = 1;
		
		echo json_encode($text);
	}
	
	/**
	 *Author : 何衡
	 *用于检查用户昵称、qq、电话和身份证是否唯一
	 *@param @uid : string 从session中获得uid
	 *@param @nickname : string 如果有，则从post取得
	 *@param @qq : string 如果有，则从post取得
	 *@param @phone : string 如果有，则从post取得
	 *@param @idnum : string 如果有，则从post取得
	 */
	public function verifyUnique() {
		
		//从session中取出用户的id
		$uId = session('uid');

		//实例化用户数据库
		$allUserDB = M('user');
		
		//判断post中的参数
		if (isset($_POST['nickename'])) {
			$criteria['unickname'] = I('post.nickname');
		} else if ($_POST['qq']) {
			$criteria['qqnum'] = I('post.qq');
		} else if ($_POST['phone']) {
			$criteria['phonenum'] = I('post.phone');
		} else if ($_POST['id']) {
			$criteria['idnum'] = I('post.id');
		}
		
		//根据参数查询数据库
		
		$result = $allUserDB->where($criteria)->find();
		if(!queryCheck($result)) {
			die();
		}
		$response = array();
		if (empty($result)) {
			//不存在重复的名字
			$response['status'] = 1;
		} else {
			$response['status'] = 2;
		}

		$this->ajaxReturn($response, 'json');
	}


	/**
	 *用户点击上传图片后，将图片信息写入到数据，并将对应文件放到指定用户目录
	 *@param @uId : string 该参数由session中获得
	 *经测试，该接口工作正常
	 */
	public function uploadUicon() {

		//宏定义头像类型！
		define('ICON', 1);

		//定义需要用的数据库
		$allImageDB		= M('image');
		$allUserDB 		= M('user');

		//从前端获取用户id
		$uId		= session('uid');

		//定义用户上传图片的目标文件夹
		$userName = $allUserDB->where('uid='.$uId)->getField('uname');
		$targetFolder = C('STATIC_RESOURCE').'/resources/'.$userName;
		mkdir("Common/Static/resources/".$userName);
		if(!queryCheck($userName)) {
			die();
		}

		if (!empty($_FILES)) {
			//在服务器根目录下指定文件上传的路径
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].$targetFolder;

			//利用毫秒级别的时间重命名上传的文件
			//切割掉 microtime()函数返回数据格式 0.25139300 1138197510中的点
			$nodot = explode(".", microtime());
			$namestr = str_replace(' ', '', $nodot[1]);
			$uptype = explode(".", $_FILES["Filedata"]["name"]);
			$newname = $namestr.".".$uptype[1];
			$_FILES["Filedata"]["name"] = $newname;

			//定位目标文件welfare/Common/Static/resources/$userName/xxxxx.jpg
			$targetFile = $targetPath.'/'.$_FILES['Filedata']['name'];

			//验证文件后缀名是否是规定的类型
			$fileTypes = array('jpg', 'jpeg', 'pjpeg', 'gif', 'png');
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			if (($uIcon = $allUserDB->where('uid='.$uId)->getField('uicon')) === false) {
				die();
			} else if (!empty($uIcon)){
				//做删除图片的操作
			}
			
			//将图片及其关联信息写入到数据库
			if (in_array($fileParts['extension'],$fileTypes)) {

				//构造需要写入数据库的图片信息
				$dataForImg['uid'] = $uId;
				$dataForImg['imgpath'] = $userName.'/'.$_FILES["Filedata"]["name"];
				$dataForImg['imgdt'] = date('Y-m-d H:i:s', time());
				$dataForImg['albumid'] = null;
				$dataForImg['imgtype'] = ICON;
				
				//将图片信息插入到数据库，失败则设置操作异常
				if (($iid = $allImageDB->data($dataForImg)->add()) === false) {
					die();
				} else {
					
					//刷新数据库，查询刚刚存入数据库的图片数据
					//$allImageDB		= M('image');
					//$iid = $allImageDB->where($dataForImg)->getField('iid');

					//更新用户数据库
					$allUserDB->uicon = $iid;
					$allUserDB->where('uid='.$uId)->save();
					
					//写数据库成功，讲图片拷贝到指定目录下
					move_uploaded_file($tempFile, $targetFile);
							
					$tmpImage = new \Think\Image(\Think\Image::IMAGE_GD, $targetFile);
					$response = array();
					$response['height'] = $tmpImage->height();
					$response['width'] = $tmpImage->width();
					$response['iid'] = $iid;
					$response['imgpath'] = $targetFolder.'/'.$_FILES['Filedata']['name'];
					$response['status'] = 1;
					
					$this->ajaxReturn($response, 'json');
					
				}
			} else {
				$response = array();
				$response['status'] = 0;
				$response['msg'] = 'Invalid file type.';
			}
		}
	}

	/**
	 *根据前端参数，获取图片！
	 *@param @uid : string  从session中获得用户id
	 *@param @iid : string  从post中获取图片id
	 *@param @width: string 从post中获取裁剪宽度
	 *@param @height: string 从post中获取裁剪高度
	 *@param @xaxis : string 从post中获取起始点x坐标
	 *@param @yaxit : stinrg 从post中获取起始点y坐标
	 *该接口未经测试
	 */
	public function sewImage() {
		//宏定义文件路径
		define("PREDIR", "/maitian/welfare/Common/Static/resources/");
		
		//从session和post中获取参数
		$uId = session('uid');
		$iId	= I('post.iid');
		
		if(!ajaxCheck($iId)) {
			die();
		}
		
		$width	= I('post.width');
		$height	= I('post.height');
		$xaxis	= I('post.xaxis');
		$yaxis	= I('post.yaxis');
		
		//实例化数据库
		$allImageDB = M('image');
		
		//根据图片id，查询图片路径
		$mid_var5 = $allImageDB->where('iid='.$iId)->getField('imgpath');
		if(!queryCheck($mid_var5)) {
			die();
		} else {
			$imgpath = $mid_var5;
			//根据图片路径，从服务器静态资源中读取图片
			$targetfile = $_SERVER['DOCUMENT_ROOT'].PREDIR.$imgpath;
			$image = new \Think\Image(\Think\Image::IMAGE_GD, $targetfile);
			
			//删除服务器图片
			if (unlink($targetfile) === false) {
				
				$response = array();
				$response['status'] = 0;
				$response['msg'] = '图片删除失败';
				$this->ajaxReturn($response, 'json');
				die();
			} else {
			
				//裁剪图片，并保存回服务器
				$image->crop($width, $height, $xaxis, $yaxis)->save($targetfile);
				
				//返回前端裁剪成功的信息
				$response = array();
				$response['status'] = 1;
				$response['imagepath'] = PREDIR.$imgpath;
				$this->ajaxReturn($response, 'json');
			}
			
		}
	}
	
}