<?php
/*
author:o¨²?¡ì??
*/
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");
class NewFeedbackController extends Controller {
    public function index() {
		$commonURL = "/maitian/welfare/index.php";
		if(!isUser(1)) {
			echo "<script>alert('ÇëÏÈµÇÂ¼!');window.location = '$commonURL/Home/HomePage/index';</script>";
			return;
		}
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}
	public function initate() {
		$aid = I('post.aid');
		$res = array();
		$res['sites'] = M('site')
			->join("targetloc on targetloc.aid = '$aid' and targetloc.siteid = site.siteid")
			->field('siteid','sitename')->select();
		$res['activity'] = M('activity')->where("aid = '$aid'")->find();
		$res['status'] = 1;
		echo json_encode($res);
	}
	public function createFeedBack() {
		$data['relsiteid'] = I('post.relsiteid');
		$data['relaid'] = I('post.relaid');
		$data['fdbckuid'] = I('post.fdbckuid');
		$data['eventdate'] = I('post.eventdate');
		$data['eventdur'] = I('post.eventdur');
		$data['eventleaderuid'] = I('post.eventleaderuid');
		$data['repairstate'] = date('y-m-d h:i:s',time());
		$data['studentnum'] = I('post.studentnum');
		$data['gradenum'] = I('post.gradenum');
		$data['classnum'] = I('post.classnum');
		$data['studentstate'] = I('post.studentstate');
		$data['teacherstate'] = I('post.teacherstate');
		$data['schlibdescrp'] = I('post.schlibdescrp');
		$data['schotherdescrp'] = I('post.schotherdescrp');
		$data['shaonianshestate'] = I('post.shaonianshestate');
		$data['facilitystate'] = I('post.facilitystate');
		$data['teameval'] = I('post.teameval');
		$data['teamsuggest'] = I('post.teamsuggest');
		$mid_var = M("feedback")->data($data)->add();
		if(!queryCheck($mid_var)) {
			die();
		}
		$text['status'] = 1;
		echo json_encode($text);
	}
}