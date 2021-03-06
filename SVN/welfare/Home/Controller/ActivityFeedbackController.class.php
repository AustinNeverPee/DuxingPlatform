<?php
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
/*作者：胡国治
时间：2014-8-26
修改时间:2014-9-1
所属部分：活动反馈页面
*/

header("Content-Type: text/html; charset=utf-8");
class ActivityFeedbackController extends Controller {
	public function index() {
		session_start();
		
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}

	public function feedbacktable(){
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();

	}

	public function actblogs(){
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}

	public function fbkalbum(){
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}

	public function photos(){
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}
/*	public function initate() {
		
		$aid = I('post.acid');
		$prompt = 'feedback.fdbckid, feedback.fdbckdt, feedback.eventdate,
				feedback.eventdur, feedback.repairstate,feedback.studentnum, feedback.gradenum,
				feedback.classnum, feedback.studentstate, feedback.teacherstate,
				feedback.schbuildingstate, feedback.schlibdescrp, feedback.schotherdescrp,
				feedback.shaonianshestate, feedback.facilitystate, feedback.teameval,
				feedback.teamsuggest, activity.aname, site.sitename';
    	$res = M('feedback')
    		->join('activity on activity.aid = feedback.relaid')
    		->join('site on site.siteid = feedback.relsiteid')
    		->field($prompt)
    		->where('activity.aid = '.$aid)
    		->select();

    	if ($res === false)
    		$this->ajaxReturn(array('statu'=>0, 'msg'=>'数据库查询失败'), 'json');
    	else
    		$this->ajaxReturn($res, 'json');
	}*/

	public function initate() {
		
		$aid = I('post.acid');
		$prompt = 'feedback.fdbckid, feedback.relaid, feedback.fdbckdt, feedback.eventdate,
				feedback.eventdur, feedback.repairstate,feedback.studentnum, feedback.gradenum,
				feedback.classnum, feedback.studentstate, feedback.teacherstate,
				feedback.schbuildingstate, feedback.schlibdescrp, feedback.schotherdescrp,
				feedback.shaonianshestate, feedback.facilitystate, feedback.teameval,
				feedback.teamsuggest, activity.aname, site.sitename, user.uname as fdbakuser';

    	$res = M('feedback')
    		->join('activity on activity.aid = feedback.relaid')
    		->join('user on user.uid = feedback.fdbckuid')
    		->join('site on site.siteid = feedback.relsiteid')
    		->field($prompt)
    		->where('activity.aid = '.$aid)
    		->select();

    	if(!$res){
    		$response['statu'] = 0;
    		$this->ajaxReturn($response, 'json');
    	}
    	foreach ($res as $key => $value) {
    		$res[$key]['sponsorname'] = M('sponsor')
    			->join('user on user.uid = sponsor.sponsoruid')
    			->field('user.uname')
    			->where('sponsor.aid = '.$value['relaid'])
    			->select();
    	}

    	if ($res === false){
    		$response['statu'] = 0;
    		$response['msg'] = '数据库查询失败';
    		$this->ajaxReturn($response, 'json');
    		//array('status'=>0, 'msg'=>'数据库查询失败')
    	} else
    		$this->ajaxReturn($res, 'json');
	}


	public function moreBlog() {

		//定义一个图片路径前缀！
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");
		define("ONE", 1);
		define("ZERO", 0);
		define("PAGELENGTH", 20);
		
       /*活动日志列表返回
        *@param currentpage acid
        */
        $blog = M('blog');
        $aid = I('post.acid');
		
		if(!ajaxCheck($aid)) {
			die();
		}

        $page = I('post.currentpage') + ONE;
		
		$User = M('user');
		$Img = M('image');
        
		$returndata = array();
        
		$blogcont = $blog->where('relaid='.$aid)->field('blogid, blogtitle, bloguid, bloglastmddt, blogcontent')->page($page, PAGELENGTH)->select();
		if(!queryCheck($blogcont)) {
			die();
		}
        if($blogcont) {
        	foreach ($blogcont as $oneblog) {
        		/*查找每一条博客的博主姓名以及头像*/
				$uname = $User->where('uid='.$oneblog['bloguid'])->field('unickname, uicon')->find();
				if(!queryCheck($uname)) {
					die();
				}
        		if($uname){
		            $returndata['owners'][] = $uname['unickname'];
		            $con['iid'] = $uname['uicon'];
					$imgpath = $Img->where($con)->field('imgpath')->find();
					if(!queryCheck($imgpath)) {
						die();
					}
		            if($imgpath) {
						$returndata['imagesrcs'][] = PREDIR.$imgpath['imgpath'];
		            }
		            else {
		              	$returndata['imagesrcs'][] = null;
		            }
	            }
        		$returndata['titles'][] = $oneblog['blogtitle'];
        		$returndata['blogid'][] = $oneblog['blogid'];
        		$returndata['contents'][] = $oneblog['blogcontent'];
        		$returndata['uids'][] = $oneblog['bloguid'];
        		$returndata['blogurl'][] = U('PersonalBlog/blogindex?blogid='.$oneblog['blogid']);
        		$returndata['statu'] = ONE;
        	}
        }
        else {
        	$returndata['statu'] = ZERO;
        	$returndata['msg'] = "当前活动没有博客";
        }
        $this->ajaxReturn($returndata, 'json');
	}

	/*相册加载*/
	public function moreAlbum() {
		//定义一个图片路径前缀！
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");
		define("ONE", 1);
		define("ZERO", 0);
		define("PAGELENGTH", 3);
		
		$aid = I('post.acid');
		
		if(!ajaxCheck($aid)) {
			die();
		}

        $page = I('post.currentpage') + ONE;
		$Album = M('Album');
		$Img = M('Image');
        $returndata = array();
        $returndata['statu'] = ONE;
        
		
		$albums = $Album->where('relaid='.$aid)->page($page, PAGELENGTH)->select();
		if(!queryCheck($albums)) {
			die();
		}
        if($albums) {
        	foreach ($albums as $key => $value) {
        		$returndata['albumnames'][] = $value['albumname'];
        		$returndata['albumids'][] = $value['albumid'];
        		$returndata['uploadtimes'][] = $value['createdt'];

        		/*相册里面所有相片的src*/
        		$imgsrc = array();
				
				$albumimgsrc = $Img->where('albumid='.$value['albumid'])->select();
				if(!queryCheck($albumimgsrc)) {
					die();
				}
        		if($albumimgsrc) {
        			foreach ($albumimgsrc as $value) {
						$imgsrc[]= PREDIR.$value['imgpath'];
        			}
        		}

        		//否则获取相册照片失败
        		else{
        			$returndata['msg'] = '1';
        		}
        		$returndata['imagesrcs'][] = $imgsrc;
        	}
        }

        //获取相册失败
        else {
        	$returndata['statu'] = ZERO;
        	$returndata['msg'] = "2";
        }

        $this->ajaxReturn($returndata, 'json');
	}


	// 通过点击相册进去，查看相片
	public function getPhotos(){
		define("PREDIR", C('STATIC_RESOURCE')."/resources/");
		
		$albumid = I('post.albumid');
		$Album = M('Album');
		$Img = M('Image');

		/*相册里面所有相片的src*/
		$imgsrc = array();
		$albumimgsrc = $Img->where('albumid='.$albumid)->select();

		if(!queryCheck($albumimgsrc)) {
			die();
		}
		if($albumimgsrc) {
			$returndata['statu'] = 1;
			foreach ($albumimgsrc as $value) {
				$imgsrc[]= PREDIR.$value['imgpath'];
			}

			$returndata['imgsrc'] = $imgsrc;
		}
		else{
			$returndata['statu'] = 0;
		}
		$this->ajaxReturn($returndata, 'json');
	}

	/**
	 *用户点击获得地点时，用于返回该活动对应的地点
	 *@param @acid : string 该参数有前端post信息中获得
	 *@param @uid : string 该参数有session中获得
	 *经测试，该接口工作正常
	 */
	public function getLocation() {
		//从post和session中获得参数
		$aid = I('post.acid');
		
		if(!ajaxCheck($aid)) {
			die();
		}
		
		$uid = session('uid');

		//实例化需要查询的数据库
		$allTargetLocDB = M('targetloc');
		$allSiteDB = M('site');

		//从数据库查询地点id和地点名字
		$siteNames = array();

		//针对对应数据库数据库进行查询
		$siteIds = $allTargetLocDB->where('aid='.$aid )->getField('siteid', true);
		if(!queryCheck($siteIds)) {
			die();
		}
		while (list($subScipty, $siteid) = each($siteIds)) {
		    $mid_var1 = $allSiteDB->where('siteid='.$siteid)->getField('sitename');
			if(!queryCheck($mid_var1)) {
				die();
			}
			array_push($siteNames, $mid_var1);
		}

		//封装返回的数据
		$response['siteid'] = $siteIds;
		$response['sitename'] = $siteNames;
		$response['status'] = 1;

		//ajax返回
		$this->ajaxReturn($response, 'json');
	}

	/**
	 *用户点击获得相册时，用于返回用户在该活动下创建的相册名
	 *@param @acid : string 该参数有前端post信息中获得
	 *@param @uid : string 该参数有session中获得
	 *经测试，该接口工作正常
	 */
	public function getAlbum() {
		//从post和session中获得参数
		$aid = I('post.acid');
		
		if(!ajaxCheck($aid)) {
			die();
		}
		
		$uid = session('uid');

		//实例化需要用到的数据库
		$allAlbumDB = M('album');

		//针对对应数据库进行查询
		$albumInfo = $allAlbumDB->where('uid = '.$uid." and relaid=".$aid)->field('albumid, albumname')->select();
		if(!queryCheck($albumInfo)) {
			die();
		}
		//定义需要返回的数据
		$albumids = array();
		$albumnames = array();

		while(list($subScript, $entry) = each($albumInfo)) {
			array_push($albumids, $entry['albumid']);
			array_push($albumnames, $entry['albumname']);
		}
		
		//封装返回数据
		$response = array();
		$response['albumid'] = $albumids;
		$response['albumname'] = $albumnames;
		$response['status'] = 1;

		//ajax返回
		$this->ajaxReturn($response, 'json');
	}
	
	/**
	 *用户点击新建相册，用于执行用户新建相册的请求
	 *@param @acid : string 从前端post请求中获得
	 *@param @uid : string  从session中获得
	 *@param @siteid : string 从前端post请求中获得
	 *@param @albumname : string 从前端post请求中获得
	 *@param @description : string 从前端post请求中获得
	 *该接口还有遗留着一个写入中文时，数据库存在乱码问题！
	 */
	public function addAlbum() {
		
		//从前端和session中取出用户id
		$uId	= session('uid');
		$acId	= I('post.acid');
		
		if(!ajaxCheck($acId)) {
			die();
		}
		
		$siteId = I('post.siteid');
		$album	= I('post.albumname');
		$descr	= I('post.description');
		
		//实例化需要用的数据库
		$allAlbumDB = M('album');
		
		//构造写入数据库的数据
		$data['uid']		= $uId;
		$data['createdt']	= date("Y-m-d H:i:s", time());
		$data['albumname']	= $album;
		$data['albumdescrp']= $descr;
		$data['relaid']		= $acId;
		$data['relsiteid']	= $siteId;
		
		//写入数据库！
		
		$mid_var2 = $allAlbumDB->data($data)->add();
		if(!queryCheck($mid_var2)) {
			die();
		}
		
		//封装返回数据！
		$response = array();
		$response['status'] = 1;
		
		//ajax返回数据
		$this->ajaxReturn($response, 'json');
		
	}

	/**
	 *用户点击上传图片后，将图片信息写入到数据，并将对应文件放到指定用户目录
	 *@param @uId : string 该参数由session中获得
	 *@param @acid : string 该参数由前端post信息传递过来
	 *@param @siteid : string 该参数由前端post信息传递过来
	 *@param @albumid : string 该参数由前端post信息传递过来
	 *经测试，该接口工作正常
	 */
	public function upload() {
		
		//宏定义头像类型！
		define('ICON', 1);
		
		//定义需要用的数据库
		$allImageDB		= M('image');
		$allUserDB 		= M('user');
		$allSiteRelImgDB = M('siterelimg');
		$allActRelImgDB = M('actrelimg');
		
		//从前端获取用户id、活动id、地点id和相册id
		$uId		= session('uid');
		$acId		= I('post.acid');
		
		if(!ajaxCheck($acId)) {
			die();
		}
		
		$siteId 	= I('post.siteid');
		$albumId	= I('post.albumid');

		//定义用户上传图片的目标文件夹
		$userName = $allUserDB->where('uid='.$uId)->getField('uname');
		if(!queryCheck($userName)) {
			die();
		}
		$targetFolder = '/welfare/Common/Static/resources/'.$userName.'/';

		if (!empty($_FILES)) {
			//在服务器根目录下指定文件上传的路径
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'].$targetFolder;

			//利用毫秒级别的时间重命名上传的文件
			//切割掉 microtime()函数返回数据格式 0.25139300 1138197510中的点
			$nodot = explode(".", microtime());
			$namestr = str_replace(' ', '', $nodot[1]);
			$uptype = explode(".", $_FILES["Filedata"]["name"]);
			$newname = $namestr.".".$uptype[1];
			$_FILES["Filedata"]["name"] = $newname;

			//定位目标文件welfare/Common/Static/resources/$userName/xxxxx.jpg
			$targetFile = $targetPath.$_FILES['Filedata']['name'];

			//验证文件后缀名是否是规定的类型
			$fileTypes = array('jpg', 'jpeg', 'pjpeg', 'gif', 'png');
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			//将图片及其关联信息写入到数据库
			if (in_array($fileParts['extension'],$fileTypes)) {
				
				//构造需要写入数据库的图片信息
				$dataForImg['uid'] = $uId;
				$dataForImg['imgpath'] = $userName.'/'.$_FILES["Filedata"]["name"];
				$dataForImg['imgdt'] = date('Y-m-d H:i:s', time());
				$dataForImg['albumid'] = $albumId;
				$dataForImg['imgtype'] = ICON;
				
				//将图片信息插入到数据库，失败则设置操作异常
				$mid_var3 = $allImageDB->data($dataForImg)->add();
				if(!queryCheck($mid_var3)) {
					die();
				} else {
					
					//刷新数据库，查询刚刚出入数据库的图片数据
					$allImageDB		= M('image');
					$iid = $allImageDB->where($dataForImg)->getField('iid');
					if(!queryCheck($iid)) {
						die();
					}
					//构造需要写入数据库的图片和活动关联的信息
					$dataForAct['actrelimgid'] = $iid;
					$dataForAct['aid'] = $uId;

					//将图片和活动关联信息写入数据库，失败则设置操作异常
					$mid_var4 = $allActRelImgDB->data($dataForAct)->add();
					if(!queryCheck($mid_var4)) {			
					    $mid_var5 = $allImageDB->where($dataForImg)->delete();
						if(!queryCheck($mid_var5)) {
							die();
						}
						die();
					} else {

						//刷新数据库
						$allImageDB		= M('image');
						$allActRelImgDB = M('actrelimg');

						//构造需要写入数据库的图片和地点关联的信息
						$dataForSite['siterelimgid'] = $iid;
						$dataForSite['siteid'] = $siteId;

						//将图片和地点关联的信息写入数据库，失败则设置操作异常
						
						$mid_var6 = $allSiteRelImgDB->data($dataForSite)->add();
						if(!queryCheck($mid_var6)) {
						    
							$mid_var7 = $allImageDB->where($dataForImg)->delete();
						    if(!queryCheck($mid_var7)) {
								die();
							}				
							//删除先前写入数据库的图片和活动的关联信息！失败则设置操作异常
							$mid_var8 = $allActRelImgDB->where($dataForAct)->delete();
							if(!queryCheck($mid_var8)) {
								die();
							}	
							die();
						} else {
							//写数据库成功，讲图片拷贝到指定目录下
							move_uploaded_file($tempFile, $targetFile);
							
							$tmpImage = new \Think\Image(\Think\Image::IMAGE_GD, $targetFile);
							$response = array();
							$response['height'] = $tmpImage->height();
							$response['width'] = $tmpImage->width();
							$response['iid'] = $iid;
							$response['imgpath'] = $targetFile;
							$retponse['status'] = 1;
							
							$this->ajaxReturn($response, 'json');
						}
					}
				}
			} else {
				$response = array();
				$response['status'] = 0;
				$response['msg'] = 'Invalid file type.';
			}
		}
	}

	/**
	 *控制器私有工具函数，后台异常时，向前端返回异常信息
	 *@param $error : $string用于设置错误提示信息msg
	 *经测试，该函数工作正常
	 */
	private function setException($error) {
		$response = array();
		$response['status'] = 0;
		$response['msg'] = $error;
		$this-ajaxReturn($response, 'ajax');
	}
}