<?php
  /*活动报名
   *作者：胡国治
   *时间：2014-9-1
   @param session('uid')
  */
header("Content-Type: text/html; charset=utf-8");
class SignUpController extends Controller{
	public function index(){
		if(isset(session('uid'))) {
			$par = M('Participant');
			$uid = session('uid');
			$data['partcpuid'] = $uid;
			$data['aid'] = $aid;
			$par->filter('strip_tags')->add();
		}
	}
}
?>