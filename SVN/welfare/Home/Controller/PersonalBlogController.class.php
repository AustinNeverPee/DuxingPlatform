<?php
namespace Home\Controller;
use Think\Controller;
require_once "functions.php";
header("Content-Type: text/html; charset=utf-8");
/*作者：胡国治
时间：2014-8-29
所属部分：我的公益——个人日志
备注:由于当前的数据库环境是windows，测试时使用的数据表名全部是小写形式
*/

/*
 * 最后修改：杨靖
 * Sun Nov 16 13:54:22 CST 2014
 */

class PersonalBlogController extends Controller {

	public function index() {

		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));
		$this->display();
	}

    public function testedit() {
    	$this->assign('static', C('STATIC_RESOURCE'));
        $this->assign('gate', C('COMMON_GATE'));
        $this->display();
    }

	public function moreBlog() {
		/*每次加载显示20条记录*/
		$uid = session('uid');
		if(isset($uid)){
			$currentpage = I('post.currentpage');
			
			if(!ajaxCheck($currentpage)) {
				die();
		    }
			
			$myblogs = M('blog');
			/*锁定currentPage>0
			*偏移量为offset
			*/
			$currentpage>0 ? $currentpage : 1;
			$offset = ($currentpage-1)*20;
			$returndata = array();
			$blogList = $myblogs->where('bloguid='.$uid)->field('blogid, bloglastmddt, blogtitle, blogcontent')->limit("$offset, 20")->select();
			if(!queryCheck($blogList)) {
				die();
			}
			foreach ($blogList as $value) {
					/*json形式返回博客数据数据*/
                $returndata['blogid'][] = $value['blogid'];
                $returndata['lastmddt'][] = $value['bloglastmddt'];
				$returndata['contents'][] =$value['blogcontent'];
				$returndata['titles'][] = $value['blogtitle'];
                $returndata['blogurl'][] = U('PersonalBlog/blogindex?blogid='.$value['blogid']);
				$returndata['statu'] = 1;
			}
			$this->ajaxReturn($returndata,'json');
			mysql_close();
			exit();
		}
		echo "请先登录";
		exit();
	}

    /*
    public function editBlog() {
        $uid = session('uid');
        if (isset($uid)) {
            $editBlogid = I('post.editBlogid', -1);
            
            if (!ajaxCheck($editBlogid)) {
                die();
            }

            $myblogs = M('blog');
            $blogrelsite = M('blogrelsite');
            $activity = M('activity');
            $participator = M('participator');
            $actrelsite = M('actrelsite');
            $site = M('site');
            
            $returndata = array();

            if ($editBlogid != -1) {
                $editBlog = $myblogs->where('blogid='.$editBlogid)->field('blogtitle, blogcontent, lastmddt, relaid')->select();
                if (!queryCheck($editBlog)) {
                    die();
                }

                $relsiteList = $blogrelsite->where('blogid='.$editBlogid)->field('siteid')->select();
                if (!queryCheck($relsiteList)) {
                    die();
                }

                $returndata['title'] = $editBlog['blogtitle'];
                $returndata['content'] = $editBlog['blogcontent'];
                $returndata['lastmddt'] = $editBlog['lastmddt'];
                $returndata['acid'] = $editBlog['relaid'];
                $returndata['siteids'][] = $relsiteList;
                $returndata['isnewblog'] = 0;

            } else {
                $returndata['isnewblog'] = 1;
            }

            $useractandsite = array();

            // for each user participated activity
            // [aid] [aname] [adate] [relsiteids, relsitenames]
            foreach (($participator->where('uid='.$uid)->field('aid')->select()) as $partactid) {
                $partact = $activity->where('aid='.$partactid)->field('aname, adate')->select();
                $useractsiteid = $actrelsite->where('aid='.$partactid)->field('siteid')->select();
                $useractsite = array();
                foreach ($useractsiteid as $siteid) {
                    $sitename = $site->where('siteid='.$siteid)->field('sitename')->select();
                    array_push($useractsite, array($siteid, $sitename)); 
                }
                array_push($useractandsite, array($partactid, $partact['aname'], $partact['adate'], $useractsite));
            }
            
            $returndata['availactsandsites'][] = $useractandsite;

            $this->ajaxReturn($returndata, 'json');
            mysql_close();
            exit();
        }
        echo "请先登录";
        exit();
        
    }
    */
    public function blogindex() {
        $this->assign('static', C('STATIC_RESOURCE'));
        $this->assign('gate', C('COMMON_GATE'));
        $this->display();
    }
    public function getBlogByblogid() {
        define("PREDIR", C('STATIC_RESOURCE')."/resources/");
        $blogid = I("post.blogid");
        $res = M("blog")
            ->join("user on user.uid = blog.bloguid and blog.blogid = '$blogid'")
            ->field('uname,uicon,blogtitle,blogcontent')
            ->find();
        $postimg = M("image")->where("iid='".$res['uicon']."'")->find();
        if($postimg == null) {
            $consts = require "consts.php";
            $res['uicon'] = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_USER"];
        }
        else {
            $res['uicon'] = PREDIR.$postimg['imgpath'];
        }
        $res['status'] = 1;
        echo json_encode($res);
    }
    public function saveBlog() {
        $uid = session('uid');
        if (isset($uid)) {
            $saveBlog = array();
            $saveBlogId = I('post.blogid', -1);
            $saveBlog['blogtitle'] = I('post.title');
            $saveBlog['blogcontent'] = I('post.content');
            $saveBlog['bloglastmddt'] = date("Y-m-d H:i:s");
            $saveBlog['bloguid'] = $uid;
            $saveBlog['relaid'] = I('post.acid');
            $siteidList = I('post.siteids');


            if (!ajaxCheck($saveBlog)) {
                die();
            }
            
            $returndata = array();

            $myblogs = M('blog');
            $blogrelsite = M('blogrelsite');
            $returndata['statu'] = 1;

            // -1 indicates add
            if ($saveBlogId == -1) {
                $saveBlog['blogcreatedt'] = date("Y-m-d H:i:s");
                $newId = $myblogs->data($saveBlog)->add();
                if(!$newId){
                    $returndata['statu']=0;
                }
                foreach ($siteidList as $siteid) {
                    $data['blogid'] = $newId;
                    $data['siteid'] = $siteid;
                    $blogrelsite->add();
                    if(!$blogrelsite){
                        $returndata['statu']=0;
                    }
                }
            } else {
                $myblogs->where('blogid='.$saveBlogId)->save($saveBlog);
            }

            $returndata['msg'] = "OK";
            $this->ajaxReturn($returndata, 'json');
            mysql_close();
            exit();

        }
        echo "请先登录";
        exit();

    }

    public function deleteBlog() {
        $uid = session('uid');
        if (isset($uid)) {
            $deleteBlogid = I('post.blogid');

            if (!ajaxCheck($deleteBlogid)) {
                die();
            }

            $returndata = array();

            $myblogs = M('blog');
            $deleteBlog = $myblogs->delete($deleteBlogid);


            if ($deleteBlog == 0) {
                $returndata['statu'] = 0;
            }
            else{
                $returndata['statu'] = 1; 
            }   

            $this->ajaxReturn($returndata, 'json');
            mysql_close();
            exit();

        }

        echo "请先登录";
        exit();
    }

    public function getUserRelAct() {
        $uid = session('uid');
        if (isset($uid)) {
            $results = array();
            $relActs = M('participant')
                            ->join('user on user.uid = participant.partcpuid')
                            ->join('activity on activity.aid = participant.aid')
                            ->where('user.uid=' . $uid)
                            ->select();
            foreach ($relActs as $key => $value) {
                $results[$key] = array('aid' => $value['aid'], 'aname' => $value['aname']);
            }
            $this->ajaxReturn($results, 'json');

        }
    }

    public function getUserActRelSite() {
        $uid = session('uid');
        if (isset($uid)) {
            $aid = I('post.aid');
            $results = array();
            $actRelSites = M('targetloc')
                            ->join('activity on activity.aid = targetloc.aid')
                            ->join('site on site.siteid = targetloc.siteid')
                            ->where('activity.aid=' . $aid)
                            ->select();
            foreach ($actRelSites as $key => $value) {
                $results[$key] = array('siteid' => $value['siteid'], 'sitename' => $value['sitename']);
            }
            $this->ajaxReturn($results, 'json');
        }
    }

}

?>
