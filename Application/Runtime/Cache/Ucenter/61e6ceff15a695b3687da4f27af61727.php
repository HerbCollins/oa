<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	
    <title>人员管理</title>

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
                <li><i class="icon icon-group"></i> 人员管理</li>
            </ol>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="tool-btns">
							<div class="col-xs-5 col-md-5">
								<button type="button" class="boxer boxer-info" data-toggle="modal" data-target="#addStaff"><i class="icon icon-plus-sign"></i> 新增</button>
								<button type="button" onclick="for_disable()" class="boxer boxer-info"><i class="icon icon-minus-sign"></i> 禁用</button>

								<button type="button" onclick="for_delete()" class="boxer boxer-info"><i class="icon icon-remove-circle"></i> 删除</button>
								<button type="button" onclick="reset()" class="boxer boxer-info"><i class="icon icon-circle-o-notch"></i> 重置密码</button>
							</div>
							<div class="tool">
								<form action="<?php echo U('');?>" method="post">
									<div class="col-xs-4 col-md-4">
									  	<div class="input-group">
									 	 	<input type="text" placeholder="用户查找" name="key" class="form-control">
									  		<span class="input-group-btn">
									    		<button class="btn btn-default" type="submit"><i class="icon icon-search"></i></button>
									  		</span>
										</div>
									</div>
								</form>
							</div>
						</div>
						<table class="table table-hover">
							<thead>
								<tr>
									<th><input type="checkbox" class="check"></th>
									<th>姓名</th>
									<th>部门</th>
									<th>职务</th>
									<th>手机</th>
									<th>办公电话</th>
									<th>家庭住址</th>
									<th>状态</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($staff)): $i = 0; $__LIST__ = $staff;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($uid == $vo['id']) or ($vo['id'] == 1)): ?><tr>
										<td></td>
										<td><b><?php echo ($vo["name"]); ?></b></td>
										<td class="depart">
											<?php echo (getUserDepart($vo["id"])); ?>
										</td>
										<td><?php echo (getUserJob($vo["id"])); ?></td>
										<td><b><?php echo ($vo["phone"]); ?></b></td>
										<td>
											<?php if(empty($vo['tel'])): ?>-
											<?php else: ?>
												<?php echo ($vo["tel"]); endif; ?>
										</td>
										<td><?php echo ($vo["addr"]); ?></td>
										<td class="status" data-status="<?php echo ($vo['status']); ?>">
											
										</td>
										<td>
											<a href="###" onclick="allot(<?php echo ($vo["id"]); ?>)" class="a-icon-info" title="分配部门" data-toggle="modal" data-target="#allot"><i class="icon icon-sitemap"></i></a>
											<a href="<?php echo U('allotJob',array('uid'=>$vo['id']));?>" class="a-icon-info" title="分配职务"><i class="icon icon-user"></i></a>
											<a href="<?php echo U('edit',array('id'=>$vo['id']));?>" onclick="edit(this)" class="a-icon-info" title="编辑"><i class="icon icon-edit"></i></a>
											
										</td>
									</tr>
									<?php else: ?>
									<tr>
										<td><input type="checkbox" name="ids" value="<?php echo ($vo["id"]); ?>"></td>
										<td><b><?php echo ($vo["name"]); ?></b></td>
										<td class="depart">
											<?php echo (getUserDepart($vo["id"])); ?>
										</td>
										<td><?php echo (getUserJob($vo["id"])); ?></td>
										<td><b><?php echo ($vo["phone"]); ?></b></td>
										<td>
											<?php if(empty($vo['tel'])): ?>-
											<?php else: ?>
												<?php echo ($vo["tel"]); endif; ?>
										</td>
										<td><?php echo ($vo["addr"]); ?></td>
										<td class="status" data-status="<?php echo ($vo['status']); ?>">
											<?php if($vo['status'] == 1): ?><a href="###" data-toggle="tooltip" title="点击禁用" onclick="status(this,<?php echo ($vo["id"]); ?>)"><span class="color-info"><i class="icon icon-toggle-on"></i> 正常</span></a>
											<?php else: ?>
												<a href="###" data-toggle="tooltip" title="点击启用" onclick="status(this,<?php echo ($vo["id"]); ?>)"><span class="color-disabled"><i class="icon icon-toggle-off"></i> 禁用</span></a><?php endif; ?>
											</td>
										<td>
											<a href="###" onclick="allot(<?php echo ($vo["id"]); ?>)" class="a-icon-info" title="分配部门" data-toggle="modal" data-target="#allot"><i class="icon icon-sitemap"></i></a>
											<a href="<?php echo U('allotJob',array('uid'=>$vo['id']));?>" class="a-icon-info" title="分配职务"><i class="icon icon-user"></i></a>
											<a href="<?php echo U('edit',array('id'=>$vo['id']));?>" onclick="edit(this)" class="a-icon-info" title="编辑"><i class="icon icon-edit"></i></a>
											<a href="javascript:void(0);" onclick="delt(<?php echo ($vo['id']); ?>)" class="a-icon-info" title="删除"><i class="icon icon-remove-circle"></i></a>
										</td>
									</tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
                </div>
            </div>
        </div>
    </div> 
	
	<!-- 增加成员 modal -->
	<div class="modal fade" id="addStaff">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="icon icon-remove"></i></span><span class="sr-only">关闭</span></button>
			        <h4 class="modal-title">增加员工</h4>
					</div>
					<div class="modal-body">
		      		<form class="form-horizontal" id="staff" action="<?php echo U('add');?>" method="post">
					  	<div class="form-group">
						    <label for="UserAccount" class="col-sm-2">账号</label>
						    <div class="col-md-6 col-sm-10">
						      	<input type="text" class="input" data-type="request" name="name" id="UserAccount" placeholder="请输入登陆账号">
						    </div>
					  	</div>
					  	<div class="form-group">
						    <label for="StaffPhone" class="col-sm-2">手机</label>
						    <div class="col-md-6 col-sm-10">
						      	<input type="text" class="input" data-type="request" name="phone" id="StaffPhone" placeholder="请输入手机号">
						    </div>
						</div>
					  	<div class="form-group">
						    <label for="StaffTel" class="col-sm-2">电话</label>
						    <div class="col-md-6 col-sm-10">
						      	<input type="text" class="input" data-type="request" name="tel" id="StaffTel" placeholder="请输入办公电话">
						    </div>
						</div>
					  	<div class="form-group">
						    <label for="StaffAddr" class="col-sm-2">地址</label>
						    <div class="col-md-6 col-sm-10">
						      	<input type="text" class="input" data-type="request" name="addr" id="StaffAddr" placeholder="请输入家庭住址">
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      	<button type="submit" class="boxer boxer-info">增加</button>
						      	<button type="button" class="boxer boxer-info" data-dismiss="modal">取消</button>
						    </div>
						</div>
					</form>
				</div>
	    	</div>
	  	</div>
	</div>


	<div class="modal fade" id="allot">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	    		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="icon icon-remove"></i></span><span class="sr-only">关闭</span></button>
			        <h4 class="modal-title">分配部门</h4>
					</div>
					<div class="modal-body">
		      		<form class="form-horizontal" id="allot_depart" action="<?php echo U('allot');?>" method="post">
					  	<div class="form-group">
						    <label for="UserDepart" class="col-sm-2">选择部门</label>
						    <div class="col-md-6 col-sm-10">
						      	<select name="pid" id="UserDepart" class="slt">
						      		<option value="">请选择部门</option>
						      		<?php if(is_array($depart)): $i = 0; $__LIST__ = $depart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo['pname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						      	</select>
						      	<input type="hidden" name="uid" value="">
						    </div>
					  	</div>
						<div class="form-group">
						    <div class=" col-xs-12 text-right">
						      	<button type="button" class="boxer boxer-disabled" data-dismiss="modal">取消</button>
						      	<button type="submit" class="boxer boxer-info">确定</button>
						    </div>
						</div>
					</form>
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

	$(document).ready(function(){
		$(".input").focus(function(){
			$(this).removeClass("input-error");
		});
		$('[data-toggle="tooltip"]').tooltip({
			placement:"right",
			trigger:"hover"
		});
		

		$("#allot_depart").submit(function(){
			if(!request_check($(this))){
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
					if(data.status==1){
						message_s(data.message);
						$("#addStaff").modal('hide');
						setTimeout(function(){location.reload();},2000);
					}else{
						message_e(data.message);
					}
				}
			});
			return false;
		});
		$("#staff").submit(function(){
			if(!request_check($(this))){
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
					if(data.status==1){
						message_s(data.message);
						$("#allot").modal('hide');
						setTimeout(function(){location.reload();},2000);
					}else{
						message_e(data.message);
					}
				}
			});
			return false;
		});
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

	function allot(id){
		$("input[name='uid']").val(id);
	}


	function for_delete(){
		var id = $("input[name='ids']:checked").map(function(){
             return $(this).val();  
        }).get().join(',');
        if(id == "" || id == null){
        	message_e("请选择需要删除的用户");
        	return false;
        }

        delt(id);
	}
	function delt(k){
		data = {
			'id':k
		}

		$.ajax({
			data:data,
			url:"<?php echo (delete);?>",
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.status == 1){
					message_s('删除成功');
					window.location.href="<?php echo U('index');?>";
				}else{
					message_e('删除失败');
				}
			}
		})
	}

	function status(k,j){
		var status = $(k).parent().attr("data-status");
		data ={
        	'id':j
        }
		if(status==1){
	        var rst = disable(1,data);
	        if(rst == 1){
	        	 var html = '<a href="###" data-toggle="tooltip" title="点击启用"  onclick="status(this,'+j+')"><span class="color-disabled"><i class="icon icon-toggle-off"></i> 禁用</span></a>';
	        	$(k).parent().attr("data-status","2");
	        	$(k).parent().html(html);
	        }
		}else{
			var rst = able(1,data);
	        if(rst == 1){
	        	 var html = '<a href="###" data-toggle="tooltip" title="点击禁用"  onclick="status(this,'+j+')"><span class="color-info"><i class="icon icon-toggle-on"></i> 正常</span></a>';
	        	$(k).parent().attr("data-status","1");
	        	$(k).parent().html(html);
	        }
		}
	}

	function reset(){
		var id = $("input[name='ids']:checked").map(function(){
             return $(this).val();  
        }).get().join(',');
        if(id == "" || id == null){
        	message_e("请选择需要重置密码的用户");
        	return false;
        }
        data ={
        	'id':id
        }
        		console.log(data);
        $.ajax({
        	data:data,
        	url:"<?php echo U('reset');?>",
        	type:"post",
        	dataType:"json",
        	success:function(data){
        		if(data.status==1){
        			message_s(data.message);
        		}else{
        			message_e(data.message);
        		}
        	}
        });
	}

	function for_disable(){
		var id = $("input[name='ids']:checked").map(function(){
             return $(this).val();  
        }).get().join(',');
        if(id == "" || id == null){
        	message_e("请选择需要禁用的用户");
        	return false;
        }

        data ={
        	'id':id
        }
        disable(2,data);
	}

	function disable(style,data){
		flog = 0;
        $.ajax({
        	data:data,
        	url:"<?php echo U('disable');?>",
        	type:"post",
        	async: false,	// 关闭异步
        	dataType:"json",
        	success:function(data){
        		if(data.status==1){
        			if(style==2){
	        			var names = $("input[name='ids']:checked").map(function(){
	        				var id = $(this).val();
				            var this_tr = $(this).parent().parent();
				            var html = '<a href="###" data-toggle="tooltip" title="点击启用"  onclick="status(this,'+id+')"><span class="color-disabled"><i class="icon icon-toggle-off"></i> 禁用</span></a>';
				            var statu = this_tr.find(".status");
				            statu.attr("data-status","2");
				            statu.html(html);
				        })
        			}
        			message_s(data.message);
        			flog = 1;
        		}else{
        			message_e(data.message);
        		}
        	}
        });
        if(flog == 1)
        	return 1;
        else
        	return 0;
	}

	function able(style,data){
		flog = 0;
        $.ajax({
        	data:data,
        	url:"<?php echo U('able');?>",
        	type:"post",
        	async: false,	// 关闭异步
        	dataType:"json",
        	success:function(data){
        		if(data.status==1){
        			if(style==2){
	        			var names = $("input[name='ids']:checked").map(function(){
	        				var id = $(this).val();
				            var this_tr = $(this).parent().parent();
				            var html = '<a href="###" onclick="status(this,'+id+')"><span class="color-info"><i class="icon icon-toggle-on"></i> 正常</span></a>';
				            var statu = this_tr.find(".status");
				            statu.attr("data-status","1");
				            statu.html(html);
				        })
        			}
        			message_s(data.message);
        			flog = 1;
        		}else{
        			message_e(data.message);
        			flog = 0;
        		}
        	}
        });
        if(flog == 1)
        	return 1;
        else
        	return 0;
	}
</script>



</body>
</html>