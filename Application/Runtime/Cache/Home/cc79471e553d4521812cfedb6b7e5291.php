<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
	<title>发布公告</title>

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
			
	<div class="main index">
		<div class="contain">
			<ol class="breadcrumb">
			  	<li><a href="<?php echo U('Home/index/index');?>"><i class="icon icon-home"></i> 首页</a></li>
			  	<li class="active"> 发布公告</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="container">
					<form action="<?php echo U();?>" method="post">
	  					<div class="form-group">
						    <label for="name">公告标题</label>
						    <input type="text" class="input" id="name" name="title" placeholder="请输入公告标题">
	  					</div>
					  	<div class="form-group">
						    <label for="info">详细信息</label>
						    <!-- 加载编辑器的容器 -->
                            <script id="container" style="height:200px" name="content" type="text/plain"></script>
						</div>
					  	<div class="form-group text-center">
	  						<button type="submit" id="edit_announce" class="boxer boxer-info">发布</button>
	  					</div>
					<form>
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
	
    <!-- 配置文件 -->
    <script type="text/javascript" src="/oa/Public/zui/lib/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/oa/Public/zui/lib/ueditor/ueditor.all.js"></script>
	<script type="text/javascript">
 		u = UE.getEditor('container');
        u.ready(function(){
          u.setContent('<?php echo (htmlspecialchars_decode(stripslashes($info["contain"]))); ?>')
        })

		$("form").submit(function(){
			data = $(this).serialize();	
			urls = $(this).attr("action");
			$.ajax({
				data:data,
				type:"post",
				url:urls,
				dataType:"json",
				beforeSend:function(){
					$("#edit_task").attr("disabled","disabled").addClass("boxer-disabled").html('<i class="icon icon-spin icon-spinner-snake"></i> 发布中...');
				},
				success:function(data){
					if(data.status==1){
						$("#edit_announce").attr("disabled",false).removeClass("boxer-disabled").html('<i class="icon icon-spin icon-spinner-snake"></i> 发布成功，正在跳转...');
						message_s(data.message);
						setTimeout(function(){
							window.location.href=data.url;
						},1000)
					}else{
						message_e(data.message);
					}
				}
			})
			return false;
		})
	</script>

</body>
</html>