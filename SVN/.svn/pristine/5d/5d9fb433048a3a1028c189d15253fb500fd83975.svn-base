<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>地点日志</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <link href="css/index.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/location_log.css" rel="stylesheet" type="text/css" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- 导航栏 -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-collapse collapse dropdown col-md-10">
          <ul class="nav nav-tabs" role="tablist">
            <li><a href="http://localhost/welfare/index.php/Home/HomePage/index">首页</a></li>
            <li role="presentation/index" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">地点</a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="http://localhost/welfare/index.php/Home/LocationIndex/index">地点索引</a></li>
                <li><a href="http://localhost/welfare/index.php/Home/NewLocation/index">新建地点</a></li>
              </ul>
            </li>
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">活动</a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="http://localhost/welfare/index.php/Home/Activity/index">活动索引列表</a></li>
                <li><a href="#">发布活动</a></li>
              </ul>
            </li>
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">我的公益</a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="http://localhost/welfare/index.php/Home/PersonalHomepage/index">个人资料</a></li>
                <li><a href="http://localhost/welfare/index.php/Home/PersonalBlog/index">日志</a></li>
                <li><a href="http://localhost/welfare/index.php/Home/PersonalPhotograph/index">相册</a></li>
                <li><a href="http://localhost/welfare/index.php/Home/PersonalActivity/index">活动</a></li>
                <li><a href="#">我关注的</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->

        <!-- 登录 & 注册 栏 -->
        <div class="logIn btn-group pull-right col-md-2">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalLogIn">登录</button>
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalRegister">注册</button>
        </div><!--/.logIn -->

        <!-- 头像信息 -->
        <div class="info pull-right col-md-3 hidden">
          <div class="dropdown pull-left">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
              yl940527
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">我的消息</a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">退出</a>
              </li>
            </ul>
          </div>

          <div class="headImage pull-left">
            <a href="#">
              <img src="resources/head.jpg">
            </a>
          </div>

          <!-- 清除浮动 -->
          <div class="clearfix"></div>
        </div><!-- /头像信息 -->

        <!-- 清除浮动 -->
        <div class="clearfix"></div>
      </div><!--/.container .row -->
    </div><!-- /导航栏 -->

    <!-- Modal 模态框 -->
    <!-- myModalLogIn -->
    <div class="modal fade" id="myModalLogIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">登录</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal formLogIn" role="form">
              <div class="form-group">
                <label for="inputUsername1" class="col-md-2 col-md-offset-2 control-label">用户名</label>
                <div class="col-md-6">
                  <input type="username" class="form-control" id="inputUsername1" placeholder="请输入用户名">
                  <span id="nameTipUsername1"></span>
                </div>
              </div>              
              <div class="form-group">
                <label for="inputPassword1" class="col-md-2 col-md-offset-2 control-label">密码</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="inputPassword1" placeholder="请输入密码">
                  <span id="nameTipPassword1"></span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> 记住我
                      <a href="#" id="forgetPassword">忘记密码？</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                  <button type="submit" class="btn btn-primary btn-lg col-md-9" id="btnLogIn">登录</button>
                </div>
              </div>
            </form>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /#myModalLogIn -->

    <!-- myModalRegister -->
    <div class="modal fade" id="myModalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">注册</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal formRegister" role="form">
              <div class="form-group">
                <label for="inputEmail" class="col-md-2 col-md-offset-2 control-label">注册邮箱</label>
                <div class="col-md-6">
                  <input type="email" class="form-control" id="inputEmail" placeholder="请输入邮箱">
                  <span id="nameTipEmail"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail2" class="col-md-2 col-md-offset-2 control-label">确认邮箱</label>
                <div class="col-md-6">
                  <input type="email" class="form-control" id="inputEmail2" placeholder="请再次输入邮箱">
                  <span id="nameTipEmail2"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputUsername2" class="col-md-2 col-md-offset-2 control-label">用户名</label>
                <div class="col-md-6">
                  <input type="username" class="form-control" id="inputUsername2" placeholder="请输入用户名">
                  <span id="nameTipUsername2"></span>
                </div>
              </div>              
              <div class="form-group">
                <label for="inputPassword2" class="col-md-2 col-md-offset-2 control-label">密码</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="inputPassword2" placeholder="请输入密码">
                  <span id="nameTipPassword2"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-md-2 col-md-offset-2 control-label">确认密码</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" id="inputPassword3" placeholder="请再次输入密码">
                  <span id="nameTipPassword3"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="inputIdentifyingCode" class="col-md-2 col-md-offset-2 control-label">验证码</label>
                <div class="col-md-3">
                  <input type="password" class="form-control" id="inputIdentifyingCode" placeholder="请输入验证码">
                </div>
                <!-- TODO 后端添加验证码 -->
                <img id="imgIdentifyingCode" src="http://localhost/welfare/index.php/Home/MainNavigation/verify" alt="验证码" />
                <a href="#" id="changeImg">看不清，换一张</a>
                <br />
                <span id="nameTipIdentifyingCode"></span>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="checkAgreement">
                      我已经阅读并同意
                      <a href="#" target="_blank">《网站注册协议》</a>、
                      <a href="#" target="_blank">《网站服务协议》</a>和
                      <a href="#" target="_blank">《网站隐私保护条款》</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                  <button type="submit" class="btn btn-primary btn-lg col-md-9" id="btnRegister" disabled="disabled">注册</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- /#myModalRegister -->
    <!-- /.Modal 模态框 -->

    <!-- 左侧悬浮二级菜单按钮 -->
    <div class="btn-group-vertical levelTwo">
      <a href="location_log.html" class="btn btn-info" role="button">
        日志
      </a>
      <a href="" class="btn btn-info" role="button">
        调查报告
      </a>
      <a href="location_album.html" class="btn btn-info" role="button">
        相册
      </a>
      <a href="location_school.html" class="btn btn-info" role="button">
        学校
      </a>
    </div><!-- /二级菜单按钮-->

    <!-- 页面主要内容 -->
    <div class="container holder">
      <div class="jumbotron">
        <div class="row">
              <!--选择头像-->
          <div class="col-md-2" id="filter-box">
            <div class="row well" id="choose-box">
              
            </div>
          </div><!--结束左侧筛选框-->

          <!--主体-->
          <div class="col-md-10" id="main-box">
            <div class="row">
              <div class="col-md-12" id="loadLog">
                <div class="log well">
                  <div class="logTitle text-center">
                    <h3>logTitle<small>time</small></h3>
                  </div>
                  <div class="logMain">
                    <!--头像 博主的链接藏于头像-->
                    <a href="">
                      <img src="" class="headSet">
                    </a>
                    <!--正文-->
                    <div id="less">
                      昨天在家看了《二十四城记》，洗脚的时候还在琢磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒四城记》，洗脚的时候还在琢磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人的生活的现实问题，导演并没有提出什么新的见解，呈现在观众面前的只是不断罗列的泪点（几乎每个人
                    </div>
                    <div id="more">
                      昨天在家看了《二十四城记》，洗脚的时候还在琢磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人的生活的现实问题，导演并没有提出什么新的见解，呈现在观众面前的只是不断罗列的泪点（几乎每个人的讲述中都有一个）、工厂内景、新旧建筑物对比、新旧人物对比，在那些类似《百姓故事》的讲述段落中，因为专业演员的出现而使得叙述的真实感大打折扣。比如吕丽萍丢孩子的部分，如果由一个工人来讲会是什么样子？那些专门讲述惨痛往事的催泪电视节目在真实感情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人的生活的现实问题，导演并没有提出什么新的见解，呈现在观众面前的只是不断罗列的泪点（
                    </div>
                    
                  </div><!--结束日志的主体-->
                  <!--点击载入全文-->
                  <div class="text-center" id="changeLog">
                    <span class="caret"></span>
                  </div>
                </div><!--结束当前日志-->
                <div class="log well">
                  <div class="logTitle text-center">
                    <h3>logTitle<small>time</small></h3>
                  </div>
                  <div class="logMain">
                    <!--头像 博主的链接藏于头像-->
                    <a href="">
                      <img src="" class="headSet">
                    </a>
                    <!--正文-->
                    <div id="less1">
                      昨天在家看了《二十四城记》，洗脚的时候还在琢磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒四城记》，洗脚的时候还在琢磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人的生活的现实问题，导演并没有提出什么新的见解，呈现在观众面前的只是不断罗列的泪点（几乎每个人
                    </div>
                    <div id="more1">
                      昨天在家看了《二十四城记》，洗脚的时候还在琢磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人的生活的现实问题，导演并没有提出什么新的见解，呈现在观众面前的只是不断罗列的泪点（几乎每个人的讲述中都有一个）、工厂内景、新旧建筑物对比、新旧人物对比，在那些类似《百姓故事》的讲述段落中，因为专业演员的出现而使得叙述的真实感大打折扣。比如吕丽萍丢孩子的部分，如果由一个工人来讲会是什么样子？那些专门讲述惨痛往事的催泪电视节目在真实感情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人磨，但愿贾导不是就此江郎才尽了。在担当了好多年的中国艺术电影发言人之后，他怎么也不能再步了老一代电影家晚节不保的后尘啊。所谓的诗意，到这里成了明白无误的煽情，本来和成都没什么内在关系的一个片子，非要贴出“成都，仅你........”的抒情句子，我想这和翟永明的参与不无关系，而这还真的关照了那些泪点比较低的文青们。对于国企变迁这样一个普遍存在的、直接影响到人的生活的现实问题，导演并没有提出什么新的见解，呈现在观众面前的只是不断罗列的泪点（
                    </div>
                    
                  </div>
                  <div class="text-center" id="changeLog1">
                    <span class="caret"></span>
                  </div>
                </div><!--结束当前日志-->
              </div><!--结束整个日志块儿-->
            </div>
          </div><!--结束右侧box-->
        </div>
      </div>
    </div><!-- /页面主要内容 -->
    
    <!-- 页脚 -->
    <div class="container footer">
      <div class="col-xs-12" id="copyrights">
        <section class="copyright">
          All content copyright 
          <a href="#" target="_blank">XXXXX</a> 
          © 2014 • All rights reserved.
        </section>
        <section class="poweredby">
          Proudly published with 
          <a href="#" target="_blank">XXXXX</a> 
        </section>
        <section class="beian">
          <a href="#" target="_blank">京ICP备XXXXXXX号</a> | 京公网安备XXXXXXXXXXX
        </section>
      </div>
    </div><!-- /页脚 -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/index.js" type="text/javascript"></script>
    <script src="js/location_log.js" type="text/javascript"></script>
  </body>
</html>