<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
	<title>OA</title>

	<meta charset="utf-8" />
	<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/css/zui.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/zui/lib/calendar/zui.calendar.css">
	<link rel="stylesheet" type="text/css" href="/oa/Public/css/core.css">
	
	<style type="text/css">
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
			
	<div class="main person index">
		<div class="contain">
			<ol class="breadcrumb">
			  	<li><a href="<?php echo U('Home/index/index');?>"><i class="icon icon-home"></i> 首页</a></li>
			  	<li><i class="icon icon-sitemap"></i> 权限配置</li>
			</ol>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-striped text-center">
						<tr>
							<td>模块</td>
							<td>
								导航名称
							</td>
							<td>
								路径
							</td>
						</tr>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["module"]); ?></td>
								<td><a href="###" onclick="list(<?php echo ($vo['id']); ?>)" data-toggle="modal" data-target="#myModal"><?php echo ($vo["menu"]); ?></a></td>
								<td><?php echo ($vo["path"]); ?></b></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal">
	  	<div class="modal-dialog">
	  		<div class="modal-header">
	  			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
	      		<h4 class="modal-title">权限配置</h4>
	    	</div>
	    	<div class="modal-content">
	      		<form action="<?php echo U('save');?>" method="post">
	      			<div id="depart"></div>
	      			<div class="text-center" style="padding:10px">
	      				<input type="hidden" name="menu" id="auth_menu" />
	      				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	      				<button type="submit" class="btn btn-primary">保存</button>
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

	function list(id){
		$('#auth_menu').val(id);
		data = {
			'id':id
		};
		$.ajax({
			data:data,
			url:"<?php echo U('model');?>",
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					$('#depart').html(data.list);
				}
			}
		})
	}

	$('form').submit(function(){
		var data = $(this).serialize();
		var action_url = $(this).attr('action');
		$.ajax({
			data:data,
			url:action_url,
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					message_s(data.message);
					$('#myModal').modal('hide');
				}else{
					message_e('权限设置失败');
				}
			}
		})
		return false;
	})
</script>

</body>
</html>