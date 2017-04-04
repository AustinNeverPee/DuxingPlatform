<?php
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
/*作者：胡国治
时间：2014-8-24  2014-9-1修改
所属部分：活动展示页面*/

header("Content-Type: text/html; charset=utf-8");
/**活动展示页面
 *@param:
 *参数接收:activityID,
 *接收方式：url参数get方式传递
*/
class ActivityDisplayController extends Controller {
	public function index(){
		session_start();
	 
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}

	/**
	 *用户加载完框架后，调用该函数填充页面内容
	 *@param $schoolid : string 该参数由前端post传递过来
	 *经测试，该接口工作正常！
	 */
	public function initate() {

		//定义一个图片路径前缀！
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");

		//从前端post数据中取出，schoolid!
		$acId = I('post.acid');
		if(!ajaxCheck($acId)) {
			die();
		}

		//实例化所有需要用到的数据表！
		$allActFollowerDB	= M('actfollower');
		$allActTypeDB		= M('activitytype');
		$allActSponserDB	= M('sponsor');
		$allTarLocationDB	= M('targetloc');
		$allSiteDB			= M('site');
		$actRelcmntDB		= M('actrelcmnt');
		$allCommentsDB		= M('comment');
		$allUsersDB			= M('user');
		$allImagesDB		= M('image');
		$allActivityDB		= M('activity');
		
		//第一步，拉取活动海报
		$actAttributes = $allActivityDB->where('aid='.$acId)->find();
		$activityImageSrc = $allImagesDB->where("iid='".$actAttributes['apostimg']."'")->getField('imgpath');
		if(!queryCheck($activityImageSrc)) {
			die();
		}
		if($activityImageSrc == null) {
			$consts = require "consts.php";
			$activityImageSrc = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_ACTIVITY"];
		}
		else {
			$activityImageSrc = PREDIR.$activityImageSrc;
		}


		//第二布，拉取活动的简介
		$activityDescrp = $actAttributes['adescrp'];
		
		//第三步，拉取活动的地理位置名字(跨表操作)
		$locationIds = $allTarLocationDB->where('aid='.$actAttributes['aid'])->getField('siteid', true);
		if(!queryCheck($locationIds)) {
			die();
		}
		$locationNames = array();
		while (list($subScript, $entry) = each($locationIds)) {
		    $mid_var1 = $allSiteDB->where('siteid='.$entry)->getField('sitename');
			array_push($locationNames, $mid_var1);
			if(!queryCheck($mid_var1)) {
				die();
			}
		}

		//第四步，拉取活动的举办时间
		$activityTime = $actAttributes['startdate'];

		//第五步，拉取活动的类型(跨表操作)
		$actType = $allActTypeDB->where('atypeid='.$actAttributes['atype'])->getField('atypename');
		if(!queryCheck($actType)) {
			die();
		}

		//第六步，拉取活动关注者的id
		$actFollowerIds = $allActFollowerDB->where('aid='.$acId)->getField('actfollowuid', true);
		if(!queryCheck($actFollowerIds)) {
			die();
		}

		//第七步，拉取活动关注者的名字，拉取关注者的头像集合
		$actFollowerNames = array();
		$actFollowerSrcs = array();
		while (list($subScripty, $entry) = each($actFollowerIds)) {
			$userInfo = $allUsersDB->where('uid='.$entry)->find();
			if(!queryCheck($userInfo)) {
				die();
			}
			$tmpImageSrc = $allImagesDB->where("iid='".$userInfo['uicon']."'")->getField('imgpath');
			if(!queryCheck($tmpImageSrc)) {
				die();
			}
			if($tmpImageSrc == null) {
				$consts = require "consts.php";
				$src = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_USER"];
			}
			else {
				$src = PREDIR.$tmpImageSrc;
			}
			array_push($actFollowerNames, $userInfo['uname']);
			array_push($actFollowerSrcs, $src);
		}

		//第八步，拉取活动组织者的名字和id
		$actSponsorIds = $allActSponserDB->where('aid='.$acId)->getField('sponsoruid', true);
		if(!queryCheck($actSponsorIds)) {
			die();
		}
		$actSponsorNames = array();
		while (list($subScipt, $entry) = each($actSponsorIds)) {
		    $mid_var2 = $allUsersDB->where('uid='.$entry)->getField('uname');
			array_push($actSponsorNames, $mid_var2);
			if(!queryCheck($mid_var2)) {
				die();
			}
		}
		
		//第九步，拉取活动下面的评论,先将所有评论放入数组
		$commentIds = $actRelcmntDB->where('aid='.$acId)->field('cmntid')->select();
		if(!queryCheck($commentIds)) {
			die();
		}
		
		//定义8个保存评论相应的值的数组
		$allComments	= array();
		$allOwners		= array();
		$allToids		= array();
		$allCmnids		= array();
		$allTimes		= array();
		$allOwnNames	= array();
		$allOwnSrcs		= array();
		$allToNames		= array();
		
		//定义一个数组，用于保存多个根节点（留言id）的数组
		$allRootIds = array();

		//找出了所有的根节点，并记录相应的id，并设置相应位置的信息
		while(list($subScript, $entry) = each($commentIds)) {
			$tmpComment = $allCommentsDB->where('recmntid is null and rtcmntid is null and cmntid='.$entry['cmntid'])->find();
			if(!queryCheck($tmpComment)) {
				die();
			}
			
			if (!empty($tmpComment)){
				//定义5个临时数组（这里少了7个中的2个用户名数组）
				$tmpcmn = array();
				$tmpown = array();
				$tmptoi = array();
				$tmpcid = array();
				$tmpTim = array();
				
				//向临时数组中添加第0个信息
				array_push($tmpcmn, $tmpComment['cmntcontent']);
				array_push($tmpown, $tmpComment['cmntuid']);
				array_push($tmptoi, null);          //因为是根节点，这个值比较特殊，设置为空
				array_push($tmpcid, $tmpComment['cmntid']);
				array_push($tmpTim, $tmpComment['cmntdt']);

				//记录每个根节点的id号
				array_push($allRootIds, $tmpComment['cmntid']);

				//将临时数组作为二维数组新的一纬写入到数组中
				$allComments[count($allComments)]	= $tmpcmn;
				$allOwners[count($allOwners)]		= $tmpown;
				$allCmnids[count($allCmnids)]		= $tmpcid;
				$allTimes[count($allTimes)]			= $tmpTim;
				$allToids[count($allToids)]			= $tmptoi;
			}
		}
		
		/*重置commentIds数组的指针！*/
		reset($commentIds);
		
		//往每个根节点后面添加二级的评论
		while (list($subScript, $entry) = each($commentIds)) {
			$tmpComment = $allCommentsDB->where('cmntid='.$entry['cmntid'].' and recmntid is not null and rtcmntid is not null')->find();
			if(!queryCheck($tmpComment)) {
				die();
			}
			if (!empty($tmpComment)) {
				foreach ($allRootIds as $key => $value) {  //通过rootid的数目，来控制循环
					if ($allRootIds[$key] == $tmpComment['rtcmntid']) {
						array_push($allComments[$key], $tmpComment['cmntcontent']);
						array_push($allOwners[$key], $tmpComment['cmntuid']);
						array_push($allCmnids[$key], $tmpComment['cmntid']);
						array_push($allTimes[$key], $tmpComment['cmntdt']);

						//找每个评论针对的用户的id
						$commentObj = $allCommentsDB->where('cmntid='.$tmpComment['recmntid'])->find();
						if(!queryCheck($commentObj)) {
							die();
						}
						array_push($allToids[$key], $commentObj['cmntuid']);
					}
				}
			}
		}
		
		//找出每条留言或者评论属主的名字和头像
		foreach ($allOwners as $key => $value) {
			$tmpNames = array();
			$tmpSrcs = array();
			while (list($subScript, $entry) = each($value)) {
				$nameAndSrc = $allUsersDB->where("uid=".$entry)->field('uname, uicon')->find();
				if(!queryCheck($nameAndSrc)) {
					die();
				}
				$tmpImagsrc = $allImagesDB->where("iid='".$nameAndSrc['uicon']."'")->getField('imgpath');
				if(!queryCheck($tmpImageSrc)) {
					die();
				}
				if($tmpImageSrc == null) {
					$consts = require "consts.php";
					$src = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_USER"];
				}
				else {
					$src = PREDIR.$tmpImageSrc;
				}
				array_push($tmpNames, $nameAndSrc['uname']);
				array_push($tmpSrcs, $src);
			}
			$allOwnNames[count($allOwnNames)] = $tmpNames;
			$allOwnSrcs[count($allOwnSrcs)] = $tmpSrcs;
		}
		
		//找出每条评论或者留言针对对象的名字
		foreach ($allToids as $key => $value) {
			$tmpNames = array();
			while (list($subScript, $entry) = each($value)) {
			    $mid_var3 = $allUsersDB->where("uid=".$entry)->getField('uname');
				array_push($tmpNames, $mid_var3);
				if(!queryCheck($mid_var3)) {
					die();
				}
			}
			$allToNames[count($allToNames)] = $tmpNames;
		}
		
		//封装需要向前端返回的数据
        $response['aname']          = $allActivityDB->where('aid=' . $acId)->getField('aname');
		$response['postersrc']		= $activityImageSrc;
		$response['activitydes']	= $activityDescrp;
		$response['location']		= $locationNames;
		$response['activitytime']	= $activityTime;
		$response['activitytype']	= $actType;
		$response['organizerids']	= $actSponsorIds;
		$response['organizernames']	= $actSponsorNames;
		$response['followerids']	= $actFollowerIds;
		$response['followernames']	= $actFollowerNames;
		$response['followersrcs']	= $actFollowerSrcs;
		$response['comments']		= $allComments;
		$response['commentids']		= $allCmnids;
		$response['ownerids']		= $allOwners;
		$response['ownernames']		= $allOwnNames;
		$response['ownersrcs']		= $allOwnSrcs;
		$response['toids']			= $allToids;
		$response['tonames']		= $allToNames;
		$response['times']			= $allTimes;
		$response['status'] = 1; 
		
		//ajax返回初始化信息
		$this->ajaxReturn($response, "json");
	}

    public function participate() {
        $uid = session('uid');
        $aid = I('post.aid');
        $participant = M('participant');

        $condition['partcpuid'] = $uid;
        $condition['aid'] = $aid;
        $isParticipated = $participant->where($condition)->select();
        if (!$isParticipated) {
            $s = $participant->add($condition);
            if (false == $s)
                $data['msg'] = '您已经参加了此活动';
        } else {
            $data['statu'] = 0;
            $data['msg'] = '对不起，报名失败';
        }
        $this->ajaxReturn($data, 'json');
    }

	/**
	 *用户浏览活动时关注活动
	 *@param uid : string 该参数是位于session中的uid
	 *@param acid : string 该参数由前端post过来
	 *经测试，该接口工作正常！
	 */
	public function follow() {

		//从session中获得uid
		$uId = session('uid');
		
		//从post请求中，获得acid
		$activityId = I('post.acid');
		
		if(!ajaxCheck($activityId)) {
			die();
		}

		//实例化所有需要用到的数据库！
		$allActFollowerDB = M('actfollower');

		//查询数据库是否已经存在这样一条记录
		$isfollowed = $allActFollowerDB->where("actfollowuid=".$uId." and aid=".$activityId)->find();
		//var_dump($isfollowed);
		if(!queryCheck($isfollowed)) {
			die();
		}

		//判断查询结果，并设置相应的返回状态和提示信息
		if (empty($isfollowed)) {
			$data['actfollowuid']	= $uId;
			$data['aid']			= $activityId;
			
			$mid_var4 = $allActFollowerDB->data($data)->add();
			if(!queryCheck($mid_var4)) {
				die();
			}
			$response['status'] = 1;
			$this->ajaxReturn($response, 'json');
		} else {
			//已经存在该数据，返回已经我关注的状态！
			$response['status'] = 0;
			$response['msg'] = 4;
			$this->ajaxReturn($response, 'json');
		}

		//ajax向前端返回信息
		
	}

	/**
	 *“活动”动态留言的请求
	 *@param @acid : string 该参数由前端post传过来
	 *@param @content : string 该参数由前端post传过来
	 *@param @uid : Int 该参数从session中获取
	 *经测试，该接口工作正常！
	 */
	public function leaveMessage() {
		//从session中获取uid
		$uId = session('uid');

		//从post中post中获取content和acid
		$activityId	= I('post.acid');
		
		if(!ajaxCheck($activityId)) {
			die();
		}
		
		$content	= I('post.content');
		
		//实例化所有需要用到的数据库！
		$allCommentDB		= M('comment');
		$allActrelcmntDB	= M('actrelcmnt');
		
		//生成要写入到数据库中的数据
		$data['cmntid']		= null;
		$data['cmntuid']	= $uId;
		$data['cmntcontent']= $content;
		$data['cmntdt']		= date("Y-m-d H:i:s", time());
		$data['recmntid']	= null;
		$data['rtcmntid']	= null;

		//将生成的留言插入到数据库中
		$mid_var5 = $allCommentDB->data($data)->add();
		if(!queryCheck($mid_var5)) {
			die();
		}	
		//插入完数据库之后，刷新数据库！
		$allCommentDB = M('comment');
		
		//定义数据库查询条件！
		$criteria['cmntdt'] = array('EQ', $data['cmntdt']);
		$cmntId = $allCommentDB->where($criteria)->getField('cmntid');
		if(!queryCheck($cmntId)) {
			die();
		}	
		//重置data，生成要插入到地点和评论的联系表的数据
		$data = null;
		$data['aid'] = $activityId;
		$data['cmntid'] = $cmntId;

		//将生成好的联系表数据插入到联系表中
		
		$mid_var6 = $allActrelcmntDB->data($data)->add();
		if(!queryCheck($mid_var6)) {
			die();
		}
		//封装需要向前端返回的数据
		$response['status'] = 1;
		
		//ajax向前端返回信息
		$this->ajaxReturn($response, 'json');
	}
	
	/**
	 *活动页动态请求更多活动信息的请求
	 *@param @shcoolid : string 该参数由前端post传过来
	 *@param @content : string 该参数由前端post传过来
	 *@param @uid : Int 该参数从session中获取
	 *@param @recmntid : Int 该参数由前端post传过来!
	 *@param @rtcmntid : Int 该参数由前端post传过来！
	 *经测试，该接口工作正常
	 */
	public function comment() {
		//从session中获取uid
		$uId = session('uid');
		
		//从post中post中获取content，acid，recmntid和rtcmntid
		$activityId		= I('post.acid');
		
		if(!ajaxCheck($activityId)) {
			die();
		}
		
		$content		= I('post.content');
		$toId			= I('post.recmntid');
		$rootId			= I('post.rtcmntid');
		//$activityId = 1;
		//$content = "这是针对id为5的评论的回复";
		//$toId = 5;
		//$rootId = 1;
		
		//实例化所有需要用到的数据库！
		$allCommentDB		= M('comment');
		$allActrelcmntDB	= M('actrelcmnt');

		//生成要写入到数据库中的数据
		$data['cmntid'] = null;
		$data['cmntuid'] = $uId;
		$data['cmntcontent'] = $content;
		$data['cmntdt'] = date("Y-m-d H:i:s", time());
		$data['recmntid'] = $toId;
		$data['rtcmntid'] = $rootId;
		
		//将生成的留言插入到数据库中
		
		$mid_var7 = $allCommentDB->data($data)->add();
		if(!queryCheck($mid_var7)) {
			die();
		}
		
		//定义数据库查询条件！
		$criteria['cmntdt'] = array('EQ', $data['cmntdt']);
		$cmntId = $allCommentDB->where($criteria)->getField('cmntid');
		if(!queryCheck($cmntId)) {
			die();
		}	
		//生成要插入到地点和评论的联系表的数据
		$data = null;
		$data['aid'] = $activityId;
		$data['cmntid'] = $cmntId;
		
		//将生成好的联系表数据插入到联系表中
		
		$mid_var8 = $allActrelcmntDB->data($data)->add();
		if(!queryCheck($mid_var8)) {
			die();
		}	
		//封装需要向前端返回的数据
		$response['status'] = 1;
		
		//ajax向前端返回信息
		$this->ajaxReturn($response, 'json');
	}

	
	public function album() {		
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
	    $this->display();
	}

    public function setFeedbackSummary() {
        $uid = session('uid');
        $aid = I('post.aid');

        $condition['aid'] = $aid;
        $data = M('feedback')->where($condition)->field('studentstate, teacherstate, schbuildingstate, schlibdescrp')-find();

        if ($data) {
            $response['data'] = $data;
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        $this->ajaxReturn($response, 'json');
    }
}
