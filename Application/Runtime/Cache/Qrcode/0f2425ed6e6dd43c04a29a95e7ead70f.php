<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>网址二维码生成</title>

	<meta charset="utf-8" />
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/css/zui.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/lib/calendar/zui.calendar.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/core.css">
	
<style type="text/css">
	form{
		padding:20px;
	}
	label{
		text-align: center;
	}
	.nav-tabs a{
		font-size: 120%;
	}
	.options{
		padding-bottom: 10px;
		border-bottom:1px solid #4ecdc4;
	}
	.qrcode-box{
		margin:20px;
		width:280px;
		height:280px;
		border:3px solid #e9e9e9;
		border-radius: 4px;
	}
	.qrcode-box img{
		width:100%;
	}
</style>

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
		        <li><a href="<?php echo U('Task/index/index');?>">任务中心</a></li>
		        <li><a href="<?php echo U('Task/index/work');?>">待完成任务</a></li>
		        <li><a href="<?php echo U('Task/index/finish');?>">已完成任务</a></li>
	      	</ul>
	    </li>
	    <li class="nav-parent">
	    	<a href="javascript:;"><i class="icon icon-edit"></i> 新闻信息</a>
	    	<ul class="nav">
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
	    <li class="ucenter">
	    	<a href="<?php echo U('Ucenter/Member/index');?>"><i class="icon icon-user"></i> 个人中心</a>
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
		   			<a href="javascript:;" class="top-toggle" data-status="0" data-target="person-zone" ><img src="/oa/Public/images/user1.png"> <?php echo (getUserName(session('uid'))); ?> <i class="icon icon-chevron-down"></i></a>
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
	      			<a href="<?php echo U('Ucenter/Member/index');?>" class="list-group-item">个人信息</a>
	      			<a href="" class="list-group-item">修改密码</a>
	      			<a href="" class="list-group-item">退出</a>
	      		</ul>
	      	</div>
		 </div>
	</nav>
</div>
			
	<div class="main">
		<div class="contain">
			<ol class="breadcrumb">
			  	<li><a href="your/url/"><i class="icon icon-home"></i> 首页</a></li>
			  	<li><a href="your/url/"><i class="icon icon-book"></i> 物品管理</a></li>
			  	<li class="active"> 物品申请</li>
			</ol>
			<ul class="nav nav-tabs">
			  	<li class="active"><a data-tab href="#tabContent1">网址</a></li>
			  	<li><a data-tab href="#tabContent2">文本</a></li>
			  	<li><a data-tab href="#tabContent3">名片</a></li>
			</ul>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-sm-12 col-lg-6">
					<div class="tab-content">
					  	<div class="tab-pane active" id="tabContent1">
					    	<form class="form-horizontal" id="web">
							  	<div class="form-group text-center">
							    	<h2>网址</h2>
							  	</div>
							  	<div class="form-group">
							      	<input type="text" name="web" class="input" id="exampleInputAccount4" placeholder="请输入完整网址,http://www.baidu.com">
							  	</div>
							  	<div class="form-group text-center">
							    	<label>选项</label>
							  	</div>
							  	<div class="form-group options">
							  		<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
							  			<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>容错率：</label> 
								  			<select name="level">
								  				<option value="L">7%</option>
								  				<option value="M">15%</option>
								  				<option value="Q">25%</option>
								  				<option value="H">30%</option>
								  			</select>
								  		</div>
								  		<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>大小：</label> 
								  			<select name="size">
								  				<option value="1">1</option>
								  				<option value="2">2</option>
								  				<option value="3">3</option>
								  				<option value="4" selected="selected">4</option>
								  				<option value="5">5</option>
								  				<option value="6">6</option>
								  				<option value="7">7</option>
								  				<option value="8">8</option>
								  				<option value="9">9</option>
								  				<option value="10">10</option>
								  			</select>
								  		</div>
							  		</div>
							  	</div>
							  	<div class="form-group text-center">
							      	<button type="submit" class="boxer boxer-info">生成二维码</button>
							  	</div>
							</form>
					  	</div>
					  	<div class="tab-pane" id="tabContent2">
					   		<form class="form-horizontal" id="text">
							  	<div class="form-group text-center">
							    	<h2>文本</h2>
							  	</div>
							  	<div class="form-group">
							      	<input type="text" name="web" class="input" id="exampleInputAccount4" placeholder="请输入完整网址,http://www.baidu.com">
							  	</div>
							  	<div class="form-group text-center">
							    	<label>选项</label>
							  	</div>
							  	<div class="form-group">
							  		<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
							  			<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>容错率：</label> 
								  			<select name="level">
								  				<option value="L">7%</option>
								  				<option value="M">15%</option>
								  				<option value="Q">25%</option>
								  				<option value="H">30%</option>
								  			</select>
								  		</div>
								  		<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>大小：</label> 
								  			<select name="size">
								  				<option value="1">1</option>
								  				<option value="2">2</option>
								  				<option value="3">3</option>
								  				<option value="4" selected="selected">4</option>
								  				<option value="5">5</option>
								  				<option value="6">6</option>
								  				<option value="7">7</option>
								  				<option value="8">8</option>
								  				<option value="9">9</option>
								  				<option value="10">10</option>
								  			</select>
								  		</div>
							  		</div>
							  	</div>
							  	<div class="form-group text-center">
							      	<button type="submit" class="boxer boxer-info">生成二维码</button>
							  	</div>
							</form>
					  	</div>
					  	<div class="tab-pane" id="tabContent3">
					    	<form class="form-horizontal" id="card">
							  	<div class="form-group text-center">
							    	<h2>名片</h2>
							  	</div>
							  	<div class="form-group">
							      	<input type="text" name="web" class="input" id="exampleInputAccount4" placeholder="请输入完整网址,http://www.baidu.com">
							  	</div>
							  	<div class="form-group text-center">
							    	<label>选项</label>
							  	</div>
							  	<div class="form-group">
							  		<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
							  			<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>容错率：</label> 
								  			<select name="level">
								  				<option value="L">7%</option>
								  				<option value="M">15%</option>
								  				<option value="Q">25%</option>
								  				<option value="H">30%</option>
								  			</select>
								  		</div>
								  		<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>大小：</label> 
								  			<select name="size">
								  				<option value="1">1</option>
								  				<option value="2">2</option>
								  				<option value="3">3</option>
								  				<option value="4" selected="selected">4</option>
								  				<option value="5">5</option>
								  				<option value="6">6</option>
								  				<option value="7">7</option>
								  				<option value="8">8</option>
								  				<option value="9">9</option>
								  				<option value="10">10</option>
								  			</select>
								  		</div>
							  		</div>
							  	</div>
							  	<div class="form-group text-center">
							      	<button type="submit" class="boxer boxer-info">生成二维码</button>
							  	</div>
							</form>
					  	</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-12 col-sm-12 col-lg-6">
					<div class="qrcode-box">
						<img src="<?php echo ($path); ?>">
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
	function adjust(){
		width = $(window).width();
		if(width<780){
			$(".body-main").addClass("phone-page");
		}else{
			$(".body-main").removeClass("phone-page");
		} 
	}

	$(document).ready(function(){
		$(".input").focus(function(){
			$(this).removeClass("input-error");
		})
		window.onresize=adjust;
		adjust();
		$(".left-toggle").click(function(){
			width = $(window).width();
			var main = $(".body-main");
			if(width<780){
				if(main.is('.left-nav-show')){
					main.removeClass("left-nav-show");
				}else{
					main.addClass("left-nav-show");
				}
			}
		});
		$(".top-toggle").click(function(){
			target = $(this).data("target");
			status = $(this).data("status");
			if(status == 0){
				$(this).addClass("click-active");
				$(".top-"+target).fadeIn(500);
				$(this).data("status","1");
			}else{
				$(this).removeClass("click-active");
				$(".top-"+target).fadeOut(500);
				$(this).data("status","0");
			}
		}).blur(function(){
			status = $(this).data("status");
			if(status == 1){
				$(this).removeClass("click-active");
				$(".top-"+target).fadeOut(500);
				$(this).data("status","0");
			}
		});
		$("form").submit(function(){
			if(!request_check(this)){
				return false;
			}
			datas = $(this).serialize();
			submit_url = $(this).attr("action");
			type = $(this).attr("method");
			$.ajax({
				data:datas,
				url:submit_url,
				type:type,
				dataType:"json",
				success:function(data){
					alert(data.message);
					if(data.status==1){
						window.location.href="<?php echo U('index');?>";
					}
				}
			})
			return false;
		})
	})

	function request_check(k){
		inputs = $(k).find("input");
		flog=1;
		$(inputs).each(function(i) {
			if($(this).data("type") == "request"){
				if($(this).val() == null || $(this).val() == ""){
					$(this).addClass("input-error");
					flog = 0;
				}
			}
		})
		if(flog==1){
			return true;
		}else{
			return false;
		}
	}

	function tooltip_error(obj){

	}
</script>

</body>
</html>