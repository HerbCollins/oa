<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
	<title>员工管理</title>

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
			<div class="logo-zone">
	<img src="/oa/Public/images/logo.png" alt="">
</div>
<nav class="menu left-nav" data-toggle="menu">
  	<ul class="nav nav-primary">
	    <li><a href="<?php echo U('Home/index/index');?>"><i class="icon-home"></i> 首页</a></li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon icon-checked"></i> 任务管理</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('Task/index/edit');?>">发布任务</a></li>
		        <li><a href="<?php echo U('Task/index/work');?>">待完成任务</a></li>
		        <li><a href="<?php echo U('Task/index/finish');?>">已完成任务</a></li>
	      	</ul>
	    </li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon icon-edit"></i> 新闻信息</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('News/cate/index');?>">新闻栏目</a></li>
		        <li><a href="<?php echo U('News/list/index');?>">新闻管理</a></li>
		        <li><a href="<?php echo U('News/index/index');?>">公司新闻</a></li>
	      	</ul>
	    </li>
	    <li>
	    	<a href="<?php echo U('Ucenter/staff/index');?>"><i class="icon icon-group"></i> 人员管理</a>
	    </li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon icon-sitemap"></i> 部门管理</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('Depart/index/index');?>">部门信息</a></li>
		        <li><a href="<?php echo U('Depart/job/index');?>">职位管理</a></li>
	      	</ul>
	    </li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon-book"></i> 物品管理</a>
	    	<ul class="nav">
		        <li><a href="<?php echo U('Things/index/index');?>">物品申请</a></li>
		        <li><a href="<?php echo U('Things/back/index');?>">物品归回</a></li>
		        <li><a href="<?php echo U('Things/apply/config');?>">申请管理</a></li>
		        <li><a href="<?php echo U('Things/index/buy');?>">采购管理</a></li>
	      	</ul>
	    </li>
	    <li class="nav-parent">
      		<a href="javascript:;"><i class="icon-qrcode"></i> 二维码生成器</a>
	      	<ul class="nav">
		        <li><a href="<?php echo U('Qrcode/index/web');?>">网址二维码</a></li>
		        <li><a href="<?php echo U('Qrcode/index/text');?>">文本二维码</a></li>
		        <li><a href="<?php echo U('Qrcode/index/card');?>">名片二维码</a></li>
	      	</ul>
	    </li>
		<button type="button" class="boxer boxer-back-full"><i class="icon icon-bullhorn"></i> 发布公告</button>
		<button type="button" class="boxer boxer-back-full"><i class="icon icon-chat-line"></i> 发送消息</button>
  	</ul> 
</nav>
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
					   		<li><a href="javascript:;" class="top-toggle" data-status="0" data-target="chat-zone" ><i class="icon icon-chat-line"></i></a></li>
					   		<li><a href="javascript:;" class="top-toggle" data-status="0" data-target="notice-zone" ><i class="icon icon-bell"></i></a></li>
					   		<li class="nav-person">
					   			<a href="javascript:;" class="top-toggle" data-status="0" data-target="person-zone" ><img src="/oa/Public/images/user1.png"> name <i class="icon icon-chevron-down"></i></a>
					   		</li>
				      	</div>

				      	<!-- 未读消息 -->
				      	<div class="top-zone top-chat-zone panel panel-info">
				      		<div class="panel-heading">
				      			未读消息
				      		</div>
				      		<div class="panel-body">
					      		<div class="arrow">
					      			<i class="icon icon-caret-up"></i>
					      		</div>
			      				<div class="comment">
								  	<a href="###" class="avatar">
								    	<img src="/oa/Public/images/user1.png">
								  	</a>
								  	<div class="content">
									    <div class="pull-right text-muted">2 个小时前</div>
									    <div>
									    	<a href="###">
									    		<strong>Catouse</strong>
									    	</a>
									    </div>
									    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
								  	</div>
								</div>
			      				<div class="comment">
								  	<a href="###" class="avatar">
								    	<img src="/oa/Public/images/user1.png">
								  	</a>
								  	<div class="content">
									    <div class="pull-right text-muted">2 个小时前</div>
									    <div>
									    	<a href="###">
									    		<strong>Catouse</strong>
									    	</a>
									    </div>
									    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
								  	</div>
								</div>
			      			</div>
							<div class="panel-footer">
								<a href="#">查看全部</a>
							</div>
				      	</div>

				      	<!-- 公告消息 -->
				      	<div class="top-zone top-notice-zone panel panel-info">
				      		<div class="panel-heading">
				      			公司公告
				      		</div>
				      		<div class="panel-body">
					      		<div class="arrow">
					      			<i class="icon icon-caret-up"></i>
					      		</div>
			      				<div class="comment">
								  	<a href="###" class="avatar">
								    	<img src="/oa/Public/images/user1.png">
								  	</a>
								  	<div class="content">
									    <div class="pull-right text-muted">2 个小时前</div>
									    <div>
									    	<a href="###">
									    		<strong>Catouse</strong>
									    	</a>
									    </div>
									    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
								  	</div>
								</div>
			      				<div class="comment">
								  	<a href="###" class="avatar">
								    	<img src="/oa/Public/images/user1.png">
								  	</a>
								  	<div class="content">
									    <div class="pull-right text-muted">2 个小时前</div>
									    <div>
									    	<a href="###">
									    		<strong>Catouse</strong>
									    	</a>
									    </div>
									    <div class="text"><a href="">你到底把我家钥匙放哪里了...</a></div>
								  	</div>
								</div>
			      			</div>
							<div class="panel-footer">
								<a href="#">查看全部</a>
							</div>
				      	</div>

				      	<!-- 个人信息 -->
				      	<div class="top-zone top-person-zone panel panel-info">
				      		<div class="arrow">
				      			<i class="icon icon-caret-up"></i>
				      		</div>
				      		<ul class="list-group">
				      			<a href="" class="list-group-item">个人信息</a>
				      			<a href="" class="list-group-item">修改密码</a>
				      			<a href="" class="list-group-item">退出</a>
				      		</ul>
				      	</div>
					 </div>
				</nav>
			</div>
			
	<div class="main index">
		<div class="contain">
			<ol class="breadcrumb">
			  	<li><a href="your/url/"><i class="icon icon-home"></i> 首页</a></li>
			  	<li><a href="your/url/"><i class="icon icon-book"></i> 员工管理</a></li>
			  	<li class="active"> 员工总览</li>
			</ol>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<div class="panel">
						<div class="panel-heading">
							工作便签
						</div>
						<div class="panel-body">
							<div class="list">
							  <!-- 列表项组 -->
							  <section class="items">
							    <div class="item">
							    	<div class="todo-check pull-left" data-toggle="0">
                                        <input type="checkbox" value="None" id="todo-check_1">
                                        <label for="todo-check_1"></label>
                                    </div>
                                    <p class="todo-title">测试便签1</p>
                                    <div class="todo-actionlist pull-right clearfix">
                                    	<a href="#" class="todo-remove"><i class="icon icon-times"></i></a>
                            		</div>
							    </div>
							    <div class="item">
							    	<div class="todo-check pull-left" data-toggle="0">
                                        <input type="checkbox" value="None" id="todo-check">
                                        <label for="todo-check"></label>
                                    </div>
                                    <p class="todo-title">测试便签2</p>
                                    <div class="todo-actionlist pull-right clearfix">
                                    	<a href="#" class="todo-remove"><i class="icon icon-times"></i></a>
                            		</div>
							    </div>
							  </section>
							  <!-- 列表底部 -->
							</div>
						</div>
						<div class="panel-footer panel-entry">
						    <form role="form" class="form-inline">
                                <div class="form-group todo-entry">
                                    <input type="text" placeholder="Enter your ToDo List" class="ipt" style="width: 100%">
                                </div>
                                <button class="box pull-right" type="submit"><i class="icon icon-plus"></i></button>
                            </form>
						</div>
					</div>
					<div class="panel">
						<div class="panel-heading">
							待完成任务
						</div>
						<div class="panel-body">
							<ul class="list-group">
							  	<li class="list-group-item">
							    	<a href="#">项目</a>
							  	</li>
							  	<li class="list-group-item">
							  		<a href="#">待办</a>
							  	</li>
							  	<li class="list-group-item"><a href="#">需求</a></li>
							  	<li class="list-group-item"><a href="#">任务</a></li>
							  	<li class="list-group-item"><a href="#">Bug</a></li>
							  	<li class="list-group-item"><a href="">用例</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
					<!-- news -->
					<div class="items">
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
						    </div>
						</div>
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
						    </div>
						</div>
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
						    </div>
						</div>
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
						    </div>
						</div>
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
						    </div>
						</div>
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
						    </div>
						</div>
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
						    </div>
						</div>
						<div class="item">
						    <div class="item-heading">
						      	<div class="pull-right label label-success">维基</div>
						      	<h4><a href="###">HTML5 发展历史</a></h4>
						    </div>
						    <div class="item-content">
						      	<div class="media pull-right"><img src="docs/img/img2.jpg" alt=""></div>
						      	<div class="text">HTML 5草案的前身名为Web Applications 1.0，是在2004年由WHATWG提出。2008年1月22日，第一份正式草案发布。WHATWG表示该规范是目前仍在进行的工作，仍须多年的努力。[8]目前Mozilla Firefox、Google Chrome、Opera、Safari（版本4以上）、Internet Explorer（版本9以上）已支持HTML5技术。</div>
						    </div>
						    <div class="item-footer">
						      	<a href="#" class="text-muted"><i class="icon-comments"></i> 243</a> &nbsp; <span class="text-muted">2013-11-11 16:14:37</span>
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
	
<script type="text/javascript">
    $(".todo-check").click(function(){
        $(this).next().addClass("line-through");
        $(this).parent().fadeOut(1000);
    })
</script>

</body>
</html>