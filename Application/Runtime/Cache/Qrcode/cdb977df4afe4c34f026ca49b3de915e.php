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
	.getPic{
		padding: 0px 20px;
		width:340px;
		text-align: center;
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
			<ul class="nav nav-tabs">
			  	<li class="active"><a data-tab href="#tabContent1">网址</a></li>
			  	<li><a data-tab href="#tabContent2">文本</a></li>
			</ul>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-sm-12 col-lg-6">
					<div class="tab-content">
					  	<div class="tab-pane active" id="tabContent1">
					    	<form class="form-horizontal" id="web" action="<?php echo U('qrcode');?>" method="post">
							  	<div class="form-group text-center">
							    	<h2>网址</h2>
							  	</div>
							  	<div class="form-group">
							      	<input type="text" name="data" class="input" value="http://" id="exampleInputAccount4" placeholder="请输入完整网址,http://www.baidu.com">
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
								  				<option value="H" selected="selected">30%</option>
								  			</select>
								  		</div>
								  		<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>大小：</label> 
								  			<select name="size">
								  				<option value="1">1</option>
								  				<option value="2">2</option>
								  				<option value="3">3</option>
								  				<option value="4">4</option>
								  				<option value="5">5</option>
								  				<option value="6">6</option>
								  				<option value="7">7</option>
								  				<option value="8" selected="selected">8</option>
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
							      	<input type="text" name="data" class="input" id="exampleInputAccount4" placeholder="请输入文本">
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
								  				<option value="H" selected="selected">30%</option>
								  			</select>
								  		</div>
								  		<div class="col-xs-6 col-md-6 col-sm-6 col-lg-6">
								  			<label>大小：</label> 
								  			<select name="size">
								  				<option value="1">1</option>
								  				<option value="2">2</option>
								  				<option value="3">3</option>
								  				<option value="4">4</option>
								  				<option value="5">5</option>
								  				<option value="6">6</option>
								  				<option value="7">7</option>
								  				<option value="8" selected="selected">8</option>
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
						<img src="/oa/Uploads/Qrcode/20170105-1483596882.png">
					</div>
					<div class="getPic">
						<a href="" download="qrcode" class="boxer boxer-info"><i class="icon icon-download-alt"></i>下载</a>
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
	$("form").submit(function(){
		data = $(this).serialize();
		$.ajax({
			data:data,
			url:"<?php echo U('qrcode');?>",
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status==1){
					message_s(data.message);
					$(".qrcode-box").find("img").attr("src",data.path);
					$('.getPic').find('a').attr('href',data.path);
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