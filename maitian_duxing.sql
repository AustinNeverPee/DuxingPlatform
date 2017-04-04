-- MySQL dump 10.13  Distrib 5.6.17, for Linux (x86_64)
--
-- Host: pro.ss.sysu.edu.cn    Database: maitian
-- ------------------------------------------------------
-- Server version	5.5.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `maitian`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `maitian` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `maitian`;

--
-- Table structure for table `actfdbcktype`
--

DROP TABLE IF EXISTS `actfdbcktype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actfdbcktype` (
  `aid` int(11) NOT NULL,
  `fdbcktypename` char(8) NOT NULL,
  PRIMARY KEY (`aid`,`fdbcktypename`),
  KEY `fdbcktypename` (`fdbcktypename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actfdbcktype`
--

LOCK TABLES `actfdbcktype` WRITE;
/*!40000 ALTER TABLE `actfdbcktype` DISABLE KEYS */;
/*!40000 ALTER TABLE `actfdbcktype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actfollower`
--

DROP TABLE IF EXISTS `actfollower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actfollower` (
  `actfollowuid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`actfollowuid`,`aid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actfollower`
--

LOCK TABLES `actfollower` WRITE;
/*!40000 ALTER TABLE `actfollower` DISABLE KEYS */;
INSERT INTO `actfollower` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(4,1),(4,2),(5,1),(5,2),(6,1),(6,2);
/*!40000 ALTER TABLE `actfollower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `aname` text NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `adescrp` text NOT NULL,
  `limitnum` int(11) DEFAULT NULL,
  `avail` int(11) NOT NULL,
  `atype` int(11) NOT NULL,
  `creatoruid` int(11) NOT NULL,
  `apostimg` int(11) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `atype` (`atype`),
  KEY `creatoruid` (`creatoruid`),
  KEY `apostimg` (`apostimg`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (1,'公益活动1','2014-09-16','2014-09-26','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',10,1,1,3,11),(2,'公益活动2','2014-09-16','2014-09-21','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',30,0,1,3,12),(3,'公益活动3','2015-01-31','2015-12-31','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',1,0,1,3,13),(4,'公益活动4','2015-12-01','2015-12-01','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',1,0,1,3,14),(5,'公益活动5','2015-01-31','2015-12-01','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',1,0,1,3,15),(6,'公益活动6','2015-01-01','2015-12-31','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',1,0,1,3,16),(7,'公益活动7','2015-01-01','2015-12-01','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',1,0,1,3,17),(8,'公益活动8','2015-03-25','2015-04-04','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',8,0,1,3,18),(9,'公益活动9','2015-03-25','2015-04-04','这是我们可以选择的一种生活方式：我们一起学习新技能，分享自己的技能，让我们在不断进步的生活中，提升自己生存的品质，在不断分享自己的过程中，找到生命的价值，让我们的生活多一点亮色，而不是日复一日循环往复，让我们的生活多一点希望，而不是做一个温水里的青蛙，让生命的每一天充满活力，充满正能量！ \n\n\n作为沪上知名公益心理机构，“麦田”发起了魔都正能量组，号召在魔都生活的我们，用不断提升技能的生活方式养护自己，也在这一过程中，与一群有着同样目标的小伙伴一起，相互扶持，相互促进，共同实现我们技能提升的目标。',8,0,1,3,19),(21,'abc','2015-03-16','2015-03-27','abc',22,0,1,3,NULL);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activitytype`
--

DROP TABLE IF EXISTS `activitytype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activitytype` (
  `atypeid` int(11) NOT NULL,
  `atypename` varchar(30) NOT NULL,
  `atypedescrp` text NOT NULL,
  PRIMARY KEY (`atypeid`),
  UNIQUE KEY `atypename` (`atypename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activitytype`
--

LOCK TABLES `activitytype` WRITE;
/*!40000 ALTER TABLE `activitytype` DISABLE KEYS */;
INSERT INTO `activitytype` VALUES (1,'游山玩水','逍遥法外！');
/*!40000 ALTER TABLE `activitytype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actrelcmnt`
--

DROP TABLE IF EXISTS `actrelcmnt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actrelcmnt` (
  `aid` int(11) NOT NULL,
  `cmntid` int(11) NOT NULL,
  PRIMARY KEY (`aid`,`cmntid`),
  KEY `cmntid` (`cmntid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actrelcmnt`
--

LOCK TABLES `actrelcmnt` WRITE;
/*!40000 ALTER TABLE `actrelcmnt` DISABLE KEYS */;
INSERT INTO `actrelcmnt` VALUES (0,196),(1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,111),(1,112),(1,113),(1,114),(1,115),(1,116),(1,117),(1,126),(1,127),(1,128),(1,148),(1,149),(1,159),(1,160),(1,163),(1,170),(1,172),(1,173),(1,178),(1,183),(1,186),(1,187),(1,188),(1,189),(1,190),(1,191),(1,192),(1,197),(2,130),(2,131),(2,132),(2,133),(2,136),(2,137),(2,138),(2,140),(2,155),(2,156),(2,193),(2,194),(2,198),(7,203);
/*!40000 ALTER TABLE `actrelcmnt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actrelimg`
--

DROP TABLE IF EXISTS `actrelimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actrelimg` (
  `actrelimgid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`actrelimgid`,`aid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actrelimg`
--

LOCK TABLES `actrelimg` WRITE;
/*!40000 ALTER TABLE `actrelimg` DISABLE KEYS */;
INSERT INTO `actrelimg` VALUES (1,2),(2,2);
/*!40000 ALTER TABLE `actrelimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `albumid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `createdt` datetime NOT NULL,
  `albumname` varchar(255) NOT NULL,
  `albumdescrp` text,
  `relaid` int(11) NOT NULL,
  `relsiteid` int(11) NOT NULL,
  PRIMARY KEY (`albumid`),
  KEY `uid` (`uid`),
  KEY `relaid` (`relaid`),
  KEY `relsiteid` (`relsiteid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,3,'2014-09-16 15:33:00','Album1','相册1',1,26),(2,3,'2014-09-16 15:33:00','Album2','相册2',1,29),(3,3,'2014-09-16 15:33:00','Album3','相册3',1,29),(4,3,'2014-09-16 15:34:00','Album4','相册4',2,29);
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `blogid` int(11) NOT NULL AUTO_INCREMENT,
  `blogtitle` text NOT NULL,
  `bloguid` int(11) NOT NULL,
  `blogcreatedt` datetime NOT NULL,
  `bloglastmddt` datetime NOT NULL,
  `blogcontent` text NOT NULL,
  `relaid` int(11) NOT NULL,
  PRIMARY KEY (`blogid`),
  KEY `bloguid` (`bloguid`),
  KEY `relaid` (`relaid`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (46,'爱心公益你我行',3,'2015-03-26 09:45:16','2015-03-26 09:45:16','<a target=\"_blank\" href=\"http://baike.baidu.com/view/1450.htm\" style=\"text-indent: 28px;\">公益</a><span style=\"text-indent: 28px;\">是</span><a target=\"_blank\" href=\"http://baike.baidu.com/view/974976.htm\" style=\"text-indent: 28px;\">公共利益</a><span style=\"text-indent: 28px;\">事业的简称。这是为人民服务的一种通俗讲法。指有关社会公众的福祉和利益。“公益”为后起词，五四运动后方才出现，其意是“公共利益”，“公益”是它的缩写。</span><a target=\"_blank\" href=\"http://baike.baidu.com/view/434652.htm\" style=\"text-indent: 28px;\">社会公益组织</a><span style=\"text-indent: 28px;\">，一般是指那些非政府的、不把利润最大化当作首要目标，且以社会公益事业为主要追求目标的社会组织。早先的公益</span><a target=\"_blank\" href=\"http://baike.baidu.com/subview/46944/5892743.htm\" style=\"text-indent: 28px;\">组织</a><span style=\"text-indent: 28px;\">主要从事人道主义救援和贫民救济活动，很多公益组织起源于慈善机构。</span>\n          ',1),(47,'山区里的留守儿童们',3,'2015-03-26 09:45:47','2015-03-26 09:45:47','<div>除此以外，“牧笛助学”成员还在个人社交媒体上进行义卖，目前已卖出1700多套明信片，收入近两万元，扣除成本，共获利约1.22万元。</div><div><br></div><div>　　学生们表示，这些义卖所得将全部捐献给“牧笛助学”成员们支教过的贵州黔东南台江县、贵州黔东南黎平县、广西柳州融水县、青海玉树囊谦县等偏远山区小学，为孩子们完善图书馆及购买学习用具和体育器材等，并为他们添置生活日用品。</div><div><br></div><div>　　点评：义卖明信片是个很棒的公益创意。明信片上的照片配上对应的支教志愿者日记，重现了支教时的酸甜苦辣，更直接与大家分享了支教背后的故事，真实且令人感动。明信片售价不高，一套9张，零售价12元，普通学生也可以承受，还具有不错的保存价值。更让人点赞的是，明信片还成为这个社团最好的代言，在举行活动的同时，“牧笛助学”在今年3月面向福建的大学生纳新，支教地点在贵州台江县和广西柳州市，希望更多人汇入他们爱的大潮中。</div><div><br></div>\n          ',2),(48,'麦田计划',3,'2015-03-26 09:48:00','2015-03-26 09:48:00','<span class=\"biaoti\">中国.麦田计划.简介</span><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">麦田计划成立于2005年6月16日。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">因为被大山、被那些渴望读书的孩子所感动，一名普通的志愿者在国内发起\"麦田计划\"。 一个民间助学组织,致力于改善中国贫困山区孩子的教育环境,包括为贫困山区中小学生提供读书资助、兴建校舍、成立图书室、资助代课老师、救助山区患病学童等项目。至今，麦田计划在北京、上海、天津、四川、山东、广东、湖南、湖北、江西、广西、安徽、河南、河北、新疆、浙江、江苏等地区建立起麦田地方志愿者团队68个。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">麦田计划从成立至今，分别在四川、云南、山东、湖南、湖北、安徽、青海、新疆、河南、江西、广西、贵州、河北建立了资助点，共资助贫困学生5000余名，代课老师300余名。并且在四川、湖南、安徽、江西兴建麦田学校共14所，建立麦田图书室350余间。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">2011年起，麦田计划开始探索深度助学项目，目前主要开展麦苗班、\"典\"燃梦想、如愿\"易\"偿、麦蕊行动等项目。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">2010年10月1日,麦田计划在广东省民政厅注册成立\"麦田教育基金会\"，致力于探索和实践学校、家庭和社区的素质教育，主要开展麦田少年社、都市方舟、同行计划三个项目。</li></ul><span class=\"biaoti\">二.中国.麦田计划.使命</span><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">让贫困山区的孩子也能平等地享受教育。</li></ul><p class=\"biaoti\"><span class=\"biaoti\">三.中国.麦田计划.性质</span></p><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">一个纯民间志愿团队。</li></ul><p><span class=\"biaoti\">四.中国.麦田计划.宗旨</span></p><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">给贫困孩子一个机会，给自己一份快乐！</li></ul><p><span class=\"biaoti\">五.中国.麦田计划.理念</span></p><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">我们的力量虽然很小，但哪怕只能够改变一个小孩子的命运，我们就依然去努力！</li></ul><p><span class=\"biaoti\">六.中国.麦田计划.文化</span></p><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">表达爱：谢谢这些孩子给了我们一个表达爱的机会！</li><li class=\"liebiao\" style=\"list-style-type: circle;\">奉献爱：给贫困孩子一个机会，给自己一份快乐！麦田倡导快乐助学，给孩子快乐，给自己快乐。麦田计划最大的魅力就是我们营造了一种快乐的氛围。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">分享爱：爱别人、爱自己、爱麦田！我们倡导给孩子、给别人爱，我们也先爱自己，爱我们的麦田，我们的家。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">感受爱：我是麦田人，我们因为麦田而自豪！</li><li class=\"liebiao\" style=\"list-style-type: circle;\">传播爱：做了好事，请留下你的名字！这是麦田的主张，除了鼓励自己，更重要的是为别人树立榜样，号召更多人加入爱心助学行列。</li></ul><p><span class=\"biaoti\">七.中国.麦田计划.架构</span></p><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">为了有效管理，麦田计划总社设立决策团队，负责把握麦田方向、重大事务决策，组织下设：秘书处、助学部、文化部、项目部、财务部、技术部、麦客中心和客服中心等，负责麦田日常事务及项目运作。</li></ul><p><span class=\"biaoti\">八.中国.麦田计划.资料</span></p><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">本着麦田资料真实性的原则，公开接受社会的监督与质疑，保证麦田计划以公益为先的性质，麦田计划在贫困山区发展优秀的地方志愿者，专门负责收集贫困学生和学校资料，上门走访，确保每一份资料的真实可靠。资料经过助学部和图书部的整理以后发布到麦田论坛，资助人可以随意浏览和与被资助者、学校联系。</li></ul><p><span class=\"biaoti\">九.中国.麦田计划.保障</span></p><blockquote><p>为了保障麦田资助人、被资助人、麦田志愿者和麦田计划的利益，麦田计划除了财务公开、透明外，还实行如下措施：</p></blockquote><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">1、麦田计划设立\"麦田保证金\"，如发生麦田计划资助款项被挪用或去向不明，将由\"麦田保证金\"垫付或补偿。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">2、每年将财务数据提交国家注册的会计事务所进行财务审计。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">3、2007年麦田计划成立五万元的\"麦爱基金\"，以保障麦田志愿者的人身安全。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">4、麦田教育基金会聘请中国著名律师梁枫，担任麦田教育基金会法律顾问；同时聘请何云霞律师担任麦田计划法律顾问。</li></ul><p></p><p class=\"biaoti\">十.中国.麦田计划.原则</p><ul><li class=\"liebiao\" style=\"list-style-type: circle;\">民间性：保持民间组织的自主、自发、自愿、自由。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">公益性：保证麦田计划以公共利益为先的性质。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">开放性：麦田计划接受社会的监督与质疑。</li><li class=\"liebiao\" style=\"list-style-type: circle;\">原则性：志愿者在保障本职工作、学业和家庭生活的基础上参与麦田活动。</li></ul><p class=\"biaoti\">十一.中国.麦田计划.项目</p><blockquote><p class=\"biaoti\">一、麦浪行动——小图书室</p><ul><li>向社会各界征集新旧的中、小学课外读物，以一间小学图书室500-2000本书为标准，帮助贫困山区小学成立\"麦田图书室\"，解决部分小学生没有课外读物的问题，充分利用社会闲置资源，同时也响应国家\"建设节约型社会\"的号召。</li></ul><p class=\"biaoti\">二、麦苗行动——我要上学</p><ul><li>麦田计划志愿者的实地走访调查，收集贫困学生的资料，发布到麦田论坛，供有资助贫困孩子意愿的爱心人士选择资助，麦田计划统一接收资助汇款，统一安排发放和监督使用，并为需要的资助人提供相应的发放凭证。</li></ul><p class=\"biaoti\">三、麦青行动——感动之旅</p><ul><li>麦田计划在全国各个城市、社区、各个高校、中小学校开展《山那边的孩子》大型纪实摄影展及莫凡《麦客旅途》报告会，让更全社会关注、参与贫困地区教育建设，同时启发青少年服务社会的思想，树立城市学生正确的人生观和思想品格。</li></ul><p class=\"biaoti\">四、麦想行动——麦田学校</p><ul><li>集合全球爱心力量和资源，为贫困山区的学童修建学校，为孩子们提供一个温暖的教室。</li></ul><p class=\"biaoti\">五、麦言行动——关爱生命</p><ul><li>成立麦言基金，为山区因为贫困而无法就医的患病 (含意外伤害) 学童进行医疗救助。</li></ul><p class=\"biaoti\">六、麦爱行动——文具物品</p><ul><li>麦田计划长期募集各种文具、体育用品等适合小学生学习使用的物品，为贫困地区的孩子送去最贴心的帮助和关怀。</li></ul><p class=\"biaoti\">七、麦香行动——大山脊梁</p><ul><li>开展以资助坚守在贫困地区教育战线上的低收入代课老师的一个活动。</li></ul><p class=\"biaoti\">八、麦风行动——第二课堂</p><ul><li>组织麦田志愿者、与全国高校合作、结合社会力量为山区孩子举办第二课堂活动，丰富山区学生课外生活，开拓学生视野，同时为大学生和社会提供一个与山区孩子交流的平台。</li><li></li></ul></blockquote>\n          ',1);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogrelcmnt`
--

DROP TABLE IF EXISTS `blogrelcmnt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogrelcmnt` (
  `blogid` int(11) NOT NULL,
  `cmntid` int(11) NOT NULL,
  PRIMARY KEY (`blogid`,`cmntid`),
  KEY `cmntid` (`cmntid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogrelcmnt`
--

LOCK TABLES `blogrelcmnt` WRITE;
/*!40000 ALTER TABLE `blogrelcmnt` DISABLE KEYS */;
INSERT INTO `blogrelcmnt` VALUES (1,1),(1,5);
/*!40000 ALTER TABLE `blogrelcmnt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogrelimg`
--

DROP TABLE IF EXISTS `blogrelimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogrelimg` (
  `blogid` int(11) NOT NULL,
  `iid` int(11) NOT NULL,
  PRIMARY KEY (`blogid`,`iid`),
  KEY `iid` (`iid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogrelimg`
--

LOCK TABLES `blogrelimg` WRITE;
/*!40000 ALTER TABLE `blogrelimg` DISABLE KEYS */;
INSERT INTO `blogrelimg` VALUES (1,2);
/*!40000 ALTER TABLE `blogrelimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogrelsite`
--

DROP TABLE IF EXISTS `blogrelsite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogrelsite` (
  `blogid` int(11) NOT NULL,
  `siteid` int(11) NOT NULL,
  PRIMARY KEY (`blogid`,`siteid`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogrelsite`
--

LOCK TABLES `blogrelsite` WRITE;
/*!40000 ALTER TABLE `blogrelsite` DISABLE KEYS */;
INSERT INTO `blogrelsite` VALUES (1,29),(2,29),(3,29),(4,29);
/*!40000 ALTER TABLE `blogrelsite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `cityid` int(11) NOT NULL AUTO_INCREMENT,
  `cityname` varchar(255) NOT NULL,
  `provinceid` int(11) NOT NULL,
  `citydescrp` text,
  PRIMARY KEY (`cityid`),
  UNIQUE KEY `uc_provincecity` (`provinceid`,`cityname`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'番禺',1,'这是广东内部的一个市'),(2,'白云',1,'广东内部的一个市'),(3,'佛山',1,'广东内部的一个市'),(4,'广州',1,'广东内部的一个市'),(5,'中山',1,'广州内部的一个市'),(6,'东莞',1,'广东内部的一个市'),(7,'珠海市',1,'广东内部的一个市'),(8,'汕头',1,'广东内部的一个市'),(9,'汕尾',1,'广东内部的一个市'),(10,'梅州',1,'广东内部的一个市'),(11,'湛江',1,'广东内部的一个市'),(12,'罗定',1,'罗定需要资助的学校较多，数据可用。');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `cmntid` int(11) NOT NULL AUTO_INCREMENT,
  `cmntuid` int(11) NOT NULL,
  `cmntcontent` text NOT NULL,
  `cmntdt` datetime DEFAULT NULL,
  `recmntid` int(11) DEFAULT NULL,
  `rtcmntid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cmntid`),
  KEY `cmntuid` (`cmntuid`)
) ENGINE=MyISAM AUTO_INCREMENT=204 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,3,'这是一条留言A，看好，就是留言','2014-09-16 15:33:00',NULL,NULL),(2,4,'这是一条留言B，哈哈，就是留言','2014-09-16 15:33:00',NULL,NULL),(3,5,'这是一条留言C，哈哈，就是留言','2014-09-16 15:33:00',NULL,NULL),(4,4,'这是一条留言D，哈哈，就是留言','2014-09-16 15:33:00',NULL,NULL),(5,4,'这是以id为1的留言的的评论，同时根节点为1','2014-09-16 15:33:00',1,1),(6,3,'这是以id为2的留言为目标的评论，根节点为2','2014-09-16 15:33:00',2,2),(7,8,'这是针对5的评论，跟节点是1','2014-09-18 15:33:00',5,1),(8,3,'这是针对5的评论，且根节点是1','2014-09-18 15:35:00',5,1),(9,8,'这是8号发出的针对6号评论的，并且以2号留言为根节点','2014-09-18 16:35:00',6,2),(10,3,'这是id为3的用户发表的针对id为3的留言的评论！','2014-09-19 16:35:00',3,3),(115,8,'','2014-09-27 11:38:56',114,1),(116,8,'','2014-09-27 11:40:02',114,1),(114,8,'这是针对id为5的评论的回复','2014-09-27 11:37:12',5,1),(113,8,'这是针对id为5的评论的回复','2014-09-27 11:34:50',5,1),(112,8,'这是针对id为5的评论的回复','2014-09-27 11:32:11',5,1),(111,8,'这是针对id为5的评论的回复','2014-09-27 11:31:46',5,1),(108,8,'楼主不要瞎逼逼！','2014-09-21 18:14:55',5,2),(117,8,'','2014-09-27 11:41:45',114,1),(118,8,'huifuzhangdasaf','2014-10-27 20:45:10',10,3),(119,8,'测试恢复','2014-10-27 20:45:25',5,1),(120,8,'测试恢复','2014-10-27 20:45:25',7,1),(121,8,'测试恢复','2014-10-27 20:45:25',8,1),(122,8,'测试恢复','2014-10-27 20:45:26',7,1),(123,8,'测试恢复','2014-10-27 20:45:26',5,1),(124,8,'回复回复','2014-10-27 20:48:00',119,1),(125,8,'再次测试','2014-10-27 20:48:15',122,1),(126,10,'我可以说话吗','2014-10-27 21:45:34',NULL,NULL),(127,11,'我想说话！！！','2014-11-16 12:38:11',NULL,NULL),(128,11,'回复huguozhi: 没事了','2014-11-16 12:38:33',127,127),(129,11,'回复huguozhi: 没事了','2014-11-16 12:38:33',127,127),(130,13,'test','2014-11-16 12:41:21',NULL,NULL),(131,13,'回复Amin: 回复成功了么？','2014-11-16 12:41:58',130,130),(132,13,'回复Amin: 咦？','2014-11-16 12:42:18',131,130),(133,13,'回复Amin: 喵~ ＞▽＜ ','2014-11-16 13:12:05',131,130),(134,13,'回复Amin: 喵~ ＞▽＜ ','2014-11-16 13:12:05',132,130),(135,13,'回复Amin: 喵~ ＞▽＜ ','2014-11-16 13:12:05',130,130),(136,13,'回复Amin: 呵呵','2014-11-16 13:12:54',132,130),(137,13,'回复Amin: 呵','2014-11-16 13:13:10',133,130),(138,13,'回复Amin: 喵~ ＞▽＜ ','2014-11-16 13:13:24',132,130),(139,13,'回复Amin: 喵~ ＞▽＜ ','2014-11-16 13:13:24',132,130),(140,13,'回复Amin: 刚刚','2014-11-16 13:13:47',132,130),(141,13,'回复Amin: 刚刚','2014-11-16 13:13:47',133,130),(142,13,'回复Amin: 刚刚','2014-11-16 13:13:47',131,130),(143,13,'回复Amin: 刚刚','2014-11-16 13:13:47',132,130),(144,13,'回复Amin: 刚刚','2014-11-16 13:13:47',133,130),(145,13,'回复Amin: 刚刚','2014-11-16 13:13:47',132,130),(146,13,'回复Amin: 刚刚','2014-11-16 13:13:47',131,130),(147,13,'回复Amin: 刚刚','2014-11-16 13:13:47',132,130),(148,11,'回复yangliu: 啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊','2014-11-16 13:14:15',126,126),(149,13,'回复heheng: 喵~ ＞▽＜ ','2014-11-16 13:15:59',114,1),(150,13,'回复heheng: 喵~ ＞▽＜ ','2014-11-16 13:15:59',113,1),(151,13,'回复heheng: 喵~ ＞▽＜ ','2014-11-16 13:15:59',112,1),(152,13,'回复heheng: 喵~ ＞▽＜ ','2014-11-16 13:15:59',114,1),(153,13,'回复heheng: 喵~ ＞▽＜ ','2014-11-16 13:15:59',115,1),(154,13,'回复heheng: 喵~ ＞▽＜ ','2014-11-16 13:15:59',7,1),(155,13,'回复Amin: 刚刚刚','2014-11-16 13:17:46',140,130),(156,8,'回复Amin: test','2015-01-27 17:42:06',131,130),(157,8,'回复Amin: test','2015-01-27 17:42:06',138,130),(158,8,'回复Amin: test','2015-01-27 17:42:06',137,130),(159,8,'回复heheng: test','2015-01-28 16:10:13',149,1),(160,8,'回复heheng: test','2015-01-28 16:10:14',115,1),(161,8,'回复heheng: test','2015-01-28 16:10:14',117,1),(162,8,'回复heheng: test','2015-01-28 16:10:14',116,1),(163,15,'回复heheng: 我要回复！','2015-01-28 16:26:26',116,1),(164,15,'回复heheng: 我要回复！','2015-01-28 16:26:26',149,1),(165,15,'回复heheng: 我要回复！','2015-01-28 16:26:26',160,1),(166,15,'回复heheng: 我要回复！','2015-01-28 16:26:26',149,1),(167,15,'回复heheng: 我要回复！','2015-01-28 16:26:26',159,1),(168,15,'回复heheng: 我要回复！','2015-01-28 16:26:26',117,1),(169,15,'回复heheng: 我要回复！','2015-01-28 16:26:26',116,1),(170,15,'回复heheng: 我要回复！','2015-01-28 16:26:27',1,1),(171,15,'回复heheng: 我要回复！','2015-01-28 16:26:27',117,1),(172,15,'回复huguozhi: 解除绑定了没？','2015-01-28 16:35:52',148,126),(173,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:18',114,1),(174,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:18',149,1),(175,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:18',159,1),(176,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:18',149,1),(177,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:18',117,1),(178,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:19',149,1),(179,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:19',115,1),(180,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:19',115,1),(181,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:19',116,1),(182,15,'回复Amin: 解除绑定了么QAQ','2015-01-28 16:36:19',116,1),(183,15,'回复AminHuang: 继续测试','2015-01-28 16:47:39',173,1),(184,15,'回复AminHuang: 继续测试','2015-01-28 16:47:39',170,1),(185,15,'回复AminHuang: 继续测试','2015-01-28 16:47:39',173,1),(186,15,'回复AminHuang: 行了么','2015-01-28 16:49:39',172,126),(187,15,'回复heheng: 这次一定解除绑定了！！！','2015-01-28 16:50:02',113,1),(188,15,'回复AminHuang: OK','2015-01-28 16:54:45',186,126),(189,15,'回复huguozhi: 。','2015-01-28 17:07:47',148,126),(190,15,'回复AminHuang: 。。','2015-01-28 17:09:48',189,126),(191,15,'回复AminHuang: 。。。','2015-01-28 17:13:07',190,126),(192,15,'回复AminHuang: 。。。。','2015-01-28 17:16:29',191,126),(193,13,'再次测试','2015-01-31 15:53:05',NULL,NULL),(194,13,'回复Amin: ？','2015-01-31 16:03:41',193,193),(195,8,'很久之后，测试一下','2015-03-15 10:11:38',8,1),(196,10,'啦啦啦','2015-03-15 13:20:23',NULL,NULL),(197,8,'回复AminHuang: 这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！这是一条长评论！！！！','2015-03-15 13:43:59',187,1),(198,10,'回复Amin: 这是一条长长长长长长长长很长很长很长很长很长的回复~~~~~~啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦~~~','2015-03-15 13:45:39',131,130),(199,10,'test','2015-03-15 14:01:57',NULL,NULL),(200,10,'Answer_test','2015-03-15 14:02:37',199,199),(201,8,'回复heheng: 很久之后，回复heheng','2015-03-21 09:53:57',195,1),(202,8,'diyiciliuyan','2015-03-22 15:22:55',NULL,NULL),(203,8,'第一条留言！','2015-03-25 00:15:57',NULL,NULL);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `county`
--

DROP TABLE IF EXISTS `county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `county` (
  `countyid` int(11) NOT NULL AUTO_INCREMENT,
  `countyname` varchar(255) NOT NULL,
  `cityid` int(11) NOT NULL,
  `countydescrp` text,
  PRIMARY KEY (`countyid`),
  UNIQUE KEY `uc_citycounty` (`cityid`,`countyname`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `county`
--

LOCK TABLES `county` WRITE;
/*!40000 ALTER TABLE `county` DISABLE KEYS */;
INSERT INTO `county` VALUES (7,'黎少镇',12,'黎少镇需要资助的学校较多，数据可用。'),(8,'连州镇',12,'连州镇需要资助的学校较多，数据可用。'),(9,'罗平镇',12,'罗平镇需要资助的学校较多，数据可用。');
/*!40000 ALTER TABLE `county` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `fdbckid` int(11) NOT NULL AUTO_INCREMENT,
  `relaid` int(11) DEFAULT NULL,
  `relsiteid` int(11) NOT NULL,
  `fdbckuid` int(11) NOT NULL,
  `fdbckdt` datetime NOT NULL,
  `eventdate` date NOT NULL,
  `eventdur` int(11) NOT NULL,
  `eventleaderuid` int(11) NOT NULL,
  `repairstate` text,
  `studentnum` int(11) NOT NULL,
  `gradenum` int(11) NOT NULL,
  `classnum` int(11) NOT NULL,
  `studentstate` text NOT NULL,
  `teacherstate` text NOT NULL,
  `schbuildingstate` text NOT NULL,
  `schlibdescrp` text NOT NULL,
  `schotherdescrp` text,
  `shaonianshestate` text NOT NULL,
  `facilitystate` text,
  `teameval` text NOT NULL,
  `teamsuggest` text NOT NULL,
  PRIMARY KEY (`fdbckid`),
  KEY `relsiteid` (`relsiteid`),
  KEY `fdbckuid` (`fdbckuid`),
  KEY `eventleaderuid` (`eventleaderuid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,1,26,3,'2014-09-16 15:33:00','2014-09-13',6,4,'good',233,2,3,'good','perfect','well enough','quite good','no','not set yet','soso','need donation','nope'),(3,2,29,3,'0000-00-00 00:00:00','2015-02-25',0,3,'15-03-25 08:37:25',0,0,15,'不知道啊','','','不知道啊','不知道啊','','不知道啊','不知道啊','不知道啊');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbacktype`
--

DROP TABLE IF EXISTS `feedbacktype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedbacktype` (
  `fdbcktypename` char(8) NOT NULL,
  `fdbcktypealias` varchar(30) NOT NULL,
  `fieldnum` int(11) NOT NULL,
  `lastmduid` int(11) NOT NULL,
  `lastmddt` datetime NOT NULL,
  `fdbcktypedescrp` text,
  PRIMARY KEY (`fdbcktypename`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacktype`
--

LOCK TABLES `feedbacktype` WRITE;
/*!40000 ALTER TABLE `feedbacktype` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedbacktype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follower`
--

DROP TABLE IF EXISTS `follower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follower` (
  `uid` int(11) NOT NULL,
  `followuid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`followuid`),
  KEY `followuid` (`followuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follower`
--

LOCK TABLES `follower` WRITE;
/*!40000 ALTER TABLE `follower` DISABLE KEYS */;
INSERT INTO `follower` VALUES (3,4),(3,5),(4,3);
/*!40000 ALTER TABLE `follower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `iid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `albumid` int(11) DEFAULT NULL,
  `imgdt` datetime NOT NULL,
  `imgpath` varchar(255) NOT NULL,
  `imgdescrp` text,
  `imgtype` int(11) NOT NULL,
  PRIMARY KEY (`iid`),
  UNIQUE KEY `imgpath` (`imgpath`),
  KEY `uid` (`uid`),
  KEY `imgtype` (`imgtype`),
  KEY `albumid` (`albumid`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,3,2,'2014-09-16 15:33:00','zhangsan/test1.jpg',NULL,0),(15,3,NULL,'2015-03-27 15:21:33','infmaker/act5.jpg',NULL,0),(16,3,NULL,'2015-03-19 11:11:38','infmaker/act6.jpg',NULL,0),(17,3,NULL,'2015-03-21 12:18:09','infmaker/act7.jpg',NULL,0),(18,3,NULL,'2015-03-27 04:41:19','infmaker/act8.jpg',NULL,0),(19,3,NULL,'2015-03-06 21:45:11','infmaker/act9.jpg',NULL,0),(20,3,2,'2015-03-27 00:00:00','infmaker/gua2_1.JPG',NULL,0),(21,3,2,'2015-03-27 00:00:00','infmaker/gua2_2.JPG',NULL,0),(22,3,2,'2015-03-20 00:00:00','infmaker/gua2_3.JPG',NULL,0),(23,3,3,'2015-03-20 00:00:00','infmaker/gua3_1.JPG',NULL,0),(24,3,3,'2015-03-13 00:00:00','infmaker/gua3_2.JPG',NULL,0),(25,2,3,'2015-03-02 00:00:00','infmaker/gua3_3.JPG',NULL,0),(26,3,4,'2015-03-28 00:00:00','infmaker/gua4_1.JPG',NULL,0),(27,3,4,'2015-03-27 00:00:00','infmaker/gua4_2.JPG',NULL,0),(28,3,4,'2015-03-30 00:00:00','infmaker/gua4_3.JPG',NULL,0),(2,1,NULL,'2015-03-26 09:21:17','root/head.jpg',NULL,0),(34,6,NULL,'2015-03-24 11:15:40','VISITOR3/head.jpg',NULL,0),(33,5,NULL,'2015-03-18 00:30:00','VISITOR2/head.jpg',NULL,0),(32,4,NULL,'2015-03-23 00:00:00','VISITOR1/head.jpg',NULL,0),(31,3,1,'2015-03-30 00:00:00','infmaker/gua1_3.JPG',NULL,0),(30,3,1,'2015-03-28 00:00:00','infmaker/gua1_2.JPG',NULL,0),(29,3,1,'2015-03-18 00:00:00','infmaker/gua1_1.JPG',NULL,0),(14,3,NULL,'2015-03-27 08:45:16','infmaker/act4.jpg',NULL,0),(13,3,NULL,'2015-03-26 08:35:31','infmaker/act3.jpg',NULL,0),(12,3,NULL,'2015-03-26 12:13:13','infmaker/act2.jpg',NULL,0),(11,3,NULL,'2015-03-27 00:00:00','infmaker/act1.jpg',NULL,0),(10,3,NULL,'2015-03-25 15:17:29','infmaker/youtong.JPG',NULL,0),(9,3,NULL,'2015-03-25 10:14:28','infmaker/linze.jpg',NULL,0),(8,3,NULL,'2015-03-27 06:13:41','infmaker/huangniumu.JPG',NULL,0),(7,3,NULL,'2015-03-27 13:11:15','infmaker/gulan.JPG',NULL,0),(6,3,NULL,'2015-03-18 12:14:21','infmaker/chiling.jpg',NULL,0),(5,3,NULL,'2015-03-24 00:00:00','infmaker/baima.JPG',NULL,0),(4,3,NULL,'2015-03-27 12:16:27','infmaker/head.jpg',NULL,0),(3,2,NULL,'2015-03-26 05:20:16','customer/head.jpg',NULL,0);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagetype`
--

DROP TABLE IF EXISTS `imagetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagetype` (
  `imgtypeid` int(11) NOT NULL,
  `imgtypedescrp` text NOT NULL,
  PRIMARY KEY (`imgtypeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagetype`
--

LOCK TABLES `imagetype` WRITE;
/*!40000 ALTER TABLE `imagetype` DISABLE KEYS */;
INSERT INTO `imagetype` VALUES (0,'æ™®é€šå›¾ç‰‡'),(1,'ç”¨æˆ·å¤´åƒ'),(2,'æ´»åŠ¨æµ·æŠ¥'),(3,'åœ°ç‚¹å¤´åƒ');
/*!40000 ALTER TABLE `imagetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imgrelcmnt`
--

DROP TABLE IF EXISTS `imgrelcmnt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imgrelcmnt` (
  `iid` int(11) NOT NULL,
  `cmntid` int(11) NOT NULL,
  PRIMARY KEY (`iid`,`cmntid`),
  KEY `cmntid` (`cmntid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imgrelcmnt`
--

LOCK TABLES `imgrelcmnt` WRITE;
/*!40000 ALTER TABLE `imgrelcmnt` DISABLE KEYS */;
INSERT INTO `imgrelcmnt` VALUES (1,2);
/*!40000 ALTER TABLE `imgrelcmnt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`oid`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `msgsenduid` int(11) NOT NULL,
  `msgrecvuid` int(11) NOT NULL,
  `msgdt` datetime NOT NULL,
  `msgcontent` varchar(300) NOT NULL,
  `msgstate` int(11) NOT NULL,
  PRIMARY KEY (`msgsenduid`,`msgrecvuid`,`msgdt`,`msgcontent`),
  KEY `msgrecvuid` (`msgrecvuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (3,8,'2014-09-16 15:33:00','äº¤ä¸ªæœ‹å‹',0),(4,8,'2014-09-16 15:33:00','ä½ å¥½',1);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organization` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `oname` varchar(255) NOT NULL,
  `odescrp` text,
  `ologo` int(11) DEFAULT NULL,
  PRIMARY KEY (`oid`),
  UNIQUE KEY `oname` (`oname`),
  KEY `ologo` (`ologo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participant`
--

DROP TABLE IF EXISTS `participant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participant` (
  `partcpuid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`partcpuid`,`aid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participant`
--

LOCK TABLES `participant` WRITE;
/*!40000 ALTER TABLE `participant` DISABLE KEYS */;
INSERT INTO `participant` VALUES (0,0),(0,12),(3,1),(3,2),(4,1),(4,2),(5,1),(5,2),(6,1);
/*!40000 ALTER TABLE `participant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province` (
  `provinceid` int(11) NOT NULL AUTO_INCREMENT,
  `provincename` varchar(255) NOT NULL,
  `provincedescrp` text,
  PRIMARY KEY (`provinceid`),
  UNIQUE KEY `provincename` (`provincename`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'广东','广东省比较富裕，需要资助学校相对较少，数据可用。'),(2,'四川','四川省需要资助的学校较多'),(3,'北京','北京需要资助的学校较少'),(4,'山东','山东需要资助的学校较少'),(5,'浙江','浙江需要资助的学校较少');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `repid` int(11) NOT NULL AUTO_INCREMENT,
  `repuid` int(11) NOT NULL,
  `repdt` datetime NOT NULL,
  `corrsuggest` text,
  `errdetails` text NOT NULL,
  `errpos` text NOT NULL,
  PRIMARY KEY (`repid`),
  KEY `repuid` (`repuid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (1,3,'2014-09-16 15:33:00','æ”¹é”™å»ºè®®','é”™è¯¯ç»†èŠ‚','é”™è¯¯ä½ç½®');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `siteid` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(255) NOT NULL,
  `townid` int(11) NOT NULL,
  `countyid` int(11) NOT NULL,
  `cityid` int(11) NOT NULL,
  `provinceid` int(11) NOT NULL,
  `sitedetailaddr` text NOT NULL,
  `creatoruid` int(11) NOT NULL,
  `createdt` datetime NOT NULL,
  `lastmduid` int(11) NOT NULL,
  `lastmddt` datetime NOT NULL,
  `sitemainpic` int(11) DEFAULT NULL,
  `sitedescrp` text,
  `longitude` decimal(13,10) DEFAULT NULL,
  `latitude` decimal(13,10) DEFAULT NULL,
  PRIMARY KEY (`siteid`),
  UNIQUE KEY `uc_fulladdr` (`provinceid`,`cityid`,`countyid`,`townid`,`sitename`),
  KEY `creatoruid` (`creatoruid`),
  KEY `lastmduid` (`lastmduid`),
  KEY `sitemainpic` (`sitemainpic`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (25,'赤岭小学',8,7,12,1,'广东省云浮罗定黎少镇赤岭小学',3,'2015-03-26 08:10:06',3,'2015-03-26 09:09:04',6,'学校交通方便，环境较好',111.4686570000,22.7246110000),(26,'榃泽小学',13,7,12,1,'广东省云浮罗定黎少镇榃泽小学',3,'2015-03-26 12:10:22',3,'0000-00-00 00:00:00',9,'好',111.4696570000,22.7248110000),(10,'油涌初小',99,7,12,1,'广东省云浮罗定黎少镇油涌初小',3,'2015-03-26 11:08:19',3,'2015-03-26 12:13:26',10,'暂无',111.4696970000,22.7247110000),(11,'白马小学',99,8,12,1,'广东省云浮罗定连州镇白马小学',3,'2015-03-26 14:13:22',3,'2015-03-26 10:00:13',5,'暂无',112.4591990000,24.9370810000),(29,'古榄小学',99,8,12,1,'广东省云浮罗定连州镇古榄小学',3,'2015-03-26 08:29:37',3,'2015-03-26 08:26:35',7,'暂无',112.4591890000,24.9370210000),(12,'黄牛木小学',99,9,12,1,'广东省云浮罗定罗平镇黄牛木小学',3,'2015-03-26 04:17:23',3,'2015-03-26 07:25:33',8,'暂无\r\n',111.4932420000,22.6909840000);
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitefollower`
--

DROP TABLE IF EXISTS `sitefollower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitefollower` (
  `sitefollowuid` int(11) NOT NULL,
  `siteid` int(11) NOT NULL,
  PRIMARY KEY (`sitefollowuid`,`siteid`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitefollower`
--

LOCK TABLES `sitefollower` WRITE;
/*!40000 ALTER TABLE `sitefollower` DISABLE KEYS */;
INSERT INTO `sitefollower` VALUES (1,26),(1,29),(2,26),(2,29),(4,26),(4,29),(5,26),(5,29),(6,26),(6,29);
/*!40000 ALTER TABLE `sitefollower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siterelcmnt`
--

DROP TABLE IF EXISTS `siterelcmnt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siterelcmnt` (
  `siteid` int(11) NOT NULL,
  `cmntid` int(11) NOT NULL,
  PRIMARY KEY (`siteid`,`cmntid`),
  KEY `cmntid` (`cmntid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siterelcmnt`
--

LOCK TABLES `siterelcmnt` WRITE;
/*!40000 ALTER TABLE `siterelcmnt` DISABLE KEYS */;
INSERT INTO `siterelcmnt` VALUES (29,1),(29,2),(29,3),(29,5),(29,6),(29,7),(29,8),(29,9),(29,10),(29,108),(29,118),(29,119),(29,122),(29,124),(29,125),(29,195),(29,199),(29,200),(29,201),(29,202);
/*!40000 ALTER TABLE `siterelcmnt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siterelimg`
--

DROP TABLE IF EXISTS `siterelimg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siterelimg` (
  `siterelimgid` int(11) NOT NULL,
  `siteid` int(11) NOT NULL,
  PRIMARY KEY (`siterelimgid`,`siteid`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siterelimg`
--

LOCK TABLES `siterelimg` WRITE;
/*!40000 ALTER TABLE `siterelimg` DISABLE KEYS */;
INSERT INTO `siterelimg` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `siterelimg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsor`
--

DROP TABLE IF EXISTS `sponsor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sponsor` (
  `sponsoruid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`sponsoruid`,`aid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsor`
--

LOCK TABLES `sponsor` WRITE;
/*!40000 ALTER TABLE `sponsor` DISABLE KEYS */;
INSERT INTO `sponsor` VALUES (3,1),(3,2),(4,1),(4,2);
/*!40000 ALTER TABLE `sponsor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `targetloc`
--

DROP TABLE IF EXISTS `targetloc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `targetloc` (
  `aid` int(11) NOT NULL,
  `siteid` int(11) NOT NULL,
  PRIMARY KEY (`aid`,`siteid`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `targetloc`
--

LOCK TABLES `targetloc` WRITE;
/*!40000 ALTER TABLE `targetloc` DISABLE KEYS */;
INSERT INTO `targetloc` VALUES (1,11),(1,12),(1,26),(1,29),(2,10),(2,11),(2,26),(2,29),(21,-1);
/*!40000 ALTER TABLE `targetloc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `town`
--

DROP TABLE IF EXISTS `town`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `town` (
  `townid` int(11) NOT NULL AUTO_INCREMENT,
  `townname` varchar(255) NOT NULL,
  `countyid` int(11) NOT NULL,
  `towndescrp` text,
  PRIMARY KEY (`townid`),
  UNIQUE KEY `uc_countytown` (`countyid`,`townname`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `town`
--

LOCK TABLES `town` WRITE;
/*!40000 ALTER TABLE `town` DISABLE KEYS */;
INSERT INTO `town` VALUES (8,'赤岭村',7,'这是赤岭村的描述，数据可用。'),(9,'古榄村',7,'关于古榄村的描述，数据可用。'),(10,'油桶村',7,'关于油桶村的描述，数据可用。'),(11,'白马村',8,'关于白马村的描述，数据可用。'),(12,'黄牛木村',9,'关于黄牛村的描述，数据可用。'),(13,'榃泽村',7,'关于榃泽村的描述，数据可用。');
/*!40000 ALTER TABLE `town` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emailaddr` varchar(255) NOT NULL,
  `unickname` varchar(255) DEFAULT NULL,
  `sex` int(1) NOT NULL,
  `qqnum` char(20) DEFAULT NULL,
  `phonenum` char(20) DEFAULT NULL,
  `idnum` char(30) DEFAULT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `addr` text,
  `selfdescrp` text,
  `wxacct` varchar(255) DEFAULT NULL,
  `wbacct` varchar(255) DEFAULT NULL,
  `uicon` int(11) DEFAULT NULL,
  `ugid` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `emailaddr` (`emailaddr`),
  UNIQUE KEY `unickname` (`unickname`),
  UNIQUE KEY `qqnum` (`qqnum`),
  UNIQUE KEY `phonenum` (`phonenum`),
  UNIQUE KEY `idnum` (`idnum`),
  UNIQUE KEY `wxacct` (`wxacct`),
  UNIQUE KEY `wbacct` (`wbacct`),
  KEY `uicon` (`uicon`),
  KEY `ugid` (`ugid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'root','root','root@mail.wf.org','大头天才',1,'123456789','12345678945',NULL,'柯南','2015-03-11','中国广东省广州市番禺区大学城至善园1号','帅得无法直视',NULL,NULL,2,0),(2,'customer','123456','custormer@mail.com.org','隔壁老王',0,'543825468','15946486769',NULL,'毛利','2015-03-12','中国广东省广州市番禺区大学城至善园2号','沉默中带着些许忧伤',NULL,NULL,3,0),(3,'infmaker','123456','jack@mail.wf.org','膝盖中箭',0,'214748364','13269475842',NULL,'吴煌','2015-03-11','中国广东省广州市番禺区大学城至善园3号','公益急先锋',NULL,NULL,4,0),(4,'VISITOR1','000000','TRYREWT',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(5,'VISITOR2','000000','SFASDFASD',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(6,'VISITOR3','000000','DFGHDFGH',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usergroup`
--

DROP TABLE IF EXISTS `usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usergroup` (
  `ugid` int(11) NOT NULL,
  `ugname` varchar(255) NOT NULL,
  `ugdescrp` text NOT NULL,
  PRIMARY KEY (`ugid`),
  UNIQUE KEY `ugname` (`ugname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usergroup`
--

LOCK TABLES `usergroup` WRITE;
/*!40000 ALTER TABLE `usergroup` DISABLE KEYS */;
INSERT INTO `usergroup` VALUES (0,'ROOT','None'),(10,'Administrator','ç®¡ç†å‘˜'),(20,'Registered_User','æ³¨å†Œç”¨æˆ·'),(30,'Unverified_User','å¾…éªŒè¯ç”¨æˆ·');
/*!40000 ALTER TABLE `usergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userverify`
--

DROP TABLE IF EXISTS `userverify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userverify` (
  `vuid` int(11) NOT NULL,
  `vstartdt` datetime NOT NULL,
  `vdur` int(11) NOT NULL,
  `vemailaddr` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`vuid`),
  UNIQUE KEY `vemailaddr` (`vemailaddr`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userverify`
--

LOCK TABLES `userverify` WRITE;
/*!40000 ALTER TABLE `userverify` DISABLE KEYS */;
INSERT INTO `userverify` VALUES (5,'2014-09-16 15:33:00',4,'wangwu2@sysu.edu.cn','wangwut1'),(6,'2014-09-16 15:33:00',7,'zhaoliu@sysu.edu.cn','zhaoliut1'),(9,'2014-10-20 09:41:38',1,'907756752@qq.com','TopUu0NyZ8'),(10,'2014-10-20 10:27:17',1,'1151730511@qq.com','lubrMkopUu'),(11,'2014-10-26 06:26:01',1,'sehuguozhi@163.com','EUxNS1RRxS'),(12,'2014-10-26 06:29:14',1,'sehuguozhi@126.com','hzIAn1WFoZ'),(13,'2014-11-16 09:33:31',1,'532514900@qq.com','Jj6bkE3CfK'),(14,'2014-11-16 12:28:48',1,'954078415@qq.com','575DsTuyTb'),(15,'2015-01-28 04:14:47',1,'kom9ing@163.com','gIYmkto9zS'),(0,'2015-03-25 07:04:52',1,'1178505135@qq.com','aoYdbtsI1k');
/*!40000 ALTER TABLE `userverify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wait_active`
--

DROP TABLE IF EXISTS `wait_active`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wait_active` (
  `uid` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `emailaddr` varchar(30) DEFAULT NULL,
  `token` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wait_active`
--

LOCK TABLES `wait_active` WRITE;
/*!40000 ALTER TABLE `wait_active` DISABLE KEYS */;
INSERT INTO `wait_active` VALUES (7,'2014-09-16 03:34:21','337377151@qq.com','JSlkdeW3P5');
/*!40000 ALTER TABLE `wait_active` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-31  0:30:27
