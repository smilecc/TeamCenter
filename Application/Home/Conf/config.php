<?php
return array(
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES'=>array( //路由设置
		'User/people/:uid\d' => 'User/people',
		'User/people.html/:uid\d' => 'User/people',//用户个人中心UID参数路由设置
		'Inform/index.html/:class/[:numb\d]' => 'Inform/index',
		'Inform/:class/[:numb\d]' => 'Inform/index',//公告板 页数numb变量路由
		'Project/:pid\d'	=> 'Project/settings',//项目设置
		'Project.html/:mode'	=> 'Project/index',//项目首页
		'Project/index.html/:mode'	=> 'Project/index',//项目首页
		'Res/:mode/[:numb\d]'	=> 'Res/index',//资料首页
		'Res.html/:mode/[:numb\d]'	=> 'Res/index',//资料首页
		'Respage/:rid'	=> 'Res/respage',//资源页
		'Talk/:mode/[:numb\d]'	=> 'Talk/index',//资料首页
		'Talk.html/:mode/[:numb\d]'	=> 'Talk/index',//资料首页
		'Talkpage/:tid/[:numb\d]'	=> 'Talk/talkpage',//讨论页
		'Inboxpage/:uid'	=> 'Inbox/inboxpage',//私信页
		'Projectlist/[:numb]'	=> 'Project/plist',//项目列表页
		'Projectsearch/:class/:keyword/[:numb]'	=> 'Project/plist',//项目列表页
		'Team/:pid'	=> 'Project/team',//项目列表页
		),
	'DEFAULT_CONTROLLER'    =>  'Inform',
);