<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>职位管理</title>

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
                <li><a href="<?php echo U('Index/index');?>"><i class="icon icon-sitemap"></i> 部门信息</a></li>
                <li><span>职位管理</span></li>
            </ol>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="tool-btns">
						<div class="col-xs-5 col-md-5">
							<button type="button" class="boxer boxer-info" data-toggle="modal" data-target="#editJob" onclick="add()"><i class="icon icon-plus-sign"></i> 新增</button>
							<button type="button" onclick="for_del()" class="boxer boxer-info"><i class="icon icon-minus-sign"></i> 删除</button>
						</div>
					</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th><input type="checkbox" class="check"></th>
								<th>职位名称</th>
								<th>所属部门</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(empty($list)): ?><tr class="text-center">
									<td colspan="4">暂无数据</td>
								</tr>
							<?php else: ?>
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><input type="checkbox" name="ids" value="<?php echo ($vo["id"]); ?>"></td>
										<td class="jobname"><b><?php echo ($vo["name"]); ?></b></td>
										<td class="depart" data-pid="<?php echo ($vo["pid"]); ?>">
											<?php echo (getJobName($vo["pid"])); ?>
										</td>
										<td>
											<a href="###" onclick="edit(this,<?php echo ($vo['id']); ?>)" class="a-icon-info" title="编辑" data-toggle="modal" data-target="#editJob"><i class="icon icon-edit"></i></a>
											<a href="###" onclick="del(<?php echo ($vo['id']); ?>)" class="a-icon-info" title="删除"><i class="icon icon-remove"></i></a>
										</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div> 
	
	<!-- 增加职位 modal -->
	<div class="modal fade" id="editJob">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="icon icon-remove"></i></span><span class="sr-only">关闭</span></button>
			        <h4 class="modal-title">编辑职位</h4>
					<div class="modal-body">
						<div class="container">
							<form action="<?php echo U('edit');?>" method="post" id="addForm">
							  	<div class="form-group">
								    <label for="jobname" class="col-sm-2">职位名称</label>
								    <div class="col-md-6 col-sm-10">
								      	<input type="text" class="input" data-type="request" name="name" id="jobname" placeholder="请输入职位名称" />
										<input type="hidden" value="<?php echo ($did); ?>" name="did">
								    </div>	
							  	</div>
							  	<div class="form-group">
								    <label for="StaffPhone" class="col-sm-2">上级职位</label>
								    <select name="pid" class="pids">
								    	<option value="0">顶级职位</option>
								    	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								    </select>
								</div>
								<div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								    	<input type="hidden" name="options" value="">
								    	<input type="hidden" name="id" value="">
								      	<button type="submit" class="boxer boxer-info">增加</button>
								      	<button type="button" class="boxer boxer-info" data-dismiss="modal">取消</button>
								    </div>
								</div>
							</form>
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
	$("form").submit(function(){
		data = $(this).serialize();
		urls = $(this).attr("action");
		$.ajax({
			data:data,
			url:urls,
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					message_s(data.message);
					$("#editJob").modal('hide');
					setTimeout(function(){location.reload();},2000);
				}else{
					message_e(data.message);
				}
			}
		})
		return false;
	});
	function edit(k,id){
		obj = $(k);
		name = obj.parent().parent().find(".jobname").text();
		pid = obj.parent().parent().find(".depart").data('pid');
		op = $(".pids").find("option");

		// 初始化
		$.each(op,function(){
			$(this).removeAttr("disabled","disabled");
			if($(this).val()==pid){
				$(this).attr("selected","selected");
			}
			if($(this).val()==id){
				$(this).attr("disabled","disabled");
			}

		})
		$("#jobname").val(name);
		$("input[name='options']").val("edit");
		$("input[name='id']").val(id);
	}
	function add(){
		$("input[name='options']").val("add");
	}

	function del(id){
		if(!confirm("确定删除此职位吗？")){
			return false;
		}
		data = {
			'id':id
		}
		$.ajax({
			data:data,
			url:"<?php echo U('delete');?>",
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status ==1){
					message_s(data.message);
					setTimeout(function(){location.reload();},2000);
				}else{
					message_e(data.message);
				}
			}
		})
	}

	function for_del(){
		var id = $("input[name='ids']:checked").map(function(){
             return $(this).val();  
        }).get().join(',');
        if(id == "" || id == null){
        	message_e("请选择需要删除的职位");
        	return false;
        }
        del(id);
	}
</script>


</script>

</body>
</html>