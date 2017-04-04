<?php
/*
author:��ѧ��
*/
namespace Home\Controller;
require_once "functions.php";
use Think\Controller;
header("Content-Type: text/html; charset=utf-8");
class PhotographController extends Controller {
    public function index() {

		/*�ڵ���֮ǰ�����и�ģ�崫���������Ⱦģ��*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}
	public function initate() {
	}
	/*
	���Գɹ���
	*/
	public function moreAlbum() {
		//����һ��ͼƬ·��ǰ׺��
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

		//�������Ϣ
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