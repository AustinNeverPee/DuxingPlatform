<?php
/*
author:胡学东
*/
namespace Home\Controller;
require_once "functions.php";
use Think\Controller;
header("Content-Type: text/html; charset=utf-8");
class HistoryblogController extends Controller {
    public function index() {
	
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}

	public function initate() {
		$response['status'] = 1;
		$this->ajaxReturn($response, 'json');
	}
	
	/*public function ajax1() {
	    $data = array();
	    $blogid = I("post.blogid");
		
		//读取博客信息
		$Blog = M('blog');
		$content = $Blog->where("blogid = '$blogid'")->find();
		$data['title'] = $content['blogtitle'];
		$data['content'] = $content['blogcontent'];
		$bloguid = $content['bloguid'];
		
		//读取博客主信息
		$User = M('user');
		$content = $User->where("uid = '$bloguid'")->find();
		$data['owner'] = $content['nickname'] = ""?$content['uname']:$content['nickname'];
		
		//读取图片集信息
		$BlogRelImg = M('blogrelimg');		
		$blogImgids = $BlogRelImg->where("blogid = '$blogid'")->getField('iid',true);
		$data['blogImageSrcs'] = array();
		$Image = M('image');
		foreach($blogImgids as $iid) {
		    $ipath = $Image->where("iid = '$iid'")->getField('ipath');
		    array_push($data['blogImageSrcs'],$ipath);
		}
		echo json_encode($data);
	}*/
	
	/*
	测试成功！
	*/
	public function moreBlog() {
	
		//定义一个图片路径前缀！
		define("LENGTH", 20);
		define("NORMAL", 1);
		define("ERROR", 0);
		define("PREDIR", "/welfare/Common/Static/resources/");

		$data = array();
		$data['status'] = NORMAL;
		$currentPage = I("post.currentpage") + NORMAL;
		$siteid = I("post.schoolid");
		
		if(!ajaxCheck($siteid)) {
			die();
		}

        $data["flag"] = $currentPage;
		//得到和这个地点关联的所有博客的id
		$BlogRelSite = M("blogrelsite");
		$blogids = $BlogRelSite->where("siteid = '$siteid'")->page($currentPage, LENGTH)->getField('blogid',true);
		if(!queryCheck($blogids)) {
			die();
		}
		$Blog = M('blog');
		$User = M('user');
		$Image = M('image');

		$data["contents"] = array();
		$data["title"] = array();
		$data["ownernames"] = array();
		$data["ownerids"] = array();
		$data['imagesrcs'] = array();
		$data["blogids"] = $blogids;
		foreach($blogids as $blogid) {
		    $content = $Blog->where("blogid = '$blogid'")->find();
			if(!queryCheck($content)) {
				die();
			}
			array_push($data["contents"], $content["blogcontent"]);
			array_push($data["title"], $content["blogtitle"]);
			$userInfo = $User->where('uid='.$content["bloguid"])->find();
			if(!queryCheck($userInfo)) {
				die();
			}
			$imageSrc = $Image->where('iid='.$userInfo['uicon'])->getField('imgpath');
			if(!queryCheck($imageSrc)) {
				die();
			}
			array_push($data["ownernames"], $userInfo['uname']);
			array_push($data["ownerids"], $content["bloguid"]);
			array_push($data['imagesrcs'], PREDIR.$imageSrc);
			array_push($data['blogurl']),U('PersonalBlog/blogindex?blogid='.$content['blogid']));
		}
		
		echo json_encode($data);
	}
}