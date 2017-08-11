<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>消息列表</title>

	<meta charset="utf-8" />
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/css/zui.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/lib/calendar/zui.calendar.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/core.css">
	
	<script type="text/javascript" src="/oa/Public/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/oa/Public/zui/js/zui.js"></script>
	<script type="text/javascript" src="/oa/Public/zui/lib/calendar/zui.calendar.js"></script>
	<script type="text/javascript" src="/oa/Public/js/common.js"></script>
</head>
<body>
	<div class="body-main">
		<div class="left-nav">
			<?php echo W('Common/Menu/menu');?>
		</div>
		<div class="right-main">
			<div class="header">
	<nav class="navbar" role="navigation">
		 <div class="container-fluid">
		    <!-- 导航头部 -->
		    <div class="toggle">
			    <!-- 移动设备上的导航切换按钮 -->
			    <button type="button" class="left-toggle" data-toggle="collapse" data-target=".navbar-top">
			        <i class="icon icon-bars"></i>
			    </button>
		    </div>
		    <!-- 导航项目 -->
		   	<div class="right-nav">
		   		<li><a href="<?php echo U('Message/Index/index');?>" title="消息列表" ><i class="icon icon-chat-line"></i></a></li>
		   		<li><a href="<?php echo U('Home/Index/announce');?>" title="公司公告" ><i class="icon icon-bell"></i></a></li>
		   		<li class="nav-person">
		   			<a href="javascript:;" class="top-toggle" data-status="0" data-target="person-zone" >  <?php echo (getUserName(session('uid'))); ?> <i class="icon icon-chevron-down"></i></a>
		   		</li>
	      	</div>

	      	<!-- 个人信息 -->
	      	<div class="top-zone top-person-zone panel panel-info">
	      		<div class="arrow">
	      			<i class="icon icon-caret-up"></i>
	      		</div>
	      		<ul class="list-group">
	      			<a href="<?php echo U('Ucenter/Member/index');?>" class="list-group-item">个人信息</a>
	      			<a href="" class="list-group-item">修改密码</a>
	      			<a href="<?php echo U('Ucenter/Member/logout');?>" class="list-group-item">退出</a>
	      		</ul>
	      	</div>
		 </div>
	</nav>
</div>
			
    <div class="main person">
        <div class="contain">
            <ol class="breadcrumb">
                <li><a href="<?php echo U('Home/index/index');?>"><i class="icon icon-home"></i> 首页</a></li>
                <li><i class="icon icon-commenting"></i> 消息列表</li>
            </ol>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="###" data-target="#tab2Content1" data-toggle="tab">接收消息</a></li>
                        <li><a href="###" data-target="#tab2Content2" data-toggle="tab">发送消息</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab2Content1">
                            <div class="list"> 
                                <div class="items">
                                    <?php if(is_array($get)): $i = 0; $__LIST__ = $get;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><div class="item">
                                        <div class="item-heading">
                                            <h4><a href="<?php echo U('detail',array('id'=>$g['id']));?>" class="color-info"><?php echo ($g["title"]); ?></a>
                                                <?php if($g["is_read"] == 0): ?><span class="label label-dot label-danger"></span><?php endif; ?>
                                            </h4>
                                        </div>
                                        <div class="item-footer">
                                            <span class="label label-badge label-info">来自：<?php echo (getUserName($g["from_uid"])); ?></span> 
                                            <span class="label label-badge label-info">时间：<?php echo ($g["time"]); ?></span>
                                        </div>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2Content2">
                            <div class="list"> 
                                <div class="items"> 
                                    <?php if(is_array($send)): $i = 0; $__LIST__ = $send;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div class="item">
                                            <div class="item-heading">
                                                <h4><a href="<?php echo U('detail',array('id'=>$s['id']));?>" class="color-info"><?php echo ($s["title"]); ?></a></h4>
                                            </div>
                                            <div class="item-footer">
                                                <span class="label label-badge label-info">发送给：<?php echo (getUserName($s["to_uid"])); ?></span> 
                                                <span class="label label-badge label-info">时间：<?php echo ($s["time"]); ?></span>
                                            </div> 
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?> 
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> 

			<div class="footer">
				<p class="pull-left">作者：<a href="" class="tip">樊格</a>、<a href="" class="tip">王庭村</a></p>
				<p class="pull-right">本网站为华东交通大学信息工程学院计算机科学与技术2013-1班毕业设计课题</p>
			</div>
		</div>
	</div>
	

</body>
</html>