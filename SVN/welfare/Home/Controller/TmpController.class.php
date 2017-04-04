<?php
namespace Home\Controller;
use Think\Controller;
require_once "User.php";
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");

class TmpController extends Controller {
	
	/**
	 *调用模板
	 *无参数
	 */
	public function index() {
		$this->display();
	}
	
	/**
	 *用户点击获得地点时，用于返回该活动对应的地点
	 *@param @acid : string 该参数有前端post信息中获得
	 *@param @uid : string 该参数有session中获得
	 *经测试，该接口工作正常
	 */
	public function getLocation() {
		//从post和session中获得参数
		$aid = I('post.acid');
		$uid = session('uid');

		//实例化需要查询的数据库
		$allTargetLocDB = M('targetloc');
		$allSiteDB = M('site');

		//从数据库查询地点id和地点名字
		$siteNames = array();

		//针对对应数据库数据库进行查询
		if (!($siteIds = $allTargetLocDB->where('aid='.$aid )->getField('siteid', true))) {
			$response['status'] = 0;
			$response['msg'] = "数据库查询失败或数据库为空";
			$this->ajaxReturn($response, 'ajax');
			die();
		}

		while (list($subScipty, $siteid) = each($siteIds)) {
			array_push($siteNames, $allSiteDB->where('siteid='.$siteid)->getField('sitename'));
		}

		//封装返回的数据
		$response['siteid'] = $siteIds;
		$response['sitename'] = $siteNames;
		$response['status'] = 1;

		//ajax返回
		$this->ajaxReturn($response, 'json');
	}

	/**
	 *用户点击获得相册时，用于返回用户在该活动下创建的相册名
	 *@param @acid : string 该参数有前端post信息中获得
	 *@param @uid : string 该参数有session中获得
	 *经测试，该接口工作正常
	 */
	public function getAlbum() {
		//从post和session中获得参数
		$aid = I('post.acid');
		$uid = session('uid');
		
		//实例化需要用到的数据库
		$allAlbumDB = M('album');
		
		//针对对应数据库进行查询
		if (!($albumInfo = $allAlbumDB->where('uid = '.$uid." and relaid=".$aid)->field('albumid, albumname')->select())) {
			$response['status'] = 0;
			$response['msg'] = "数据库查询失败或数据库为空";
			$this->ajaxReturn($response, 'ajax');
			die();
		}
		
		//定义需要返回的数据
		$albumids = array();
		$albumnames = array();
		
		while(list($subScript, $entry) = each($albumInfo)) {
			array_push($albumids, $entry['albumid']);
			array_push($albumnames, $entry['albumname']);
		}
		
		//封装返回数据
		$response = array();
		$response['albumid'] = $albumids;
		$response['albumname'] = $albumnames;
		$response['status'] = 1;
		
		//ajax返回
		$this->ajaxReturn($response, 'json');
	}
	
	/**
	 *用户点击新建相册，用于执行用户新建相册的请求
	 *@param @acid : string 从前端post请求中获得
	 *@param @uid : string  从session中获得
	 *@param @siteid : string 从前端post请求中获得
	 *@param @albumname : string 从前端post请求中获得
	 *@param @description : string 从前端post请求中获得
	 *该接口还有遗留着一个写入中文时，数据库存在乱码问题！
	 */
	public function addAlbum() {
		
		//从前端和session中取出用户id
		$uId	= session('uid');
		$acId	= I('post.acid');
		$siteId = I('post.siteid');
		$album	= I('post.albumname');
		$descr	= I('post.description');
		/*$acId = 1;
		$siteId = 1;
		$album = "摩的大镖客";
		$descr = "这是一胡好查";*/
		
		//实例化需要用的数据库
		$allAlbumDB = M('album');
		
		//构造写入数据库的数据
		$data['uid']		= $uId;
		$data['createdt']	= date("Y-m-d H:i:s", time());
		$data['albumname']	= $album;
		$data['albumdescrp']= $descr;
		$data['relaid']		= $acId;
		$data['relsiteid']	= $siteId;
		
		//写入数据库！
		if (!($allAlbumDB->data($data)->add())) {
			$response = array();
			$response['status'] = 0;
			$response['msg'] = '新建相册失败！';
			$this->ajaxReturn($response, 'json');
			die();
		}
		
		//封装返回数据！
		$response = array();
		$response['status'] = 1;
		
		//ajax返回数据
		$this->ajaxReturn($response, 'json');
		
	}

	/**
	 *用户点击上传图片后，将图片信息写入到数据，并将对应文件放到指定用户目录
	 *@param @uId : string 该参数由session中获得
	 *@param @acid : string 该参数由前端post信息传递过来
	 *@param @siteid : string 该参数由前端post信息传递过来
	 *@param @albumid : string 该参数由前端post信息传递过来
	 *经测试，该接口工作正常
	 */
	public function upload() {
		
		//宏定义头像类型！
		define('ICON', 1);
		
		//定义需要用的数据库
		$allImageDB		= M('image');
		$allUserDB 		= M('user');
		$allSiteRelImgDB = M('siterelimg');
		$allActRelImgDB = M('actrelimg');
		
		//从前端获取用户id、活动id、地点id和相册id
		$uId		= session('uid');
		$acId		= I('post.acid');
		$siteId 	= I('post.siteid');
		$albumId	= I('post.albumid');

		//定义用户上传图片的目标文件夹
		$userName = $allUserDB->where('uid='.$uId)->getField('uname');
		$targetFolder = '/welfare/Common/Static/resources/'.$userName.'/';

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
			$targetFile = $targetPath.$_FILES['Filedata']['name'];

			//验证文件后缀名是否是规定的类型
			$fileTypes = array('jpg', 'jpeg', 'pjpeg', 'gif', 'png');
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			//将图片及其关联信息写入到数据库
			if (in_array($fileParts['extension'],$fileTypes)) {
				
				//构造需要写入数据库的图片信息
				$dataForImg['uid'] = $uId;
				$dataForImg['imgpath'] = $userName.'/'.$_FILES["Filedata"]["name"];
				$dataForImg['imgdt'] = date('Y-m-d H:i:s', time());
				$dataForImg['albumid'] = $albumId;
				$dataForImg['imgtype'] = ICON;
				
				//将图片信息插入到数据库，失败则设置操作异常
				if (!($allImageDB->data($dataForImg)->add())) {
					die();
				} else {
					
					//刷新数据库，查询刚刚出入数据库的图片数据
					$allImageDB		= M('image');
					$iid = $allImageDB->where($dataForImg)->getField('iid');

					//构造需要写入数据库的图片和活动关联的信息
					$dataForAct['actrelimgid'] = $iid;
					$dataForAct['aid'] = $uId;

					//将图片和活动关联信息写入数据库，失败则设置操作异常
					if (!($allActRelImgDB->data($dataForAct)->add())) {
						
						//删除先前写入数据库的图片信息！失败则设置操作异常
						if (!($allImageDB->where($dataForImg)->delete())) {
							die();
						}

						die();
					} else {

						//刷新数据库
						$allImageDB		= M('image');
						$allActRelImgDB = M('actrelimg');

						//构造需要写入数据库的图片和地点关联的信息
						$dataForSite['siterelimgid'] = $iid;
						$dataForSite['siteid'] = $siteId;

						//将图片和地点关联的信息写入数据库，失败则设置操作异常
						if (!($allSiteRelImgDB->data($dataForSite)->add())) {
							
							//删除先前写入数据库的图片信息！失败则设置操作异常
							if (!($allImageDB->where($dataForImg)->delete())) {
								die();
							}
							
							//删除先前写入数据库的图片和活动的关联信息！失败则设置操作异常
							if (!($allActRelImgDB->where($dataForAct)->delete())) {
								die();
							}

							die();
						} else {
							//写数据库成功，讲图片拷贝到指定目录下
							move_uploaded_file($tempFile,$targetFile);
							echo '1';
						}
					}
				}
			} else {
				echo 'Invalid file type.';
			}
		}
	}

	/**
	 *控制器私有工具函数，后台异常时，向前端返回异常信息
	 *@param $error : $string用于设置错误提示信息msg
	 *经测试，该函数工作正常
	 */
	private function setException($error) {
		$response = array();
		$response['status'] = 0;
		$response['msg'] = $error;
		$this-ajaxReturn($response, 'ajax');
	}

	/**
	 *控制器私有工具函数，用于后台调试时写入日志
	 *@param $record : $string用于设置错误提示信息msg
	 *经测试，该函数工作正常
	 */
	private function myLog($record) {
        $handle = fopen("log.txt", 'a');
        fwrite($handle, $record);
        fwrite($handle, "\n");
        fclose($handle);
    }
}