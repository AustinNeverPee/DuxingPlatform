<?php
/*
author:胡学东
*/
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");
class ActivityController extends Controller {
    public function index() {		
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}
    
	public function initate() {
	    $data = array();
	    $Province = M("province");
		
		$content = $Province->select();
		if(!queryCheck($content)) {
			die();
		}
		
		$data['status'] = 1;
		$data["provinceids"] = array();
		$data["provincenames"] = array();
		foreach($content as $province) {
			array_push($data["provinceids"],$province["provinceid"]);
			array_push($data["provincenames"],$province["provincename"]);
		}
		echo json_encode($data);
	}

    public function getCity() {	
	    $provinceid = I("post.provinceid");
	    $this->_response("city","province",$provinceid);
	}

	public function getCounty() {
	    $cityid = I("post.cityid");
	    $this->_response("county","city",$cityid);
	}

	public function getTown() {	
	    $countyid = I("post.countyid");
	   	$this->_response("town","county",$countyid);
	}
	
	public function getActivity() {	
	    $townid = I("post.townid");
	    $this->_response(null,"town",$townid);
	}

	public function _response($sheet,$name,$id) {
		//定义一个图片路径前缀！
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");
		$data = array();
		$data['status'] = 1;
		if($sheet != null) {
			$content = M($sheet)->where($name."id = '$id'")->select();
			if(!queryCheck($content)) {
				die();
			}
			$data[$sheet."ids"] = array();
			$data[$sheet."names"] = array();
			foreach($content as $town) {
				array_push($data[$sheet."ids"],$town[$sheet."id"]);
				array_push($data[$sheet."names"],$town[$sheet."name"]);
			}
		}
		if(!ajaxCheck($id)) {
			die();
		}
		//读取活动id和名称
		$Activity = M("activity");
		$data["activityids"] = array();
		$data["activityurls"] = array();
		$data["activitynames"] = array();
		$data["imagesrcs"] = array();
		$aids = M("site")
				->join("targetloc on site.siteid = targetloc.siteid and site.".$name."id = '$id'")->getField("aid",true);
		if(!queryCheck($aids)) {
			die();
		}
		$map = array();
		foreach($aids as $aid) {	
			if(!$map[$aid]) {
			    $content = $Activity->where('aid='.$aid)->select();
				if(!queryCheck($content)) {
					die();
				}
				foreach($content as $activity) {
					array_push($data["activityids"],$activity["aid"]);
					array_push($data["activityurls"],U('ActivityDisplay/index?acid='.$activity["aid"]));
					array_push($data["activitynames"],$activity["aname"]);
					$goalImage =  M("image")->where("iid='".$activity['apostimg']."'") ->find();
					if(!queryCheck($goalImage)) {
						die();
					}
					if($goalImage == null) {
						$consts = require "consts.php";
						$src = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_ACTIVITY"];
					}
					else {
						$src = PREDIR.$goalImage['imgpath'];
					}
					array_push($data["imagesrcs"], $src);
				}
				$map[$aid] = true;
			}
		}
		echo json_encode($data);
	}
}