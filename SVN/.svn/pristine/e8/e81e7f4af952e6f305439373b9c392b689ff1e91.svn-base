<?php
/*
author:胡学东
*/
namespace Home\Controller;
require_once "functions.php";
use Think\Controller;
header("Content-Type: text/html; charset=utf-8");
class PhotographController extends Controller {
    public function index() {

		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}
	public function initate() {
	}
	/*
	测试成功！
	*/
	public function moreAlbum() {
		//定义一个图片路径前缀！
		define("LENGTH", 3);
		define("NORMAL", 1);
		define("ERROR", 0);
		define("PREDIR", "/welfare/Common/Static/resources/");
		
	    $data = array();
		
		$siteid = I('post.schoolid');
		
		if(!ajaxCheck($siteid)) {
			die();
		}
		
		$currentpage = I('post.currentpage') + NORMAL;

		//读相册信息
		$Album = M("album");
		$Image = M("image");
		$data['status'] = NORMAL;
		$content = $Album->where("relsiteid = '$siteid'")->page($currentpage, LENGTH)->select();
		if(!queryCheck($content)) {
			die();
		}
		//var_dump($content);
		$data["albumnames"] = array();
		$data["uploadtimes"] = array();
		$data["imagesrcs"] = array();
		$i = ERROR;
		foreach($content as $album) {
		    array_push($data["albumnames"],$album["albumname"]);
			array_push($data["uploadtimes"],$album["createdt"]);
			$albumid = $album["albumid"];
			$tmpSrcs = $Image->where("albumid = '$albumid'")->getField('imgpath',true);
			if(!queryCheck($tmpSrcs)) {
				die();
			} else {
				$tmpSrcArray = array();
				foreach ($tmpSrcs as $entry) {
					array_push($tmpSrcArray, PREDIR.$entry);
				}
				$data["imagesrcs"][$i] = $tmpSrcArray;
			}
			$i++;
		}

		echo json_encode($data);
	}
}