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
		        <li><a href="<?php echo U('Task/index/not_deal');?>">待完成任务</a></li>
		        <li><a href="<?php echo U('Task/index/dealed');?>">已完成任务</a></li>
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
		        <li><a href="<?php echo U('Things/index/notBack');?>">物品归回</a></li>
		        <li><a href="<?php echo U('Things/index/applyDeal');?>">申请管理</a></li>
		        <li><a href="<?php echo U('Things/index/buy');?>">采购管理</a></li>
	      	</ul>
	    </li>
	    <li>
      		<a href="<?php echo U('Qrcode/index/index');?>"><i class="icon-qrcode"></i> 二维码生成器</a>      	
	    </li>
	    <li class="ucenter">
	    	<a href="<?php echo U('Ucenter/Member/index');?>"><i class="icon icon-user"></i> 个人中心</a>
	    </li>
		<a href="<?php echo U('Home/index/sendAnnounce');?>" class="boxer boxer-back-full text-center"><i class="icon icon-bullhorn"></i> 发布公告</a>
		<a href="<?php echo U('Message/index/add');?>" class="boxer boxer-back-full text-center"><i class="icon icon-bullhorn"></i> 发布公告</a>
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
                <li><a href="<?php echo U('index');?>"><i class="icon icon-home"></i> 员工管理</a></li>
                <li><i class="icon icon-group"></i> 分配职位-<?php echo (getUserName($uid)); ?></li>
            </ol>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="container">
						<form class="form-horizontal" id="staff" action="<?php echo U('');?>" method="post">
						<div class="form-group">
							<label for="" class="col-sm-2 text-left">姓名</label>
							<label class="col-md-6 col-sm-10 text-left" style="text-align:left"><?php echo (getUserName($uid)); ?></label>
						
						</div>
					  	<div class="form-group">
							<label for="" class="col-sm-2 text-left">当前部门</label>
							<label class="col-md-6 col-sm-10 text-left" style="text-align:left"><?php echo (getUserDepart($uid)); ?></label>
						</div>
					  	<div class="form-group">
							<label for="" class="col-sm-2 text-left">当前职位</label>
							<label class="col-md-6 col-sm-10 text-left" style="text-align:left"><?php echo (getUserJob($uid)); ?></label>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 text-left">是否为主管</label>
							<label class="col-md-6 col-sm-10 text-left" style="text-align:left">
								<input type="radio" name="is_leader" value="1"> 是 
								<input type="radio" name="is_leader" value="0" checked="checked"> 否
							</label>
						</div>
					  	<div class="form-group jobs">
						    <label for="StaffPhone" class="col-sm-2">职位</label>
						    <div class="col-md-6 col-sm-10">
						      	<select name="jid" class="slt">
						      		<?php if(is_array($job)): $i = 0; $__LIST__ = $job;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						      	</select>
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						    	<input type="hidden" value="<?php echo ($uid); ?>" name="id" />
						    	<input type="hidden" value="<?php echo ($pid); ?>" name="pid" />
						      	<button type="submit" class="boxer boxer-info">保存</button>
						      	<a href="<?php echo U('index');?>" class="boxer boxer-info">取消</a>
						    </div>
						</div>
					</form>
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
	$("input[name='is_leader']").change(function(){
		var is_leader = $(this).val();
		console.log(is_leader);
		if(is_leader ==1 ){
			$(".jobs").hide();
		}else{
			$(".jobs").show();
		}
	})
	$("form").submit(function(){
		
		data = $(this).serialize();
		$.ajax({
			data:data,
			type:"post",
			url:"<?php echo U('allotJob');?>",
			dataType:"json",
			success:function(data){
				if(data.status==1){
					message_s(data.message);
					setTimeout(function(){location.href="<?php echo U('index');?>"},2000);
				}else{
					message_e(data.message);
				}
			},
			error:function(){
				message_e("链接失败");
			}
		})
		return false;
	})

</script>


</script>

</body>
</html>