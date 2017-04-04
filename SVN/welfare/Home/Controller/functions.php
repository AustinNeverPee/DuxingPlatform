<?php
function random_text($count) {
	$chars = array_flip(array_merge(range(0,9),range('A','Z'),range('a','z')));
	
	$text = '';
	for($i = 0; $i<$count; $i++) {
		$text .= array_rand($chars);
	}
	return $text;
}

/*
	当字符串在网页中显示的时候，网页只会保留一个空格，且不保留换行
	比如123
		12
	网页中显示123 12
	所以需要把空格换行替换成html能够显示的字符
*/
function DatatoHtml($string) {
	return str_replace("\n","<br />",str_replace(" ","&nbsp",$string));
}

//判断是否为合法用户
function isUser($pattern = 0) {
	if(!session('?uid')) 
		session('uid','vistor');
	if($pattern == 1) {
	    if(session('uid') == "vistor") {
			return false;
		}
		return true;
	}
	return true;
}

function queryCheck($data) {
    if(false === $data) {
	    $data['status'] = 0;
		$data['msg'] = 2;
		echo json_encode($data);
	    return false;
	}
	return true;
}

//ajax请求防止直接访问和返回会话过期错误
function ajaxCheck($data) {
	if(null === $data) {
		header("Location: /maitian/404.html");
		die();
	}
	$data = array();
	if(!session('?uid')) {
	    $data['status'] = 0;
		$data['msg'] = 1;
		echo json_encode($data);
		return false;
	}
	return true;
}

function get_var_name(&$var, $scope=null){    
    $scope = $scope==null? $GLOBALS : $scope;
    //$tmp = $var;  
      
    //$var = 'tmp_value_'.mt_rand();  
    $name = array_search($var, $scope, true);
  
    //$var = $tmp;  
    return $name;  
} 
function mylog($text) {
	$handle = fopen("/log.txt", 'a');
	$time = date('y-m-d h:i:s');
	fwrite($handle,"[");
	fwrite($handle,$time);
	fwrite($handle,"]<----->");
	fwrite($handle,$text);
	fwrite($handle,"\n");
	fclose($handle);
} 