<?php
/*
author:ºúÑ§¶«
*/
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");
class NewActivityController extends Controller {
    public function index() {
		$commonURL = "/maitian/welfare/index.php";
		if(!isUser(1)) {
			echo "<script>alert('请先登录!');window.location = '$commonURL/Home/HomePage/index';</script>";
			return;
		}
		/*ÔÚµ÷ÓÃÖ®Ç°£¬ÏÖÐÐ¸øÄ£°å´«Èë²ÎÊý£¡äÖÈ¾Ä£°å*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}
	public function initate() {
	    $data = array();
	    $ActivityType = M("activitytype");
		$content = $ActivityType->select();
		
		if(!queryCheck($content)) {
			die();
		}
		$data['status'] = 1;
		$data["activitytypeids"] = array();
		$data["activitytypenames"] = array();
		foreach($content as $province) {
			array_push($data["activitytypeids"],$province["atypeid"]);
			array_push($data["activitytypenames"],$province["atypename"]);
		}
		echo json_encode($data);
	}
	public function getProvince() {
	    $data = array();

		//¶ÁÈ¡ÊÐµÄidºÍÃû³Æ
		$Province = M("province");
		$content = $Province->select();
		
		if(!queryCheck($content)) {
			die();
		}
		
		$data['status'] = 1;
		$data["provinceids"] = array();
		$data["provincenames"] = array();
		foreach($content as $city) {
			array_push($data["provinceids"],$city["provinceid"]);
			array_push($data["provincenames"],$city["provincename"]);
		}
		echo json_encode($data);
	}
    public function getCity() {
	    $provinceid = I("post.provinceid");
		
		if(!ajaxCheck($provinceid)) {
			die();
		}
		
	    $data = array();

		//¶ÁÈ¡ÊÐµÄidºÍÃû³Æ
		$City = M("city");
		$content = $City->where("provinceid = '$provinceid'")->select();
		
		if(!queryCheck($content)) {
			die();
		}
		$data['status'] = 1;
		$data["cityids"] = array();
		$data["citienames"] = array();
		foreach($content as $city) {
			array_push($data["cityids"],$city["cityid"]);
			array_push($data["citienames"],$city["cityname"]);
		}
		echo json_encode($data);
	}
	
	public function getCounty() {
	    $cityid = I("post.cityid");
		
		if(!ajaxCheck($cityid)) {
			die();
		}
		
	    $data = array();
		
		//¶ÁÈ¡ÏØµÄidºÍÃû³Æ
		$County = M("county");
		$content = $County->where("cityid = '$cityid'")->select();
		
		if(!queryCheck($content)) {
			die();
		}
		$data['status'] = 1;
		$data["countyids"] = array();
		$data["countynames"] = array();
		foreach($content as $county) {
			array_push($data["countyids"],$county["countyid"]);
			array_push($data["countynames"],$county["countyname"]);
		}
		echo json_encode($data);
	}
	
	public function getTown() {
	    $countyid = I("post.countyid");
		
		if(!ajaxCheck($countyid)) {
			die();
		}
		
	    $data = array();
		
		//¶ÁÈ¡ÏçÕòµÄidºÍÃû³Æ
		$Town = M("town");
		$content = $Town->where("countyid = '$countyid'")->select();
		
		if(!queryCheck($content)) {
			die();
		}
		$data['status'] = 1;
		$data["townids"] = array();
		$data["townnames"] = array();
		foreach($content as $town) {
			array_push($data["townids"],$town["townid"]);
			array_push($data["townnames"],$town["townname"]);
		}
		echo json_encode($data);
	}
	public function getSite() {
	    $townid = I("post.townid");
		
		if(!ajaxCheck($townid)) {
			die();
		}
		
	    $data = array();
		
		//¶ÁÈ¡ÏçÕòµÄidºÍÃû³Æ
		$Site = M("site");
		$content = $Site->where("townid = '$townid'")->select();
		
		if(!queryCheck($content)) {
			die();
		}
		$data['status'] = 1;
		$data["siteids"] = array();
		$data["sitenames"] = array();
		foreach($content as $town) {
			array_push($data["siteids"],$town["siteid"]);
			array_push($data["sitenames"],$town["sitename"]);
		}
		echo json_encode($data);
	}
	public function saveActivity() {
		$Activity = M("activity");
	    $text = array();
		$activitytypeid = I("post.activitytypeid");
		
		if(!ajaxCheck($activitytypeid)) {
			die();
		}
		
		$sponsorids = I("post.sponsorids");
		//$sponsorids = '{&quot;sponsorids&quot;:[]}';

		$sponsorids = str_replace("&quot;", "\"", $sponsorids);
		$siteids = I("post.siteids");
		//$siteids = '{&quot;siteids&quot;:[9]}';
		$siteids = str_replace("&quot;", "\"", $siteids);
		$title = I("post.title");
		$startdate = I("post.startdate");
		$enddate = I("post.enddate");
		$description = I("post.description");
		$population = I("post.population");
		
		$sponsorids = json_decode($sponsorids);
		$siteids = json_decode($siteids);
		$data['aname'] = $title;
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		$data['adescrp'] = $description;
		$data['limitnum'] = $population;
		$data['avail'] = 0;
		$data['atype'] = $activitytypeid;
		$data['creatoruid'] = session('uid');
		
		$aid = $Activity->data($data)->add();
		if(!queryCheck($aid)) {
			die();
		}
		$data = array();
		foreach($sponsorids->sponsorids as $sponsorid) {
		    $data['aid'] = $aid;
			$data['sponsorid'] = $sponsorid;
			$Sponsor = M("sponsor");
			$mid_var1 = $Sponsor->data($data)->add();
			if(!queryCheck($mid_var1)) {
				die();
			}
		}
		$data = array();
		foreach($siteids->siteids as $siteid) {
			$data['aid'] = $aid;
			$data['siteid'] = $siteid;
			$targetLoc = M("targetloc");
			$mid_var2 = $targetLoc->data($data)->add();
			if(!queryCheck($mid_var2)) {
				die();
			}
		}
		$text["status"] = 1;
		echo json_encode($text);
	}
}