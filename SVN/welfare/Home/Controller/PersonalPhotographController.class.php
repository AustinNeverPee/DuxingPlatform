<?php
/**
 *Author: 何衡
 *Date: 2014/8/30
 *Function: 实现“学校页”控制器
 */
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");

class PersonalPhotographController extends Controller {
	/**
	 *用户第一次请求该页面时调用模板
	 *@param @void : void 无参数
	 */
	public function index() {

		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}

	/**
	 *文档加载完毕之后，调用该函数初始化页面
	 *@param @void : void 无参数
	 */
	public function initate() {
		$response['status'] = '1';
		$this->ajaxReturn($response, "json");
	}

	/**
	 *响应前端发出“更多相册”的请求
	 *@param @uid : string 用户唯一标识符uid
	 *@param @currentpage : string 用于控制分页的当前页变量
	 *经测试，该接口工作正常！
	 */
	public function moreAlbum() {
		//定义默认的数据项长度为3和图片路径前缀
		define("PAGELENGTH", 3);
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");
		
		//第一步，从session信息中获取变量uid
		$uId = session('uid');
		
		//第二步，从post信息中获取变量currentpage
		$currentPage = I('post.currentpage');
		
		if(!ajaxCheck($currentPage)) {
			die();
		}
		
		//定义用于保存返回信息的数组
        $allAlbumIds = array();
		$allAlbumNames = array();
		$allImageSrcs = array();
		$allUploadTimes = array();
		
		//第三步，获取用户相册名信息,相册路径信息和相册内的路径信息
		$allImageDB = M('image');
		$allAlbums = M('album')->where('uid='.$uId)->order('createdt')->limit(PAGELENGTH * $currentPage, PAGELENGTH)->select();
		if(!queryCheck($allAlbums)) {
			die();
		}
		
		while (list($subScripto, $entry) = each($allAlbums)) {
            array_push($allAlbumIds, $entry['albumid']);
			array_push($allAlbumNames, $entry['albumname']);
			array_push($allUploadTimes, $entry['createdt']);
			$tmpImages = $allImageDB->where('albumid='.$entry['albumid'])->select();
			if(!queryCheck($tmpImages)) {
				die();
			}
			$tmpImageArray = array();
			while (list($subScripti, $singleImage) = each($tmpImages)) {
				array_push($tmpImageArray, PREDIR.$singleImage['imgpath']);
			}
			$allImageSrcs[count($allImageSrcs)] = $tmpImageArray;
		}
		
		//第四步，封装返回给前端的信息
        $response['albumids'] = $allAlbumIds;
		$response['albumnames'] = $allAlbumNames;
		$response['imagesrcs'] = $allImageSrcs;
		$response['uploadtimes'] = $allUploadTimes;
		$response['status'] = 1;

		//ajax返回信息
		$this->ajaxReturn($response, 'json');
	}

    public function createAlbum() {
        $uid = session('uid');

        $album = M('album');
        $newAlbum['uid'] = $uid;
        $newAlbum['createdt'] = date('Y-m-d');
        $newAlbum['albumname'] = I('post.name');
        $newAlbum['albumdescrp'] = I('post.descrp');
        $newAlbum['relaid'] = I('post.aid');
        $newAlbum['relsiteid'] = I('post.siteid');

        $status = $album->add($newAlbum);

        $response = array();
        $response['createdt'] = $newAlbum['createdt'];
        if ($status)
            $response['status'] = 1;
        else
            $response['status'] = 0;

        $this->ajaxReturn($response, 'json');
    }

    public function getRelAct() {
        $uid = $session('uid');

        $condition['partcpuid'] = $uid;
        $relActIds = M('participant')->where($condition)->getField('aid', true);
        $map['aid'] = array('IN', $relActIds);
        $relActs = M('activity')->where($map)->getField('aid, aname', true);
        if ($relActs)
            $response['status'] = 1;
        else
            $response['status'] = 0;
        $response['relacts'] = $relActs;

        $this->ajaxReturn($response, 'json');
    }

    public function getActRelSites() {
        $aid = I('post.aid');
        $condition['aid'] = $aid;
        $relSiteIds = M('targetloc')->where($condition)->getField('siteid', true);
        $map['siteid'] = array('IN', $relSiteIds);
        $relSites = M('site')->where($map)->getField('siteid, sitename', true);
        if ($relSites)
            $response['status'] = 1;
        else
            $response['status'] = 0;
        $response['relsites'] = $relSites;

        $this->ajaxReturn($response, 'json');
    }
}

