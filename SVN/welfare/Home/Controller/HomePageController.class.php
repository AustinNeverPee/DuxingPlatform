<?php
/**
 *作者：杨柳
 *时间：2015-3-16
 *修改时间：2015-3-24
 *所属部分：首页展示
 *主要包括热门活动、热门日志、热门地点的获取
*/

namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html; charset=utf-8");
require_once "functions.php";

class HomePageController extends Controller {
	public function index() {
		isUser();
		/*在调用之前，现行给模板传入参数！渲染模板*/
		$this->assign('static', C('STATIC_RESOURCE'));
		$this->assign('gate', C('COMMON_GATE'));

		$this->display();
	}

    public function initate() {
        define("PREDIR", C('STATIC_RESOURCE')."/resources/");
        // Related images
        $image = M('image');

        // Activities
        // Post URLs, activity names
        $hotActivities = M('activity')
                            ->limit(6)
                            ->field('aid, apostimg, aname')
                            ->select();
        $data = array();
        $data['activities'] = array();
        foreach ($hotActivities as $activity) {
            $postimg = $image->where("iid='".$activity['apostimg']."'")->find();
            if($postimg == null) {
                $consts = require "consts.php";
                $src = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_ACTIVITY"];
            }
            else {
                $src = PREDIR.$postimg['imgpath'];
            }
            $activity['apostimg'] = $src;
            $activity['activityurl'] = U('ActivityDisplay/index?acid='.$activity["aid"]);
            array_push($data['activities'], $activity);
        }

        // Blogs
        // Blog titles & author names
        $hotBlogs = M('blog')
                    ->join("user on user.uid = blog.bloguid")
                    ->limit(6)
                    ->field('blogid, blogtitle,uname')
                    ->select();
        
        $data['blogs'] = array();
        foreach ($hotBlogs as $blog) {
            $blog['blogurl'] = U('PersonalBlog/blogindex?blogid='.$blog['blogid']);
            array_push($data['blogs'], $blog);
        }


        // Sites
        // Site images, site names & complete address
        $hotSites = M('site')
                    ->limit(6)
                    ->field('siteid, sitemainpic, sitename, provinceid, cityid, countyid, townid')
                    ->select();
        $data['sites'] = array();
        foreach ($hotSites as $site) {
            $postimg = $image->where("iid='".$site['sitemainpic']."'")->find();
            if($postimg == null) {
                $consts = require "consts.php";
                $src = $consts["STATIC_PATH"]["STATIC_IMG_PATH"].$consts["DEFAULT_IMG"]["DEFAULT_SITE"];
            }
            else {
                $src = PREDIR.$postimg['imgpath'];
            }
            $site['sitemainpic'] = $src;
            $site['siteurl'] =  U('School/index?schoolid='.$site['siteid']);
            array_push($data['sites'],$site);
        }
        $data['status'] = 1;
        echo json_encode($data);
    }
	/*public function test() {
		echo U('PersonalHomepage/index?id=1')."<br />";
		echo C('COMMON_GATE')."<br />";
		echo C('STATIC_RESOURCE');
		die("<br />暂停脚本");
	}*/
}
