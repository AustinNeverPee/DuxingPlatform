<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新建地点</title>

    <!-- Bootstrap -->
    <link href="<?php echo ($static); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <link href="<?php echo ($static); ?>/css/index.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo ($static); ?>/css/location_newplace.css" rel="stylesheet" type="text/css" media="screen">

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
            <li><a href="<?php echo ($gate); ?>/HomePage/index">首页</a></li>
            <li role="presentation/index" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">地点</a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo ($gate); ?>/LocationIndex/index">地点索引</a></li>
                <li><a href="<?php echo ($gate); ?>/NewLocation/index">新建地点</a></li>
              </ul>
            </li>
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">活动</a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo ($gate); ?>/Activity/index">活动索引列表</a></li>
                <li><a href="<?php echo ($gate); ?>/NewActivity/index">发布活动</a></li>
              </ul>
            </li>
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">我的公益</a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo ($gate); ?>/PersonalHomepage/index">个人资料</a></li>
                <li><a href="<?php echo ($gate); ?>/PersonalBlog/index">日志</a></li>
                <li><a href="<?php echo ($gate); ?>/PersonalPhotograph/index">相册</a></li>
                <li><a href="<?php echo ($gate); ?>/PersonalActivity/index">活动</a></li>
                <li><a href="<?php echo ($gate); ?>/PersonalFollow/index">我关注的</a></li>
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
              <span id="username"></span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="">
                  我的消息
                  <span id="newsNum"></span>
                </a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="" id="logOut">退出</a>
              </li>
            </ul>
          </div>

          <div class="headImage pull-left">
            <a href="<?php echo ($gate); ?>/PersonalHomepage/index">
              <img alt="head">
            </a>
          </div>

          <!-- 清除浮动 -->
          <div class="clearfix"></div>
        </div><!-- /头像信息 -->

        <!-- 清除浮动 -->
        <div class="clearfix"></div>
      </div><!--/.container .row -->
    </div><!-- /导航栏 -->

    <!-- Logo -->
    <div class="logo pull-left">
      <img src="<?php echo ($static); ?>/resources/logo.png" alt="LOGO" class="img-circle">
    </div><!-- /Logo -->

    <!-- Modal 模态框 -->
    <!-- myModalLogIn -->
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
                <div class="col-md-offset-2 col-md-10">
                  <button type="submit" class="btn btn-primary btn-lg col-md-9" id="btnLogIn">登录</button>
                  <a href="#" id="forgetPassword">忘记密码？</a>
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
                <img id="imgIdentifyingCode" src="<?php echo ($gate); ?>/MainNavigation/verify" alt="验证码" />
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
      <a href="<?php echo ($gate); ?>/LocationIndex/index" class="btn btn-info" role="button">
        地点索引
      </a>
      <a href="<?php echo ($gate); ?>/NewLocation/index" class="btn btn-info" role="button">
        新建地点
      </a>
    </div><!-- /二级菜单按钮-->

    <!-- 页面主要内容 -->
    <div class="container holder">
      <div class="jumbotron">
        <div class="row">
          <!--选择头像-->
          <div class="col-md-2 well" id="filter-box">
            <div id="headImgblock">
              <img src="" id="headImg">
            </div>  
            <form class="form text-center" role="form">           
              <input id="headUpload" type="file" name="file" placeholder="点击选择图片"/>
            </form>
          </div>

          <!--主体-->
          <div class="col-md-10" id="main-box">
            <div class="row">
              <div class = "col-md-9 col-md-offset-1 well">

                <form role="form">
                  <!--选择地点板块-->
                  <div class="row">
                    <div class="col-md-3">
                      <select  class="form-control" id="province" name="provinceid">
                        <option value="-1">--选择省--</option>
                      </select>
                    </div><!--结束选择省-->

                    <div class="col-md-3">
                      <select class="form-control" id="cities" name="cityid">
                        <option value="-1">--选择市--</option>
                      </select>
                    </div><!--结束选择市-->

                    <div class="col-md-3">
                      <select class="form-control" id="contrises" name="contryid">
                        <option value="-1">--选择县--</option>>
                      </select>
                    </div><!--结束选择县-->

                    <div class="col-md-3">
                      <select class="form-control" id="towns" name="townid">
                        <option value="-1">--选择乡镇--</option>
                      </select>
                    </div><!--结束选择乡镇-->
                  </div><!--结束选择地点栏-->

                  <div class="form-group">
                    <label for="InputStreet">街道</label>
                    <input name="village" type="text" class="form-control" id="InputStreet" placeholder="请输入街道名称">
                  </div>

                  <div class="form-group">
                    <label for="InputSchool">学校</label>
                    <input name="school" type="text" class="form-control" id="InputSchool" placeholder="请输入学校名称">
                  </div>

                  <div class="form-group">
                    <label for="InputPerson">资料收集人</label>
                    <input name="sponsor" type="text" class="form-control" id="InputPerson" placeholder="请输入资料收集人姓名">
                  </div>

                  <div class="form-group">
                    <label for="InputIntroduce">简单介绍地点</label>
                    <textarea name="description" class="form-control" rows="4" id="InputIntroduce" placeholder="请输入对地点的简单介绍"></textarea>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-5">
                      <button type="button" class="btn btn-default" id="submitButton">提交</button>
                    </div>
                  </div>
                </form><!--结束提交表单-->
              </div>
            </div>
          </div>
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
    <script src="<?php echo ($static); ?>/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo ($static); ?>/js/jquery.cookie.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ($static); ?>/js/bootstrap.min.js"></script>

    <script src="<?php echo ($static); ?>/js/index.js" type="text/javascript"></script>
    <script src="<?php echo ($static); ?>/js/location_newplace.js" type="text/javascript"></script>
  </body>
</html>