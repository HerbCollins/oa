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
					<div class="tool">
						<div class="col-xs-3 col-sm-2 col-md-1 text-right">
							<label>物品类型</label>
						</div>
						<div class="col-xs-3 col-sm-2 col-md-1">
							<select class="form-control">
								<option>类型</option>
							</select>
						</div>
						<div class="col-xs-3 col-sm-2 col-md-1 text-right">
							<label>物品状态</label>
						</div>
						<div class="col-xs-3 col-sm-2 col-md-1">
							<select class="form-control">
								<option>状态</option>
							</select>
						</div>
					</div>
					<table class="table text-center table-striped table-hover">
						<tr>
							<th class="text-center">序号</th>
							<th class="text-center">名称</th>
							<th class="text-center">剩余数量</th>
							<th class="text-center">类型</th>
							<th class="text-center">借用状态</th>
							<th class="text-center">归回时间</th>
							<th class="text-center">申请</th>
						</tr>
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($i); ?></td>
								<td><?php echo ($vo["name"]); ?></td>
								<td><?php echo ($vo["count"]); ?></td>
								<td><?php echo ($vo["type"]); ?></td>
								<td>-</td>
								<td>-</td>
								<td><button class="btn btn-info" onclick="tid(<?php echo ($vo['id']); ?>)" data-toggle="modal" data-target="#myModal">申请</button></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
				</div>
			</div>

<!-- 对话框HTML -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content"style="padding:40px 10px;">
      	<form class="form-horizontal" id="applyDeal" action="<?php echo U('apply');?>" method="post" >
		  	<div class="form-group">
			    <label for="number" class="col-sm-2">申请数量</label>
			    <div class="col-md-6 col-sm-10">
			      	<input type="number" class="input" data-type="request" name="number" id="number" placeholder="请输入申请数量">
			      	<input type="hidden" name="tid" value="">
			    </div>
		  	</div>
			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
			      	<button type="submit" class="btn btn-info">申请</button>
			    </div>
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
	function tid(k){
		$('input[name="tid"]').val(k);
	}
	$(document).ready(function(){
		
		$('#applyDeal').submit(function(){
			$num = parseInt($('input[name="number"]').val());
			if($num == 0){
				message_e('请填写数量');
				return false;
			}
			tid = $('input[name="tid"]').val();
			data = {
				'number':$num,
				'tid':tid
			}
			$url = $(this).attr('action');
			$.ajax({
				data:data,
				url:$url,
				type:"post",
				dataType:"json",
				success:function(data){
					if(data.status == 1){
						message_s(data.message);
						$('#myModal').modal('hide')
					}else{
						message_e(data.message);
					}
				}
			})
			return false;
		})
	})
</script>

</body>
</html>