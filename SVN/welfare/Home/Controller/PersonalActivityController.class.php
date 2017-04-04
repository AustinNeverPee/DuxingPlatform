<?php
/*
author:胡学东
*/
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");
class PersonalActivityController extends Controller {
    public function index() {
	
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}
	public function initate() {
	}
	public function moreActivity() {
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");
        define("LENGTH", 20);
		
	    $data = array();
		$currentpage = I("post.currentpage");
		
		if(!ajaxCheck($currentpage)) {
			die();
		}
		
		$Activity = M("activity");
		
		//用户的uid保存在了session中
		$uid = session("uid");
		
		//找出用户创建的所有活动
		$content = $Activity->where("creatoruid = '$uid'")->select();
		if(!queryCheck($content)) {
			die();
		}
		
		//找出用户参与的所有活动
		$Participant = M("participant");
		$aids = $Participant->where("partcpuid = '$uid'")->getField('aid',true);
		if(!queryCheck($aids)) {
			die();
		}
		foreach($aids as $aid) {
		    $mid = 0;
		    $text = $Activity->where("aid = '$aid'")->find();
			if(!queryCheck($text)) {
				die();
			}
			$num = count($content);
			foreach($content as $act) {
			    if($act['aid'] == $text['aid']) {
				    $mid = 1;
				}
			}
			if($mid == 0)
		        array_push($content,$text);
		}
		
		//找出用户组织的所有活动
		$Sponsor = M("sponsor");
		$aids = $Sponsor->where("sponsoruid = '$uid'")->getField('aid',true);
		if(!queryCheck($aids)) {
			die();
		}
		foreach($aids as $aid) {
		    $mid = 0;
		    $text = $Activity->where("aid = '$aid'")->find();
			if(!queryCheck($text)) {
				die();
			}
		    $num = count($content);
			foreach($content as $act) {
			    if($act['aid'] == $text['aid']) {
				    $mid = 1;
				}
			}
			if($mid == 0)
		        array_push($content,$text);
		}

		//分页
		$data["acids"] = array();
        $data["acurls"] = array();
		$data["imagesrcs"] = array();
		$data["description"] = array();
		$num  = count($content) > $currentpage * 10 + 10?$currentpage * 10 +10:count($content);
		for($i = ($currentpage - 1) * 10;$i < $num;$i++) {
            if ($content[$i]["aid"]) {
                array_push($data["acids"],$content[$i]["aid"]);
                $acurl = U("ActivityDisplay/index?acid=" . $content[$i]["aid"]);
                array_push($data["acurls"], $acurl);
                //array_push($data["imagesrcs"],$content[$i]["apostimg"]);

                $imgurl = M('image')->where('iid=' . $content[$i]["apostimg"])->getField('imgpath');
                if ($imgurl == null) {
                    $consts = require "consts.php";
                    array_push($data["imagesrcs"], $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_ACTIVITY"]);
                } else {
                    array_push($data["imagesrcs"], PREDIR . $imgurl);
                }

                array_push($data["description"],$content[$i]["adescrp"]);
            }
		}
		$data['status'] = 1;

		echo json_encode($data);
	}
}
