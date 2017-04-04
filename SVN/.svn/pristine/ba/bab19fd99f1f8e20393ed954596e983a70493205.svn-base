<?php
/**
 *Author : 何衡
 *Date: 2014/8/29
 *Function : 实现“用户浏览地点信息页”控制器
 */
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");

class LocationIndexController extends Controller {

	/**
	 *首次访问该网页，调用模板
	 *@param void : void 无参数
	 */
	public function index() {

		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this -> display();
	}

	// /**
	//  *初始化页面，查询省的id和省的名字
	//  *经测试，该接口正常！
	//  *@param $void : void 无参数
	//  */
	// public function initate() {
	// 	//查询所有的省信息
	// 	$provinceEntry = M('site')
	// 		->join('province on province.provinceid = site.provinceid')
	// 		->field('province.provinceid, province.provincename, site.longitude, site.latitude')
	// 		->select();
	// 	var_dump($provinceEntry);
	// 	if ($res === false)
 //    		$this->ajaxReturn(array('status'=>0, 'msg'=>2), 'json');
 //    	else
 //    		$response['status'] = 1;

	// 	//显式地定义后文会用到的，存储信息的变量
	// 	$provinceids = array();
	// 	$provincenames = array();

	// 	//将查询信息添加到相应数组中保存
	// 	while (list($subscript, $entry) = each($provinceEntry)) {
	// 		array_push($provinceids, $entry['provinceid']);
	// 		array_push($provincenames, $entry['provincename']);
	// 	}

	// 	//整合返回信息
	// 	$response['provinceids'] = $provinceids;
	// 	$response['provincenames'] = $provincenames;
		
	// 	//ajax返回处理结果！
	// 	//$this->ajaxReturn($response, 'json');
	// 	var_dump($response);
	// }


	/**
	 *初始化页面，查询省的id和省的名字
	 *经测试，该接口正常！
	 *@param $void : void 无参数
	 */
	public function initate() {
		//查询所有的省信息
		$provinceEntry = M('province')->field('provinceid, provincename')->select();
		if(!queryCheck($provinceEntry)) {
			die();
		}

		//显式地定义后文会用到的，存储信息的变量
		$provinceids = array();
		$provincenames = array();

		//将查询信息添加到相应数组中保存
		while (list($subscript, $entry) = each($provinceEntry)) {
			array_push($provinceids, $entry['provinceid']);
			array_push($provincenames, $entry['provincename']);
		}

		//整合返回信息
		$response['provinceids'] = $provinceids;
		$response['provincenames'] = $provincenames;

		//强制设置返回状态为真	
		$status = 1;
		$response['status'] = $status;
		
		//ajax返回处理结果！
		$this->ajaxReturn($response, 'json');
	}

	/**
	 *根据前端传来的provinceid，查询该省下所有的市
	 *根据前端传来的provinceid，查询该省下所有的学校
	 * 增加了返回数据中增加了经度和纬度！
	 *经测试，该接口正常
	 * @param $void : provinceid 
	 *
	 */
	public function getCity() {

		//根据provinceid查询市信息和学校（地点）信息
		if(!ajaxCheck(I('post.provinceid'))) {
			//die();
		}
		$provinceid = I('post.provinceid');
		$this->_response("province","city",$provinceid);
	}

	/**
	 *根据前端传来的cityid，查询该市下面所有的县
	 *根据前端传来的cityid，查询该市下所有的学校
	 *经测试，该接口工作正常！
	 *@param $void : void 无参数
	 */
	public function getCounty() {
		//从前端获取cityid
		$cityId = I('post.cityid');
		
		if(!ajaxCheck($cityId)) {
			die();
		}
		$this->_response("city","county",$cityId);
	}

	/**
	 *根据前端传来的countyid，查询该县下面所有的镇
	 *根据前端传来的countyid，查询该县下所有的学校
	 *经测试，该接口工作正常!
	 *@param $void : void 无参数
	 */
	public function getTown() {
		//从前端获取countyid
		$countyId = I('post.countyid');
		if(!ajaxCheck($countyId)) {
			die();
		}
		$this->_response("county","town",$countyId);
	}

	/**
	 *根据前端传来的townid，查询该镇下所有的学校
	 *@param $void : void 无参数
	 *经测试，该接口工作正常！
	 */
	public function getSchool() {
		//根据townid查询学校（地点）信息
		
		if(!ajaxCheck(I('post.townid'))) {
			die();
		}
		$townid = I("post.townid");
		$this->_response("town",null,$townid);
	}


	private function _response($chart,$name,$id) {
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");
		//根据省份，获取city的信息
		if($name != null) {
			$Entry = M($name)
				->where($chart."id=".$id)
				->field($name.'id, '.$name.'name')
				->select();

			if(!queryCheck($Entry)) {
				die();
			}
		}
		else {
			$name = 'unvalid';
		}

		$siteEntry = M('site')
			->where($chart.'id='.$id)
			->field('siteid, sitename, longitude, latitude, sitedescrp, sitemainpic')
			->select();

		if(!queryCheck($siteEntry)) {
			die();
        }

		//显式地定义后文会用到的，存储信息的变量
		$response = array($name.'ids'=>array(), $name.'names'=>array(), 'schools'=>array(),
			'schoolids'=>array(), 'schoolurls'=>array(), 'longitude'=>array(), 
			'imgurls'=>array(),'descrps'=>array(),'latitude'=>array());

		//将查询到的市信息添加到相应数组中保存
		while (list($subscript, $cEntry) = each($Entry)) {
			array_push($response[$name.'ids'], $cEntry[$name.'id']);
			array_push($response[$name.'names'], $cEntry[$name.'name']);
		}

		//将查询到的学校信息添加到相应数组保存
		while (list($subscript, $sEntry) = each($siteEntry)) {
			array_push($response['schools'], $sEntry['sitename']);
			array_push($response['schoolids'], $sEntry['siteid']);
			array_push($response['schoolurls'], U('School/index?schoolid='.$sEntry['siteid']));
			array_push($response['longitude'], $sEntry['longitude']);
			array_push($response['latitude'], $sEntry['latitude']);
			array_push($response['descrps'], $sEntry['sitedescrp']);
			$imgurl = M('image')->where("iid='".$sEntry['sitemainpic']."'")->find();
			if($imgurl == null) {
				$consts = require "consts.php";
				$src = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_SITE"];
			}
			else {
				$src = PREDIR.$imgurl['imgpath'];
			}
			array_push($response['imgurls'], $src);
		}
		
        $response['status'] = 1;
		//ajax返回处理结果！
		$this->ajaxReturn($response, 'json');
	}
}
