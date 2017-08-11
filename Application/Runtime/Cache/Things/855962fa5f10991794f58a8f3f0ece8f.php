<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>信息编辑</title>

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
			
			<div class="main">
				<div class="contain">
					<ol class="breadcrumb">
					  	<li><a href="your/url/"><i class="icon icon-home"></i> 首页</a></li>
					  	<li><a href="your/url/"><i class="icon icon-book"></i> 物品管理</a></li>
					  	<li class="active"> 物品申请</li>
					</ol>
					<div class="container">
						<form class="form-horizontal" action="<?php echo U();?>" method="post">
						  	<div class="form-group">
						    	<label class="col-sm-2" for="exampleInputAccount1">物品名称</label>
						    	<div class="col-md-6 col-sm-10">
						    		<input type="text" class="input" data-type="request" title="请输入物品名称" name="name" placeholder="请输入物品名称">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label class="col-sm-2" for="exampleInputPassword1">采购数量</label>
						    	<div class="col-md-6 col-sm-10">
						    		<input type="number" class="input" data-type="request" title="请输入物品采购数量" name="count" placeholder="请输入物品采购数量">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label class="col-sm-2" for="exampleInputPassword1">物品类型</label>
						    	<div class="col-md-6 col-sm-10">
						    		<select class="form-control" name="type">
						    			<option value="1">消耗品</option>
						    			<option value="2">公共用品</option>
						    		</select>
						    	</div>
						  	</div>
						  	<div class="form-group">
						  		<label class="col-sm-2" for="exampleInputPassword1">采购时间</label>
						    	<div class="col-md-6 col-sm-10">
						    		<input type="date" class="input" name="buy_time" placeholder="请输入物品采购数量">
						    	</div>
						  	</div>
						  	<div class="form-group">
						    	<label class="col-sm-2" for="exampleInputMoney1">花费金额</label>
							    <div class="col-md-6 col-sm-10">
								    <div class="input-group">
								      	<span class="input-group-addon"><i class="icon icon-yen"></i></span>
								      	<input type="number" data-type="request" title="请输入采购所花费的金额" class="input" name="cost" placeholder="请输入采购所花费的金额">
								    </div>
								</div>
	  						</div>
	  						<div class="form-group text-center">
						  		<button type="submit" class="boxer boxer-info">提交</button>
						  	</div>
						</form>
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
	$(document).ready(function(){
		$(".input").focus(function(){
			$(this).removeClass("input-error");
		})
		
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