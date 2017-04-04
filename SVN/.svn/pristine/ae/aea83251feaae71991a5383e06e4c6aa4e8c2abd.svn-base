<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html; charset=utf-8");

class AdminController extends Controller {
	public function index() {
		$this->display();
	}
	public function removeAll() {
		$chart = ["actfdbcktype","actfollower","activity","activitytype","actrelcmnt","actrelimg","album","blog","blogrelcmnt","blogrelimg",
		"blogrelsite","city","comment","county","feedback","feedbacktype","follower","image","imagetype","imgrelcmnt","member","message",
		"organization","participant","province","report","site","sitefollower","siterelcmnt","siterelimg","sponsor","targetloc","town","user",
		"user","usergroup","userverify"];
		for($i = 0; $i < count($chart); $i++)
			M($chart[$i])->where("1")->delete();
		$text['status'] = 1;
		echo json_encode($text);
	}
	public function addBase() {
		//添加固定地点信息
		$this->_setlocation(null,"province");
		$this->_setlocation("province","city");
		$this->_setlocation("city","county");
		$this->_setlocation("county","town");

		//添加一个用户信息
		$data = array('uname' => 'huxd' ,'password' => md5("123456"), 'emailaddr'=>'907756752@qq.com','sex'=> -1,'ugid'=>1);
		M('user')->data($data)->add();

		//添加活动类别
		$data = array();
		$data[] = array('atypename' => '游玩');
		$data[] = array('atypename' => '野炊');
		M('activitytype')->addAll($data);

		$text['status'] = 1;
		echo json_encode($text);
	}
	private function _setlocation($chart,$name) {
		$ids = M($chart)->getField($chart.'id',true);
		$map = array('province' => '省','city' => '市','county' => '县','town' => '镇');
		$suffix = 1;
		foreach ($ids as $id) {			
			for($i = 0; $i < 3; $i++) {
				$data = array($name.'name' => $map[$name].$suffix);
				$data[$chart.'id'] = $id;
				M($name)->data($data)->add();
				$suffix++;
			}
		}
		if($chart == null) {
			for($i = 0; $i < 3; $i++) {
				$data = array($name.'name' => $map[$name].$suffix);
				$data[$name.'id'] = $id;
				M($name)->data($data)->add();
				$suffix++;
			}
		}
	}
}