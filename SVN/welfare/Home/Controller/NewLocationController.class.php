<?php
/*
author:ºúÑ§¶«
*/
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");
class NewLocationController extends Controller {
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

	/**
	 *Author: ºÎºâ
	 *ÓÃ»§µã»÷ÉÏ´«Í¼Æ¬ºó£¬½«Í¼Æ¬ÐÅÏ¢Ð´Èëµ½Êý¾Ý£¬²¢½«¶ÔÓ¦ÎÄ¼þ·Åµ½Ö¸¶¨ÓÃ»§Ä¿Â¼
	 *@param @uId : string ¸Ã²ÎÊýÓÉsessionÖÐ»ñµÃ
	 *@param @siteId : string ¸Ã²ÎÊýÓÉ´ÓPOST±äÁ¿ÖÐ»ñµÃ
	 *¾­²âÊÔ£¬¸Ã½Ó¿Ú¹¤×÷Õý³£
	 */
	public function uploadImage() {
		
		//ºê¶¨ÒåÍ·ÏñÀàÐÍ£¡
		define('ICON', 1);

		//¶¨ÒåÐèÒªÓÃµÄÊý¾Ý¿â
		$allImageDB		= M('image');
		$allUserDB 		= M('user');
		$allSiteDB		= M('site');

		//´ÓÇ°¶Ë»ñÈ¡ÓÃ»§id
		$uId		= session('uid');
		$siteId 	= I('post.siteid');

		//¶¨ÒåÓÃ»§ÉÏ´«Í¼Æ¬µÄÄ¿±êÎÄ¼þ¼Ð
		$userName = $allUserDB->where('uid='.$uId)->getField('uname');
		if(!queryCheck($userName)) {
			die();
		}
		$targetFolder = C('STATIC_RESOURCE').'/resources/'.$userName.'/';
		mkdir("Common/Static/resources/".$userName);
		if (!empty($_FILES)) {
			//ÔÚ·þÎñÆ÷¸ùÄ¿Â¼ÏÂÖ¸¶¨ÎÄ¼þÉÏ´«µÄÂ·¾¶
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].$targetFolder;

			//ÀûÓÃºÁÃë¼¶±ðµÄÊ±¼äÖØÃüÃûÉÏ´«µÄÎÄ¼þ
			//ÇÐ¸îµô microtime()º¯Êý·µ»ØÊý¾Ý¸ñÊ½ 0.25139300 1138197510ÖÐµÄµã
			$nodot = explode(".", microtime());
			$namestr = str_replace(' ', '', $nodot[1]);
			$uptype = explode(".", $_FILES["Filedata"]["name"]);
			$newname = $namestr.".".$uptype[1];
			$_FILES["Filedata"]["name"] = $newname;

			//¶¨Î»Ä¿±êÎÄ¼þwelfare/Common/Static/resources/$userName/xxxxx.jpg
			$targetFile = $targetPath.'/'.$_FILES['Filedata']['name'];

			//ÑéÖ¤ÎÄ¼þºó×ºÃûÊÇ·ñÊÇ¹æ¶¨µÄÀàÐÍ
			$fileTypes = array('jpg', 'jpeg', 'pjpeg', 'gif', 'png');
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			//½«Í¼Æ¬¼°Æä¹ØÁªÐÅÏ¢Ð´Èëµ½Êý¾Ý¿â
			if (in_array($fileParts['extension'],$fileTypes)) {

				//¹¹ÔìÐèÒªÐ´ÈëÊý¾Ý¿âµÄÍ¼Æ¬ÐÅÏ¢
				$dataForImg['uid'] = $uId;
				$dataForImg['imgpath'] = $userName.'/'.$_FILES["Filedata"]["name"];
				$dataForImg['imgdt'] = date('Y-m-d H:i:s', time());
				$dataForImg['albumid'] = null;
				$dataForImg['imgtype'] = ICON;
				
				//½«Í¼Æ¬ÐÅÏ¢²åÈëµ½Êý¾Ý¿â£¬Ê§°ÜÔòÉèÖÃ²Ù×÷Òì³£
				$iid = $allImageDB->data($dataForImg)->add();
				if (!queryCheck($iid)) {
					die();
				} else {

					//¸üÐÂÓÃ»§Êý¾Ý¿â
					$allSiteDB->sitemainpic = $iid;
					$allSiteDB->where('siteid='.$siteId)->save();
					
					//Ð´Êý¾Ý¿â³É¹¦£¬½²Í¼Æ¬¿½±´µ½Ö¸¶¨Ä¿Â¼ÏÂ
					move_uploaded_file($tempFile, $targetFile);

							
					$tmpImage = new \Think\Image(\Think\Image::IMAGE_GD, $targetFile);
					$response = array();
					$response['iid'] = $iid;
					$response['imgpath'] = $targetFolder.'/'.$_FILES['Filedata']['name'];
					$response['status'] = 1;
					
					$this->ajaxReturn($response, 'json');
					
				}
			} else {
				$response = array();
				$response['status'] = 0;
				$response['msg'] = 'Invalid file type.';
			}
		}
	}
	public function saveLocation() {
	    
	    $text = array();
        $townid = I('post.townid');
		
		if(!ajaxCheck($townid)) {
			die();
		}
		
		$cityid = I('post.cityid');
		$provinceid = I('post.provinceid');
		$countyid = I('post.countyid');
		$descrp = I('post.description');
		$village = I('post.village');
		$sitename = I('post.school');
		$sponsor = I('post.sponsor');
		//µØµãÍ¼Æ¬
		//$iid = I('post.iid');
				
		$Site = M('site');
		$data['sitename'] = $sitename;
		$data['sitedetailaddr'] = $village;
		$data['creatoruid'] = session('uid');
		$data['createdt'] = date('y-m-d H:i:s');
		$data['lastmduid'] = session('uid');
		$data['lastmddt'] = date('y-m-d H:i:s');
		$data['sitedescrp'] = $descrp;
		//$data['sitemainpic'] = $iid;
		$data['townid'] = $townid;
		$data['countyid'] = $countyid;
		$data['provinceid'] = $provinceid;
		$data['cityid'] = $cityid;
		
		$mid_var1 = $Site->data($data)->add();
		if(!queryCheck($mid_var1)) {
			die();
		}
		//ÐÂÔöÒ»¸ö×Ö¶Î£¬siteid
		$text['siteid'] = $mid_var1;
		$text["status"] = 1;
		
		echo json_encode($text);
	}
}