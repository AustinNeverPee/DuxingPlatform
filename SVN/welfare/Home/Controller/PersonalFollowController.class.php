<?php
/**
 *Author: 胡学东
 */
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");

class PersonalFollowController extends Controller {
	
	public function index() {
	
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}
	
	public function initate() {
	
		//定义一个图片路径前缀！
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");

		$uid = session("uid");

		//关注的用户
		$Follower = M("follower");
		$data = $Follower->where("followuid = '$uid'")->getField("uid",true);
		if(!queryCheck($data)) {
			die();
		}
		$text = array();
		$text['userids'] = array();
		$text['usernames'] = array();
		$text['usersrcs'] = array();
		foreach($data as $userid) {
		    $User = M("user");
			$content = $User->where("uid = '$userid'")->find();
			if(!queryCheck($content)) {
				die();
			}
			array_push($text['userids'],$content['uid']);
			array_push($text['usernames'],$content['uname']);
			
			$Image = M("image");
			$iid = $content['uicon'];
			$mid_var1 = $Image->where("iid = '$iid'")->getField("imgpath");
			array_push($text['usersrcs'], PREDIR.$mid_var1);
			if(!queryCheck($mid_var1)) {
				die();
			}
		}
		
		//关注的地点
		$SiteFollower = M("sitefollower");
		$data = $SiteFollower->where("sitefollowuid = '$uid'")->getField("siteid",true);
		if(!queryCheck($data)) {
			die();
		}
		$text['siteids'] = array();
		$text['sitenames'] = array();
		$text['sitesrcs'] = array();
		foreach($data as $siteid) {
			$Site = M("site");
			$content = $Site->where("siteid = '$siteid'")->find();
			if(!queryCheck($content)) {
				die();
			}
			
			array_push($text['siteids'],$content['siteid']);
			array_push($text['sitenames'],$content['sitename']);
			
			$Image = M("image");
			$iid = $content['sitemainpic'];
			$mid_var2 = $Image->where("iid = '$iid'")->getField("imgpath");
			array_push($text['sitesrcs'], PREDIR.$mid_var2);
			if(!queryCheck($mid_var2)) {
				die();
			}
		}
		
		//关注的活动
		$ActFollower = M("actfollower");
		$data = $ActFollower->where("actfollowuid = '$uid'")->getField("aid",true);
		if(!queryCheck($data)) {
			die();
		}
		$text['activityids'] = array();
		$text['activitynames'] = array();
		$text['activitysrcs'] = array();
		foreach($data as $aid) {
			$Activity = M("activity");
			$content = $Activity->where("aid = '$aid'")->find();
			if(!queryCheck($content)) {
				die();
			}
			
			array_push($text['activityids'],$content['aid']);
			array_push($text['activitynames'],$content['aname']);
			
			$Image = M("image");
			$iid = $content['apostimg'];
			$mid_var3 = $Image->where("iid = '$iid'")->getField("imgpath");
			array_push($text['activitysrcs'], PREDIR.$mid_var3);
			if(!queryCheck($mid_var3)) {
				die();
			}
		}
		
		$text['status'] = 1;
		echo json_encode($text);
	}
}